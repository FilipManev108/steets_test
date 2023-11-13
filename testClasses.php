<?php

require_once './autoload.php';

use Year\Year;
use Encription\Encrypt;
use Encription\Decrypt;



$env = parse_ini_file('.env');

$key = $env['KEY'];

$year = 2023;

$yr = new Year(2023);
$en = new Encrypt($key);
$de = new Decrypt($key);

$yearArr = $yr->processYear();

print_r($yearArr);

$yearArr = $en->encryptDays($yearArr);

print_r($yearArr);

$yearArr = $de->decryptDays($yearArr);

print_r($yearArr);
// var_dump($en);
die();