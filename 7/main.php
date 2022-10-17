<?php

require_once 'RentTypeRepository.php';
require_once 'TenantsRepository.php';
require_once 'RentObjectRepository.php';
require_once 'RentRepository.php';

$rent_type_repository = new RentTypeRepository();
$tenants_repository = new TenantsRepository();
$rent_object_repository = new RentObjectRepository();
$rent_repository = new RentRepository();

function create_tenants_table($data)
{
    echo "<div>";

    echo 'Арендаторы';

    echo '<form method="post">
    <input type="text" name="name" placeholder="Имя">
    <button name="tenants" type="submit" value="true">Добавить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <input type="text" name="name" placeholder="Имя">
    <button name="tenants" type="submit" value="true">Обновить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <button name="tenants" type="submit" value="true">Удалить</button>
    </form>';

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Имя</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td></tr>";
    }

    echo "</table>";
    echo "</div>";
    echo '<br><br><br>';
}

function create_rent_object_table($data)
{
    echo "<div>";

    echo 'Объекты аренды';

    echo '<form method="post">
    <input type="text" name="type_id" placeholder="Идентификатор типа">
    <input type="text" name="price" placeholder="Цена">
    <input type="text" name="name" placeholder="Название">
    <button name="rent_object" type="submit" value="true">Добавить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <input type="text" name="type_id" placeholder="Идентификатор типа">
    <input type="text" name="price" placeholder="Цена">
    <input type="text" name="name" placeholder="Название">
    <button name="rent_object" type="submit" value="true">Обновить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <button name="rent_object" type="submit" value="true">Удалить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="type_id" placeholder="Идентификатор типа">
    <button name="rent_object_price_up" type="submit" value="true">Увеличить на 12%</button>
    </form>';

    echo "<table border=\"1\">";

    echo "<tr><th>id</th><th>Тип</th><th>Цена</th><th>Название</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td>";
    }

    echo "</table>";
    echo "</div>";
    echo '<br><br><br>';

}

function create_rent_object_type_table($data)
{
    echo "<div>";

    echo 'Тип объектов аренды';

    echo '<form method="post">
    <input type="text" name="name" placeholder="Имя">
    <button name="rent_object_type" type="submit" value="true">Добавить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <input type="text" name="name" placeholder="Имя">
    <button name="rent_object_type" type="submit" value="true">Обновить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <button name="rent_object_type" type="submit" value="true">Удалить</button>
    </form>';

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>Название</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td></tr>";
    }

    echo "</table>";
    echo "</div>";
    echo '<br><br><br>';

}

function create_rent_info_table($data)
{
    echo "<div>";

    echo '<form method="post">
    <input type="text" name="object_id" placeholder="Идентификатор объекта">
    <input type="text" name="tenants_id" placeholder="Идентификатор арендатора">
    <input type="date" name="rent_start_date" placeholder="Дата начала аренды">
    <input type="text" name="rent_period" placeholder="Длительность аренды">
    <button name="rent_info" type="submit" value="true">Добавить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <input type="text" name="object_id" placeholder="Идентификатор объекта">
    <input type="text" name="tenants_id" placeholder="Идентификатор арендатора">
    <input type="date" name="rent_start_date" placeholder="Дата начала аренды">
    <input type="text" name="rent_period" placeholder="Длительность аренды">
    <button name="rent_info" type="submit" value="true">Обновить</button>
    </form>';

    echo '<form method="post">
    <input type="text" name="id" placeholder="Идентификатор">
    <button name="rent_info" type="submit" value="true">Удалить</button>
    </form>';

    echo "<table border=\"1\">";
    echo "<tr><th>id</th><th>id Объекта</th><th>id Арендатора</th><th>Дата начала аренды</th><th>Длительность аренды</th></tr>";

    foreach ($data as $k => $value) {
        echo "<tr><td>$value[0]</td><td>$value[1]</td><td>$value[2]</td><td>$value[3]</td><td>$value[4]</td></tr>";
    }

    echo "</table>";
    echo "</div>";
    echo '<br><br><br>';
}

if (isset($_POST['tenants'])) {

    if (isset($_POST['id']) && isset($_POST['name'])) {
        $tenants_repository->update(['id' => (int)$_POST['id'], 'name' => $_POST['name']]);
        unset($_POST['id']);
        unset($_POST['name']);
    }


    if (isset($_POST['name'])) {
        $tenants_repository->create(['name' => $_POST['name']]);
        unset($_POST['name']);
    }


    if (isset($_POST['id'])) {
        $tenants_repository->delete((int)$_POST['id']);
        unset($_POST['id']);
    }

    unset($_POST['tenants']);
}

if (isset($_POST['rent_object'])) {

    if (isset($_POST['id']) && isset($_POST['type_id']) && isset($_POST['price']) && isset($_POST['name'])) {
        $rent_object_repository->update(['id' => (int)$_POST['id'], 'type_id' => (int)$_POST['type_id'], 'price' => $_POST['price'], 'name' => $_POST['name']]);
        unset($_POST['id']);
        unset($_POST['name']);
        unset($_POST['type_id']);
        unset($_POST['price']);
        unset($_POST['name']);
    }


    if (isset($_POST['type_id']) && isset($_POST['price']) && isset($_POST['name'])) {
        $rent_object_repository->create(['type_id' => (int)$_POST['type_id'], 'price' => (double)$_POST['price'], 'name' => $_POST['name']]);
        unset($_POST['name']);
        unset($_POST['type_id']);
        unset($_POST['price']);
        unset($_POST['name']);
    }


    if (isset($_POST['id'])) {
        $rent_object_repository->delete((int)$_POST['id']);
        unset($_POST['id']);
    }

    unset($_POST['rent_object']);
}

if (isset($_POST['rent_object_type'])) {

    if (isset($_POST['id']) && isset($_POST['name'])) {
        $rent_type_repository->update(['id' => (int)$_POST['id'], 'name' => $_POST['name']]);
        unset($_POST['id']);
        unset($_POST['name']);
    }


    if (isset($_POST['name'])) {
        $rent_type_repository->create(['name' => $_POST['name']]);
        unset($_POST['name']);
    }


    if (isset($_POST['id'])) {
        $rent_type_repository->delete((int)$_POST['id']);
        unset($_POST['id']);
    }

    unset($_POST['rent_object_type']);
}

if (isset($_POST['rent_info'])) {


    if (isset($_POST['id']) && isset($_POST['object_id']) && isset($_POST['tenants_id']) && isset($_POST['rent_start_date']) && isset($_POST['rent_period'])) {
        $rent_repository->update(['id' => (int)$_POST['id'], 'object_id' => (int)$_POST['object_id'], 'tenants_id' => (int)$_POST['tenants_id'], 'rent_start_date' => $_POST['rent_start_date'], 'rent_period' => (int)$_POST['rent_period']]);
    }


    if (isset($_POST['type_id']) && isset($_POST['price']) && isset($_POST['name'])) {
        $rent_repository->create(['object_id' => (int)$_POST['object_id'], 'tenants_id' => (int)$_POST['tenants_id'], 'rent_start_date' => $_POST['rent_start_date'], 'rent_period' => (int)$_POST['rent_period']]);
    }


    if (isset($_POST['id'])) {
        $rent_object_repository->delete((int)$_POST['id']);
    }

}

if (isset($_POST['rent_object_price_up'])) {
    $rent_object_repository->update_price((int)$_POST['type_id']);
}

create_tenants_table($tenants_repository->get_all());
create_rent_object_table($rent_object_repository->get_all());
create_rent_object_type_table($rent_type_repository->get_all());
create_rent_info_table($rent_repository->get_all());