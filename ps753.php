#!/usr/bin/php -q
<?php
$db = 0;

$prime = 0;

function testPrime($number) {

    global $db;
    global $pows;
    global $prime;

    $prime = (int)gmp_strval(gmp_nextprime($prime));
    
    echo $prime . ' ';

    for ($a = 1; $a < $prime; $a++) {
        for($b = 1; $b < $prime; $b++){
            for($c = 1; $c < $prime; $c++){
                $left = (pow($a,3) + pow($b,3)) % $prime;
                $right = pow($c,3) % $prime;
                /*$left = ($pows[$a] + $pows[$b]) % $prime;
                $right = $pows[$c] % $prime;*/
                if($left == $right){
                    $db++;
                }
            }
        }
    }

}


$primes = array();

$num = 2;

$primes[] = $num;

$pows = array();

$i = 1;

/*while($num < 1000){
    $num = (int)gmp_strval(gmp_nextprime($num));
    $primes[] = $num;   
}*/

/*for($i = 1; $i <= 1000000;$i++) {
    $pows[$i] = pow($i,3);
}*/

//var_dump($primes);
//echo '<br /><br />';
//var_dump($pows);
//exit;

for($i = 0;$i < 1000; $i++){
    testPrime($i);
}

echo "Found: ",$db;

?>
