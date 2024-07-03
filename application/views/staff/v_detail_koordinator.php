<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail data koordinator
            </div>
        <div class="card-body">
            <h5 class="card-title"><?= $koordinator['nama']; ?></h5>
            <div class="row">
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">nidn :</span> <?= $koordinator['nidn']; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('assets/images/upload/' . $koordinator['gambar']); ?>" alt="default" class="img-thumbnail" style="width: 150px;">
                </div>
            </div>
            <a href="<?= base_url('staff/kelola_koordinator'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>