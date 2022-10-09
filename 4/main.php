<?php


$banner = require_once(realpath('banners/banner.php'));

$random_banner_id = rand(0, banner_count() - 1);
echo banner_show($random_banner_id);

echo '<br>';
echo '<a href="statistics.php">Статистика</a>';



