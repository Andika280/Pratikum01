<!DOCTYPE html>
<html>
<head>
    <title><?php echo html_escape($title); ?></title>
</head>
<body>

    <h2>Data Ujicoba</h2>

    <p>
        <a href="<?php echo base_url('Ujicoba/create'); ?>">Tambah Data</a>
    </p>

    <table border="1" width="100%" cellpadding="5">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data_ujicoba)): ?>
                <tr>
                    <td colspan="4" align="center">Data masih kosong</td>
                </tr>
            <?php else: ?>
                <?php $no = 1; ?>
                <?php foreach ($data_ujicoba as $row): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo html_escape($row->nama); ?></td>
                        <td><?php echo html_escape($row->keterangan); ?></td>
                        <td>
                            <a href="<?php echo base_url('Ujicoba/show/' . $row->id); ?>">Lihat</a>
                            |
                            <a href="<?php echo base_url('Ujicoba/edit/' . $row->id); ?>">Ubah</a>
                            |
                            <a href="<?php echo base_url('Ujicoba/delete/' . $row->id); ?>">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>
