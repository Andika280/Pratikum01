<?php
session_start();
if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
require 'koneksi.php';
?>
<!DOCTYPE html>
<html>
<head><title>Smart Flood Sensor</title></head>
<body>
    <?php include 'navbar.php'; ?>
    
    <h2>Selamat Datang, <?= $_SESSION['user']; ?>!</h2>
    <a href="tambah_data.php"><button>+ Tambah Laporan Baru</button></a>
    <br><br>

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>Foto Bukti</th>
            <th>Data 1 (Misal: Lokasi)</th>
            <th>Data 2 (Misal: Status)</th>
            <th>Aksi</th>
        </tr>
        <?php
        $data = $conn->query("SELECT * FROM datamonitoring ORDER BY id DESC");
        while($row = $data->fetch_assoc()):
        ?>
        <tr>
            <td align="center"><img src="uploads/<?= $row['foto_bukti']; ?>" width="80"></td>
            <td><?= $row['kolom1']; ?></td>
            <td><?= $row['kolom2']; ?></td>
            <td>
                <a href="edit_data.php?id=<?= $row['id']; ?>">Edit</a> | 
                <a href="hapus_data.php?id=<?= $row['id']; ?>" onclick="return confirm('Hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

    <?php include 'footer.php'; ?>
</body>
</html>