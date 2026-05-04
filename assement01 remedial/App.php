<?php
class Smartflood_sensor {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "smartflood_sensor");

        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function tampilkanData() {
        return $this->conn->query("SELECT * FROM smartflood_sensor ORDER BY id DESC");
    }

    public function simpanData($post, $file) {
        $id = $post['id'] ?? '';

        $lokasi   = trim($post['lokasi_sungai'] ?? '');
        $waktu    = trim($post['waktu_pengukuran'] ?? '');
        $tinggi   = (int)($post['tinggi_air'] ?? 0);
        $deskripsi= trim($post['deskripsi'] ?? '');

        if ($lokasi == '' || $waktu == '' || $tinggi <= 0) {
            return false;
        }

        if ($tinggi <= 50) {
            $status = 1; // Aman
        } elseif ($tinggi <= 100) {
            $status = 2; // Siaga
        } else {
            $status = 3; // Bahaya
        }

        $foto = $post['foto_lama'] ?? '';

        if (!empty($file['foto_bukti']['name'])) {

            $uploadDir = "uploads/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir);
            }

            $ext = strtolower(pathinfo($file['foto_bukti']['name'], PATHINFO_EXTENSION));

            $allowed = ['jpg','jpeg','png'];

            if (in_array($ext, $allowed)) {
                $namaBaru = time() . "." . $ext;

                if (move_uploaded_file($file['foto_bukti']['tmp_name'], $uploadDir . $namaBaru)) {
                    $foto = $namaBaru;
                }
            }
        }

        if ($id == '') {
            $sql = "INSERT INTO smartflood_sensor 
            (lokasi_sungai, waktu_pengukuran, tinggi_air, status_banjir, deskripsi, foto_bukti)
            VALUES 
            ('$lokasi','$waktu','$tinggi','$status','$deskripsi','$foto')";
        } else {
            $sql = "UPDATE smartflood_sensor SET
            lokasi_sungai='$lokasi',
            waktu_pengukuran='$waktu',
            tinggi_air='$tinggi',
            status_banjir='$status',
            deskripsi='$deskripsi',
            foto_bukti='$foto'
            WHERE id='$id'";
        }

        return $this->conn->query($sql);
    }

    public function hapusData($id) {

        $data = $this->ambilSatuData($id);

        if (!empty($data['foto_bukti'])) {
            $filePath = "uploads/" . $data['foto_bukti'];

            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        return $this->conn->query("DELETE FROM smartflood_sensor WHERE id='$id'");
    }

    public function ambilSatuData($id) {
        return $this->conn->query("SELECT * FROM smartflood_sensor WHERE id='$id'")->fetch_assoc();
    }

    public function loginUser($user, $pass) {
        return $this->conn->query("SELECT * FROM users WHERE username='$user' AND password='$pass'");
    }
}
?>