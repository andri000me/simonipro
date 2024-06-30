        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Kegiatan</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddKegiatan">
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
                        <th class="text-start">Tanggal Dimulai</th>
                        <th class="text-start">Tanggal Selesai</th>
                        <th class="text-start">Nama Kegiatan</th>
                        <th class="text-start">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($kegiatan as $keg) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $keg['tgl_awal']; ?></td>
                        <td><?= $keg['tgl_selesai']; ?></td>
                        <td><?= $keg['nama_kegiatan']; ?></td>
                        <td>
                          <small>
                          <a href="ubah_kegiatan/<?= $keg['id']; ?>" class="btn btn-outline-warning mb-1">
                              <span>
                                <i class="ti ti-edit"></i>
                              </span>
                              Ubah
                            </a>
                          </small>
                          <small>
                          <a href="hapus_kegiatan/<?= $keg['id']; ?>" class="btn btn-outline-danger mb-1" onclick="return confirm('Yakin ingin menghapus ?')">
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
                        <th class="text-start">Tanggal Dimulai</th>
                        <th class="text-start">Tanggal Selesai</th>
                        <th class="text-start">Nama Kegiatan</th>
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
<div class="modal fade" id="modalAddKegiatan" tabindex="-1" aria-labelledby="modalAddKegiatanLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddKegiatanLabel">Form Tambah Data kegiatan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_kegiatan'); ?>" method="post">
            <div class="mb-3">
                <label for="jadwal_id" class="form-label">Jadwal</label>
                    <select class="form-select" id="jadwal_id" name="jadwal_id">
                        <option value="" selected>-- Pilih Jadwal --</option>
                        <?php foreach ($jadwal as $j) : ?>
                            <option value="<?= $j['id']; ?>"><?= $j['nama_jadwal']; ?></option>
                        <?php endforeach; ?>
                    </select>
                <?= form_error('jadwal_id', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tgl_awal" class="form-label">Tanggal Dimulai</label>
                        <input type="date" name="tgl_awal" id="tgl_awal" class="form-control" value="<?= set_value('tgl_awal'); ?>">
                        <?= form_error('tgl_awal', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" value="<?= set_value('tgl_selesai'); ?>">
                        <?= form_error('tgl_selesai', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" value="<?= set_value('nama_kegiatan'); ?>" maxlength="150">
                <?= form_error('nama_kegiatan', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea id="tiny" name="deskripsi">
                    <p><?= set_value('deskripsi'); ?></p>
                </textarea>
                <?= form_error('deskripsi', '<small class="text-danger fst-italic">', '</small>'); ?>
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