<?php

namespace Encription;

use Encription\Cipher;

class Decrypt extends Cipher
{
    private $encrypt = false;

    public function __construct(string $key){
        parent::__construct($key);
    }

    protected function shift(int $stringCharOrd, int $shifter, array $index): int {
        $stringCharOrd -= $shifter;
        if($stringCharOrd < $index['a']){ //if it goes bellow 'a' start from 'z'
            $stringCharOrd = ($index['z'] + 1) - ($index['a'] - $stringCharOrd);
        }
        return $stringCharOrd;
    }

    public function decryptDay(string $string): string {
        return $this->process($string, $this->encrypt);
    }

    public function decryptDays(array $arr): array{
        foreach($arr as $key => $val){
            $arr[$key]['encrypted_day'] = $this->decryptDay($val['encrypted_day']);
        }
        return $arr;
    }

}