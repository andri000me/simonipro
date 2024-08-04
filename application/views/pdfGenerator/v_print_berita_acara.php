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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Acara Proyek 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 80%;
            margin: auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header h2 {
            margin: 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .checkbox-group {
            margin-bottom: 20px;
        }
        .checkbox-group label {
            display: block;
            margin-bottom: 5px;
        }
        .checkbox-group input {
            margin-right: 10px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        .signature .name {
            margin-top: 50px;
            text-align: center;
            display: inline-block;
        }
        .grades-table {
            width: 60%;
            border-collapse: collapse;
            margin-bottom: 20px;
            margin-left: 20%;
        }
        .grades-table th, .grades-table td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>BERITA ACARA</h1>
            <h2>TELAH MELAKSANAKAN SIDANG PROYEK 2</h2>
        </div>
        <p>Yang bertanda tangan di bawah ini, selaku pihak yang terlibat, menyatakan mahasiswa di bawah ini:</p>
        <table class="table">
            <tr>
                <th>NPM</th>
                <th>NAMA</th>
                <th>KELAS</th>
            </tr>
            <tr>
                <td><?= $penilaian['mahasiswa_npm']; ?></td>
                <td><?= $penilaian['mahasiswa_nama']; ?></td>
                <td><?= $penilaian['nama_kelas']; ?></td>
            </tr>
        </table>
        <div class="form-group">
            <label>Judul Proyek 2:</label>
            <p><?= $penilaian['judul_proyek']; ?></p>
        </div>
        <div class="form-group">
            <label>Telah melaksanakan Sidang Proyek 2 pada:</label>
            <p>Hari/Tanggal: <?= $hari[$day]; ?>, <?= $dayNum . ' ' . $bln[$month] . ' ' . $year; ?></p>
        </div>
        <p>Dan dinyatakan dengan status di bawah ini (beri tanda √ untuk status yang dipilih):</p>
        <div class="checkbox-group">
            <label><input type="checkbox" disabled <?= $penilaian['status_kelulusan'] == 'Lulus Tanpa Perbaikan' ? 'checked' : ''; ?>> LULUS TANPA PERBAIKAN</label>
            <label><input type="checkbox" disabled <?= $penilaian['status_kelulusan'] == 'Lulus Dengan Perbaikan' ? 'checked' : ''; ?>> LULUS DENGAN PERBAIKAN *:</label>
            <div style="margin-left: 20px;">
                <label><input type="checkbox" disabled>Laporan</label>
                <label><input type="checkbox" disabled>Perangkat Lunak</label>
                <label><input type="checkbox" disabled>Lain-lain</label>
            </div>
            <label><input type="checkbox" disabled <?= $penilaian['status_kelulusan'] == 'Sidang ulang' ? 'checked' : ''; ?>> SIDANG ULANG</label>
            <label><input type="checkbox" disabled <?= $penilaian['status_kelulusan'] == 'Tidak lulus' ? 'checked' : ''; ?>> TIDAK LULUS/MENGULANG</label>
        </div>
        <table class="grades-table">
            <tr>
                <th colspan="2">Penilaian:</th>
            </tr>
            <tr>
                <th>ANGKA MUTU (AM)</th>
                <th>HURUF MUTU (HM)</th>
            </tr>
            <tr>
                <td>&gt; 85</td>
                <td>A: Sangat Baik</td>
            </tr>
            <tr>
                <td>70 - 84.99</td>
                <td>B: Baik</td>
            </tr>
            <tr>
                <td>55.00 - 69.99</td>
                <td>C: Cukup</td>
            </tr>
            <tr>
                <td>&lt; 55.00</td>
                <td>D: Tidak Lulus</td>
            </tr>
        </table>
        <div class="signature">
            <p>Bandung, <?= $dayNum . ' ' . $bln[$month] . ' ' . $year; ?></p>
            <p>Pembimbing Internal,</p>
            <div class="name">
                <p>(<?= $penilaian['dosen_pembimbing_nama']; ?>)</p>
                <p>NIDN/NIK* <?= $penilaian['dosen_penguji_1_nidn']; ?></p>
            </div>
        </div>
        <p>*coret yang tidak digunakan</p>
    </div>
</body>
</html>
