<?php

use Year\Year;
use Encription\Encrypt;

require_once './autoload.php';

checkPost();

$year = (int)$_POST['input'];

$key = getKey();

$yr = new Year($year);

$en = new Encrypt($key);

$yearArr = $yr->processYear();
$yearArr = $en->encryptDays($yearArr);


try {
    if(DB::write($yearArr)){
        echo 'success';
        die();
    } else {
        throw new Exception('Something went wrong');;
    }
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
