<?php

require_once '../base/BaseRepository.php';

class ProductRepository extends BaseRepository
{
    public function __construct()
    {
        parent::__construct('l6_product');
    }

    public function import_data()
    {

        $file = "data.csv";

        $file_data = fopen($file, "r");
        $cont = fread($file_data, filesize($file));
        $pieces = explode("#", $cont);

        for ($i = 0; $i < count($pieces); $i++) {
            $text = explode("|", trim($pieces[$i]));
            $item = ['name' => $text[0], 'brand' => $text[1], 'type' => $text[2], 'price' => (double)$text[3], 'description' => $text[4], 'count' => (int)$text[5]];
            $this->create($item);
        }

    }
}