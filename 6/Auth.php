<?php

class Auth
{
    private bool $isAuth;
    private mysqli $connection;

    public function __construct()
    {
        $this->isAuth = false;
        $this->connection = new mysqli("localhost", 'root', '', "web");
    }

    public function register(string $login, string $password)
    {
        $sql = "insert into user (login, password) values ('$login', '$password')";
        if ($this->connection->query($sql) != 1) {
            echo 'Пользователь с таким логином уже существует';
        }
    }

    public function login(string $login, string $password)
    {
        $sql = "select * from user where login = '$login' and password = '$password'";

        if ($this->connection->query($sql)->num_rows != 1) {
            echo 'Пользователь с таким именем не найден';
            return;
        }

        $this->isAuth = true;
    }

    public function isAuth(): bool
    {
        return $this->isAuth;
    }
}