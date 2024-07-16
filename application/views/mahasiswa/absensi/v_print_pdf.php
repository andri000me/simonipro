<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print PDF</title>
    <style>
        /* Tambahkan gaya CSS untuk PDF di sini */
    </style>
</head>
<body>
    <h1>Detail Absensi Mahasiswa</h1>
    <!-- Tampilkan data absensi di sini -->
    <?php foreach ($absensi_bimbingan as $absen): ?>
        <p><?= $absen['topik'] ?> - <?= $absen['tgl_bimbingan'] ?> - <?= $absen['status'] ?></p>
    <?php endforeach; ?>
</body>
</html>
