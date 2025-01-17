        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Koordinator</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddKoordinator">
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
                          <th class="text-start">NIDN</th>
                          <th class="text-start">Nama</th>
                          <th class="text-start">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($koordinator as $koor) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $koor['nidn']; ?></td>
                          <td><?= $koor['nama']; ?></td>
                          <td>
                            <small>
                              <a href="detail_koordinator/<?= $koor['id']; ?>" class="btn btn-outline-primary mb-2">
                                <span>
                                  <i class="ti ti-info-circle"></i>
                                </span>
                                Detail
                              </a>
                            </small>
                            <small>
                              <a href="ubah_koordinator/<?= $koor['id']; ?>" class="btn btn-outline-warning mb-2">
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
                          <th class="text-start">NIDN</th>
                          <th class="text-start">Nama</th>
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
  <div class="modal fade" id="modalAddKoordinator" tabindex="-1" aria-labelledby="modalAddKoordinatorLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddKoordinatorLabel">Form Tambah Data koordinator</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('staff/tambah_koordinator'); ?>" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="user_id" class="form-label">User ID</label>
            <select class="form-select" id="user_id" name="user_id">
              <option selected>-- Pilih User --</option>
              <?php foreach ($users as $user) : ?>
                <option value="<?= $user['id']; ?>" data-nama="<?= $user['nama']; ?>"><?= $user['username']; ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('user_id', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="nidn" class="form-label">NIDN</label>
            <input type="text" name="nidn" id="nidn" class="form-control" maxlength="10" autofocus autocomplete="off" value="<?= set_value('nidn'); ?>">
            <?= form_error('nidn', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?= set_value('nama'); ?>" readonly>
            <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
          </div>
          <div class="mb-3">
            <label for="gambar" class="form-label">Gambar</label>
            <input type="file" name="gambar" id="gambar" class="form-control" value="<?= set_value('gambar'); ?>">
            <?= form_error('gambar', '<small class="text-danger fst-italic">', '</small>'); ?>
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