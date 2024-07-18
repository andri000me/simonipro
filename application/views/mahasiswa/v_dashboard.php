    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-danger rounded start">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:clipboard" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-9 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">65</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-primary rounded start">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:users" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-9 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">9</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-warning rounded start">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:github" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-9 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">22</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-success rounded start">
                        <div class="row">
                            <div class="col-3 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:plane" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-9 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">12</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Kalender -->
        <div class="row">
            <div class="col-lg-8 d-flex align-items-stretch">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Kalender Proyek 2</h5>
                            </div>
                            <div class="mb-3 mb-sm-0">
                                <a href="<?= base_url('mahasiswa/print_kalender') ?>" class="btn btn-danger d-flex">
                                    <span class="text-white d-inline-block d-flex align-items-center me-1">
                                        <iconify-icon icon="ant-design:file-pdf-outlined"></iconify-icon>
                                    </span>
                                    Print PDF
                                </a>
                            </div>
                        </div>
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- List Event -->
                        <div class="card overflow-hidden">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-3 fw-semibold">List Kegiatan</h5>
                                <div class="event-list" id="event-list">
                                    <?php if (!empty($events)): ?>
                                        <?php foreach ($events as $event): ?>
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">Informasi kegiatan</h5>
                                                    <small class="text-muted">
                                                        <span class="fw-bold">Mulai</span> :<?= $event['start']; ?> <br>
                                                        <span class="fw-bold">Selesai</span> :<?= $event['end']; ?> <br>
                                                    </small>
                                                    <small class="text-muted">
                                                        <span class="fw-bold">Keterangan: <br></span>
                                                        <?= $event['title']; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <p>Tidak ada kegiatan untuk hari ini.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <!-- Monthly Earnings -->
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-start">
                                    <div class="col-8">
                                        <h5 class="card-title mb-9 fw-semibold">Monthly Earnings</h5>
                                        <h4 class="fw-semibold mb-3">$6,820</h4>
                                        <div class="d-flex align-items-center pb-1">
                                            <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-arrow-down-right text-danger"></i>
                                            </span>
                                            <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                            <p class="fs-3 mb-0">last year</p>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="d-flex justify-content-end">
                                            <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                                <i class="ti ti-currency-dollar fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="earning"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>