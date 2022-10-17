<form method="post">
    <input type="text" name="login" placeholder="Логин">
    <input type="text" name="password" placeholder="Пароль">
    <input type="submit" value="Авторизация">
</form>

<?php
echo '<a href="http://localhost/web3/6/register.php">Регистрация</a><br>';

require_once 'Auth.php';

if (isset($_POST['login']) && isset($_POST['password'])){
    $auth = new Auth();
    $res = $auth->login($_POST['login'], $_POST['password']);

    if($res){
        header("Location: " . 'main.php');
    }
}
