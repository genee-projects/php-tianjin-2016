<?php

class Summator {

    private $_sum = 0;
    public function __construct($init=0) {
        $this->_sum = $init;
    }

    public function add($n) {
        $this->_sum += $n;
        return $this;
    }

    public function result() {
        return $this->_sum;
    }
}

class Statement {

    public static function main($max) {
        // $s = 0;
        // for ($i=1; $i<=$max; $i++) {
        //     $s += $i;
        // }

        $summator = new Summator(0);
        for ($i=1; $i<=$max; $i++) {
            $summator->add($i);
        }
        $s = $summator->result();

        if ($max == 1) {
            echo "This is $s \n";
        } elseif ($max == 2) {
            echo "1 + 2 = $s \n";
        } elseif ($max == 3) {
            echo "1 + 2 + $max = $s \n";
        } else {
            echo "1 + 2 + ... + $max = $s\n";
        }
    }

}

Statement::main($argc > 1 ? $argv[1] : 100);