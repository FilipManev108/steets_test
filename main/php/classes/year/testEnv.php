<?php

// $env = parse_ini_file('../../../.env');


$key = 'adadasdad';
$key = strtoupper(md5($key));
// $numbers = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];

// $onlyStr = str_replace($numbers, "", $key);

// $stringArr = str_split($string);
$keyArr = str_split($key);

// $keyCharOrd = is_numeric($keyArr[$i]) ? (int)$keyArr[$i] : ord($keyArr[$i]);

// var_dump($keyArr);
var_dump(is_numeric('3'));
var_dump(is_numeric('V'));

foreach($keyArr as $key => $val){
    var_dump(is_numeric($val));
}

