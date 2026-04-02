<?php
$conn = new mysqli("localhost", "root", "", "db_agrilink2");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>