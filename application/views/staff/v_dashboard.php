<div class="container-fluid">
    <div class="row">
        <!-- Total Mahasiswa -->
        <div class="col-lg-3 col-md-4 col-12">
            <div class="card w-100">
                <div class="card-body border-start border-4 border-danger rounded start">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <span>
                                <iconify-icon icon="ph:student" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                            </span>
                        </div>
                        <div class="col-9 text-start">
                            <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Mahasiswa</span>
                            <span class="d-block fw-bolder" style="font-size: 1.25rem;"><?= $count_mhs; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Dosen -->
        <div class="col-lg-3 col-md-4 col-12">
            <div class="card w-100">
                <div class="card-body border-start border-4 border-warning rounded start">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <span>
                                <iconify-icon icon="material-symbols:school-outline-rounded" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                            </span>
                        </div>
                        <div class="col-9 text-start">
                            <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Dosen</span>
                            <span class="d-block fw-bolder" style="font-size: 1.25rem;"><?= $count_dsn; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Rekomendasi -->
        <div class="col-lg-3 col-md-4 col-12">
            <div class="card w-100">
                <div class="card-body border-start border-4 border-primary rounded start">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <span>
                                <iconify-icon icon="octicon:verified-16" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                            </span>
                        </div>
                        <div class="col-9 text-start">
                            <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Pengguna</span>
                            <span class="d-block fw-bolder" style="font-size: 1.25rem;"><?= $count_pengguna; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Total Pengguna Aktif -->
        <div class="col-lg-3 col-md-4 col-12">
            <div class="card w-100">
                <div class="card-body border-start border-4 border-success rounded start">
                    <div class="row">
                        <div class="col-3 d-flex justify-content-center align-items-center">
                            <span>
                                <iconify-icon icon="fluent:document-folder-16-regular" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                            </span>
                        </div>
                        <div class="col-9 text-start">
                            <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Pengguna Aktif</span>
                            <span class="d-block fw-bolder" style="font-size: 1.25rem;"><?= $count_pengguna_aktif; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
