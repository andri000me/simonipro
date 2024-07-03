
<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data pengguna</h5>
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url('staff/update_pengguna'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $pengguna['id']; ?>">
                    <input type="hidden" name="old_password" value="<?= $pengguna['password']; ?>">
                    <input type="hidden" name="created_at" value="<?= $pengguna['created_at']; ?>">
                    <!-- <div class="mb-3">
                      <label for="nama" class="form-label">Nama Pengguna</label>
                      <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama', $pengguna['nama']); ?>">
                      <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div> -->
                    <div class="mb-3">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username', $pengguna['username']); ?>">
                      <?= form_error('username', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="<?= set_value('password', $pengguna['password']); ?>">
                        <?= form_error('password', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Role</label>
                        <select class="form-select" id="role_id" name="role_id">
                            <option value="" selected>-- Pilih role pengguna --</option>
                            <?php foreach ($roles as $role): ?>
                                <option value="<?= $role['id']; ?>" <?= ($role['id'] == $pengguna['role_id']) ? 'selected' : ''; ?>>
                                    <?= $role['nama_role']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('role_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <div class="mb-3">
                      <label for="is_active" class="form-label">Status Pengguna</label>
                      <select class="form-select" id="is_active" name="is_active">
                            <option value="1" <?= ($pengguna['is_active'] == 1) ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?= ($pengguna['is_active'] == 0) ? 'selected' : ''; ?>>Tidak Aktif</option>
                        </select>
                        <?= form_error('is_active', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>