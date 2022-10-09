<form method="post">
    <input type="text" name="user_login" placeholder="Логин">
    <input type="text" name="user_password" placeholder="Пароль">
    <input type="submit" value="Авторизация">
</form>

<?php

$user_name = $_POST['user_login'];
$user_password = $_POST['user_password'];

if (trim($user_name) !== "") {

    $connection = new mysqli("localhost", $user_name, $user_password, "web");

    if ($connection->connect_errno) {
        printf("Неверный логин или пароль");
        exit();
    }

    create_table($connection);
    add_data($connection);
    $connection->close();

    header('Location: main.php');
}


function create_table($connection)
{
    $sql = "DROP TABLE IF EXISTS l1";
    $connection->query($sql);


    $sql = "create table l1(id bigint, title varchar(128), body text)";
    $connection->query($sql);
}

function add_data($connection)
{

    $file = "1.csv";
    $file_data = fopen($file, "r");
    $cont = fread($file_data, filesize($file));
    $pieces = explode("#", $cont);

    for ($i = 0; $i < count($pieces); $i++) {
        $text = explode("|", $pieces[$i]);
        $title = trim($text[0]);
        $body = trim($text[1]);
        $sql = "insert into l1 (id, title, body) values ($i, '$title', '$body')";

        if ($i < 15) {
            $connection->query($sql);
        }

    }

}

?>

