<!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Absensi Bimbingan</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddAbsensiBimbingan">
                        <span>
                          <i class="ti ti-plus"></i>
                        </span> 
                        Tambah Data
                      </button>
                    </div>
                  </div>
                  <table id="myTable" class="table table-hover table-responsive">
                    <thead>
                      <tr>
                        <th class="text-start">#</th>
                        <th class="text-start">Tanggal Bimbingan</th>
                        <th class="text-start">Topik</th>
                        <th class="text-start">Status</th>
                        <th class="text-start">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($absensi_bimbingan as $absensi) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $absensi['tgl_bimbingan']; ?></td>
                        <td><?= $absensi['topik']; ?></td>
                        <td>
                          <?php if ( $absensi['status'] == 'belum dikonfirmasi' ) : ?> 
                              <?php $color = 'danger'; ?>
                            <?php elseif ( $absensi['status'] == 'hadir' ) : ?>
                              <?php $color = 'warning'; ?>
                            <?php else : ?>
                                <?php $color = 'success'; ?>
                            <?php endif; ?>
                            <small class="badge text-bg-<?= $color; ?>">
                                <?= $absensi['status']; ?>
                            </small>
                        </td>
                        <td>
                          <small>
                          <a href="detail_absensi/<?= $absensi['id']; ?>" class="btn btn-outline-primary mb-2 d-flex">
                              <span>
                                <i class="ti ti-info-circle me-1"></i>
                              </span>
                              Detail
                            </a>
                          </small>
                        </td>
                      </tr>
                      <?php $i++; ?>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th class="text-start">#</th>
                        <th class="text-start">Tanggal Bimbingan</th>
                        <th class="text-start">Topik</th>
                        <th class="text-start">Status</th>
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
  </div>

<!-- Modal -->
<div class="modal fade" id="modalAddAbsensiBimbingan" tabindex="-1" aria-labelledby="modalAddAbsensiBimbinganLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddAbsensiBimbinganLabel">Form Tambah Data Absensi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('mahasiswa/tambah_absensi'); ?>" method="post">
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
                <input type="date" name="tgl_bimbingan" id="tgl_bimbingan" class="form-control" autocomplete="off" value="<?= set_value('tgl_bimbingan'); ?>">
                <?= form_error('tgl_bimbingan', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="topik" class="form-label">Topik</label>
                <textarea name="topik" id="topik" class="form-control"><?= set_value('topik'); ?></textarea>
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
