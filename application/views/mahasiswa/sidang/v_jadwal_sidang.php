<?php 
    $bulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];
    $hari = [
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    ];

    if ($jadwal_sidang !== NULL) {
        // Mengubah format tanggal menjadi format bahasa Indonesia
        $tanggal_sidang = strtotime($jadwal_sidang['tgl_sidang']);
        $hari_sidang = $hari[date('w', $tanggal_sidang)];
        $tgl = date('d', $tanggal_sidang);
        $bln = $bulan[date('n', $tanggal_sidang) - 1];
        $thn = date('Y', $tanggal_sidang);
    }
?>
<div class="container-fluid">
    <div class="row">
        <?php if ( $jadwal_sidang !== NULL ) : ?>
        <div class="col-lg-6 col-12">
            <div class="card w-100">
                <div class="card-body">
                        <h5 class="card-title fw-semibold">Jadwal Sidang</h5>
                        <div class="tabel-responsive mb-3">
                            <table class="table">
                                <tr>
                                    <th>Nama</th>
                                    <td>: <?= $jadwal_sidang['mahasiswa_nama'] ?></td>
                                </tr>
                                <tr>
                                    <th>NPM</th>
                                    <td>: <?= $jadwal_sidang['mahasiswa_npm'] ?></td>
                                </tr>
                                <tr>
                                    <th>Kelas</th>
                                    <td>: <?= $jadwal_sidang['nama_kelas'] ?></td>
                                </tr>
                                <tr>
                                    <th>Hari/Tanggal</th>
                                    <td>: <?= $hari_sidang ?>, <?= $tgl ?> <?= $bln ?> <?= $thn ?></td>
                                </tr>
                                <tr>
                                    <th>Waktu</th>
                                    <td>: <?= date('H:i', strtotime($jadwal_sidang['waktu_sidang'])) ?> - <?= date('H:i', strtotime($jadwal_sidang['waktu_sidang']) + 3600) ?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="d-flex justify-content-end">
                            <a href="<?= base_url('mahasiswa/detail_jadwal_sidang/' . $jadwal_sidang['id']); ?>" class="btn btn-outline-primary rounded-pill d-flex align-items-center">
                                <span class="me-2">
                                    Selengkapnya
                                </span>
                                <iconify-icon icon="majesticons:arrow-right"></iconify-icon>
                            </a>
                        </div>
                </div>
            </div>
        </div>
        <?php else : ?>
            <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header bg-danger text-white">
                    Form Informasi Jadwal Sidang
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <img src="<?= base_url('assets/images/backgrounds/ill-404.svg') ?>" alt="bg-ill-404" class="img-fluid w-75">
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <div class="d-flex d-block align-items-center justify-content-between mb-4">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title text-center text-capitalize">Jadwal Pelaksanaan Sidang Anda belum ditentukan.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
