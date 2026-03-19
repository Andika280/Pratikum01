<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Gagal menghapus data: " . $stmt->error;
    }
    $stmt->close();
}
$conn->close();
?>