<?php
class Smartflood_sensor {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "smartflood_sensor";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function tampilkanData() {
        return $this->conn->query("SELECT * FROM datamonitoring ORDER BY id DESC");
    }

    public function simpanData($post, $file) {
        $id = $post['id'];

        $lokasi_sungai = $post['lokasi_sungai']; 
        $waktu_pengukuran = $post['waktu_pengukuran'];
        $tinggi_air = $post['tinggi_air'];
        $status_banjir = $post['status_banjir'];
        $deksripsi = $post['deksripsi'];
        $foto_bukti = $post['foto_bukti'];

        if ($file['gambar']['name'] != "") {
            $uploadDir = 'uploads/';
            $ext = strtolower(pathinfo($file["gambar"]["name"], PATHINFO_EXTENSION));
            $newFileName = time() . "." . $ext;
            
            if (move_uploaded_file($file['gambar']['tmp_name'], $uploadDir . $newFileName)) {
                $gambar = $newFileName;
            }
        }

        if (empty($id)) {
            $sql = "INSERT INTO smartflood_sensor (lokasi sungai, waktu pengukuran, tinggi air, statusbanjir, deksripsi, fotobukti ) VALUES ('$lokasi_sungai', '$waktu_pengukuran', '$tinggi_air', '$status_banjir',
            '$deksripsi','$foto_bukti')";
        } else {
            $sql = "UPDATE smartflood_sensor SET lokasi sungai='$lokasi_sungai', waktu pengukuran='$waktu_pengukuran', tinggi air='$tinggi_air', statusbanjir ='$status_banjir' WHERE id=$id";
        }
        return $this->conn->query($sql);
    }

    public function hapusData($id) {
        return $this->conn->query("DELETE FROM datamonitoring WHERE id=$id");
    }

    public function ambilSatuData($id) {
        return $this->conn->query("SELECT * FROM datamonitoring WHERE id=$id")->fetch_assoc();
    }

    public function loginUser($user, $pass) {
        $sql = "SELECT * FROM users WHERE username='$user' AND password='$pass'";
        return $this->conn->query($sql);
    }

    public function __destruct() {
        $this->conn->close();
    }
}
?>