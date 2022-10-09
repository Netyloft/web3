<?php

function call($id){
    $log = read();
    $inc = increment($id, $log);
    write($inc);
}

function read()
{
    $filename = '../log.txt';
    $data = file_get_contents($filename);
    return unserialize($data);
}

function increment($id, $log){
    $i = $log[$id];
    $i = $i + 1;
    $log[$id] = $i;
    return $log;
}

function write($log){
    $filename = '../log.txt';
    $data = serialize($log);
    file_put_contents($filename, $data);
}