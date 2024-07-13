<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 45rem;">
            <div class="card-header">
                Detail data kelompok
            </div>
        <div class="card-body">
            <!-- <h5 class="card-title text-uppercase">Pembentukan kelompok</h5> -->
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
                                <td scope="row">: <?= ($kelompok['semester'] % 2 == 0) ? 'Genap, ' : 'Ganjil, ' ?><?=$kelompok['tahun_ajaran']; ?></td>
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
            <a href="<?= base_url('koordinator/kelola_kelompok'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>