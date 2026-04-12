<?php
session_start();
require_once 'app.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$app = new ProdukManager();

if (isset($_GET['hapus'])) {
    $app->hapusData($_GET['hapus']);
    header("Location: index.php");
}

if (isset($_POST['simpan'])) {
    $app->simpanData($_POST, $_FILES);
    header("Location: index.php");
}

$edit = ["id"=>"", "nama_produk"=>"", "kategori"=>"", "harga"=>"", "gambar"=>""];
if (isset($_GET['edit'])) {
    $edit = $app->ambilSatuData($_GET['edit']);
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard Produk OOP</title></head>
<body>
    <h2>Selamat Datang, <?= $_SESSION['username']; ?>! | <a href="logout.php">Logout</a></h2>
    <hr>
    
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $edit['id']; ?>">
        <input type="hidden" name="gambar_lama" value="<?= $edit['gambar']; ?>">
        
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" value="<?= $edit['nama_produk']; ?>" required><br>
        
        <label>Kategori:</label><br>
        <input type="text" name="kategori" value="<?= $edit['kategori']; ?>" required><br>
        
        <label>Harga:</label><br>
        <input type="number" name="harga" value="<?= $edit['harga']; ?>" required><br>
        
        <label>Gambar Produk:</label><br>
        <input type="file" name="gambar" accept="image/*"><br>
        
        <br>
        <button type="submit" name="simpan">Simpan Data</button>
    </form>

    <hr>

    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%;">
        <tr>
            <th>Foto</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php 
        $data = $app->tampilkanData();
        while($row = $data->fetch_assoc()): 
        ?>
        <tr>
            <td align="center">
                <?php if (!empty($row['gambar'])): ?>
                <img src="uploads/<?= $row['gambar']; ?>" width="60" style="border-radius: 5px;">
                <?php else: ?>
                <span style="color: red; font-size: 12px;">Foto tidak ditemukan</span>
                <?php endif; ?>
            </td>
            <td><?= $row['nama_produk']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id']; ?>">Edit</a> | 
                <a href="index.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Hapus data ini?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>