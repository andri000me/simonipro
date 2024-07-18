<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jadwal Pelaksanaan Proyek 2</title>
    <style>
        /* Gaya umum */
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* Container untuk konten */
        .container {
            width: 100%;
            padding: 15px;
            margin: 0 auto;
        }

        /* Tabel */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }

        th, td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6; /* Border color */
        }

        th {
            text-align: left;
            text-transform: uppercase;
            background-color: #6c757d; /* BG color for thead */
            color: #fff; /* Text color for thead */
        }

        .text-end {
            text-align: right;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .note {
            margin-top: 20px;
            font-size: 14px;
        }

        .note ul {
            padding-left: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row mb-3">
            <div class="col-12 text-center">
                <h1>Jadwal Pelaksanaan Proyek 2</h1>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-12">
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal Awal</th>
                            <th>Tanggal Selesai</th>
                            <th>Kegiatan Proyek 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($kegiatan)) : ?>
                            <?php foreach ($kegiatan as $k) : ?>
                                <tr>
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
                                            $date = new DateTime($k['tgl_awal']);
                                            $bulan = $date->format('F');
                                            $tanggal = $date->format('d');
                                            $tahun = $date->format('Y');
                                            echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            $date = new DateTime($k['tgl_selesai']);
                                            $bulan = $date->format('F');
                                            $tanggal = $date->format('d');
                                            $tahun = $date->format('Y');
                                            echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
                                        ?>
                                    </td>
                                    <td>
                                        <?= $k['nama_kegiatan']; ?><br>
                                        <?= html_entity_decode($k['deskripsi'], ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="3" class="text-center">Tidak ada kegiatan</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>  
            </div>
        </div>
        <div class="note">
            <strong>Catatan:</strong> Jadwal dapat berubah menyesuaikan dengan kegiatan di prodi dan akan diumumkan.
            <ul class="mb-3">
                <li>Waktu pelaksanaan PKL sesuai dengan kesepakatan dengan instansi/perusahaan dengan waktu minimal 24 hari kerja</li>
                <li>Proposal PKL minimal memuat Latar Belakang, Rumusan Masalah, Tujuan dan Ruang Lingkup dilampirkan saat melakukan pengajuan PKL ke instansi/perusahaan.</li>
                <li>Mahasiswa tidak boleh melanggar jadwal yang telah ditetapkan di atas</li>
                <li>Jika mahasiswa terlambat dari jadwal yang telah ditentukan, maka dianggap mengundurkan diri dari PKL</li>
                <li>Jadwal dapat berubah sesuai kepentingan prodi</li>
            </ul>
            <div class="text-end">
                Bandung, 2 Februari 2024<br>
                Koordinator PKL<br>
                <br><br>
                TTD.
            </div>
        </div>
    </div>
</body>
</html>
