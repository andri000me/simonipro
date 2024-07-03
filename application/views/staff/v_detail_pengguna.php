<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail data pengguna
            </div>
        <div class="card-body">
            <!-- <h5 class="card-title"><?= $pengguna['nama']; ?></h5> -->
            <div class="row">
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">username :</span> <?= $pengguna['username']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">password :</span> <?= $pengguna['password']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">role :</span> <?= $pengguna['nama_role']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">status :</span> <?= ($pengguna['is_active'] == 1) ? 'Aktif' : 'Tidak Aktif'; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">dibuat pada :</span> <?= date('d-m-Y H:i:s', $pengguna['created_at']); ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">diubah pada :</span> <?= date('d-m-Y H:i:s', $pengguna['updated_at']); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('staff/kelola_pengguna'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>