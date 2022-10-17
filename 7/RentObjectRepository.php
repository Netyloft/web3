<?php
require_once '../base/BaseRepository.php';

class RentObjectRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct('l7_rent_object');
    }


    //1 Список объектов указанного типа, упорядоченный по возрастанию цены;
    public function get_by_type_order_price(int $type_id)
    {
        $sql = "select * from $this->table_name where type_id = $type_id order by price asc";
        return $this->connection->query($sql)->fetch_all();
    }

    //1 Список объектов указанного типа, упорядоченный по убыванию по алфавиту;
    public function get_by_type_order_name(int $type_id)
    {
        $sql = "select * from $this->table_name where type_id = $type_id order by name desc";
        return $this->connection->query($sql)->fetch_all();
    }

    //3 Список объектов, которые не сдавались;
    public function get_dont_rent()
    {
        $sql = "
            select l7_rent_object.*
            from l7_rent_object
            left join l7_rent_info on l7_rent_info.object_id = l7_rent_object.id
            where l7_rent_info.id is null";
        return $this->connection->query($sql)->fetch_all();
    }

    //4 Список объектов, которые сдавались более 3 раз;
    public function get_rent_more_3()
    {
        $sql = "
            select l7_rent_object.*, count(l7_rent_object.id) as coun
            from l7_rent_object
            left join l7_rent_info on l7_rent_info.object_id = l7_rent_object.id
            group by id, type_id, price, name
            having coun > 3";
        return $this->connection->query($sql)->fetch_all();
    }


    //5 Список объектов, которые сдавались в аренду больше 2 раз на срок более 1 года со столбцом количество таких аренд.
    public function get_rent_more_2_and_year()//todo
    {
    $sql = "
            select l7_rent_object.*, count(l7_rent_object.id) as coun
            from l7_rent_object
            inner join l7_rent_info on l7_rent_info.object_id = l7_rent_object.id
            where l7_rent_info.rent_period > 12
            group by id, type_id, price, name
            having coun > 2";
        return $this->connection->query($sql)->fetch_all();
    }


    //6 Список объектов со столбцами, содержащими количество сдач каждого объекта и выплаченную общую сумму.
    public function get_all_and_count_and_sum()
    {
        $sql = "
            select l7_rent_object.*, count(l7_rent_object.id) count, sum(l7_rent_object.price) sum
            from l7_rent_object
            left join l7_rent_info on l7_rent_object.id = l7_rent_info.object_id
            group by id, type_id, price, name";
        return $this->connection->query($sql)->fetch_all();
    }


    //8 Список объектов (с указанием типа), сданных в аренду в заданном квартале определенного года. Упорядочить по дате начала аренды.
    public function get_quarter($type_id,$year, $quarter){

        $one_year = $year.'-01-01';
        $two_year = $year.'-12-31';

        $sql = "
            select l7_rent_object.*, l7_rent_info.rent_start_date
            from l7_rent_object
            inner join l7_rent_info on l7_rent_object.id = l7_rent_info.object_id
            where l7_rent_object.type_id = $type_id and l7_rent_info.rent_start_date between '$one_year' and '$two_year' and quarter(l7_rent_info.rent_start_date) = $quarter
            order by l7_rent_info.rent_start_date asc";
        return $this->connection->query($sql)->fetch_all();
    }

    //10 Изменить цену аренды у объектов заданного типа: увеличить на 12%.
    public function update_price(int $type_id)
    {
        $sql = "update l7_rent_object set price = price+price*0.12 where type_id = $type_id";
        $this->connection->query($sql);
    }
}