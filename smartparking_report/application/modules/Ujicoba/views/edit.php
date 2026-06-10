<!DOCTYPE html>
<html>
<head>
    <title><?php echo html_escape($title); ?></title>
</head>
<body>

    <p>
        <a href="<?php echo base_url('Ujicoba'); ?>">Kembali ke Daftar</a>
    </p>

    <h2>Ubah Data Ujicoba</h2>

    <form method="post" action="<?php echo base_url('Ujicoba/update/' . $data_ujicoba->id); ?>">
        <label>Nama:</label><br>
        <input type="text" name="nama" value="<?php echo html_escape($data_ujicoba->nama); ?>" required><br><br>

        <label>Keterangan:</label><br>
        <textarea name="keterangan" rows="4" cols="30"><?php echo html_escape($data_ujicoba->keterangan); ?></textarea><br><br>

        <button type="submit">Simpan Perubahan</button>
        <a href="<?php echo base_url('Ujicoba'); ?>">Batal</a>
    </form>

</body>
</html>
