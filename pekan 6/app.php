<?php
class ProdukManager {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db   = "db_praktikum_web";
    protected $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function tampilkanData() {
        return $this->conn->query("SELECT * FROM produk ORDER BY id DESC");
    }

    public function simpanData($post, $file) {
        $id = $post['id'];
        $nama = $post['nama_produk'];
        $kategori = $post['kategori'];
        $harga = $post['harga'];
        $gambar = $post['gambar_lama'];

        if ($file['gambar']['name'] != "") {
            $uploadDir = 'uploads/';
            $ext = strtolower(pathinfo($file["gambar"]["name"], PATHINFO_EXTENSION));
            $newFileName = time() . "." . $ext;
            if (move_uploaded_file($file['gambar']['tmp_name'], $uploadDir . $newFileName)) {
                $gambar = $newFileName;
            }
        }

        if (empty($id)) {
            $sql = "INSERT INTO produk (nama_produk, kategori, harga, gambar) VALUES ('$nama', '$kategori', '$harga', '$gambar')";
        } else {
            $sql = "UPDATE produk SET nama_produk='$nama', kategori='$kategori', harga='$harga', gambar='$gambar' WHERE id=$id";
        }
        return $this->conn->query($sql);
    }

    public function hapusData($id) {
        return $this->conn->query("DELETE FROM produk WHERE id=$id");
    }

    public function ambilSatuData($id) {
        return $this->conn->query("SELECT * FROM produk WHERE id=$id")->fetch_assoc();
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