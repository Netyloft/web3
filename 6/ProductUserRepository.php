<?php

require_once '../base/BaseRepository.php';

class ProductUserRepository extends BaseRepository
{

    public function __construct()
    {
        parent::__construct('l6_user_product');
    }

    public function get_by_user_id(int $user_id){
        $sql = "
            select l6_user_product.id, l6_product.id, l6_product.name, l6_product.price from  l6_user_product
            inner join l6_product on l6_user_product.product_id = l6_product.id
            where user_id = $user_id
            ";

        return $this->connection->query($sql)->fetch_all();
    }
}