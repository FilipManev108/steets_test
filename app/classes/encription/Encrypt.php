<?php

namespace Encription;

use Encription\Cipher;

class Encrypt extends Cipher
{
    private $encrypt = true;

    public function __construct(string $key){
        parent::__construct($key);
    }

    protected function shift(int $stringCharOrd, int $shifter, array $index): int {
        $stringCharOrd += $shifter;
        if($stringCharOrd > $index['z']){ //if it goes beyond 'z' start from 'a'
            $stringCharOrd = ($index['a'] - 1) + ($stringCharOrd - $index['z']);
        }
        return $stringCharOrd;
    }

    private function encryptDay(string $string): string {
        return $this->process($string, $this->encrypt);
    }

    public function encryptDays(array $arr): array {
        foreach($arr as $key => $val){
            $arr[$key] = $this->encryptDay($val);
        }
        return $arr;
    }
}