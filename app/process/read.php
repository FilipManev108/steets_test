<?php

use Year\Year;
use Encription\Decrypt;

require_once './autoload.php';

if(!checkPostRequest()){
    echo 'not a post request';
    die();
}

$year = (int)$_POST['input'];

$key = getEncryptionKey();

$primeYears = DB::getPrimeYearsFrom($year);

$decriptor = new Decrypt($key);

$response = $decriptor->decryptDays($primeYears);

echo json_encode($response);