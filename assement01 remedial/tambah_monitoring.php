<?php
session_start();
require 'koneksi.php';
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }

$id = $_GET['id'];
$data = $conn->query("SELECT * FROM tabel_laporan WHERE id=$id")->fetch_assoc();

if (isset($_POST['update'])) {
    $kolom1 = $_POST['kolom1'];
    $kolom2 = $_POST['kolom2'];
    $foto = $_POST['foto_bukti'];

    if ($_FILES['foto_bukti']['name'] != "") {
        $foto = time() . "_" . $_FILES['foto_bukti']['name'];
        move_uploaded_file($_FILES['foto_bukti']['tmp_name'], "uploads/" . $foto);
    }

    $conn->query("UPDATE tabel_laporan SET kolom1='$kolom1', kolom2='$kolom2', foto_bukti='$foto' WHERE id=$id");
    header("Location: dashboard.php");
}
?>