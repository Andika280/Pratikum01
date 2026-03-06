<?php 
function desimalKeHexa(int $desimal): string {
    $hexKarakter = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");
    $hasilHexa = "";

    if ($desimal == 0) {
        return "0";
    }

    while ($desimal > 0) {
        $sisa = $desimal % 16;
        
        $hasilHexa = $hexKarakter[$sisa] . $hasilHexa;
 
        $desimal = floor($desimal / 16); 
    }

    return $hasilHexa;
}

$angkaInput = 255;

echo "Bilangan Desimal: " . $angkaInput . "<br>";
echo "Bilangan Heksadesimal: " . desimalKeHexa($angkaInput);
?>