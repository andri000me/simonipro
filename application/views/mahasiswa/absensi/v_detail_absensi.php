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
                                    <th>NPM</th>
                                    <th>Nama mahasiswa</th>
                                    <th>Kelas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?= $kelompok['npm'] ?></td>
                                    <td><?= $kelompok['nama_mahasiswa'] ?></td>
                                    <td><?= $kelompok['nama_kelas']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- Kondisi Catatan Penolakan -->
                <?php if ($absensi_bimbingan[0]['is_confirmed'] === 'rejected' && !empty($absensi_bimbingan[0]['catatan_penolakan'])): ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-danger text-light">
                                Informasi Penolakan Pengajuan Bimbingan
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Catatan Penolakan</h5>
                                <p class="card-text">
                                    <?= $absensi_bimbingan[0]['catatan_penolakan'] ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row mb-3">
                    <div class="col-12">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-uppercase">
                                    <th>Tanggal Bimbingan</th>
                                    <th>Topik</th>
                                    <th>Paraf Pembimbing</th>
                                    <th>Paraf Mahasiswa</th>
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
                      
                                                echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun; // Output: 15 Juli 2024
                                            ?><br>
                                            <?= substr($absen['waktu'], 0, 5); ?>
                                         </td>
                                        <td><?= $absen['topik']; ?></td>
                                        <td>
                                            <?= $absen['is_confirmed'] === 'confirmed' ? '<small class="badge text-bg-success">Terkonfirmasi</small>' : '<small class="badge text-bg-warning">Belum Dikonfirmasi</small>'; ?>
                                        </td>
                                        <td>
                                            <?= $absen['is_confirmed'] === 'confirmed' ? '<small class="badge text-bg-success">Paraf Lengkap</small>' : '<small class="badge text-bg-danger">Belum di paraf</small>'; ?>
                                        </td>
                                        <td>
                                            <?php if ( $absen['is_submitted'] == FALSE ) : ?>
                                                <button type="button" class="btn btn-warning mb-1" data-bs-toggle="modal" data-bs-target="#modalEditAbsensiBimbingan" onclick="editAbsensi(<?= $absen['id']; ?>, '<?= $absen['tgl_bimbingan']; ?>', '<?= $absen['topik']; ?>')">
                                                    <span>
                                                        <i class="ti ti-edit"></i>
                                                    </span>
                                                </button>
                                            <?php endif; ?>
                                            <?php if ($absen['is_submitted'] == TRUE) : ?>
                                                    <small class="text-danger">
                                                        <sup>*</sup>Submitted
                                                    </small>
                                                <?php else : ?>
                                                    <a href="<?= base_url('mahasiswa/submit_absensi/' . $absen['id']) ?>" class="btn btn-danger mb-1" onclick="return confirm('Submit absensi ke pembimbing ?')">
                                                    <span>
                                                        <i class="ti ti-brand-telegram"></i>
                                                    </span>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <a href="<?= base_url('mahasiswa/kelola_absensi'); ?>" class="btn btn-primary">Kembali</a>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalEditAbsensiBimbingan" tabindex="-1" aria-labelledby="modalEditAbsensiBimbinganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalEditAbsensiBimbinganLabel">Form Edit Data Absensi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('mahasiswa/update_absensi'); ?>" method="post">
            <input type="hidden" name="id" id="absensi_id">
            <input type="hidden" name="kelompok_id" value="<?= $kelompok['id']; ?>">
            <input type="hidden" name="mahasiswa_id" value="<?= $kelompok['mahasiswa_id']; ?>">
            <div class="row">
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="kelompok_id" class="form-label">Kode Kelompok</label>
                    <select id="kelompok_id" class="form-control" disabled>
                        <option value="<?= $kelompok['id']; ?>">
                            <?= $kelompok['kode_kelompok']; ?>
                        </option>
                    </select>
                    <?= form_error('kelompok_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="kode_kelas" class="form-label">Kode Kelas</label>
                  <input type="text" class="form-control" id="kode_kelas" autocomplete="off" value="<?= $kelompok['jenjang'] . '-' . getShortProdi($kelompok['nama_prodi']) . '-' . $kelompok['nama_kelas']; ?>" disabled>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="nama_dospem" class="form-label">Nama Dosen Pembimbing</label>
                  <input type="text" class="form-control" id="nama_dospem" autocomplete="off" value="<?= $kelompok['nama_dosen_pembimbing']; ?>" disabled>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label for="mahasiswa_npm" class="form-label">NPM</label>
              <input type="text" class="form-control" name="mahasiswa_npm" id="mahasiswa_npm" autocomplete="off" value="<?= $kelompok['npm']; ?>" disabled>
            </div>
            <div class="mb-3">
              <label for="mahasiswa_nama" class="form-label">Nama Mahasiswa</label>
              <input type="text" class="form-control" name="mahasiswa_nama" id="mahasiswa_nama" autocomplete="off" value="<?= $kelompok['nama_mahasiswa']; ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="tgl_bimbingan" class="form-label">Tanggal Bimbingan</label>
                <input type="date" name="tgl_bimbingan" id="tgl_bimbingan" class="form-control" autocomplete="off">
                <?= form_error('tgl_bimbingan', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="topik" class="form-label">Topik</label>
                <textarea name="topik" id="topik" class="form-control"></textarea>
                <?= form_error('topik', '<small class="text-danger fst-italic">', '</small>'); ?>
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
function editAbsensi(id, tgl_bimbingan, topik) {
    document.getElementById('absensi_id').value = id;
    document.getElementById('tgl_bimbingan').value = tgl_bimbingan;
    document.getElementById('topik').value = topik;
}
</script>
