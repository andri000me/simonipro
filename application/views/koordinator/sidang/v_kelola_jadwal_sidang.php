<!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Jadwal Sidang</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddJadwalSidang">
                        <span>
                          <i class="ti ti-plus"></i>
                        </span> 
                        Tambah Data
                      </a>
                    </div>
                  </div>
                  <div class="table-responsive">
                    <table id="myTable" class="table table-hover text-wrap mb-0 align-middle">
                      <thead>
                          <tr>
                              <th class="text-start">#</th>
                              <th class="text-start">Proyek</th>
                              <th class="text-start">Penguji 1</th>
                              <th class="text-start">Penguji 2</th>
                              <th class="text-start">Mahasiswa</th>
                              <th class="text-start">Waktu</th>
                              <th class="text-start">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($jadwal_sidang as $row) : ?>
                              <tr>
                                  <th scope="row"><?= $i; ?></th>
                                  <td><?= $row['project_nama']; ?></td>
                                  <td>
                                    <h6 class="fw-semibold mb-1">
                                        <?= $row['dosen_penguji_1_nama']; ?>
                                    </h6>
                                    <span class="fw-normal">
                                        <?= $row['dosen_penguji_1_nidn']; ?>
                                    </span>
                                  </td>
                                  <td>
                                    <h6 class="fw-semibold mb-1">
                                        <?= $row['dosen_penguji_2_nama']; ?>
                                    </h6>
                                    <span class="fw-normal">
                                        <?= $row['dosen_penguji_2_nidn']; ?>
                                    </span>
                                  </td>
                                  <td>
                                    <h6 class="fw-semibold mb-1">
                                        <?= $row['mahasiswa_nama']; ?>
                                    </h6>
                                    <span class="fw-normal">
                                        <?= $row['mahasiswa_npm']; ?>
                                    </span>
                                  </td>
                                  <td>
                                  <?php
                                    // Mengambil tanggal dari database
                                    $tanggal = $row['tgl_sidang'];

                                    // Membuat objek DateTime dari string tanggal
                                    $date = new DateTime($tanggal);

                                    // Mengatur format tanggal
                                    $formattedDate = $date->format('d F Y');

                                    // Mengatur nama bulan dalam bahasa Indonesia
                                    $bulan = [
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
                                    ];

                                    // Mengganti nama bulan dalam format
                                    $formattedDate = strtr($formattedDate, $bulan);

                                    ?>
                                    <h6 class="fw-semibold mb-1">
                                        <?= $formattedDate; ?>
                                    </h6>
                                    <span class="fw-normal">
                                        <?= substr($row['waktu_sidang'], 0, 5); ?>
                                    </span>
                                  </td>
                                  <td>
                                      <small>
                                          <a href="detail_jadwal_sidang/<?= $row['id']; ?>" class="btn btn-outline-primary mb-2">
                                              <span>
                                                  <i class="ti ti-info-circle"></i>
                                              </span>
                                              Detail
                                          </a>
                                      </small>
                                      <small>
                                          <a href="ubah_jadwal_sidang/<?= $row['id']; ?>" class="btn btn-outline-warning mb-2">
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
                              <th class="text-start">Proyek</th>
                              <th class="text-start">Penguji 1</th>
                              <th class="text-start">Penguji 2</th>
                              <th class="text-start">Mahasiswa</th>
                              <th class="text-start">Waktu</th>
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
<div class="modal fade" id="modalAddJadwalSidang" tabindex="-1" aria-labelledby="modalAddJadwalSidangLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddJadwalSidangLabel">Form Tambah Jadwal Sidang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_jadwal_sidang'); ?>" method="post" enctype="multipart/form-data">
            <?php if (!empty($mahasiswa) && isset($mahasiswa[0]['plotting_id'])): ?>
                <input type="hidden" name="plotting_id" value="<?= htmlspecialchars($mahasiswa[0]['plotting_id'], ENT_QUOTES, 'UTF-8'); ?>">
            <?php else: ?>
                <!-- Jika tidak ada data, tampilkan pesan atau nilai default -->
                <input type="hidden" name="plotting_id" value="">
            <?php endif; ?>
            <div class="mb-3">
                <label for="project_id" class="form-label">Nama Project</label>
                <select class="form-select" id="project_id" name="project_id">
                    <option value="" selected>-- Pilih Project --</option>
                    <?php foreach ($projects as $project) : ?>
                        <option value="<?= $project['id']; ?>"><?= $project['nama_project']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('project_id', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="mahasiswa_id" class="form-label">Mahasiswa</label>
                <select class="form-select" id="mahasiswa_id" name="mahasiswa_id" onchange="fetchPenguji(this.value)">
                    <option value="" selected>-- Pilih Mahasiswa --</option>
                    <?php foreach ($mahasiswa as $m) : ?>
                        <option value="<?= $m['id']; ?>"><?= $m['nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('mahasiswa_id', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            
            <!-- Field untuk dosen penguji hanya muncul jika mahasiswa dipilih -->
            <div class="mb-3 d-none" id="dosenPenguji1Field">
                <label for="dosen_penguji_1" class="form-label">Dosen Penguji 1</label>
                <input type="text" name="dosen_penguji_1" id="dosen_penguji_1" class="form-control" readonly>
            </div>
            <div class="mb-3 d-none" id="dosenPenguji2Field">
                <label for="dosen_penguji_2" class="form-label">Dosen Penguji 2</label>
                <input type="text" name="dosen_penguji_2" id="dosen_penguji_2" class="form-control" readonly>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="tgl_sidang" class="form-label">Tanggal Sidang</label>
                        <input type="date" name="tgl_sidang" id="tgl_sidang" class="form-control" autocomplete="off" value="<?= set_value('tgl_sidang'); ?>">
                        <?= form_error('tgl_sidang', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-3">
                        <label for="waktu_sidang" class="form-label">Waktu Sidang</label>
                        <input type="time" name="waktu_sidang" id="waktu_sidang" class="form-control" autocomplete="off" value="<?= set_value('waktu_sidang'); ?>">
                        <?= form_error('waktu_sidang', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="no_ruangan" class="form-label">No. Ruangan</label>
                        <input type="text" name="no_ruangan" id="no_ruangan" class="form-control" autocomplete="off" value="<?= set_value('no_ruangan'); ?>" maxlength="3">
                        <?= form_error('no_ruangan', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                        <input type="text" name="nama_ruangan" id="nama_ruangan" class="form-control" autocomplete="off" value="<?= set_value('nama_ruangan'); ?>">
                        <?= form_error('nama_ruangan', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
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
</div>