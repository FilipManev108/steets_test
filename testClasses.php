<?php

require_once './autoload.php';

// use Database\DB;
use Year\Year;
use Encription\Encrypt;
use Encription\Decrypt;



$env = parse_ini_file('.env');;
var_dump($env['ENCRYPTION_KEY']);
die();

$key = $env['KEY'];

$year = 2030;

$yr = new Year($year);
$en = new Encrypt($key);
// $de = new Decrypt($key);

$yearArr = $yr->processYear();

// print_r($yearArr);

$yearArr = $en->encryptDays($yearArr);



// print_r($yearArr);

// $yearArr = $de->decryptDays($yearArr);

// print_r($yearArr);
// var_dump($en);

echo '<pre>';
print_r(DB::read($year));

die();

// CREATE TABLE prime_years (
//     id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
//     year SMALLINT UNSIGNED UNIQUE,
//     encrypted_day VARCHAR(64)
//     );