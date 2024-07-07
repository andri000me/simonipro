<div class="col-md-4">
    <div class="card" style="width: 30rem;">
        <div class="card-header">
            Detail Data Plotting
        </div>
        <div class="card-body">
            <!-- <h5 class="card-title">Data Plotting</h5> -->
            <div class="row">
                <div class="col-md-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Koordinator :</span> <?= $plotting['koordinator_nama']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dosen Pembimbing :</span> <?= $plotting['dosen_pembimbing_nama']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Mahasiswa :</span> <?= $plotting['mahasiswa_nama']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">NPM :</span> <?= $plotting['mahasiswa_npm']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Project :</span> <?= $plotting['project_nama']; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dosen Penguji 1 :</span> 
                            <?php if ( $plotting['dosen_penguji_1_nama'] ) : ?>
                                <?= $plotting['dosen_penguji_1_nama']; ?>
                                <?php else : ?>
                                    -
                            <?php endif; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dosen Penguji 2 :</span> 
                            <?php if ( $plotting['dosen_penguji_2_nama'] ) : ?>
                                <?= $plotting['dosen_penguji_2_nama']; ?>
                                <?php else : ?>
                                    -
                            <?php endif; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Dibuat pada :</span> <?= date('d-M-Y H:i', strtotime($plotting['created_at'])); ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Diubah pada :</span> <?= date('d-M-Y H:i', strtotime($plotting['updated_at'])); ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Jenis Plotting :</span> <?= $plotting['jenis_plotting_nama']; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('koordinator/kelola_plotting'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>
