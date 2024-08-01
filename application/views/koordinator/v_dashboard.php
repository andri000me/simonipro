<?php 
    $bln = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];
?>
    <div class="container-fluid">
        <div class="row">
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
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Rekomendasi</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;"><?= $count_rekomendasi; ?></span>
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
                                    <iconify-icon icon="fluent:document-folder-16-regular" width="2.65rem" style="color: #d9d9d9;"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-9 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Siap Sidang</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;"><?= $count_siap_sidang; ?></span>
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
                                <a href="<?= base_url('koordinator/print_kalender') ?>" class="btn btn-primary d-flex">
                                    <span class="text-white d-inline-block d-flex align-items-center me-1">
                                        <iconify-icon icon="ant-design:file-pdf-outlined"></iconify-icon>
                                    </span>
                                    Download PDF
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
                <!-- Perkembangan Proyek -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-9 fw-semibold">Perkembangan Proyek</h5>
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h4 class="mb-3"><?= round($percent_siap_sidang, 2); ?> / <span class="fw-semibold">100%</span></h4>
                                <div class="d-block">
                                    <div class="me-4">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Siap Sidang</span>
                                    </div>
                                    <div>
                                        <span class="round-8 bg-light-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Rekomendasi</span>
                                    </div>
                                    <div>
                                        <span class="round-8 bg-light rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Belum Terpenuhi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-center">
                                    <div id="breakup"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Perkembangan Proyek -->
              </div>
                <div class="col-lg-12">
                    <!-- Riwayat kegiatan -->
                    <div class="card w-100" style="max-height: 60vh;">
                    <div class="card-body p-4 overflow-auto">
                        <div class="mb-4">
                        <h5 class="card-title fw-semibold">Riwayat kegiatan</h5>
                        <div class="d-flex align-items-center">
                            <span class="me-1 d-flex align-items-center">
                                <i class="ti ti-point text-danger"></i>
                                <small>Selesai</small>
                            </span>
                            <span class="me-1 d-flex align-items-center">
                                <i class="ti ti-point text-warning"></i>
                                <small>Berlangsung</small>
                            </span>
                            <span class="me-1 d-flex align-items-center">
                                <i class="ti ti-point text-success"></i>
                                <small>Segera</small>
                            </span>
                        </div>
                        </div>
                        <ul class="timeline-widget mb-0 position-relative mb-n5">
                            <?php foreach ($events as $event) : ?>
                            <?php
                                // Tentukan kelas border berdasarkan status event
                                $start = strtotime($event['start']);
                                $end = strtotime($event['end']);
                                $now = time();
                                
                                if ($end < $now) {
                                    $borderClass = 'border-danger';
                                } elseif ($start <= $now && $end >= $now) {
                                    $borderClass = 'border-warning';
                                } else {
                                    $borderClass = 'border-success';
                                }

                                // Format tanggal tanpa fungsi terpisah
                                $tanggal = strtotime($event['start']);
                                $bulan = $bln[date('n', $tanggal) - 1];
                                $formattedDate = date('d', $tanggal) . ' ' . $bulan . ' ' . date('Y', $tanggal);
                            ?>
                            <li class="timeline-item d-flex position-relative overflow-hidden">
                                <div class="timeline-badge-wrap d-flex flex-column align-items-center">
                                <span class="timeline-badge border-2 border <?php echo $borderClass; ?> flex-shrink-0 my-8"></span>
                                <span class="timeline-badge-border d-block flex-shrink-0"></span>
                                </div>
                                <div class="timeline-desc text-dark mt-n1">
                                <span class="fs-3 fw-semibold d-block">
                                    <?php echo $formattedDate; ?>
                                </span>
                                <small><?php echo $event['title']; ?></small>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>