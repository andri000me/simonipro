<div class="col-md-8">
    <div class="card" style="width: 45rem;">
        <div class="card-header">
            Detail data absensi
        </div>
        <div class="card-body">
            <h5 class="card-title text-uppercase text-center mb-3">Form bimbingan</h5>
            <div class="row mb-3">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-uppercase">
                                <th>NPM</th>
                                <th>Nama mahasiswa</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $kelompok['npm'] ?></td>
                                <td><?= $kelompok['nama_mahasiswa'] ?></td>
                                <td><?= $kelompok['nama_kelas']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-uppercase">
                                <th>No</th>
                                <th>Tanggal Bimbingan</th>
                                <th>Topik</th>
                                <th>Paraf Pembimbing</th>
                                <th>Paraf Mahasiswa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ( $absensi_bimbingan as $absen ) : ?>
                                <tr>
                                    <td><?= $i; ?></td>
                                    <td><?= $absen['tgl_bimbingan']; ?></td>
                                    <td><?= $absen['topik']; ?></td>
                                    <td>
                                        <?= $absen['is_confirmed'] === 'confirmed' ? '<small class="badge text-bg-success">Terkonfirmasi</small>' : '<small class="badge text-bg-warning">Belum Terkonfirmasi</small>'; ?>
                                    </td>
                                    <td>
                                        <?= $absen['is_confirmed'] === 'confirmed' ? '<small class="badge text-bg-success">Paraf Lengkap</small>' : '<small class="badge text-bg-danger">Paraf Belum Lengkap</small>'; ?>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="<?= base_url('mahasiswa/kelola_absensi'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
