<?php

require_once 'ProductUserRepository.php';
require_once 'Auth.php';

$auth = new Auth();
$user_id = $auth->is_auth();

if(!$user_id){
    header("Location: " . 'login.php');
}

echo '<a href="http://localhost/web3/6/main.php">Главная</a><br>';

$product_repository = new ProductUserRepository();

if (isset($_POST['product_user_id'])) {
    $product_repository->delete((int)$_POST['product_user_id']);
    unset($_POST['product_user_id']);
}

$data = $product_repository->get_by_user_id($user_id);
foreach ($data as $key => $value) {
    echo '<form method="post">';
    echo $value[2] . ' ' . $value[3] . '
    <button name="product_user_id" type="submit" value="' . $value[0] . '">Удалить</button>';
    echo '</form>';
}