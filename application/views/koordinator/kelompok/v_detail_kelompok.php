<div class="col-md-8">
    <div class="card" style="width: 45rem;">
        <div class="card-header">
            Detail data kelompok
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <table class="table table-bordered table-hover table-responsive">
                        <tbody>
                            <tr class="text-uppercase">
                                <th scope="col">Nama pembimbing</th>
                                <td scope="row">: <?= $kelompok['nama_pembimbing'] ?></td>
                            </tr>
                            <tr class="text-uppercase">
                                <th scope="col">Semester/Tahun ajaran</th>
                                <td scope="row">: <?= ($kelompok['semester'] % 2 == 0) ? 'Genap, ' : 'Ganjil, ' ?><?= $kelompok['tahun_ajaran']; ?></td>
                            </tr>
                            <tr class="text-uppercase">
                                <th scope="col">Kelas</th>
                                <td scope="row">: <?= $kelompok['jenjang']; ?>-<?= getShortProdi($kelompok['nama_prodi']); ?>-<?= $kelompok['nama_kelas']; ?></td>
                            </tr>
                            <tr class="text-uppercase">
                                <th scope="col">Kode Kelompok</th>
                                <td scope="row">: <?= $kelompok['kode_kelompok'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h5 class="mt-4 text-uppercase">Anggota Kelompok</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-uppercase">
                                <th>#</th>
                                <th>NPM</th>
                                <th>Nama mahasiswa</th>
                                <th>Kelas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($anggota_kelompok)) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($anggota_kelompok as $anggota) : ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= $anggota['mahasiswa_npm'] ?></td>
                                        <td><?= $anggota['mahasiswa_nama'] ?></td>
                                        <td><?= $anggota['jenjang']; ?>-<?= getShortProdi($anggota['nama_prodi']); ?>-<?= $anggota['nama_kelas']; ?></td>
                                    </tr>
                                    <?php $i++ ?>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada anggota kelompok</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="<?= base_url('koordinator/kelola_kelompok'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
