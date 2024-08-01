<!-- Row 1 -->
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Daftar Penilaian</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalAddPenilaian">
                                <span>
                                    <i class="ti ti-plus"></i>
                                </span> 
                                Tambah Data
                            </button>
                        </div>
                        <div class="table-responsive">
                            <?= $this->session->flashdata('pesan'); ?>
                            <table id="myTable" class="table table-hover text-wrap mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-start">#</th>
                                        <th class="text-start">Mahasiswa</th>
                                        <th class="text-start">Nilai Penguji 1</th>
                                        <th class="text-start">Nilai Penguji 2</th>
                                        <th class="text-start">Grade</th>
                                        <th class="text-start">Status</th>
                                        <th class="text-start">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($penilaian as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td>
                                                <?= $row['mahasiswa_nama']; ?><br>
                                                <small><?= $row['mahasiswa_npm']; ?></small>
                                            </td>
                                            <td><?= $row['nilai_penguji_1']; ?></td>
                                            <td><?= $row['nilai_penguji_2']; ?></td>
                                            <td><?= $row['grade']; ?></td>
                                            <td><?= $row['status_kelulusan']; ?></td>
                                            <td>
                                                <small>
                                                    <a href="detail_penilaian/<?= $row['id']; ?>" class="btn btn-outline-primary mb-2">
                                                        <span>
                                                            <i class="ti ti-info-circle me-1"></i>
                                                        </span>
                                                        Detail
                                                    </a>
                                                </small>
                                                <small>
                                                    <a href="ubah_penilaian/<?= $row['id']; ?>" class="btn btn-outline-warning mb-2">
                                                        <span>
                                                            <i class="ti ti-edit me-1"></i>
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
                                        <th class="text-start">Mahasiswa</th>
                                        <th class="text-start">Nilai Penguji 1</th>
                                        <th class="text-start">Nilai Penguji 2</th>
                                        <th class="text-start">Grade</th>
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

<!-- Modal -->
<div class="modal fade" id="modalAddPenilaian" tabindex="-1" aria-labelledby="modalAddPenilaianLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddPenilaianLabel">Form Tambah Data penilaian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('dosen/tambah_penilaian'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="plotting_id" class="form-label">Mahasiswa</label>
                <select class="form-select" id="plotting_id" name="plotting_id">
                    <option value="" selected>-- Pilih Mahasiswa --</option>
                    <?php foreach ($mahasiswa as $mhs) : ?>
                        <option value="<?= $mhs['plotting_id']; ?>"><?= $mhs['mahasiswa_npm']; ?> - <?= $mhs['mahasiswa_nama']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('plotting_id', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="dosen_penguji_1_nidn" class="form-label">NIDN</label>
                        <input type="text" class="form-control" value="<?= $mhs['dosen_penguji_1_nidn']; ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="dosen_penguji_1_nidn" class="form-label">Nama Dosen Penguji 1</label>
                        <input type="text" class="form-control" value="<?= $mhs['dosen_penguji_1_nama']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="mb-3">
                        <label for="dosen_penguji_1_nidn" class="form-label">NIDN</label>
                        <input type="text" class="form-control" value="<?= $mhs['dosen_penguji_2_nidn']; ?>" readonly>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="mb-3">
                        <label for="dosen_penguji_1_nidn" class="form-label">Nama Dosen Penguji 2</label>
                        <input type="text" class="form-control" value="<?= $mhs['dosen_penguji_2_nama']; ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="nilai_penguji_1" class="form-label">Nilai Penguji 1</label>
                <input type="text" class="form-control" name="nilai_penguji_1" id="nilai_penguji_1" inputmode="numeric">
                <?= form_error('nilai_penguji_1', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="nilai_penguji_2" class="form-label">Nilai Penguji 2</label>
                <input type="text" class="form-control" name="nilai_penguji_2" id="nilai_penguji_2" inputmode="numeric">
                <?= form_error('nilai_penguji_2', '<small class="text-danger fst-italic">', '</small>'); ?>
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