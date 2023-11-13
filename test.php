<?php
require_once './main/php/functions/redirect.php';
require_once './main/php/functions/array_debugger.php';



function br(){
    echo '<br>';
}

// checkPost();


// json_encode(arrDebug($_POST));

function checkPrime($num){
    $num = abs($num);
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
        if($year <= 0){
            break; //prime numbers cannot be negative
        }
        if(checkPrime(abs($year))){
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




// $year = 23;

// $arr = get30PrimeYears($year);

// $arr = getChristmassDays($arr);

// print_r($arr);
// die();

// arrDebug(openssl_get_cipher_methods());
// define("ENCRYPTION_METHOD", "AES-128-CBC");
// define("KEY", "asd");


/**
 * 
 * 
 * 
 *
 * 
 */



// function encrypt($data) {
//     $key = KEY;
//     $plaintext = $data;
//     $ivlen = openssl_cipher_iv_length($cipher = ENCRYPTION_METHOD);
//     $iv = openssl_random_pseudo_bytes($ivlen);
//     $ciphertext_raw = openssl_encrypt($plaintext, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
//     $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
//     $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
//     return $ciphertext;
// }


// function decrypt($data) {
//     $key = KEY;
//     $c = base64_decode($data);
//     $ivlen = openssl_cipher_iv_length($cipher = ENCRYPTION_METHOD);
//     $iv = substr($c, 0, $ivlen);
//     $hmac = substr($c, $ivlen, $sha2len = 32);
//     $ciphertext_raw = substr($c, $ivlen + $sha2len);
//     $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
//     $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
//     if (hash_equals($hmac, $calcmac))
//     {
//         return $original_plaintext;
//     }
// }
// CXVQEXCY
// Wendsday -> Csahaw
function customEncrypt($key, $string){ //key has to be all caps string with length at least 9, string has to be day od the week in string
    $keyArr = str_split($key);
    $stringArr = str_split($string);
    $encrypted = '';
    for ($i=0; $i < count($stringArr); $i++) { 
        $stringCharOrd = ord($stringArr[$i]);
        $shifter = is_numeric($keyArr[$i]) ? intval($keyArr[$i]) : (ord($keyArr[$i]) - 65);
        if($stringCharOrd >= 97 && $stringCharOrd <= 122){
            $stringCharOrd += $shifter;
            if($stringCharOrd > 122){ //if it goes beyond 'z' start from 'a'
                $stringCharOrd = 96 + ($stringCharOrd - 122);
            }
            $encrypted .= chr($stringCharOrd);
        } else if ($stringCharOrd >= 65 && $stringCharOrd <= 90) {
            $stringCharOrd += $shifter;
            if($stringCharOrd > 90){ //if it goes beyond 'Z' start from 'A'
                $stringCharOrd = 64 + ($stringCharOrd - 90);
            }
            $encrypted .= chr($stringCharOrd);
        }
        echo var_dump($shifter);
        var_dump($stringCharOrd);
    }
    return $encrypted;
}

function customDecrypt($key, $string){ //key has to be all caps string with length at least 9, string has to be day od the week in string
    $keyArr = str_split($key);
    $stringArr = str_split($string);
    $decrypted = '';
    for ($i=0; $i < count($stringArr); $i++) { 
        $stringCharOrd = ord($stringArr[$i]);
        $shifter = is_numeric($keyArr[$i]) ? intval($keyArr[$i]) : (ord($keyArr[$i]) - 65);
        if($stringCharOrd >= 97 && $stringCharOrd <= 122){
            $stringCharOrd -= $shifter;
            if($stringCharOrd < 97){ //if it goes bellow 'a' start from 'z'
                $stringCharOrd = 123 - (97 - $stringCharOrd);
            }
            $decrypted .= chr($stringCharOrd);
        } else if ($stringCharOrd >= 65 && $stringCharOrd <= 90) {
            $stringCharOrd -= $shifter;
            if($stringCharOrd < 65){ //if it goes bellow 'A' start from 'Z'
                $stringCharOrd = 91 - (65 - $stringCharOrd);
            }
            $decrypted .= chr($stringCharOrd);
        }
    }
    return $decrypted;
}



// var_dump(getenv('ENCRYPTION_KEY'));
// die();
// $encrypted = encrypt($plaintext);
// $decrypted = decrypt($encrypted);
// $hashText = hash('sha256', $plaintext);


// var_dump(base64_encode($plaintext), base64_decode(base64_encode($plaintext)), $hashText);
// var_dump(ord('a'));
$string = "Monday";
$key = "11BBBBB";

$encrypt = customEncrypt($key, $string);
$decrypt = customDecrypt($key, $encrypt);

echo $encrypt . PHP_EOL;
echo $decrypt;



// var_dump(ord('a'), ord('z'), ord('A'), ord('Z'));
die();
$cipher = "aes-128-gcm";
$ivlen = openssl_cipher_iv_length($cipher);

$key = openssl_random_pseudo_bytes(5);
$iv = openssl_random_pseudo_bytes($ivlen);

// $ssl = ['key' => $key, 'cipher' => $cipher, 'ivlen' => $ivlen, 'iv' => $iv];
// arrDebug($ssl);

$encrypted = openssl_encrypt($plaintext, $cipher, $key, $options=0, $iv, $tag);
echo $encrypted;




$decrypted = openssl_decrypt($encrypted, $cipher, $key, $options=0, $iv, $tag);
echo '<br>', $decrypted;




// $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

// $md5Days = [];

// foreach($days as $val){
//     $md5Days[md5($val)] = $val;
// }

// arrDebug($md5Days);





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

                    
// $key = 'XZASDPOTY';
// $word = 'Monday';

// $days = ['Monday', 'Monday', 'Monday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


// $en = new Encrypt($key);
// // $encrypted = $en->process($word);

// $de = new Decrypt($key);
// // $decrypted = $de->process($encrypted);

// foreach($days as $day){
//     $encrypted = $en->process($day, true);
//     $decrypted = $de->process($encrypted);
//     var_dump($encrypted);
//     echo PHP_EOL;
//     var_dump($decrypted);
//     echo PHP_EOL;
// }