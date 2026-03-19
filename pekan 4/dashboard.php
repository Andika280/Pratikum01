<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $nama_produk = htmlspecialchars($_POST["nama_produk"]);
    $kategori = htmlspecialchars($_POST["kategori"]);
    $harga = htmlspecialchars($_POST["harga"]);

    $sql = "INSERT INTO products (nama_produk, kategori, harga) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama_produk, $kategori, $harga);
    $stmt->execute();
    $stmt->close();
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard Agrilink ID</title></head>
<body>
    <h2>Selamat Datang, <?php echo $_SESSION['current_user']; ?>! <a href="dashboard.php?action=logout" style="color:red; font-size:14px;">[Logout]</a></h2>
    <hr>

    <h3>Tambah Produk Pertanian</h3>
    <form method="post" action="">
        Nama Produk: <input type="text" name="nama_produk" required> <br><br>
        Kategori: <input type="text" name="kategori" required> <br><br>
        Harga (Rp): <input type="number" name="harga" required> <br><br>
        <button type="submit" name="tambah">Simpan Produk</button>
    </form>
    <br>

    <h3>Katalog Produk</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th><th>Nama Produk</th><th>Kategori</th><th>Harga</th><th>Aksi</th>
        </tr>
        <?php
        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $no = 1;
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $row['nama_produk'] . "</td>";
                echo "<td>" . $row['kategori'] . "</td>";
                echo "<td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>"; 
                echo "<td>
                        <a href='edit.php?id=".$row['id']."'>Edit</a> | 
                        <a href='hapus.php?id=".$row['id']."' onclick='return confirm(\"Yakin ingin menghapus?\")'>Hapus</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>Belum ada produk.</td></tr>";
        }
        ?>
    </table>
</body>
</html>