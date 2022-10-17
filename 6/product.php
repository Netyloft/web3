<?php

require_once 'ProductRepository.php';
require_once 'ProductUserRepository.php';
require_once 'Auth.php';

$auth = new Auth();
$user_id = $auth->is_auth();

if(!$user_id){
    header("Location: " . 'login.php');
}

echo '<a href="http://localhost/web3/6/main.php">Главная</a><br>';

$product_repository = new ProductUserRepository();

if (isset($_POST['product_id'])){
    $product_repository->create(['product_id' => (int)$_POST['product_id'], 'user_id' => $user_id]);
    unset($_POST['product_id']);
}

$data_rep = new ProductRepository();
$data = $data_rep->get_all();

foreach ($data as $key => $value){

    echo '<form method="post">';
    echo $value[2].' '.$value[6].'
    <button name="product_id" type="submit" value="'.$value[0].'">Добавить</button>';
    echo '</form>';
}

