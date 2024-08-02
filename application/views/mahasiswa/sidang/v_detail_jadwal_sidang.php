<?php 
    $bulan = [
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus',
        'September', 'Oktober', 'November', 'Desember'
    ];
    $hari = [
        'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
    ];

    // Mengubah format tanggal menjadi format bahasa Indonesia
    $tanggal_sidang = strtotime($jadwal_sidang['tgl_sidang']);
    $hari_sidang = $hari[date('w', $tanggal_sidang)];
    $tgl = date('d', $tanggal_sidang);
    $bln = $bulan[date('n', $tanggal_sidang) - 1];
    $thn = date('Y', $tanggal_sidang);
    $jam_sidang = date('H:i', strtotime($jadwal_sidang['waktu_sidang']));
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
                                    <?= $hari_sidang . ', ' . $tgl . ' ' . $bln . ' ' . $thn; ?>
                                </td>
                                <td scope="row">
                                    <?= $jam_sidang; ?> - <?= date('H:i', strtotime($jadwal_sidang['waktu_sidang']) + 3600) ?>
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
            <a href="<?= base_url('mahasiswa/jadwal_sidang'); ?>" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</div> 
</div>
