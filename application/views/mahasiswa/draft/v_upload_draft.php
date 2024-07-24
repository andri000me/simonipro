<?php if ($isRekomendasi && !$has_uploaded_draft && !$is_submitted): ?>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header bg-primary text-white">
                    Form Upload Draft Sidang
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-5">
                            <div class="row">
                                <div class="col-lg-12">
                                    <?= $this->session->flashdata('pesan'); ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 d-flex justify-content-center align-items-center">
                                    <img src="<?= base_url('assets/images/backgrounds/ill-upload.svg') ?>" alt="bg-ill-upload" class="img-fluid w-75">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 d-flex justify-content-center align-items-center">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-4 w-100">
                                <div class="mb-3 mb-sm-0 w-100">
                                    <h5 class="card-title">Silahkan upload draft sidang di sini.</h5>
                                    <p class="text-muted">Beberapa hal yang perlu diperhatikan:</p>
                                    <ul class="list-group list-group-flush mb-4">
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1">
                                                    <span>
                                                        <i class="ti ti-archive text-primary me-2"></i>
                                                    </span>
                                                </div>
                                                <div class="col-11">
                                                    Mencantumkan dokumen laporan dan dokumen perangkat lunak serta surat rekomendasi yang telah didapatkan.
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1">
                                                    <span>
                                                        <i class="ti ti-file-zip text-primary me-2"></i>
                                                    </span>
                                                </div>
                                                <div class="col-11">
                                                    File yang di-upload harus berupa rar atau zip.
                                                </div>
                                            </div>
                                        </li>
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-1">
                                                    <span>
                                                        <i class="ti ti-school text-primary me-2"></i>
                                                    </span>
                                                </div>
                                                <div class="col-11">
                                                    Mengisikan biodata singkat terkait proyek 2 Anda.
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalUploadDraft">
                                        <span>
                                            <i class="ti ti-upload me-2"></i>
                                        </span>
                                        Upload Draft
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($isRekomendasi && $has_uploaded_draft && !$is_submitted): ?>
    <?php if ( $draft[0]['status'] == 'rejected' ) : ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Draft Ditolak!</h4>
            <p><?= $draft[0]['catatan_penolakan']; ?></p>
            <hr>
            <p class="mb-0">Harap upload ulang draft dengan perbaikan-perbaikan yang tertera pada catatan diatas.</p>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header bg-danger text-white">
                    Form Upload Draft Sidang
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="myTable" class="table table-hover text-wrap mb-0 align-middle">
                                    <thead>
                                        <tr>
                                            <th class="text-start">Waktu Upload</th>
                                            <th class="text-start">File Laporan</th>
                                            <th class="text-start">File DPL</th>
                                            <th class="text-start">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($draft) && is_array($draft) && !empty($draft)): ?>
                                            <?php foreach ($draft as $d): ?>
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
                                                            $tanggal = date('d', $d['submitted_at']);
                                                            $bulan = date('F', $d['submitted_at']);
                                                            $tahun = date('Y', $d['submitted_at']);
                    
                                                            echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun; // Output: 15 Juli 2024
                                                            ?>
                                                            </h6>
                                                        <span class="fw-normal">
                                                            <?= date('H:i', $d['submitted_at']); ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <?= $d['file_laporan']; ?>
                                                            <a href="<?= base_url('mahasiswa/do_download_file_laporan/' . $d['id'] ) ?>" class="btn btn-warning">
                                                            <span>
                                                                <i class="ti ti-download"></i>
                                                            </span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <?= $d['file_dpl']; ?>
                                                            <a href="<?= base_url('mahasiswa/do_download_file_dpl/' . $d['id'] ) ?>" class="btn btn-warning">
                                                            <span>
                                                                <i class="ti ti-download"></i>
                                                            </span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalUpdateUploadedDraft">
                                                            Ubah
                                                        </button>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data draft</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th class="text-start">Waktu upload</th>
                                            <th class="text-start">File Laporan</th>
                                            <th class="text-start">File DPL</th>
                                            <th class="text-start">Aksi</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($isRekomendasi && $has_uploaded_draft && $is_submitted): ?>
    <?php if ( $draft[0]['status'] == 'approved' ) : ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Draft Berhasil Di Approve!</h4>
            <hr>
            <p class="mb-0">Selamat! Draft Anda telah disetujui. Teruslah berusaha dan pertahankan semangat kerja keras Anda!</p>
        </div>
    <?php endif ?>
    <div class="card w-100">
        <div class="card-header bg-success text-white">
            Berhasil Upload Draft Sidang
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-5 d-flex justify-content-center align-items-center">
                    <img src="<?= base_url('assets/images/backgrounds/ill-success.svg') ?>" alt="bg-ill-404" class="img-fluid w-75">
                </div>
                <div class="col-lg-7">
                    <div class="card w-100">
                        <div class="card-body">
                            <h5 class="card-title fw-semibold mb-4">History Upload</h5>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class="text-uppercase">
                                        <tr>
                                            <th>Waktu Upload</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (isset($draft) && is_array($draft) && !empty($draft)): ?>
                                            <?php foreach ($draft as $d): ?>
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
                                                            $tanggal = date('d', $d['submitted_at']);
                                                            $bulan = date('F', $d['submitted_at']);
                                                            $tahun = date('Y', $d['submitted_at']);
                    
                                                            echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun; // Output: 15 Juli 2024
                                                            ?>
                                                            </h6>
                                                            <span class="fw-normal">
                                                                <?= date('H:i', $d['submitted_at']); ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center gap-2">
                                                                <?php if ( $d['status'] == 'pending' ) : ?>
                                                                    <?php $primary = 'warning' ?>
                                                                <?php elseif ( $d['status'] == 'approved' ) : ?>
                                                                    <?php $primary = 'primary' ?>
                                                                <?php else : ?>
                                                                    <?php $primary = 'danger' ?>
                                                                <?php endif ?>
                                                                <span class="badge bg-<?= $primary; ?> rounded-3 fw-semibold">
                                                                    <?= $d['status']; ?>
                                                                </span>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada data draft</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-header bg-danger text-white">
                    Form Upload Draft Sidang
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <img src="<?= base_url('assets/images/backgrounds/ill-404.svg') ?>" alt="bg-ill-404" class="img-fluid w-75">
                        </div>
                        <div class="col-lg-6 d-flex justify-content-center align-items-center">
                            <div class="d-flex d-block align-items-center justify-content-between mb-4">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title text-center">Anda belum mendapatkan rekomendasi dari Dosen pembimbing.</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- Modal Upload Draft -->
