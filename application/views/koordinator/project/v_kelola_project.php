        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Project</h5>
                </div>
              </div>
              <div class="card">
                <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                  <div class="d-flex align-items-center justify-content-between">
                    <div class="mb-3">
                      <button type="button" class="btn btn-success"  data-bs-toggle="modal" data-bs-target="#modalAddProject">
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
                              <th class="text-start">Nama Project</th>
                              <th class="text-start">Dimulai</th>
                              <th class="text-start">Selesai</th>
                              <th class="text-start">Nama Prodi</th>
                              <th class="text-start">Aksi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php $i = 1; ?>
                          <?php foreach ($projects as $project) : ?>
                              <tr>
                                  <th scope="row"><?= $i; ?></th>
                                  <td><?= $project['nama_project']; ?></td>
                                  <td><?= $project['tgl_mulai']; ?></td>
                                  <td><?= $project['tgl_selesai']; ?></td>
                                  <td><?= $project['nama_prodi']; ?></td>
                                  <td>
                                      <small>
                                          <a href="detail_project/<?= $project['id']; ?>" class="btn btn-outline-primary mb-2">
                                              <span>
                                                  <i class="ti ti-info-circle"></i>
                                              </span>
                                              Detail
                                          </a>
                                      </small>
                                      <small>
                                          <a href="ubah_project/<?= $project['id']; ?>" class="btn btn-outline-warning mb-2">
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
                              <th class="text-start">Nama Project</th>
                              <th class="text-start">Dimulai</th>
                              <th class="text-start">Selesai</th>
                              <th class="text-start">Nama Prodi</th>
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
<div class="modal fade" id="modalAddProject" tabindex="-1" aria-labelledby="modalAddProjectLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAddProjectLabel">Form Tambah Data project</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('koordinator/tambah_project'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_project" class="form-label">Nama Project</label>
                <input type="text" name="nama_project" id="nama_project" class="form-control" autofocus autocomplete="off" value="<?= set_value('nama_project'); ?>">
                <?= form_error('nama_project', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <label for="deskripsi" class="form-label">Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="form-control"><?= set_value('deskripsi'); ?></textarea>
                <?= form_error('deskripsi', '<small class="text-danger fst-italic">', '</small>'); ?>
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="tgl_mulai" class="form-label">Tanggal Dimulai</label>
                        <input type="date" name="tgl_mulai" id="tgl_mulai" class="form-control" autocomplete="off" value="<?= set_value('tgl_mulai'); ?>">
                        <?= form_error('tgl_mulai', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                    <div class="col-md-6">
                    <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                        <input type="date" name="tgl_selesai" id="tgl_selesai" class="form-control" autocomplete="off" value="<?= set_value('tgl_selesai'); ?>">
                        <?= form_error('tgl_selesai', '<small class="text-danger fst-italic">', '</small>'); ?>
                    </div>
                </div>
            </div>
            <div class="mb-3">
              <label for="prodi_id" class="form-label">Nama Prodi</label>
                <select class="form-select" id="prodi_id" name="prodi_id">
                    <option value="" selected>-- Pilih Prodi --</option>
                    <?php foreach ($prodi as $p) : ?>
                        <option value="<?= $p['id']; ?>"><?= $p['nama_prodi']; ?></option>
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