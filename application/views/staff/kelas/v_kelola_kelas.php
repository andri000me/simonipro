
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Kelas</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddKelas">
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
                          <th class="text-start">Nama kelas</th>
                          <th class="text-start">Program Studi</th>
                          <th class="text-start">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kelas as $kls) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $kls['nama_kelas']; ?></td>
                          <td><?= $kls['jenjang'] . ' ' . $kls['nama_prodi']; ?></td>
                          <td>
                            <small>
                            <a href="detail_kelas/<?= $kls['id']; ?>" class="btn btn-outline-primary mb-2">
                                <span>
                                  <i class="ti ti-info-circle"></i>
                                </span>
                                Detail
                              </a>
                            </small>
                            <small>
                            <a href="ubah_kelas/<?= $kls['id']; ?>" class="btn btn-outline-warning mb-2">
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
                          <th class="text-start">Nama kelas</th>
                          <th class="text-start">Program Studi</th>
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
<div class="modal fade" id="modalAddKelas" tabindex="-1" aria-labelledby="modalAddKelasLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddKelasLabel">Form Tambah Data kelas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('staff/tambah_kelas'); ?>" method="post">
            <div class="mb-3">
                <label for="nama_kelas" class="form-label">Nama kelas</label>
                <input type="text" name="nama_kelas" id="nama_kelas" class="form-control" autocomplete="off" maxlength="2" value="<?= set_value('nama_kelas'); ?>">
                <?= form_error('nama_kelas', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
              <label for="prodi_id" class="form-label">Program Studi</label>
                <select class="form-select" id="prodi_id" name="prodi_id">
                    <option value="" selected>-- Pilih Prodi --</option>
                    <?php foreach ($prodi as $p) : ?>
                        <option value="<?= $p['id']; ?>"><?= $p['jenjang'] . ' ' .$p['nama_prodi']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('prodi_id', '<small class="text-danger fst-italic">', '</small>'); ?>
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