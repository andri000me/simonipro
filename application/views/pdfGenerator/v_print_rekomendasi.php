<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print Surat Rekomendasi</title>

    <style>
        /* Gaya umum */
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Container untuk konten */
        .container-fluid {
            width: 100%;
            padding: 15px;
            margin: 0 auto;
        }

        /* Baris untuk layout */
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        /* Kolom */
        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        /* Gaya header */
        .text-center {
            text-align: center;
        }

        h1 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        thead.bg-secondary {
            background-color: #6c757d; /* BG color for thead */
            color: #fff; /* Text color for thead */
        }

        th, td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6; /* Border color */
        }

        th {
            text-align: left;
            text-transform: uppercase;
        }

        .bg-secondary {
            background-color: #6c757d;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        /* Gaya paragraf */
        p {
            margin-bottom: 1rem;
        }

        .signature-table td {
            border: none;
            padding: 0;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h1>Form Rekomendasi Sidang</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <p>Berdasarkan hasil kegiatan bimbingan baik itu dari kecakapan, dokumentasi, dan aplikasi, maka nama-nama dibawah layak direkomendasikan untuk melaksanakan sidang.</p>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <table>
                    <thead class="bg-secondary">
                        <tr class="text-uppercase">
                            <th>NPM</th>
                            <th>Nama mahasiswa</th>
                            <th>IPK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $kelompok['npm'] ?></td>
                            <td><?= $kelompok['nama_mahasiswa'] ?></td>
                            <td><?= $kelompok['ipk']; ?></td>
                        </tr>
                    </tbody>
                </table>  
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <table>
                    <thead class="bg-secondary">
                        <tr>
                            <th><span class="text-uppercase">Catatan Khusus </span>(Diisi oleh pembimbing)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="height: 150px; border-bottom: 1px solid #dee2e6;"></td>
                        </tr>
                    </tbody>
                </table> 
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12 mt-3">
                <table class="signature-table">
                    <tr>
                        <td>Direkomendasikan oleh:</td>
                        <td>:</td>
                        <td><?= $kelompok['nama_dosen_pembimbing']; ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal rekomendasi</td>
                        <td>:</td>
                        <td>
                        <?php
                            $bulanIndo = array(
                                'January' => 'Januari',
                                'February' => 'Februari',
                                'March' => 'Maret',
                                'April' => 'April',
                                'May' => 'Mei',
                                'June' => 'Juni',
                                'July' => 'Juli',
                                'August' => 'Agustus',
                                'September' => 'September',
                                'October' => 'Oktober',
                                'November' => 'November',
                                'December' => 'Desember'
                            );
                            $date = new DateTime($absensi_bimbingan['tgl_bimbingan']);
                            $bulan = $date->format('F');
                            $tanggal = $date->format('d');
                            $tahun = $date->format('Y');
                            echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun; // Output: 15 Juli 2024
                        ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanda tangan validasi</td>
                        <td>:</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
