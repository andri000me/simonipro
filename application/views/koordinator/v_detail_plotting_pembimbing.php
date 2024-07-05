<div class="col-md-4">
    <div class="card" style="width: 30rem;">
        <div class="card-header">
            Detail data plotting
        </div>
        <div class="card-body">
            <h5 class="card-title">Data plotting</h5>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Koordinator :</span> <?= $plotting['koordinator_nama']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dosen Pembimbing :</span> <?= $plotting['dosen_nama']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Mahasiswa :</span> <?= $plotting['mahasiswa_nama']; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dibuat pada :</span> <?= date('d-M-Y H:i', $plotting['created_at']); ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Diubah pada :</span> <?= date('d-M-Y H:i', $plotting['updated_at']); ?>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('koordinator/kelola_plotting_pembimbing'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
