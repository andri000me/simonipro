        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Pengguna</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddUser">
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
                          <th class="text-start">Nama</th>
                          <th class="text-start">Role</th>
                          <th class="text-start">Status</th>
                          <th class="text-start">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($pengguna as $user) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td>
                            <?= $user['nama']; ?> <br>
                            <span><i class="ti ti-user"></i></span>
                            <small class="fw-bold"><?= $user['username']; ?></small>
                          </td>
                          <td><?= $user['nama_role']; ?></td>
                          <td>
                          <span class="badge <?= $user['is_active'] == 1 ? 'text-bg-success' : 'badge-muted' ?>">
                            <?= $user['is_active'] == 1 ? 'aktif' : 'tidak aktif' ?>
                          </span>
                          </td>
                          <td>
                            <small>
                            <a href="detail_pengguna/<?= $user['id']; ?>" class="btn btn-outline-primary mb-2">
                                <span>
                                  <i class="ti ti-info-circle"></i>
                                </span>
                                Detail
                              </a>
                            </small>
                            <small>
                            <a href="ubah_pengguna/<?= $user['id']; ?>" class="btn btn-outline-warning mb-2">
                                <span>
                                  <i class="ti ti-edit"></i>
                                </span>
                                Ubah
                              </a>
                            </small>
                            <small>
                              <a href="hapus_pengguna/<?= $user['id']; ?>" class="btn btn-outline-danger mb-2" onclick="return confirm('Yakin ingin menghapus data yang dipilih ?')">
                                <span>
                                  <i class="ti ti-trash"></i>
                                </span>
                                Hapus
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
                          <th class="text-start">Nama</th>
                          <th class="text-start">Role</th>
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
        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a></p>
        </div>
      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="modalAddUser" tabindex="-1" aria-labelledby="modalAddUserLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddUserLabel">Form Tambah Data Pengguna</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('staff/tambah_pengguna'); ?>" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" name="nama" id="nama" class="form-control" autocomplete="off" value="<?= set_value('nama'); ?>">
                <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
                <?= form_error('username', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" value="<?= set_value('password'); ?>">
                <?= form_error('password', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select class="form-select" id="role_id" name="role_id">
                    <option value="" selected>-- Pilih role pengguna --</option>
                    <?php foreach ( $roles as $role ) : ?>
                        <option value="<?= $role['id']; ?>"><?= $role['nama_role']; ?></option>
                    <?php endforeach; ?>
                </select>
                <?= form_error('role_id', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="text" name="no_telp" id="no_telp" class="form-control" autocomplete="off" value="<?= set_value('no_telp'); ?>" maxlength="12">
                <?= form_error('no_telp', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="is_active" class="form-label">Status Pengguna</label>
                <input type="hidden" id="is_active" name="is_active" value="1">
                <input type="text" class="form-control" disabled placeholder="Aktif"></input>
                <?= form_error('is_active', '<small class="text-danger fst-italic">', '</small>'); ?>
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