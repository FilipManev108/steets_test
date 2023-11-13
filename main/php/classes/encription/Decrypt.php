<?php

namespace Encription;

use Encription\Cipher;

class Decrypt extends Cipher
{
    private $flag = false;

    public function __construct($key){
        parent::__construct($key);
    }

    protected function shift($stringCharOrd, $shifter, $index){
        $stringCharOrd -= $shifter;
        if($stringCharOrd < $index['a']){ //if it goes bellow 'a' start from 'z'
            $stringCharOrd = ($index['z'] + 1) - ($index['a'] - $stringCharOrd);
        }
        return $stringCharOrd;
    }

    public function decryptDay($string){
        return $this->process($string, $this->flag);
    }

    public function decryptDays($arr){
        foreach($arr as $key => $val){
            $arr[$key] = $this->decryptDay($val);
        }
        return $arr;
    }

}