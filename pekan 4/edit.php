<?php
require 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nama_produk = $_POST['nama_produk'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];

    $sql = "UPDATE products SET nama_produk=?, kategori=?, harga=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $nama_produk, $kategori, $harga, $id);
    
    if ($stmt->execute()) {
        header("Location: dashboard.php");
        exit();
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head><title>Edit Produk</title></head>
<body>
    <h2>Edit Produk Pertanian</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
        Nama Produk: <input type="text" name="nama_produk" value="<?php echo $data['nama_produk']; ?>" required> <br><br>
        Kategori: <input type="text" name="kategori" value="<?php echo $data['kategori']; ?>" required> <br><br>
        Harga (Rp): <input type="number" name="harga" value="<?php echo $data['harga']; ?>" required> <br><br>
        <button type="submit">Update Data</button>
    </form>
</body>
</html>