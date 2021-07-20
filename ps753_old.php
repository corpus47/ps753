#!/usr/bin/php -q
<?php

/*
* Require: php-gmp
*/
DEFINE('MAXPRIME',100);

$db = 0;

$prime = 0;

$pows = array();

$sums = array();

function speed_sum($a,$b) {

    global $sums;

    if($a < $b) {

        if(!isset($sums[$a][$b])){
            $sums[$a][$b] = pows($a) + pows($b);
            $sums[$b][$a] = $sums[$a][$b];
        }

    } else {

        if(!isset($sums[$b][$a])) {
            $sums[$b][$a] = pows($b) + pows($a);
        }

    }

    return $sums[$b][$a];

}

function pows($number) {

    global $pows;

    if(!isset($pows[$number])) {
        $pows[$number] = pow($number,3);
    }

    return $pows[$number];

}

function testPrime($number) {

    global $db;
    global $pows;
    global $prime;

    $prime = (int)gmp_strval(gmp_nextprime($prime));
    
    echo $prime . ' ';

    for ($a = 1; $a < $prime; $a++) {
        for($b = 1; $b < $prime; $b++){
            for($c = 1; $c < $prime; $c++){
                $left = speed_sum($a,$b) % $prime;
                $right = pows($c) % $prime;
                if($left == $right){
                    $db++;
                }
            }
        }
    }

}

echo 'Maxprime: ' . MAXPRIME;

for($i = 0;$prime < MAXPRIME; $i++){
    testPrime($i);
}

echo PHP_EOL . "Found: ",$db;

?>
