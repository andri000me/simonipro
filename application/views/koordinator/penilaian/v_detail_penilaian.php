<?php 
$bln = [
    'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
    'September', 'Oktober', 'November', 'Desember'
];
$hari = [
    'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
];

// Menguraikan tanggal sidang
$date = strtotime($penilaian['tgl_sidang']);
$day = date('N', $date) - 1; // Mengambil indeks hari (0-6)
$dayNum = date('j', $date); // Mengambil tanggal (1-31)
$month = date('n', $date) - 1; // Mengambil indeks bulan (0-11)
$year = date('Y', $date); // Mengambil tahun (4 digit)

// Menguraikan waktu sidang
$time = strtotime($penilaian['waktu_sidang']);
$hour = date('H', $time); // Mengambil jam (00-23)
$minute = date('i', $time); // Mengambil menit (00-59)

// Menguraikan tanggal created_at dan updated_at
$created_at_date = $penilaian['created_at'];
$created_day = date('j', $created_at_date); // Mengambil tanggal (1-31)
$created_month = date('n', $created_at_date) - 1; // Mengambil indeks bulan (0-11)
$created_year = date('Y', $created_at_date); // Mengambil tahun (4 digit)

$updated_at_date = $penilaian['updated_at'];
$updated_day = date('j', $updated_at_date); // Mengambil tanggal (1-31)
$updated_month = date('n', $updated_at_date) - 1; // Mengambil indeks bulan (0-11)
$updated_year = date('Y', $updated_at_date); // Mengambil tahun (4 digit)
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>
                    Detail Penilaian
                </span>
                <a href="<?= base_url('koordinator/print_berita_acara/' . $penilaian['penilaian_id']); ?>" class="btn btn-secondary d-flex align-items-center">
                    <iconify-icon icon="material-symbols:download" class="me-2 d-inline-block" width="1.295rem"></iconify-icon>
                    Berita Acara
                </a>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-12">
                        <h5 class="text-uppercase">Data Waktu Sidang</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Hari/Tanggal</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">
                                            <?= $hari[$day] . ', ' . $dayNum . ' ' . $bln[$month] . ' ' . $year; ?>
                                        </td>
                                        <td scope="row">
                                            <?= $hour . ':' . $minute ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <h5 class="text-uppercase">Data Penguji</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>NIDN</th>
                                        <th>Nama Penguji 1</th>
                                        <th>NIDN</th>
                                        <th>Nama Penguji 2</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">
                                            <?= $penilaian['dosen_penguji_1_nidn']; ?>
                                        </td>
                                        <td scope="row">
                                            <?= $penilaian['dosen_penguji_1_nama']; ?>
                                        </td>
                                        <td scope="row">
                                            <?= $penilaian['dosen_penguji_2_nidn']; ?>
                                        </td>
                                        <td scope="row">
                                            <?= $penilaian['dosen_penguji_2_nama']; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <h5 class="text-uppercase">Data Mahasiswa</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>NPM</th>
                                        <th>Nama Mahasiswa</th>
                                        <th>Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row"><?= $penilaian['mahasiswa_npm']; ?></td>
                                        <td scope="row"><?= $penilaian['mahasiswa_nama']; ?></td>
                                        <td scope="row"><?= $penilaian['nama_kelas']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                    <h5 class="text-uppercase">Data Nilai Sidang</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-uppercase">
                                        <th>Nilai Pembimbing</th>
                                        <th>Nilai Penguji 1</th>
                                        <th>Nilai Penguji 2</th>
                                        <th>Rata-rata</th>
                                        <th>Grade</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?= $penilaian['nilai_pembimbing']; ?></td>
                                        <td><?= $penilaian['nilai_penguji_1']; ?></td>
                                        <td><?= $penilaian['nilai_penguji_2']; ?></td>
                                        <td><?= number_format(($penilaian['nilai_pembimbing'] + $penilaian['nilai_penguji_1'] + $penilaian['nilai_penguji_2']) / 3, 2); ?></td>
                                        <td><?= $penilaian['grade']; ?></td>
                                        <td><?= $penilaian['status_kelulusan']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <a href="<?= base_url('koordinator/kelola_penilaian'); ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div> 
</div>
