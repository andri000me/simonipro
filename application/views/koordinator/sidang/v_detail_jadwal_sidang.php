<?php 
    $bln = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];
    $hari = [
        'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'
    ];

    // Menguraikan tanggal sidang
    $date = strtotime($jadwal_sidang['tgl_sidang']);
    $day = date('N', $date) - 1; // Mengambil indeks hari (0-6)
    $dayNum = date('j', $date); // Mengambil tanggal (1-31)
    $month = date('n', $date) - 1; // Mengambil indeks bulan (0-11)
    $year = date('Y', $date); // Mengambil tahun (4 digit)

    // Menguraikan waktu sidang
    $time = strtotime($jadwal_sidang['waktu_sidang']);
    $hour = date('H', $time); // Mengambil jam (00-23)
    $minute = date('i', $time); // Mengambil menit (00-59)

    // Menguraikan tanggal created_at dan updated_at
    $created_at_date = $jadwal_sidang['created_at'];
    $created_day = date('j', $created_at_date); // Mengambil tanggal (1-31)
    $created_month = date('n', $created_at_date) - 1; // Mengambil indeks bulan (0-11)
    $created_year = date('Y', $created_at_date); // Mengambil tahun (4 digit)

    $updated_at_date = $jadwal_sidang['updated_at'];
    $updated_day = date('j', $updated_at_date); // Mengambil tanggal (1-31)
    $updated_month = date('n', $updated_at_date) - 1; // Mengambil indeks bulan (0-11)
    $updated_year = date('Y', $updated_at_date); // Mengambil tahun (4 digit)
?>
<div class="row">
   <div class="col-md-12">
    <div class="card">
        <div class="card-header">
            Detail data jadwal sidang <?= $jadwal_sidang['project_nama']; ?>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-12">
                    <h5 class="text-uppercase">Data Waktu Sidang</h5>
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
            <div class="row mb-3">
                <div class="col-12">
                    <h5 class="text-uppercase">Data Penguji</h5>
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
                                    <?= $jadwal_sidang['penguji_1_nidn']; ?>
                                </td>
                                <td scope="row">
                                    <?= $jadwal_sidang['penguji_1_nama']; ?>
                                </td>
                                <td scope="row">
                                    <?= $jadwal_sidang['penguji_2_nidn']; ?>
                                </td>
                                <td scope="row">
                                    <?= $jadwal_sidang['penguji_2_nama']; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <h5 class="text-uppercase">Data Mahasiswa</h5>
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
                                <td scope="row"><?= $jadwal_sidang['mahasiswa_npm']; ?></td>
                                <td scope="row"><?= $jadwal_sidang['mahasiswa_nama']; ?></td>
                                <td scope="row"><?= $jadwal_sidang['nama_kelas']; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-uppercase">
                                <th>Ditetapkan Pada</th>
                                <th>Diubah Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><?= $created_day . ' ' . $bln[$created_month] . ' ' . $created_year; ?></td>
                                <td><?= $updated_day . ' ' . $bln[$updated_month] . ' ' . $updated_year; ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <a href="<?= base_url('koordinator/kelola_jadwal_sidang'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div> 
</div>
