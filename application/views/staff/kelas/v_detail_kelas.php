<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail data kelas
            </div>
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">nama kelas :</span> <?= $kelas['nama_kelas']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">program studi :</span> <?= $kelas['jenjang'] . ' ' . $kelas['nama_prodi']; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('staff/kelola_kelas'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>