<?php

namespace Encription;

abstract class Cipher
{

    private $key;
    private static $lower = ['a' => 65, 'z' => 90];
    private static $upper = ['a' => 97, 'z' => 122];

    protected function __construct(string $key){
        $this->key = strtoupper(md5($key));
    }

    //this is a custom encryption method which uses an algorythim based on the 0-255 byte values for the key characters
    protected function process(string $string, bool $flag): string {
        $string = $flag ? $string : base64_decode($string);
        $keyArr = str_split($this->key);
        $stringArr = str_split($string);
        $encrypted = '';
        for ($i=0; $i < count($stringArr); $i++) { 
            $stringCharOrd = ord($stringArr[$i]);
            $shifter = is_numeric($keyArr[$i]) ? intval($keyArr[$i]) : (ord($keyArr[$i]) - 65);
            if($stringCharOrd >= self::$lower['a'] && $stringCharOrd <= self::$lower['z']){
                $encrypted .= chr($this->shift($stringCharOrd, $shifter, self::$lower));
            } else if ($stringCharOrd >= self::$upper['a'] && $stringCharOrd <= self::$upper['z']) {
                $encrypted .= chr($this->shift($stringCharOrd, $shifter, self::$upper));
            }
        }
        return $flag ? base64_encode($encrypted) : $encrypted;
    }

    protected abstract function shift(int $stringCharOrd, int $shifter, array $indexes): int;
}