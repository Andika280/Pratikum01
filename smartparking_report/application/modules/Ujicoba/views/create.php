<!DOCTYPE html>
<html>
<head>
    <title><?php echo html_escape($title); ?></title>
</head>
<body>

    <p>
        <a href="<?php echo base_url('Ujicoba'); ?>">Kembali ke Daftar</a>
    </p>

    <h2>Tambah Data Ujicoba</h2>

    <form method="post" action="<?php echo base_url('Ujicoba/store'); ?>">
        <label>Nama:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Keterangan:</label><br>
        <textarea name="keterangan" rows="4" cols="30"></textarea><br><br>

        <button type="submit">Simpan</button>
        <a href="<?php echo base_url('Ujicoba'); ?>">Batal</a>
    </form>

</body>
</html>
