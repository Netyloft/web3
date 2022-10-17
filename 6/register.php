<form method="post">
    <input type="text" name="login" placeholder="Логин">
    <input type="text" name="password" placeholder="Пароль">
    <input type="submit" value="Регистрация">
</form>

<?php

require_once 'Auth.php';

if (isset($_POST['login']) && isset($_POST['password'])){
    $auth = new Auth();
    $res = $auth->register($_POST['login'], $_POST['password']);

    if($res){
        header("Location: " . 'main.php');
    }
}