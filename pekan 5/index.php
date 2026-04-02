<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $gambar = $_POST['gambar_lama'];

    if ($_FILES['gambar']['name'] != "") {
        $uploadDir = 'uploads/';
        $imageFileType = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png'];

        if (in_array($imageFileType, $allowedTypes)) {
            $newFileName = time() . "." . $imageFileType; 
            $targetFile = $uploadDir . $newFileName;
            
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
                $gambar = $newFileName;
            } else {
                echo "<script>alert('Gagal mengunggah gambar!');</script>";
            }
        } else {
            echo "<script>alert('Format gambar tidak diizinkan!');</script>";
        }
    }

    if (empty($id)) {

        $sql = "INSERT INTO produk (nama_produk, kategori, harga, gambar) VALUES ('$nama_produk', '$kategori', '$harga', '$gambar')";
    } else {

        $sql = "UPDATE produk SET nama_produk='$nama_produk', kategori='$kategori', harga='$harga', gambar='$gambar' WHERE id=$id";
    }
    
    $conn->query($sql);
    header("Location: index.php"); 
    exit;
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM produk WHERE id=$id");
    header("Location: index.php");
    exit;
}

$id_edit = $nama_edit = $kategori_edit = $harga_edit = $gambar_edit = "";
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $data = $conn->query("SELECT * FROM produk WHERE id=$id")->fetch_assoc();
    $id_edit = $data['id'];
    $nama_edit = $data['nama_produk'];
    $kategori_edit = $data['kategori'];
    $harga_edit = $data['harga'];
    $gambar_edit = $data['gambar'];
}
?>

<!DOCTYPE html>
<html>
<head><title>Dashboard Agrilink</title></head>
<body>
    <h2>Selamat Datang, <?= $_SESSION['username']; ?>! | <a href="logout.php">Logout</a></h2>
    <hr>

    <h3>Form Data Produk</h3>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $id_edit; ?>">
        <input type="hidden" name="gambar_lama" value="<?= $gambar_edit; ?>">
        
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" value="<?= $nama_edit; ?>" required><br>
        
        <label>Kategori:</label><br>
        <input type="text" name="kategori" value="<?= $kategori_edit; ?>" required><br>
        
        <label>Harga (Rp):</label><br>
        <input type="number" name="harga" value="<?= $harga_edit; ?>" required><br>
        
        <label>Upload Gambar:</label><br>
        <input type="file" name="gambar" accept="image/*"><br>
        <?php if($gambar_edit != "") echo "<small>Gambar saat ini: $gambar_edit</small><br>"; ?>
        
        <br>
        <button type="submit" name="simpan">Simpan Data</button>
    </form>

    <hr>

    <h3>Daftar Produk</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM produk ORDER BY id DESC");
        $no = 1;
        while ($row = $result->fetch_assoc()):
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td>
                <?php if ($row['gambar'] != ""): ?>
                <img src="uploads/<?= $row['gambar'] ?>" width="80">
                <?php else: ?>
                Tidak ada
                <?php endif; ?>
            </td>
            <td><?= $row['nama_produk']; ?></td>
            <td><?= $row['kategori']; ?></td>
            <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
            <td>
                <a href="index.php?edit=<?= $row['id']; ?>">Edit</a> | 
                <a href="index.php?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin hapus data?');">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>