
<div class="container-fluid">
        <div class="container-fluid">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data prodi</h5>
              <div class="card">
                <div class="card-body">
                  <form action="<?= base_url('staff/update_prodi'); ?>" method="post">
                    <input type="hidden" name="id" value="<?= $prodi['id']; ?>">
                    <div class="mb-3">
                      <label for="kode_prodi" class="form-label">Kode Prodi</label>
                      <input type="text" class="form-control" id="kode_prodi" name="kode_prodi" autocomplete="off" value="<?= $prodi['kode_prodi']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="nama_prodi" class="form-label">Nama Prodi</label>
                      <input type="text" class="form-control" id="nama_prodi" name="nama_prodi" autocomplete="off" value="<?= $prodi['nama_prodi']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="jenjang" class="form-label">Jenjang</label>
                        <select class="form-select" id="jenjang" name="jenjang">
                            <option value="<?= $prodi['jenjang']; ?>" selected><?= $prodi['jenjang']; ?></option>
                            <option value="D3">D3</option>
                            <option value="D4">D4</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                        </select>
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