<div class="modal fade" id="modalUploadDraft" tabindex="-1" aria-labelledby="modalUploadDraftLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalUploadDraftLabel">Form Upload Draft</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('mahasiswa/do_upload_draft'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="kelompok_id" value="<?= $kelompok['id']; ?>">
            <input type="hidden" name="mahasiswa_id" value="<?= $kelompok['mahasiswa_id']; ?>">
            <div class="row">
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="kelompok_id" class="form-label">Kode Kelompok</label>
                    <input type="text" class="form-control" id="kelompok_id" autocomplete="off" value="<?= $kelompok['kode_kelompok']; ?>" readonly>
                    <?= form_error('kelompok_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="kode_kelas" class="form-label">Kode Kelas</label>
                  <input type="text" class="form-control" id="kode_kelas" autocomplete="off" value="<?= $kelompok['jenjang'] . '-' . getShortProdi($kelompok['nama_prodi']) . '-' . $kelompok['nama_kelas']; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="mb-3">
                <label for="mahasiswa_npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="mahasiswa_npm" autocomplete="off" value="<?= $kelompok['npm']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="mahasiswa_id" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="mahasiswa_id" autocomplete="off" value="<?= $kelompok['nama_mahasiswa']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_dospem" class="form-label">Nama Dosen Pembimbing</label>
                <input type="text" class="form-control" id="nama_dospem" autocomplete="off" value="<?= $kelompok['nama_dosen_pembimbing']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <textarea name="judul" id="judul" class="form-control"><?= set_value('judul'); ?></textarea>
                <?= form_error('judul', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="file_laporan" class="form-label">File Laporan</label>
                <input type="file" name="file_laporan" id="file_laporan" class="form-control" value="<?= set_value('file_laporan'); ?>">
                <small class="text-danger fst-italic"><sup>*</sup>File yang di upload adalah .pdf</small>
                <?= form_error('file_laporan', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="file_dpl" class="form-label">File Dokumen Perangkat Lunak</label>
                <input type="file" name="file_dpl" id="file_dpl" class="form-control" value="<?= set_value('file_dpl'); ?>">
                <small class="text-danger fst-italic"><sup>*</sup>File yang di upload adalah .pdf</small>
                <?= form_error('file_dpl', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="action" value="draft">Simpan Sebagai Draft</button>
                <button type="submit" class="btn btn-danger" name="action" value="submit" onclick="return confirm('Yakin ingin melakukan submit draft?'); ">
                    <span>
                        <i class="ti ti-brand-telegram me-1"></i>
                    </span>
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Update Draft -->
<div class="modal fade" id="modalUpdateUploadedDraft" tabindex="-1" aria-labelledby="modalUpdateUploadedDraftLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalUpdateUploadedDraftLabel">Form Update Draft</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('mahasiswa/do_update_uploaded_draft/' . $draft[0]['id']); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="kelompok_id" value="<?= $kelompok['id']; ?>">
            <input type="hidden" name="mahasiswa_id" value="<?= $kelompok['mahasiswa_id']; ?>">
            <div class="row">
              <div class="col-md-6">
                  <div class="mb-3">
                    <label for="kelompok_id" class="form-label">Kode Kelompok</label>
                    <input type="text" class="form-control" id="kelompok_id" autocomplete="off" value="<?= $kelompok['kode_kelompok']; ?>" readonly>
                    <?= form_error('kelompok_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="kode_kelas" class="form-label">Kode Kelas</label>
                  <input type="text" class="form-control" id="kode_kelas" autocomplete="off" value="<?= $kelompok['jenjang'] . '-' . getShortProdi($kelompok['nama_prodi']) . '-' . $kelompok['nama_kelas']; ?>" readonly>
                </div>
              </div>
            </div>
            <div class="mb-3">
                <label for="mahasiswa_npm" class="form-label">NPM</label>
                <input type="text" class="form-control" id="mahasiswa_npm" autocomplete="off" value="<?= $kelompok['npm']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="mahasiswa_id" class="form-label">Nama Mahasiswa</label>
                <input type="text" class="form-control" id="mahasiswa_id" autocomplete="off" value="<?= $kelompok['nama_mahasiswa']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="nama_dospem" class="form-label">Nama Dosen Pembimbing</label>
                <input type="text" class="form-control" id="nama_dospem" autocomplete="off" value="<?= $kelompok['nama_dosen_pembimbing']; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <textarea name="judul" id="judul" class="form-control"><?= set_value('judul', $draft[0]['judul']); ?></textarea>
                <?= form_error('judul', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="file_laporan" class="form-label">File Laporan</label>
                <input type="file" name="file_laporan" id="file_laporan" class="form-control">
                <small class="text-danger fst-italic"><sup>*</sup>File yang di upload adalah .pdf</small>
            </div>
            <div class="mb-3">
                <label for="file_dpl" class="form-label">File Dokumen Perangkat Lunak</label>
                <input type="file" name="file_dpl" id="file_dpl" class="form-control">
                <small class="text-danger fst-italic"><sup>*</sup>File yang di upload adalah .pdf</small>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="action" value="draft">Simpan Sebagai Draft</button>
                <button type="submit" class="btn btn-danger" name="action" value="submit" onclick="return confirm('Yakin ingin melakukan submit draft?'); ">
                    <span>
                        <i class="ti ti-brand-telegram me-1"></i>
                    </span>
                    Submit
                </button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

