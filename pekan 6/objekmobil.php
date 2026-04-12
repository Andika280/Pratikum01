<?php
class objekmobil {
    public $warna;

    public function setwarna ($warna) {
        $this->warna = $warna;
    }

    public function getWarna() {
        return $this->warna;
    }
}

$mobil1 = new objekmobil();
$mobil1->setwarna("Merah");

$mobil2 = new objekmobil();
$mobil2->setWarna("Biru");

echo "Warna mobil pertama: " . $mobil1->getWarna() . "<br>";
echo "Warna mobil kedua: " . $mobil2->getWarna();
?>