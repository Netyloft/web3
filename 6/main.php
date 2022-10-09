<?php

require_once 'Auth.php';

$auth = new Auth();
//$auth ->register('олеdааг','олег');
$auth ->login('олег','олег');
$ff = $auth -> isAuth();

echo $ff;