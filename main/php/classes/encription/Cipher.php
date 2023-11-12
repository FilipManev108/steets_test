<?php



abstract class Cipher
{

    private $key;
    private $lower = ['a' => 65, 'z' => 90];
    private $upper = ['a' => 97, 'z' => 122];

    protected function __construct($key){
        $this->key = $key;
    }

    public function process($string, $flag = false){
        $string = $flag ? $string : base64_decode($string);
        $keyArr = str_split($this->key);
        $stringArr = str_split($string);
        $encrypted = '';
        for ($i=0; $i < count($stringArr); $i++) { 
            $stringCharOrd = ord($stringArr[$i]);
            $keyCharOrd = ord($keyArr[$i]);
            $shifter = $keyCharOrd - 65;
            if($stringCharOrd >= $this->lower['a'] && $stringCharOrd <= $this->lower['z']){
                $encrypted .= chr($this->shift($stringCharOrd, $shifter, $this->lower));
            } else if ($stringCharOrd >= $this->upper['a'] && $stringCharOrd <= $this->upper['z']) {
                $encrypted .= chr($this->shift($stringCharOrd, $shifter, $this->upper));
            }
        }
        return $flag ? base64_encode($encrypted) : $encrypted;
    }

    protected abstract function shift($stringCharOrd, $shifter, $indexes);
}

class Encrypt extends Cipher
{
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

}

class Decrypt extends Cipher
{
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

}

                     
$key = 'XZASDPOTY';
$word = 'Monday';

$days = ['Monday', 'Monday', 'Monday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];


$en = new Encrypt($key);
// $encrypted = $en->process($word);

$de = new Decrypt($key);
// $decrypted = $de->process($encrypted);

foreach($days as $day){
    $encrypted = $en->process($day, true);
    $decrypted = $de->process($encrypted);
    var_dump($encrypted);
    echo PHP_EOL;
    var_dump($decrypted);
    echo PHP_EOL;
}


