<?php 
// var_dump($mahasiswa); die; 
?>
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Mahasiswa</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddMahasiswa">
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
                            <th class="text-start">NPM</th>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Kelas</th>
                            <th class="text-start">IPK</th>
                            <th class="text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa as $mhs) : ?>
                            <tr>
                                <th scope="row"><?= $i; ?></th>
                                <td><?= $mhs['npm']; ?></td>
                                <td><?= $mhs['nama']; ?></td>
                                <td><?= $mhs['nama_kelas']; ?></td>
                                <td><?= $mhs['ipk']; ?></td>
                                <td>
                                    <small>
                                        <a href="detail_mahasiswa/<?= $mhs['id']; ?>" class="btn btn-outline-primary mb-2">
                                            <span>
                                                <i class="ti ti-info-circle"></i>
                                            </span>
                                            Detail
                                        </a>
                                    </small>
                                    <small>
                                        <a href="ubah_mahasiswa/<?= $mhs['id']; ?>" class="btn btn-outline-warning mb-2">
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
                            <th class="text-start">NPM</th>
                            <th class="text-start">Nama</th>
                            <th class="text-start">Kelas</th>
                            <th class="text-start">IPK</th>
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
<div class="modal fade" id="modalAddMahasiswa" tabindex="-1" aria-labelledby="modalAddMahasiswaLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddMahasiswaLabel">Form Tambah Data Mahasiswa</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('staff/tambah_mahasiswa'); ?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
              <select class="form-select" id="user_id" name="user_id">
                <option value="" selected>-- Pilih User --</option>
                <?php foreach ($users as $user) : ?>
                  <option value="<?= $user['id']; ?>" data-npm="<?= $user['username']; ?>" data-nama="<?= $user['nama']; ?>"><?= $user['username']; ?> - <?= $user['nama']; ?></option>
                <?php endforeach; ?>
              </select>
              <?= form_error('user_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
            <div class="mb-3">
                <label for="npm" class="form-label">NPM</label>
                <input type="text" name="npm" id="npm" class="form-control" maxlength="9" autofocus autocomplete="off" value="<?= set_value('npm'); ?>" readonly>
                <?= form_error('npm', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama mahasiswa</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" readonly>
                <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="prodi_id" class="form-label">Nama Prodi</label>
                <select class="form-select" id="prodi_id" name="prodi_id">
                    <option value="" selected>-- Pilih Prodi --</option>
                    <?php foreach ($prodi as $p) : ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama_prodi']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('prodi_id', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="kelas_id" class="form-label">Kelas</label>
                <select class="form-select" id="kelas_id" name="kelas_id">
                    <option value="" selected>-- Pilih Kelas --</option>
                    <?php foreach ($kelas as $p) : ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama_kelas']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('kelas', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="semester" class="form-label">Semester</label>
                <input type="text" class="form-control" id="semester" name="semester" value="<?= set_value('semester'); ?>" maxlength="2">
                <?= form_error('semester', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="tahun_angkatan" class="form-label">Tahun Angkatan</label>
                <select class="form-control" id="tahun_angkatan" name="tahun_angkatan">
                    <option value="">Pilih Tahun</option>
                    <?php for ($year = 2020; $year <= date('Y'); $year++): ?>
                        <option value="<?= $year ?>" <?= set_select('tahun_angkatan', $year); ?>><?= $year ?></option>
                    <?php endfor; ?>
                </select>
                <?= form_error('tahun_angkatan', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar" class="form-control" value="<?= set_value('gambar'); ?>">
                <?= form_error('gambar', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="ipk" class="form-label">Nilai IPK</label>
              <input type="text" class="form-control" id="ipk" name="ipk" value="<?= set_value('ipk'); ?>" placeholder="0.00" maxlength="4">
              <?= form_error('ipk', '<small class="text-danger fst-italic">', '</small>'); ?>
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