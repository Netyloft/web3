<?php

require_once(realpath('count/counter.php'));

$count_banner_click = unserialize(file_get_contents(BANNER_CLICK_PATH));
$count_banner_display = unserialize(file_get_contents(BANNER_DISPLAY_PATH));
$count_page_visit = unserialize(file_get_contents(PAGE_VISIT_PATH));
$count_page_order = unserialize(file_get_contents(PAGE_ORDER_PATH));


ksort($count_banner_display);
ksort($count_page_visit);

foreach ($count_banner_display as $key_display => $banner_display){
    foreach ($count_banner_click as $key_click => $banner_click){

        if($key_display === $key_click){
            echo 'CTR для '.$key_display.' сайта: '.(round(($banner_click / $banner_display) * (100),1)).'  (Показы: '.$banner_display.', Переходы: '.$banner_click.')<br>';
        }
    }
}

echo  '<br>';

foreach ($count_page_visit as $key_visit => $page_visit){
    foreach ($count_banner_click as $key_click => $banner_click){

        if($key_visit === $key_click){
            echo 'CTI для '.$key_visit.' сайта: '.(round((($page_visit - $banner_click) / $page_visit) * (100),1)).'  (Заинтерисованные посещения: '.($page_visit - $banner_click).', Посещения: '.$page_visit.')<br>';
        }
    }
}

echo  '<br>';

foreach ($count_page_visit as $key_visit => $page_visit){
    foreach ($count_page_order as $key_order => $page_order){

        if($key_visit === $key_order){
            echo 'CTB для '.$key_visit.' сайта: '.(round(($page_order / $page_visit) * (100),1)).'  (Посещения: '.$page_visit.', Покупки: '.$page_order.')<br>';
        }
    }
}
