<?php
session_start();
require 'koneksi.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM tabel_laporan WHERE id=$id");
}
header("Location: dashboard.php");
?>