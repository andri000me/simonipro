<div class="container-fluid">
    <div class="col-md-4">
        <!-- <h5 class="card-title fw-semibold mb-4">Header and footer</h5> -->
        <div class="card" style="width: 30rem;">
            <div class="card-header">
                Detail Data Penilaian
            </div>
            <div class="card-body">
                <!-- <h5 class="card-title"><?= $penilaian['nama_project']; ?></h5> -->
                <div class="row">
                    <div class="col-6">
                        <ul>
                            <li class="mb-2 text-capitalize">
                                <span class="fw-bold d-block">Nilai Penguji 1 :</span> <?= $penilaian['nilai_penguji_1']; ?>
                            </li>
                            <li class="mb-2 text-capitalize">
                                <span class="fw-bold d-block">Nilai Penguji 2 :</span> <?= $penilaian['nilai_penguji_2']; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="col-6">
                        <ul>
                            <li class="mb-2 text-capitalize">
                                <span class="fw-bold d-block">Grade :</span> <?= $penilaian['grade']; ?>
                            </li>
                            <li class="mb-2 text-capitalize">
                                <span class="fw-bold d-block">Status Kelulusan :</span> <?= $penilaian['status_kelulusan']; ?>
                            </li>
                        </ul>
                    </div>
                </div>
                <a href="<?= base_url('dosen/kelola_penilaian'); ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>
