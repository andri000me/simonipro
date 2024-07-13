        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Kelompok</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddKelompok">
                        <span>
                          <i class="ti ti-plus"></i>
                        </span> 
                        Tambah Data
                      </a>
                    </div>
                  </div>
                  <table id="myTable" class="table table-hover table-responsive">
                    <thead>
                        <tr>
                            <th class="text-start">#</th>
                            <th class="text-start">Nama pembimbing</th>
                            <th class="text-start">Semester/TA</th>
                            <th class="text-start">Kode</th>
                            <th class="text-start">Kelas</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kelompok as $kel) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $kel['nama_pembimbing']; ?></td>
                                <td>
                                  <?= ($kel['semester'] % 2 == 0) ? 'Genap, ' : 'Ganjil, ' ?><?=$kel['tahun_ajaran']; ?>
                                </td>
                                <td><?= $kel['kode_kelompok']; ?></td>
                                <td><?= $kel['jenjang']; ?>-<?= getShortProdi($kel['nama_prodi']); ?>-<?= $kel['nama_kelas']; ?></td>
                                <td>
                                    <small>
                                        <a href="detail_kelompok/<?= $kel['id']; ?>" class="btn btn-outline-primary mb-2">
                                            <span>
                                                <i class="ti ti-info-circle"></i>
                                            </span>
                                            Detail
                                        </a>
                                    </small>
                                    <small>
                                        <a href="ubah_kelompok/<?= $kel['id']; ?>" class="btn btn-outline-warning mb-2">
                                            <span>
                                                <i class="ti ti-edit"></i>
                                            </span>
                                            Ubah
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
                            <th class="text-start">Nama pembimbing</th>
                            <th class="text-start">Semester/TA</th>
                            <th class="text-start">Kode</th>
                            <th class="text-start">Kelas</th>
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
<div class="modal fade" id="modalAddKelompok" tabindex="-1" aria-labelledby="modalAddKelompokLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddKelompokLabel">Form Tambah Data Kelompok</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_kelompok'); ?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="dosen_pembimbing_id" class="form-label">Dosen Pembimbing</label>
            <select class="form-select" id="dosen_pembimbing_id" name="dosen_pembimbing_id">
                <option value="" selected>-- Pilih Dosen Pembimbing --</option>
                <?php foreach ($dosen as $dsn) : ?>
                    <option value="<?= $dsn['id']; ?>"><?= $dsn['nidn'] . ' - ' . $dsn['nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('dosen_pembimbing_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="kelas_id" class="form-label">Kelas</label>
            <select class="form-select" id="kelas_id" name="kelas_id">
                <option value="" selected>-- Pilih Kelas --</option>
                <?php foreach ($kelas as $kls) : ?>
                    <option value="<?= $kls['id']; ?>"><?= $kls['jenjang'] . '-' . getShortProdi($kls['nama_prodi']) . '-' . $kls['nama_kelas']; ?></option>
                <?php endforeach; ?>
            </select>
            <?= form_error('kelas_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="semester" class="form-label">Semester</label>
            <input type="text" name="semester" id="semester" class="form-control" autocomplete="off" value="<?= set_value('semester'); ?>">
            <?= form_error('semester', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
            <select class="form-control" id="tahun_ajaran" name="tahun_ajaran">
                <option value="">-- Pilih Tahun Ajaran --</option>
                <?php for ($year = 2020; $year <= date('Y'); $year++): ?>
                    <option value="<?= $year . '/' . ($year + 1) ?>" <?= set_select('tahun_ajaran', $year . '/' . ($year + 1)); ?>><?= $year . '/' . ($year + 1) ?></option>
                <?php endfor; ?>
                <?= form_error('tahun_ajaran', '<small class="text-danger fst-italic">', '</small>'); ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="kode_kelompok" class="form-label">Kode Kelompok</label>
            <input type="text" name="kode_kelompok" id="kode_kelompok" class="form-control" autocomplete="off" value="<?= $kode_kelompok; ?>" disabled>
            <input type="hidden" name="kode_kelompok" value="<?= $kode_kelompok; ?>"> <!-- Hidden field untuk menyimpan kode kelompok -->
            <?= form_error('kode_kelompok', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Tambah Kelompok</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Akhir Modal -->
