<?php
$n = $_GET['n'] ?? 18; 
$tempN = $n;


$minExponent = PHP_INT_MAX; 
$bestPrime = -1;


for ($i = 2; $i * $i <= $tempN; $i++) {
    
    if ($tempN % $i == 0) {
        $exponent = 0;
        
        while ($tempN % $i == 0) {
            $exponent++;
            $tempN /= $i;
        }
        
        if ($exponent < $minExponent) {
            $minExponent = $exponent;
            $bestPrime = $i;
        }
    }
}

if ($tempN > 1) {
    $exponent = 1;
    if ($exponent < $minExponent) {
        $bestPrime = $tempN;
    }
}

echo "Contoh Masukan: " . $n . "<br>";
echo "Contoh Keluaran: " . $bestPrime;
?>