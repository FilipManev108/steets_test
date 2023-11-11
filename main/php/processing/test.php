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

$year = 2023;

$arr = get30PrimeYears($year);
$arr = getChristmassDays($arr);

arrDebug($arr);



// for ($i=1; $i < 2001; $i++) { 
//    echo checkPrime($i) ? '<span style="color: green">'. $i .'</span><br>' : '<span style="color: red">'. $i .'</span><br>';
// }