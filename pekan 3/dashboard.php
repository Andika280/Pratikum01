<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

if (!isset($_SESSION['agrilink_products'])) {
    $_SESSION['agrilink_products'] = [];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah'])) {
    $nama_produk = htmlspecialchars(trim($_POST["nama_produk"]));
    $harga = htmlspecialchars(trim($_POST["harga"]));
    $kategori = htmlspecialchars(trim($_POST["kategori"]));

    if (!empty($nama_produk) && !empty($harga) && !empty($kategori)) {
        $_SESSION['agrilink_products'][] = [
            "nama" => $nama_produk,
            "harga" => $harga,
            "kategori" => $kategori
        ];
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy();
    header("Location: login.php");
    exit;
}
?>

<?php include 'header.php'; ?>
    <h2>Selamat Datang, <?php echo $_SESSION['current_user']; ?>!</h2>
    <a href="dashboard.php?action=logout" style="color: red;">[Logout]</a>
    
    <hr>

    <h3>Tambah Produk Pertanian (Create)</h3>
    <form method="post" action="">
        Nama Produk: <input type="text" name="nama_produk" required> <br><br>
        Kategori (Sayur/Buah/Biji): <input type="text" name="kategori" required> <br><br>
        Harga (Rp): <input type="number" name="harga" required> <br><br>
        <input type="submit" name="tambah" value="Simpan Produk">
    </form>

    <br>

    <h3>Katalog Produk (Read)</h3>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No</th>
            <th>Nama Produk</th>
            <th>Kategori</th>
            <th>Harga (Rp)</th>
        </tr>
        <?php
        if (count($_SESSION['agrilink_products']) > 0) {
            $no = 1;
            foreach ($_SESSION['agrilink_products'] as $produk) {
                echo "<tr>";
                echo "<td>" . $no++ . "</td>";
                echo "<td>" . $produk['nama'] . "</td>";
                echo "<td>" . $produk['kategori'] . "</td>";
                echo "<td>Rp " . number_format($produk['harga'], 0, ',', '.') . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Belum ada produk yang ditambahkan.</td></tr>";
        }
        ?>
    </table>
</body>
</html>