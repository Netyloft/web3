<?php

require_once 'Auth.php';

$auth = new Auth();
$user_id = $auth->is_auth();

if(!$user_id){
    echo '<a href="http://localhost/web3/6/login.php">Авторизация</a><br>';
    echo '<a href="http://localhost/web3/6/register.php">Регистрация</a><br>';
}else{
    echo '<a href="http://localhost/web3/6/logout.php">Выход</a><br>';

}


echo '<a href="http://localhost/web3/6/product.php">Список товаров</a><br>';
echo '<a href="http://localhost/web3/6/user_product.php">Корзина</a><br>';


