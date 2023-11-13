<?php

use Year\Year;
use Encription\Decrypt;

require_once './autoload.php';

// checkPost();

$key = getKey();

$response = DB::read(2000);



$yearArr = [];


$de = new Decrypt($key);

$yearArr = $de->decryptDays($response);


echo json_encode($yearArr);