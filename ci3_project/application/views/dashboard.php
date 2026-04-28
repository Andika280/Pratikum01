<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Agrilink ID - Manajemen Produk</title>
    <style>
        body { font-family: sans-serif; margin: 20px; background-color: #f4f4f4; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #2ecc71; color: white; }
        .btn { padding: 8px 12px; text-decoration: none; border-radius: 4px; color: white; }
        .btn-edit { background-color: #f1c40f; }
        .btn-delete { background-color: #e74c3c; }
        .btn-logout { background-color: #34495e; float: right; }
    </style>
</head>
<body>

<div class="container">
    <h2>Halo, <?= $this->session->userdata('username'); ?>! 
        <a href="<?= base_url('auth/logout'); ?>" class="btn btn-logout">Logout</a>
    </h2>
    <hr>

    <h3>Form Kelola Produk Agrilink ID</h3>
    <?php echo form_open_multipart('dashboard/simpan'); ?>
        <input type="hidden" name="id" value="<?= $edit['id']; ?>">
        <input type="hidden" name="gambar_lama" value="<?= $edit['gambar']; ?>">
        
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" value="<?= $edit['nama_produk']; ?>" placeholder="Contoh: Padi Organik" required style="width: 100%; padding: 8px; margin: 8px 0;"><br>
        
        <label>Kategori:</label><br>
        <select name="kategori" required style="width: 100%; padding: 8px; margin: 8px 0;">
            <option value="">-- Pilih Kategori --</option>
            <option value="Sayuran" <?= $edit['kategori'] == 'Sayuran' ? 'selected' : ''; ?>>Sayuran</option>
            <option value="Buah" <?= $edit['kategori'] == 'Buah' ? 'selected' : ''; ?>>Buah</option>
            <option value="Biji-bijian" <?= $edit['kategori'] == 'Biji-bijian' ? 'selected' : ''; ?>>Biji-bijian</option>
        </select><br>
        
        <label>Harga (Rp):</label><br>
        <input type="number" name="harga" value="<?= $edit['harga']; ?>" required style="width: 100%; padding: 8px; margin: 8px 0;"><br>
        
        <label>Upload Foto Produk:</label><br>
        <input type="file" name="gambar" accept="image/*"><br>
        <small style="color: #666;">Format: JPG/PNG, Maksimal 2MB</small><br><br>
        
        <button type="submit" style="background-color: #27ae60; color: white; padding: 10px 20px; border: none; cursor: pointer;">Simpan Produk</button>
    <?php echo form_close(); ?>

    <hr>

    <h3>Katalog Produk Pertanian</h3>
    <table>
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if(empty($produk)): ?>
                <tr><td colspan="5" align="center">Belum ada produk yang terdaftar.</td></tr>
            <?php else: ?>
                <?php foreach($produk as $row): ?>
                <tr>
                    <td align="center">
                        <?php if($row['gambar']): ?>
                            <img src="<?= base_url('uploads/'.$row['gambar']); ?>" width="80" style="border-radius: 5px;">
                        <?php else: ?>
                            <small>Tidak ada foto</small>
                        <?php endif; ?>
                    </td>
                    <td><strong><?= $row['nama_produk']; ?></strong></td>
                    <td><?= $row['kategori']; ?></td>
                    <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                    <td>
                        <a href="<?= base_url('dashboard?edit_id='.$row['id']); ?>" class="btn btn-edit">Edit</a>
                        <a href="<?= base_url('dashboard/hapus/'.$row['id']); ?>" class="btn btn-delete" onclick="return confirm('Yakin ingin menghapus produk ini?')">Hapus</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>