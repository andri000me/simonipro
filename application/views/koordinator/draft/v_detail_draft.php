<div class="container-fluid">
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    Detail Draft Sidang
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Kode Kelompok</th>
                            <td><?= $draft['kode_kelompok']; ?></td>
                        </tr>
                        <tr>
                            <th>NIDN</th>
                            <td><?= $draft['dosen_pembimbing_nidn']; ?></td>
                        </tr>
                        <tr>
                            <th>Dosen Pembimbing</th>
                            <td><?= $draft['dosen_pembimbing_nama']; ?></td>
                        </tr>
                        <tr>
                            <th>NPM</th>
                            <td><?= $draft['mahasiswa_npm']; ?></td>
                        </tr>
                        <tr>
                            <th>Mahasiswa</th>
                            <td><?= $draft['mahasiswa_nama']; ?></td>
                        </tr>
                        <tr>
                            <th>Judul</th>
                            <td><?= $draft['judul']; ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <?php if ( $draft['status'] == 'pending' ) : ?>
                                        <?php $primary = 'warning' ?>
                                    <?php elseif ( $draft['status'] == 'approved' ) : ?>
                                        <?php $primary = 'primary' ?>
                                    <?php else : ?>
                                        <?php $primary = 'danger' ?>
                                    <?php endif ?>
                                    <span class="badge bg-<?= $primary; ?> rounded-3 fw-semibold">
                                        <?= $draft['status']; ?>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- <h5 class="mt-4">Daftar Kegiatan</h5> -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Waktu Upload</th>
                                <th>File Laporan</th>
                                <th>File DPL</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                <h6 class="fw-semibold mb-1">
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
                        
                                    // Konversi timestamp ke format tanggal
                                    $tanggal = date('d', $draft['submitted_at']);
                                    $bulan = date('F', $draft['submitted_at']);
                                    $tahun = date('Y', $draft['submitted_at']);
                        
                                    echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun; // Output: 15 Juli 2024
                                    ?>
                                    </h6>
                                    <span class="fw-normal">
                                        <?= date('H:i', $draft['submitted_at']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?= $draft['file_laporan']; ?>
                                        <a href="<?= base_url('koordinator/do_download_file_laporan/' . $draft['id'] ) ?>" class="btn btn-secondary">
                                            <span>
                                                <i class="ti ti-download"></i>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <?= $draft['file_dpl']; ?>
                                        <a href="<?= base_url('koordinator/do_download_file_dpl/' . $draft['id'] ) ?>" class="btn btn-secondary">
                                            <span>
                                                <i class="ti ti-download"></i>
                                            </span>
                                        </a>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary"  data-bs-toggle="modal" data-bs-target="#modalValidasiDraft">
                                        <span>
                                        <i class="ti ti-eye-check"></i>
                                        </span> 
                                        Validasi Draft
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="<?= base_url('koordinator/kelola_draft'); ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalValidasiDraft" tabindex="-1" aria-labelledby="modalValidasiDraftLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalValidasiDraftLabel">Form Tambah Data jadwal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/do_validasi_draft/' . $draft['id']); ?>" method="post">
            <div class="mb-3">
                <label for="status" class="form-label">Status Validasi Draft</label>
                <select name="status" id="status" class="form-select">
                    <option value="<?= $draft['status'] ?>" selected>-- Pilih status validasi --</option>
                    <option value="approved">Terima</option>
                    <option value="rejected">Tolak</option>
                </select>
                <?= form_error('status', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3" id="catatan_penolakan">
                <label for="catatan_penolakan" class="form-label">Catatan Penolakan</label>
                <textarea id="tiny" name="catatan_penolakan">
                    <p><?= set_value('catatan_penolakan'); ?></p>
                </textarea>
                <?= form_error('catatan_penolakan', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
    </form>
</div>
</div>
</div>