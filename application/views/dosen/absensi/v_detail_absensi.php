<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                Detail data absensi
            </div>
            <div class="card-body">
                <h5 class="card-title text-uppercase text-center mb-3">Form bimbingan</h5>
                <div class="row mb-3">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>nidn</th>
                                    <th>Nama dosen</th>
                                    <th>Kode Kelompok</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $kelompok['nidn'] ?></td>
                                    <td><?= $kelompok['nama_dosen'] ?></td>
                                    <td><?= $kelompok['kode_kelompok']; ?></td>
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
                                    <th>Tanggal Bimbingan</th>
                                    <th>Topik</th>
                                    <th>Paraf Pembimbing</th>
                                    <th>Paraf dosen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($absensi_bimbingan as $absen) : ?>
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
                            
                                            $date = new DateTime($absen['tgl_bimbingan']);
                                            $bulan = $date->format('F');
                                            $tanggal = $date->format('d');
                                            $tahun = $date->format('Y');
                            
                                            echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun;
                                        ?><br>
                                        <?= substr($absen['waktu'], 0, 5); ?>
                                         </td>
                                        <td><?= $absen['topik']; ?></td>
                                        <td>
                                            <?= $absen['is_confirmed'] === 'confirmed' ? '<small class="badge text-bg-success">Terkonfirmasi</small>' : '<small class="badge text-bg-warning">Belum Dikonfirmasi</small>'; ?>
                                        </td>
                                        <td>
                                            <?= $absen['is_confirmed'] === 'confirmed' ? '<small class="badge text-bg-success">Paraf Lengkap</small>' : '<small class="badge text-bg-danger">Belum Diparaf</small>'; ?>
                                        </td>
                                        <td>
                                            <?php if ($absen['is_confirmed'] == 'rejected') : ?>
                                                    <small class="text-danger fst-italic">
                                                        <sup>*</sup>Ditolak
                                                    </small>
                                                    <?php elseif ( $absen['is_confirmed'] == 'confirmed' ) : ?>
                                                    <small class="text-success fst-italic">
                                                        <sup>*</sup>Terkonfirmasi
                                                    </small>
                                                <?php else : ?>
                                                    <button class="btn btn-outline-danger mb-1" data-bs-toggle="modal" data-bs-target="#modalEditAbsensiBimbingan" onclick="editAbsensi(
                                                        <?= $absen['id']; ?>, 
                                                        '<?= $absen['tgl_bimbingan']; ?>', 
                                                        '<?= $absen['waktu']; ?>', 
                                                        '<?= $absen['topik']; ?>', 
                                                        '<?= $absen['is_confirmed']; ?>', 
                                                        '<?= $absen['catatan_penolakan'] ?? '' ?>',
                                                        '<?= $absen['mahasiswa_nama']; ?>',
                                                        '<?= $absen['mahasiswa_npm']; ?>'
                                                    )">
                                                    <span><i class="ti ti-checkbox"></i></span> Konfirmasi
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="<?= base_url('dosen/kelola_absensi'); ?>" class="btn btn-primary">Kembali</a>
                <!-- jika jumlah hadir absensi mahasiswa belum >= 8, tombol dibawah ini akan disabled, akan aktif jika jumlah absensi mahasiswa sudah >= 8 -->
                <a href="<?= base_url('dosen/rekomendasi_absensi/' . $mahasiswa_id); ?>" class="btn btn-danger <?= $jumlahHadir >= 8 ? '' : 'disabled'; ?>" onclick="return confirm('Rekomendasikan Mahasiswa ?');">Rekomendasi</a>
            </div>
        </div>
    </div>
</div>



<!-- Modal Edit Absensi Bimbingan -->
<div class="modal fade" id="modalEditAbsensiBimbingan" tabindex="-1" aria-labelledby="modalEditAbsensiBimbinganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditAbsensiBimbinganLabel">Edit Absensi Bimbingan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('dosen/update_absensi') ?>" method="post">
                    <input type="hidden" name="id" id="absensi_id">
                    <div class="mb-3">
                        <label for="nama_mahasiswa" class="form-label">Nama Mahasiswa</label>
                        <input type="text" id="nama_mahasiswa" class="form-control" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="npm_mahasiswa" class="form-label">NPM Mahasiswa</label>
                        <input type="text" id="npm_mahasiswa" class="form-control" disabled>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="mb-3">
                                <label for="tgl_bimbingan" class="form-label">Tanggal Bimbingan</label>
                                <input type="date" name="tgl_bimbingan" id="tgl_bimbingan" class="form-control" autocomplete="off">
                                <?= form_error('tgl_bimbingan', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mb-3">
                                <label for="waktu" class="form-label">Waktu Bimbingan</label>
                                <input type="time" name="waktu" id="waktu" class="form-control" autocomplete="off">
                                <?= form_error('waktu', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="topik" class="form-label">Topik</label>
                        <textarea name="topik" id="topik" class="form-control"></textarea>
                        <?= form_error('topik', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="is_confirmed" class="form-label">Status Konfirmasi</label>
                        <select name="is_confirmed" id="is_confirmed" class="form-select">
                            <option value="pending">Belum Dikonfirmasi</option>
                            <option value="confirmed">Terkonfirmasi</option>
                            <option value="rejected">Ditolak</option>
                        </select>
                        <?= form_error('is_confirmed', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <!-- input ini hanya akan muncul ketika status hadir sudah >= 8 -->
                    <div class="mb-3" id="catatan_penolakan_div" style="display: none;">
                        <label for="catatan_penolakan" class="form-label">Catatan Penolakan</label>
                        <textarea name="catatan_penolakan" id="catatan_penolakan" class="form-control"></textarea>
                        <?= form_error('catatan_penolakan', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function editAbsensi(id, tgl_bimbingan, waktu, topik, is_confirmed, catatan_penolakan, nama_mahasiswa, npm_mahasiswa) {
        document.getElementById('absensi_id').value = id;
        document.getElementById('tgl_bimbingan').value = tgl_bimbingan;
        document.getElementById('waktu').value = waktu;
        document.getElementById('topik').value = topik;
        document.getElementById('is_confirmed').value = is_confirmed;
        document.getElementById('catatan_penolakan').value = catatan_penolakan;
        document.getElementById('nama_mahasiswa').value = nama_mahasiswa;
        document.getElementById('npm_mahasiswa').value = npm_mahasiswa;

        if (is_confirmed === 'rejected') {
            document.getElementById('catatan_penolakan_div').style.display = 'block';
        } else {
            document.getElementById('catatan_penolakan_div').style.display = 'none';
        }
    }

    document.getElementById('is_confirmed').addEventListener('change', function() {
        if (this.value === 'rejected') {
            document.getElementById('catatan_penolakan_div').style.display = 'block';
        } else {
            document.getElementById('catatan_penolakan_div').style.display = 'none';
        }
    });
</script>

