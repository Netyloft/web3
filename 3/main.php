<?php

$filename = 'file.htm';
$result_filename = 'result.txt';

$data = file_get_contents($filename);

$php_count = 0;

preg_match_all('#<code>(.+?)</code>#s', $data, $res);
$res = mb_convert_encoding($res, "utf-8", "windows-1251");

$str = file_put_contents($result_filename, "");
foreach ($res[0] as $data) {
    print_r($data);
    $str_data = strip_tags($data);
    $str_data = preg_split('#\n#', $str_data);

    $result = "";

    foreach ($str_data as $str){
        $str = trim($str);
        $str = str_replace("&nbsp;", " ", $str);
        $str = str_replace("&quot", "\"", $str);
        $str = str_replace("&lt;", "<", $str);
        $str = str_replace("&gt;", ">", $str);

        if($str === "<?php"){
            $php_count++;
        }

        $result = $result.$str."\n";
    }

    $str = file_get_contents($result_filename);
    $str = $str.$result."\n\n";
    file_put_contents($result_filename, $str);
}


$file = file_get_contents($result_filename);
file_put_contents($result_filename, $file."\nКоличество слов ?php: ".$php_count);

