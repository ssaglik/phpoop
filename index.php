<?php

/*
 * This file is a demonstration for turcom
 *
 */


interface payment {
    public function P();
}

interface bank extends payment {
    public function B();
}

abstract class banks implements bank {
    public function __construct($banks = []) {
        echo __METHOD__."()<br/>";
        $this->banks= $banks;
    }

    private function getByMinimumCommission() {
        // Assuming that the minimum commission between banks is generated randomly for now
        return $this->banks[rand(0,sizeof($this->banks)-1)];
    }

    public function P() {
        // Assuming that there is only one payment method
        return "CreditCard";
    }

    public function B() {
        return self::getByMinimumCommission();        
    }

}

// Class definition for demonstration of the interfaces and abstract classes in this file.
class story extends banks {

    private $payments = [];

    public function __construct($banks = []) {
        echo __METHOD__."()<br/>";
        parent::__construct($banks);
    }

    public function __destruct() {
        echo __METHOD__."()<br/>";
    }

    public function start() {
        echo __METHOD__."()<br/>";
        // generate 1000 random payments between 5TL - 3000TL 
        $p = 1;
        for ($p==1;$p<1001;$p++) {
            $item = new StdClass();
            $item->paymentBy = self::B();
            $item->paymentMethod = self::P();
            $item->patmentAmount = rand(5,3000)."TL";
            $this->payments[] = $item;            
        }
        self::debug();
    }

    private function debug() {
        echo "<pre>";
        print_r($this->payments);
        echo "</pre>";
    }
}

$banks = ["isbankasi","finansbank","akbank","yapikredi","ziraat","garanti"];
$story = new story($banks);
$story->start();
?>