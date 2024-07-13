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
                          <?php ( $absensi['status'] == 'hadir' ) ? $color = 'warning' : $color = 'success' ?>
                            <small class="badge text-bg-<?= $color; ?>">
                                <?= $absensi['status']; ?>
                            </small>
                        </td>
                        <td>
                          <small>
                          <a href="detail_jadwal/<?= $absensi['id']; ?>" class="btn btn-outline-primary mb-2">
                              <span>
                                <i class="ti ti-info-circle"></i>
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
        <h1 class="modal-title fs-5" id="modalAddAbsensiBimbinganLabel">Form Tambah Data jadwal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_jadwal'); ?>" method="post">
            <div class="mb-3">
                <label for="nama_jadwal" class="form-label">Nama jadwal</label>
                <input type="text" name="nama_jadwal" id="nama_jadwal" class="form-control" autofocus autocomplete="off" value="<?= set_value('nama_jadwal'); ?>">
                <?= form_error('nama_jadwal', '<small class="text-danger fst-italic">', '</small>'); ?>
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