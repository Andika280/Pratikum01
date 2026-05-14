<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

require_once 'App.php';
$app = new Smartflood_sensor();

if (isset($_GET['hapus'])) {
    $app->hapusData($_GET['hapus']);
    $_SESSION['success'] = "Data berhasil dihapus!";
    header("Location: index.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $app->simpanData($_POST, $_FILES);
    $_SESSION['success'] = "Data berhasil disimpan!";
    header("Location: index.php");
    exit;
}

$edit = [
    "id"=>"",
    "lokasi_sungai"=>"",
    "waktu_pengukuran"=>"",
    "tinggi_air"=>"",
    "status_banjir"=>"",
    "deskripsi"=>"",
    "foto_bukti"=>""
];

if (isset($_GET['edit'])) {
    $edit = $app->ambilSatuData($_GET['edit']);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="main-wrapper">

    <div class="header">
        <h2>Dashboard | Halo, <?= $_SESSION['username']; ?></h2>
        <a href="logout.php">Logout</a>
    </div>

    <!-- ALERT -->
    <?php if(isset($_SESSION['success'])): ?>
        <div class="alert-success">
            <?= $_SESSION['success']; ?>
        </div>
    <?php unset($_SESSION['success']); endif; ?>

    <div class="main">

        <div class="form-box">
            <h3>Form Data</h3>

            <form method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $edit['id']; ?>">
                <input type="hidden" name="foto_lama" value="<?= $edit['foto_bukti']; ?>">

                <label>Lokasi:</label>
                <input name="lokasi_sungai" value="<?= $edit['lokasi_sungai']; ?>" required>

                <label>Waktu:</label>
                <input name="waktu_pengukuran" value="<?= $edit['waktu_pengukuran']; ?>" required>

                <label>Tinggi:</label>
                <input type="number" name="tinggi_air" value="<?= $edit['tinggi_air']; ?>" required>

                <label>Status:</label>
                <small>(otomatis dari tinggi air)</small>

                <input type="text"
                value="<?=
                    ($edit['tinggi_air'] ?? 0) <= 50 ? 'Aman' :
                    (($edit['tinggi_air'] ?? 0) <= 100 ? 'Siaga' : 'Bahaya')
                ?>"
                disabled>

                <label>Deskripsi:</label>
                <input name="deskripsi" value="<?= $edit['deskripsi']; ?>" required>

                <label>Foto:</label>
                <input type="file" name="foto_bukti">

                <button name="simpan">Simpan</button>
            </form>
        </div>

        <div class="table-box">
            <h3>Data Monitoring</h3>

            <table>
                <tr>
                    <th>Lokasi</th>
                    <th>Waktu</th>
                    <th>Tinggi</th>
                    <th>Status</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>

                <?php
                $data = $app->tampilkanData();

                if ($data->num_rows == 0) {
                    echo "<tr><td colspan='7'>Belum ada data</td></tr>";
                } else {
                    while($row = $data->fetch_assoc()):
                ?>
                <tr>
                    <td><?= $row['lokasi_sungai']; ?></td>
                    <td><?= $row['waktu_pengukuran']; ?></td>
                    <td><?= $row['tinggi_air']; ?></td>

                    <td>
                    <?php
                    if ($row['status_banjir'] == 1) {
                        echo "<span class='status-aman'>Aman</span>";
                    } elseif ($row['status_banjir'] == 2) {
                        echo "<span class='status-siaga'>Siaga</span>";
                    } else {
                        echo "<span class='status-bahaya'>Bahaya</span>";
                    }
                    ?>
                    </td>

                    <td><?= $row['deskripsi']; ?></td>

                    <td>
                    <?php if($row['foto_bukti'] && file_exists("uploads/".$row['foto_bukti'])): ?>
                        <img src="uploads/<?= $row['foto_bukti']; ?>" class="img-table">
                    <?php else: ?>
                        Tidak ada gambar
                    <?php endif; ?>
                    </td>

                    <td>
                        <a href="?edit=<?= $row['id']; ?>">Edit</a> |
                        <a href="?hapus=<?= $row['id']; ?>" onclick="return confirm('Yakin?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; } ?>
            </table>
        </div>

    </div>

</div>

</body>
</html>