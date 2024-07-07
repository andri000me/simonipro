<div class="col-md-4">
    <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail data project
            </div>
        <div class="card-body">
            <h5 class="card-title"><?= $projects['nama_project']; ?></h5>
            <div class="row">
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">deskripsi :</span> <?= $projects['deskripsi']; ?>
                        </li>
                    </ul>
                </div>
                <div class="col-6">
                    <ul>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Tanggal dimulai :</span> <?= $projects['tgl_mulai']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Tanggal selesai :</span> <?= $projects['tgl_selesai']; ?>
                        </li>
                        <li class="mb-2 text-capitalize">
                            <span class="fw-bold d-block">Prodi :</span> <?= $projects['nama_prodi']; ?>
                        </li>
                    </ul>
                </div>
            </div>
            <a href="<?= base_url('koordinator/kelola_project'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div>