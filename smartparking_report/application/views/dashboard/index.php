<?php $this->load->view('templates/header', ['title' => 'Dashboard']); ?>

<div class="main-wrapper">

    <div class="header">
        <h2>Dashboard | Halo, <?= $this->session->userdata('username'); ?></h2>
        <a href="<?= base_url('auth/logout'); ?>">Logout</a>
    </div>

    <!-- ALERT -->
    <?php if($this->session->flashdata('success')): ?>
        <div class="alert-success">
            <?= $this->session->flashdata('success'); ?>
        </div>
    <?php endif; ?>

    <div class="main">

        <div class="form-box">
            <h3>Form Data</h3>

            <form action="<?= base_url('dashboard/save'); ?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $edit['id']; ?>">
                <input type="hidden" name="foto_lama" value="<?= $edit['foto_bukti']; ?>">

                <label>Lokasi:</label>
                <input name="lokasi" value="<?= $edit['lokasi']; ?>" required>

                <label>Waktu laporan:</label>
                <input name="waktu_laporan" value="<?= $edit['waktu_laporan']; ?>" required>

                <label>Jumlah Kendaraan:</label>
                <input type="number" name="jumlah_kendaraan" value="<?= $edit['jumlah_kendaraan']; ?>" required>

                <label>Status Pelanggaran:</label>
                <small>(otomatis dari jumlah kendaraan)</small>

                <input type="text"
                value="<?=
                    ($edit['jumlah_kendaraan'] ?? 0) <= 5 ? 'Ringan' :
                    (($edit['jumlah_kendaraan'] ?? 0) <= 15 ? 'Sedang' : 'Berat')
                ?>"
                disabled>

                <label>Deskripsi:</label>
                <input name="deskripsi" value="<?= $edit['deskripsi']; ?>" required>

                <label>Foto:</label>
                <input type="file" name="foto_bukti">

                <button type="submit" name="simpan">Simpan</button>
                <?php if($edit['id']): ?>
                    <a href="<?= base_url('dashboard'); ?>" style="display:inline-block; margin-top:10px; color: #666;">Batal Edit</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-box">
            <h3>Data Laporan</h3>

            <table>
                <tr>
                    <th>Lokasi</th>
                    <th>Waktu laporan</th>
                    <th>Jumlah Kendaraan</th>
                    <th>Status Pelanggaran</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>

                <?php if (empty($monitoring)): ?>
                    <tr><td colspan='7'>Belum ada data</td></tr>
                <?php else: ?>
                    <?php foreach($monitoring as $row): ?>
                    <tr>
                        <td><?= $row['lokasi']; ?></td>
                        <td><?= $row['waktu_laporan']; ?></td>
                        <td><?= $row['jumlah_kendaraan']; ?></td>

                        <td>
                        <?php
                        if ($row['status_pelanggaran'] == 1) {
                            echo "<span class='status-ringan'>Ringan</span>";
                        } elseif ($row['status_pelanggaran'] == 2) {
                            echo "<span class='status-sedang'>Sedang</span>";
                        } else {
                            echo "<span class='status-berat'>Berat</span>";
                        }
                        ?>
                        </td>

                        <td><?= $row['deskripsi']; ?></td>

                        <td>
                        <?php if($row['foto_bukti'] && file_exists('./assets/uploads/'.$row['foto_bukti'])): ?>
                            <img src="<?= base_url('assets/uploads/'.$row['foto_bukti']); ?>" class="img-table">
                        <?php else: ?>
                            Tidak ada gambar
                        <?php endif; ?>
                        </td>

                        <td>
                            <a href="<?= base_url('dashboard/index/'.$row['id']); ?>">Edit</a> |
                            <a href="<?= base_url('dashboard/delete/'.$row['id']); ?>" onclick="return confirm('Yakin?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </table>
        </div>

    </div>

</div>

<?php $this->load->view('templates/footer'); ?>
