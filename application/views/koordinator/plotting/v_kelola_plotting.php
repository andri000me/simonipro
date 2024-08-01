<!-- Row 1 -->
<div class="row">
  <div class="col-lg-12 d-flex align-items-strech">
    <div class="card w-100">
      <div class="card-body">
        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
          <div class="mb-3 mb-sm-0">
            <h5 class="card-title fw-semibold">Daftar Plotting</h5>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <?= $this->session->flashdata('pesan'); ?>
            <div class="d-flex align-items-center justify-content-between">
              <div class="mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddPlotting">
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
                    <th class="text-start">Project</th>
                    <th class="text-start">Koordinator</th>
                    <th class="text-start">NIDN</th>
                    <th class="text-start">Pembimbing</th>
                    <!-- <th class="text-start">Dosen Penguji 1</th>
                    <th class="text-start">Dosen Penguji 2</th> -->
                    <th class="text-start">NPM</th>
                    <th class="text-start">Mahasiswa</th>
                    <!-- <th class="text-start">Project</th> -->
                    <!-- <th class="text-start">Jenis Plotting</th> -->
                    <th class="text-start">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; ?>
                  <?php foreach ($plotting as $plot) : ?>
                  <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $plot['project_nama']; ?></td>
                    <td><?= $plot['koordinator_nama']; ?></td>
                    <td><?= $plot['dosen_pembimbing_nidn']; ?></td>
                    <td><?= $plot['dosen_pembimbing_nama']; ?></td>
                    <!-- <td><?= $plot['dosen_penguji_1_nama']; ?></td>
                    <td><?= $plot['dosen_penguji_2_nama']; ?></td> -->
                    <td><?= $plot['mahasiswa_npm']; ?></td>
                    <td><?= $plot['mahasiswa_nama']; ?></td>
                    <!-- <td><?= $plot['project_nama']; ?></td> -->
                    <!-- <td><?= $plot['jenis_plotting_nama']; ?></td> -->
                    <td>
                      <small>
                        <a href="detail_plotting/<?= $plot['id']; ?>" class="btn btn-outline-primary mb-2">
                          <span>
                            <i class="ti ti-info-circle"></i>
                          </span>
                          Detail
                        </a>
                      </small>
                      <small>
                        <a href="ubah_plotting/<?= $plot['id']; ?>" class="btn btn-outline-warning mb-2">
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
                    <th class="text-start">Project</th>
                    <th class="text-start">Koordinator</th>
                    <th class="text-start">NIDN</th>
                    <th class="text-start">Pembimbing</th>
                    <!-- <th class="text-start">Dosen Penguji 1</th>
                    <th class="text-start">Dosen Penguji 2</th> -->
                    <th class="text-start">NPM</th>
                    <th class="text-start">Mahasiswa</th>
                    <!-- <th class="text-start">Project</th> -->
                    <!-- <th class="text-start">Jenis Plotting</th> -->
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

<!-- Modal -->
<div class="modal fade" id="modalAddPlotting" tabindex="-1" aria-labelledby="modalAddPlottingLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddPlottingLabel">Form Tambah Data Plotting</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_plotting'); ?>" method="post">
          <input type="hidden" name="koordinator_id" id="koordinator_id" value="<?= $koordinator['id']; ?>">
          <div class="mb-3">
            <label for="jenis_plotting_id" class="form-label">Jenis Plotting</label>
            <select class="form-select" id="jenis_plotting_id" name="jenis_plotting_id" onchange="togglePengujiFields()">
              <?php foreach ($jenis_plotting as $jenis) : ?>
                <option value="<?= $jenis['id']; ?>" <?= ($jenis['nama'] == 'Bimbingan') ? 'selected' : ''; ?>><?= $jenis['nama']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('jenis_plotting_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="koordinator" class="form-label">Koordinator</label>
            <input type="text" class="form-control" id="koordinator" value="<?= $this->session->userdata['nama']; ?>" readonly>
          </div>
          <div class="mb-3">
            <label for="kelompok_id" class="form-label">Kelompok Pembimbing</label>
            <select class="form-select" id="kelompok_id" name="kelompok_id">
              <option value="" selected>-- Pilih Kelompok Pembimbing --</option>
              <?php foreach ($kelompok as $kel) : ?>
                <option value="<?= $kel['id']; ?>"><?= $kel['kode_kelompok']; ?>. <?= $kel['dosen_pembimbing_nidn']; ?> - <?= $kel['nama_pembimbing']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('kelompok_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3" id="dosenPenguji1Field" style="display: none;">
            <label for="dosen_penguji_1_id" class="form-label">Dosen Penguji 1</label>
            <select class="form-select" id="dosen_penguji_1_id" name="dosen_penguji_1_id">
              <option value="" selected>-- Pilih Dosen Penguji 1 --</option>
              <?php foreach ($dosen as $dsn) : ?>
                <option value="<?= $dsn['id']; ?>"><?= $dsn['nidn']; ?> - <?= $dsn['nama']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('dosen_penguji_1_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3" id="dosenPenguji2Field" style="display: none;">
            <label for="dosen_penguji_2_id" class="form-label">Dosen Penguji 2</label>
            <select class="form-select" id="dosen_penguji_2_id" name="dosen_penguji_2_id">
              <option value="" selected>-- Pilih Dosen Penguji 2 --</option>
              <?php foreach ($dosen as $dsn) : ?>
                <option value="<?= $dsn['id']; ?>"><?= $dsn['nidn']; ?> - <?= $dsn['nama']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('dosen_penguji_2_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
            <select class="form-select" id="mahasiswa_id" name="mahasiswa_id">
              <option value="" selected>-- Pilih Mahasiswa --</option>
              <?php foreach ($mahasiswa as $mhs) : ?>
                <option value="<?= $mhs['id']; ?>"><?= $mhs['npm']; ?> - <?= $mhs['nama']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('mahasiswa_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="project_id" class="form-label">Project</label>
            <select class="form-select" id="project_id" name="project_id">
              <option value="" selected>-- Pilih Project --</option>
              <?php foreach ($projects as $project) : ?>
                <option value="<?= $project['id']; ?>"><?= $project['nama_project']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('project_id', '<small class="text-danger fst-italic">', '</small>'); ?>
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