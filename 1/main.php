<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <input type="text" name="field" placeholder="Название или год">
    <input type="submit" value="Отобразить">
</form>

<?php

$id = $_POST['id'];
$year = $_POST['field'];

$connection = new mysqli("localhost", "root", "", "web");

if(trim($id) != "")
    get_by_id($id, $connection);

if(trim($year) != "")
    get_from_text($year, $connection);

function get_by_id($id, $connection)
{

    $sql = "select * from l1 where id = $id";
    $result = $connection->query($sql);

    if ($result -> num_rows <= 0) {
        echo "Этот идентификатор нигде не встречается";
        return;
    }

    $row = $result -> fetch_assoc();

    show($row["id"], $row["title"], $row["body"]);
}

function get_from_text($year, $connection)
{

    $sql = "select * from l1 where body like '%$year%'";
    $result = $connection->query($sql);

    if ($result -> num_rows <= 0) {
        echo "Этот годр нигде не встречается";
        return;
    }

    $row = $result -> fetch_all();

    foreach ($row as $key_click => $item){
        show($item[0], $item[1], $item[2]);
    }


}

function show($id, $title, $body){
    $src = "img/$id.jpg";

    echo "<img src='$src'> <br>";
    echo "<h1> $title</h1> <br>";
    echo $body;
}
?>

