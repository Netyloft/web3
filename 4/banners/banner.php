<?php

require_once(realpath("count/counter.php"));

function banner_show($id){
    increment_banner_display($id);
    return '<a href="banners/banner_redirect.php?banner_id='.$id.'"><img src="banners/'.$id.'.gif"></a>';
}

function banner_count(): int
{
    $dir = opendir(__DIR__);
    $count = 0;

    while (false !== ($file = readdir($dir))) {

        if (strpos($file, '.gif', 1)) {
            $count++;
        }
    }
    return $count;
}