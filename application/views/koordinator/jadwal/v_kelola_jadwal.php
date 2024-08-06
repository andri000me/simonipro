        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Jadwal</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddJadwal">
                        <span>
                          <i class="ti ti-plus"></i>
                        </span> 
                        Tambah Data
                      </button>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table id="myTable" class="table table-hover text-wrap mb-0 align-middle">
                      <thead>
                        <tr>
                          <th class="text-start">#</th>
                          <th class="text-start">Nama jadwal</th>
                          <th class="text-start">Tahun Akademik</th>
                          <th class="text-start">Dibuat pada</th>
                          <th class="text-start">Status</th>
                          <th class="text-start">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($jadwal as $j) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $j['nama_jadwal']; ?></td>
                          <td>Semester Genap <?= $j['tahun_akademik']; ?></td>
                          <td><?= date('d-M-Y', $j['created_at']); ?></td>
                          <td>
                            <?php ( $j['status'] == 'draft' ) ? $color = 'warning' : $color = 'success' ?>
                              <span class="badge text-bg-<?= $color; ?>">
                                  <?= $j['status']; ?>
                              </span>
                          </td>
                          <td>
                            <small>
                            <a href="detail_jadwal/<?= $j['id']; ?>" class="btn btn-outline-primary mb-2">
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
                          <th class="text-start">Nama jadwal</th>
                          <th class="text-start">Tahun Akademik</th>
                          <th class="text-start">Dibuat pada</th>
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
  </div>

<!-- Modal -->
<div class="modal fade" id="modalAddJadwal" tabindex="-1" aria-labelledby="modalAddJadwalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddJadwalLabel">Form Tambah Data jadwal</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_jadwal'); ?>" method="post">
        <?php
          $currentYear = date('Y');
          $previousYear = $currentYear - 1;
          $nextYear = $currentYear + 1;
          $twoYearsAhead = $currentYear + 2;
          ?>
          <div class="mb-3">
              <label for="tahun_akademik" class="form-label">Tahun Akademik</label>
              <select name="tahun_akademik" id="tahun_akademik" class="form-select">
                  <option value="">-- Pilih Tahun Akademik --</option>
                  <option value="<?= "{$previousYear}-{$currentYear}" ?>">Semester Genap <?= "{$previousYear}-{$currentYear}" ?></option>
                  <option value="<?= "{$currentYear}-{$nextYear}" ?>">Semester Genap <?= "{$currentYear}-{$nextYear}" ?></option>
                  <option value="<?= "{$nextYear}-{$twoYearsAhead}" ?>">Semester Genap <?= "{$nextYear}-{$twoYearsAhead}" ?></option>
              </select>
              <?= form_error('tahun_akademik', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
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