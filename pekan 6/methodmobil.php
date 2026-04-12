<?php
class methodmobil {
    public function maju() {
        echo "Mobil bergerak maju";
    }

    public function berhenti() {
        echo "Mobil berhenti";
    }

    public function belok($arah) {
        echo "Mobil berbelok ke " . $arah;
    }
}

$myCar = new methodmobil();

$myCar->maju();
echo "<br>";
$myCar->berhenti();
echo "<br>";
$myCar->belok("kanan");
?>