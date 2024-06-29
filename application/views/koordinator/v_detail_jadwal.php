<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail data Jadwal
            </div>
        <div class="card-body">
            <h5 class="card-title"><?= $jadwal['nama_jadwal']; ?></h5>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dibuat pada :</span> <?= date('d-M-Y', $jadwal['created_at']); ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Diubah pada :</span> <?= date('d-M-Y', $jadwal['updated_at']); ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Status jadwal :</span> 
                            <span class="text-warning">
                                <?= $jadwal['status']; ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('koordinator/kelola_jadwal'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>