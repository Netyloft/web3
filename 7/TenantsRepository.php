<?php
require_once '../base/BaseRepository.php';

class TenantsRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct('l7_tenants');
    }


    //2 Список арендаторов, которым сдавались объекты с указанием количества аренд;
    public function get_all_and_count()
    {
        $sql = '
            select l7_tenants.*, count(l7_tenants.id) from l7_tenants
            inner join l7_rent_info on l7_tenants.id = l7_rent_info.tenants_id
            group by id, name
        ';
        return $this->connection->query($sql)->fetch_all();
    }


    //7 Список арендаторов с указанием, сколько раз он арендовал объекты и среднего срока аренды;
    public function get_all_count_and_avg(){
        $sql = '
            select l7_tenants.*, count(l7_tenants.id) count, round(avg(l7_rent_info.rent_period),1) avg
            from l7_tenants
            inner join l7_rent_info on l7_tenants.id = l7_rent_info.tenants_id
            group by id, name
        ';
        return $this->connection->query($sql)->fetch_all();
    }

    //9 Список арендаторов с указанием количества различных арендуемых объектов.
    public function get_all_and_uniqu(){
        $sql = '
            select l7_tenants.*, count(tenants_id)
            from(
                select distinct object_id, tenants_id
                from l7_rent_info) tt
            inner join l7_tenants on tt.tenants_id = l7_tenants.id
            group by tenants_id
        ';
        return $this->connection->query($sql)->fetch_all();
    }
}