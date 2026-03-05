<?php
function desimalKeHexa($desimal) {

    if ($desimal == 0) {
        return "0";
    }
    
    $karakterHexa = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'A', 'B', 'C', 'D', 'E', 'F'];
    $hasilHexa = "";

    while ($desimal > 0) {
        $sisa = $desimal % 16;
        $hasilHexa = $karakterHexa[$sisa] . $hasilHexa;
        $desimal = floor($desimal / 16);
    }

    return $hasilHexa;
}

$angkaUji = 300; 

echo "<h3>Hasil Konversi</h3>";
echo "Bilangan Desimal : " . $angkaUji . "<br>";

echo "Heksadesimal (Fungsi Manual) : " . desimalKeHexa($angkaUji) . "<br>";

echo "Heksadesimal (Fungsi Bawaan PHP) : " . strtoupper(dechex($angkaUji)) . "<br>";
?>