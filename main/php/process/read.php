<?php

use Year\Year;
use Encription\Decrypt;

require_once './autoload.php';

checkPost();

$year = (int)$_POST['input'];

$key = getKey();

$response = DB::read($year);

$de = new Decrypt($key);

$yearArr = $de->decryptDays($response);

echo json_encode($yearArr);