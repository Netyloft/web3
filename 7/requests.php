<?php

require_once 'RentTypeRepository.php';
require_once 'TenantsRepository.php';
require_once 'RentObjectRepository.php';
require_once 'RentRepository.php';

$rent_type_repository = new RentTypeRepository();
$tenants_repository = new TenantsRepository();
$rent_object_repository = new RentObjectRepository();
$rent_repository = new RentRepository();

echo '<form method="post">
    <input type="text" name="type_id" placeholder="Идентификатор типа">
    <button name="1_1" type="submit" value="true">Список объектов упорядоченный по убыванию по алфавиту</button>
    </form>';

if(isset($_POST['1_1'])){

    $data = $rent_object_repository->get_by_type_order_name((int)$_POST['type_id']);

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <input type="text" name="type_id" placeholder="Идентификатор типа">
    <button name="1_2" type="submit" value="true">Список объектов упорядоченный по возрастанию цены</button>
    </form>';

if(isset($_POST['1_2'])){

    $data = $rent_object_repository->get_by_type_order_price((int)$_POST['type_id']);

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="2" type="submit" value="true">Список арендаторов, которым сдавались объекты с указанием количества аренд</button>
    </form>';

if(isset($_POST['2'])){

    $data = $tenants_repository->get_all_and_count();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Имя</th><th>Количество</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="3" type="submit" value="true">Список объектов которые не сдавались</button>
    </form>';

if(isset($_POST['3'])){

    $data = $rent_object_repository->get_dont_rent();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="4" type="submit" value="true">Список объектов, которые сдавались более 3 раз</button>
    </form>';

if(isset($_POST['4'])){

    $data = $rent_object_repository->get_rent_more_3();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="5" type="submit" value="true">Список объектов, которые сдавались в аренду больше 2 раз на срок более 1 года со
столбцом количество таких аренд.</button>
    </form>';

if(isset($_POST['5'])){

    $data = $rent_object_repository->get_rent_more_2_and_year();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th><th>Количество</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="6" type="submit" value="true">Список объектов со столбцами, содержащими количество сдач каждого объекта и
выплаченную общую сумму.</button>
    </form>';

if(isset($_POST['6'])){

    $data = $rent_object_repository->get_all_and_count_and_sum();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th><th>Количество сдач</th><th>Сумма</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td><td>$value[5]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="7" type="submit" value="true">Список арендаторов с указанием, сколько раз он арендовал объекты и среднего
срока аренды</button>
    </form>';

if(isset($_POST['7'])){

    $data = $tenants_repository->get_all_count_and_avg();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Имя</th><th>Количество</th><th>Средний срок аренды</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <button name="9" type="submit" value="true">Список арендаторов с указанием количества различных арендуемых объектов.</button>
    </form>';

if(isset($_POST['9'])){

    $data = $tenants_repository->get_all_and_uniqu();

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Имя</th><th>Количество</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}

echo '<form method="post">
    <input type="text" name="type_id" placeholder="Идентификатор типа">
    <input type="text" name="year" placeholder="Год">
    <input type="text" name="quarter" placeholder="Квартал">
    <button name="8" type="submit" value="true">Список объектов (с указанием типа), сданных в аренду в заданном квартале
определенного года. Упорядочить по дате начала аренды.</button>
    </form>';

if(isset($_POST['8'])){

    $data = $rent_object_repository->get_quarter($_POST['type_id'],$_POST['year'],$_POST['quarter']);

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th><th>Дата начала аренды</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td>";
    }
    echo "</table>";
    echo "<br><br><br>";
}