<!DOCTYPE html>
<html>
<head>
    <title><?php echo html_escape($title); ?></title>
</head>
<body>

    <p>
        <a href="<?php echo base_url('Ujicoba'); ?>">Kembali ke Daftar</a>
    </p>

    <h2>Detail Data Ujicoba</h2>

    <table border="1" cellpadding="5">
        <tr>
            <th>ID</th>
            <td><?php echo $data_ujicoba->id; ?></td>
        </tr>
        <tr>
            <th>Nama</th>
            <td><?php echo html_escape($data_ujicoba->nama); ?></td>
        </tr>
        <tr>
            <th>Keterangan</th>
            <td><?php echo nl2br(html_escape($data_ujicoba->keterangan)); ?></td>
        </tr>
    </table>

    <p>
        <a href="<?php echo base_url('Ujicoba/edit/' . $data_ujicoba->id); ?>">Ubah</a>
        |
        <a href="<?php echo base_url('Ujicoba/delete/' . $data_ujicoba->id); ?>">Hapus</a>
    </p>

</body>
</html>
