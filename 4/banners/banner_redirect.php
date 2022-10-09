<?php

require_once(realpath("../count/counter.php"));

if (isset($_GET["banner_id"])) {
    $id = $_GET["banner_id"];

    increment_banner_click($id);

    header("Location: " . '../pages/'.$id.'.php');
}
