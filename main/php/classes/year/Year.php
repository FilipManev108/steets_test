<?php

namespace Year;

use \Datetime;

class Year
{
    private $year;
    private $primeYears = [];

    public function __construct($year){
        $this->year = abs($year);
    }

    private function checkPrime($num){
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

    private function get30PrimeYears(){
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

    private function getChristmassDays(){
        
        foreach($this->primeYears as $key => $val){
            $date = DateTime::createFromFormat('Y-m-d', strval($key).'-12-25');
            $this->primeYears[$key] = $date->format('l');
        }
        return true;
    }

    public function processYear(){
        $this->get30PrimeYears();
        $this->getChristmassDays();
        return $this->primeYears;
    }

    public function reset30Prime(){
        $this->primeYears = [];
    }
}