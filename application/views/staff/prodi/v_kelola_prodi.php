
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Prodi</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddProdi">
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
                        <th class="text-start">Kode Prodi</th>
                        <th class="text-start">Nama Prodi</th>
                        <th class="text-start">Jenjang</th>
                        <th class="text-start">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($prodi as $p) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $p['kode_prodi']; ?></td>
                        <td><?= $p['nama_prodi']; ?></td>
                        <td><?= $p['jenjang']; ?></td>
                        <td>
                          <small>
                          <a href="detail_prodi/<?= $p['id']; ?>" class="btn btn-outline-primary mb-2">
                              <span>
                                <i class="ti ti-info-circle"></i>
                              </span>
                              Detail
                            </a>
                          </small>
                          <small>
                          <a href="ubah_prodi/<?= $p['id']; ?>" class="btn btn-outline-warning mb-2">
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
                        <th class="text-start">Kode Prodi</th>
                        <th class="text-start">Nama Prodi</th>
                        <th class="text-start">Jenjang</th>
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
<div class="modal fade" id="modalAddProdi" tabindex="-1" aria-labelledby="modalAddProdiLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddProdiLabel">Form Tambah Data Prodi</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('staff/tambah_prodi'); ?>" method="post">
            <div class="mb-3">
                <label for="kode_prodi" class="form-label">Kode Prodi</label>
                <input type="text" name="kode_prodi" id="kode_prodi" class="form-control" autofocus autocomplete="off" maxlength="5" value="<?= set_value('kode_prodi'); ?>">
                <?= form_error('kode_prodi', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="nama_prodi" class="form-label">Nama Prodi</label>
                <input type="text" name="nama_prodi" id="nama_prodi" class="form-control" autocomplete="off" value="<?= set_value('nama_prodi'); ?>">
                <?= form_error('nama_prodi', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="jenjang" class="form-label">Jenjang</label>
                <select name="jenjang" id="jenjang" class="form-select">
                    <option value="">-- Pilih jenjang prodi --</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S1">S1</option>
                    <option value="S2">S2</option>
                </select>
                <?= form_error('jenjang', '<small class="text-danger fst-italic">', '</small>'); ?>
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