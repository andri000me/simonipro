<?php if ($isRekomendasi): ?>
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-header bg-primary text-white">
                Form Upload Draft Sidang
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
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
                    <div class="col-lg-6 d-flex justify-content-center align-items-center">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-4">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title">Silahkan upload draft sidang di sini.</h5>
                                <p class="text-muted">
                                    Beberapa hal yang perlu diperhatikan:
                                </p>
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
                                <?php if (!$has_uploaded_draft): ?>
                                    <button type="button" class="btn btn-success float-end" data-bs-toggle="modal" data-bs-target="#modalUploadDraft">
                                        <span>
                                            <i class="ti ti-upload me-2"></i>
                                        </span> 
                                        Upload Draft
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-success float-end" disabled>
                                        <span>
                                            <i class="ti ti-check me-2"></i>
                                        </span> 
                                        Anda sudah melakukan upload Draft
                                    </button>
                                <?php endif; ?>
                            </div>
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

<!-- Modal -->
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
                <label for="file_path" class="form-label">File Draft</label>
                <input type="file" name="file_path" id="file_path" class="form-control" value="<?= set_value('file_path'); ?>">
                <?= form_error('file_path', '<small class="text-danger fst-italic">', '</small>'); ?>
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
