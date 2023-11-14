<?php

namespace Year;

use \Datetime;

class Year
{
    private $year;
    private $primeYears = [];

    public function __construct(int $year){
        $this->year = abs($year);
    }

    private function checkPrime(int $num): bool {
        $num = abs($num);
        if($num == 1) return false;
        $sieve = [2, 3, 5];
        for ($i=0; $i < count($sieve); $i++) { 
            if($num % $sieve[$i] == 0) return ($num == $sieve[$i]);
        }

        $root = sqrt($num);
        if($root == floor($root)) return false;
        $root = floor($root);

        for ($i=3; $i < $root; $i+=2) { 
           if($num % $i == 0){
            return false;
           }
        }
        return true;
    }

    private function get30PrimeYears(): bool {
        $year = $this->year;
        while (count($this->primeYears) <= 30) {
            if($year <= 0){
                break; //prime numbers cannot be negative
            }
            if($this->checkPrime($year)){
                $this->primeYears[$year] = ['']; 
            }
           $year--;
        }
        return true;
    }

    private function getChristmassDays(): bool {
        
        foreach($this->primeYears as $key => $val){
            $date = DateTime::createFromFormat('Y-m-d', strval($key).'-12-25');
            $this->primeYears[$key] = $date->format('l');
        }
        return true;
    }

    public function processYear(): array {
        $this->get30PrimeYears();
        $this->getChristmassDays();
        return $this->primeYears;
    }
 
    public function reset30Prime(): void{
        $this->primeYears = [];
    }
}