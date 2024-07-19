
        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Role</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddRole">
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
                          <th class="text-start">Nama Role</th>
                          <th class="text-start">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($roles as $role) : ?>
                        <tr>
                          <th scope="row"><?= $i; ?></th>
                          <td><?= $role['nama_role']; ?></td>
                          <td>
                            <small>
                            <a href="ubah_role/<?= $role['id']; ?>" class="btn btn-outline-warning mb-2">
                                <span>
                                  <i class="ti ti-edit"></i>
                                </span>
                                Ubah
                              </a>
                            </small>
                            <small>
                              <a href="hapus_role/<?= $role['id']; ?>" class="btn btn-outline-danger mb-2" onclick="return confirm('Yakin ingin menghapus data yang dipilih ?')">
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
                          <th class="text-start">Nama Role</th>
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
<div class="modal fade" id="modalAddRole" tabindex="-1" aria-labelledby="modalAddRoleLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddRoleLabel">Form Tambah Data Role</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('staff/tambah_role'); ?>" method="post">
            <div class="mb-3">
                <label for="nama_role" class="form-label">Nama Role</label>
                <input type="text" name="nama_role" id="nama_role" class="form-control" autofocus autocomplete="off">
                <?= form_error('nama_role', '<small class="text-danger fst-italic">', '</small>'); ?>
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