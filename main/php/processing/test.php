<?php
require_once '../functions/redirect.php';
require_once '../functions/array_debugger.php';

function br(){
    echo '<br>';
}

// checkPost();


// json_encode(arrDebug($_POST));

function checkPrime($num){
    if($num == 1) return false;
    if($num % 2 == 0) return ($num == 2);
    
    $root = floor(sqrt($num));
    for ($i=3; $i < $root; $i+=2) { 
       if($num % $i == 0){
        return false;
       }
    }
    return true;
}


function get30PrimeYears($year){
    $arr = [];
    while (count($arr) <= 30) {
       if(checkPrime($year)){
           $arr[] = ['year' => $year, 'christmass' => '']; 
       }
       $year--;
    }
    return $arr;
}

function getChristmassDays($arr){
    foreach($arr as $key => $val){
        $date = DateTime::createFromFormat('Y-m-d', strval($val['year']).'-12-25');
        $arr[$key]['christmass'] = $date->format('l');
    }
    return $arr;
}

// $year = 2023;

// $arr = get30PrimeYears($year);
// $arr = getChristmassDays($arr);

// arrDebug(openssl_get_cipher_methods());

$key = openssl_random_pseudo_bytes(5);
$plaintext = "message to be encrypted";
$cipher = "aes-128-gcm";

$ivlen = openssl_cipher_iv_length($cipher);
$iv = openssl_random_pseudo_bytes($ivlen);

$encrypted = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
echo $encrypted;
$decrypted = openssl_decrypt($encrypted, $cipher, $key, $options=0, $iv, $tag);
echo '<br>', $decrypted;
// echo $key, '<br>', $plaintext, '<br>', $cipher, '<br>';
// // die();
// if (in_array($cipher, openssl_get_cipher_methods()))
// {
//     $ivlen = openssl_cipher_iv_length($cipher);
//     $iv = openssl_random_pseudo_bytes($ivlen);
//     $ciphertext = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
//     //store $cipher, $iv, and $tag for decryption later
//     $original_plaintext = openssl_decrypt($ciphertext, $cipher, $key, $options=0, $iv, $tag);
//     echo $original_plaintext."\n";
// }
// for ($i=1; $i < 2001; $i++) { 
//    echo checkPrime($i) ? '<span style="color: green">'. $i .'</span><br>' : '<span style="color: red">'. $i .'</span><br>';
// }