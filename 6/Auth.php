<?php

class Auth
{
    private mysqli $connection;

    public function __construct()
    {
        $this->connection = new mysqli("localhost", 'root', '', "web");
    }

    public function register(string $login, string $password)
    {
        $sql = "insert into l6_user (login, password) values ('$login', '$password')";
        if ($this->connection->query($sql) != 1) {
            echo 'Пользователь с таким логином уже существует';
            return false;
        }

        return true;
    }

    public function login(string $login, string $password)
    {
        $sql = "select * from l6_user where login = '$login' and password = '$password'";

        if ($this->connection->query($sql)->num_rows != 1) {
            echo 'Пользователь с таким именем не найден';
            return false;
        }

        $res = $this->connection->query($sql)->fetch_assoc();

        setrawcookie("user_id", $res['id']);
        return true;
    }

    public function logout()
    {
        setrawcookie("user_id");
    }

    public function is_auth()
    {
        if($_COOKIE['user_id'] !== null)
            return $_COOKIE['user_id'];

        return false;
    }
}