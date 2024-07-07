<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail data prodi
            </div>
        <div class="card-body">
            <h5 class="card-title"><?= $prodi['nama_prodi']; ?></h5>
            <div class="row">
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">kode prodi :</span> <?= $prodi['kode_prodi']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">jenjang :</span> <?= $prodi['jenjang']; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('staff/kelola_prodi'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>