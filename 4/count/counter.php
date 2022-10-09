<?php

const BANNER_CLICK_PATH = "count/banner_click.csv";
const BANNER_DISPLAY_PATH = "count/banner_display.csv";
const PAGE_ORDER_PATH = "count/page_order.csv";
const PAGE_VISIT_PATH = "count/page_visit.csv";

function increment_banner_click(string $id)
{
    increment($id, '../'.BANNER_CLICK_PATH);
}

function increment_banner_display(string $id)
{
    increment($id, BANNER_DISPLAY_PATH);
}

function increment_page_order(string $id)
{
    increment($id, '../'.PAGE_ORDER_PATH);
}

function increment_page_visit(string $id)
{
    increment($id, '../'.PAGE_VISIT_PATH);
}

function increment(string $id, string $path)
{
    $data = unserialize(file_get_contents($path));

    $i = $data[$id];
    $i = $i + 1;
    $data[$id] = $i;

    file_put_contents($path, serialize($data));
}