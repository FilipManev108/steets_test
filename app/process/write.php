<?php

use Year\Year;
use Encription\Encrypt;

require_once './autoload.php';

if(!checkPostRequest()){
    echo 'not a post request';
    die();
}

$year = (int)$_POST['input'];

$key = getEncryptionKey();

$year = new Year($year);

$encriptor = new Encrypt($key);

$yearArr = $year->processYear(30);
$yearArr = $encriptor->encryptDays($yearArr);


try {
    if(DB::writePrimeYears($yearArr)){
        echo 'success';
        die();
    } else {
        throw new Exception('Something went wrong');;
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
