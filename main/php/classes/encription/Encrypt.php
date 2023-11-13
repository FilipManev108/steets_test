<?php

namespace Encription;

use Encription\Cipher;

class Encrypt extends Cipher
{
    private $flag = true;

    public function __construct($key){
        parent::__construct($key);
    }

    protected function shift($stringCharOrd, $shifter, $index){
        $stringCharOrd += $shifter;
        if($stringCharOrd > $index['z']){ //if it goes beyond 'z' start from 'a'
            $stringCharOrd = ($index['a'] - 1) + ($stringCharOrd - $index['z']);
        }
        return $stringCharOrd;
    }

    private function encryptDay($string){
        return $this->process($string, $this->flag);
    }

    public function encryptDays($arr){
        foreach($arr as $key => $val){
            $arr[$key] = $this->encryptDay($val);
        }
        return $arr;
    }
}