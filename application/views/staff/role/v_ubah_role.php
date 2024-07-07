
      <div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data role</h5>
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url('staff/update_role'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $roles['id']; ?>">
                    <div class="mb-3">
                      <label for="nama_role" class="form-label">Nama Role</label>
                      <input type="text" class="form-control" id="nama_role" name="nama_role" autocomplete="off" value="<?= $roles['nama_role']; ?>">
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