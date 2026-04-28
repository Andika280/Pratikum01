<?php
session_start();
require_once 'App.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$app = new Smartflood_sensor();

if (isset($_GET['hapus'])) {
    $app->hapusData($_GET['hapus']);
    header("Location: index.php");
}

if (isset($_POST['simpan'])) {
    $app->simpanData($_POST, $_FILES);
    header("Location: index.php");
}

$edit = ["id"=>"", "user_id"=>"", "lokasi_sungai"=>"", "waktu_pengukuran"=>"", "tinggi_air"=>"", "status_banjir"=>"", "deksripsi"=>"", "foto_bukti"=>""];
if (isset($_GET['edit'])) {
    $edit = $app->ambilSatuData($_GET['edit']);
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard Sistem</title></head>
<body>
    <h2>Dashboard | Halo, <?= $_SESSION['username']; ?>! | <a href="logout.php">Logout</a></h2>
    <hr>
    
    <h3>Form Data Monitoring</h3>
    <form method="post" action="" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $edit['id']; ?>">
        <input type="hidden" name="gambar_lama" value="<?= $edit['gambar']; ?>">
        
        <label>lokasi sungai:</label><br>
        <input type="text" name="nama_item" value="<?= $edit['nama_item']; ?>" required><br><br>
        
        <label>waktu pengukuran:</label><br>
        <input type="text" name="kategori" value="<?= $edit['kategori']; ?>" required><br><br>
        
        <label>tinggi air:</label><br>
        <input type="number" name="harga" value="<?= $edit['harga']; ?>" required><br><br>
        
        <label>status banjir:</label><br>
        <input type="file" name="gambar" accept="image/*"><br><br>

        <label>deksripsi:</label><br>
        <input type="text" name="nama_item" value="<?= $edit['nama_item']; ?>" required><br><br>

        <label>foto bukti:</label><br>
        <input type="text" name="nama_item" value="<?= $edit['nama_item']; ?>" required><br><br>
        
        <button type="submit" name="simpan">Simpan Data</button>
    </form>

    <hr>

    <h3>Daftar Data monitoring</h3>
    <table border="1" cellpadding="8" cellspacing="0" style="width: 100%;">
        <tr>
            <th>lokasi sungai</th>
            <th>waktu pengukuran</th> <th>Kategori</th>
            <th>tinggi air</th>
            <th>status banjir</th>
            <th>deksripsi</th>
            <th>foto bukti</th>
        </tr>
        
        <?php 
        $data = $app->tampilkanData();
        while($row = $data->fetch_assoc()): 
        ?>
        <tr>
            <td align="center">
                <?php if (!empty($row['gambar'])): ?>
                    <img src="uploads/<?= $row['gambar']; ?>" width="60" alt="foto">
                <?php else: ?>
                    <small>Tidak ada foto</small>
                <?php endif; ?>
            </td>
            <td><?= $row['nama_item']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id']; ?>">Edit</a> | 
                <a href="index.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>


<label>Nama Lengkap:</label><br>
<input type="text" name="nama_lengkap" value="<?= $edit['nama_lengkap'] ?? ''; ?>" required><br><br>

<label>id:</label><br>
<input type="number" name="id" value="<?= $edit['id'] ?? ''; ?>" required><br><br>

<label>user id</label><br>
<input type="text" name="user id" value="<?= $edit['user id'] ?? ''; ?>" required><br><br>


<img src="uploads/<?= $row['foto_warga']; ?>" width="60">

<td><?= $row['nama_lengkap']; ?></td>
<td><?= $row['id']; ?></td>
<td><?= $row['user id']; ?> Tahun</td>