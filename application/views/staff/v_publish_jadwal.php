        <!--  Row 1 -->
        <div class="row">
          <div class="col-lg-12 d-flex align-items-strech">
            <div class="card w-100">
              <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                  <div class="mb-3 mb-sm-0">
                    <h5 class="card-title fw-semibold">Daftar Jadwal</h5>
                  </div>
                </div>
              <div class="card">
                <div class="card-body">
                  <?= $this->session->flashdata('pesan'); ?>
                  <table id="myTable" class="table table-hover table-responsive">
                    <thead>
                      <tr>
                        <th class="text-start">#</th>
                        <th class="text-start">Nama jadwal</th>
                        <th class="text-start">Dibuat pada</th>
                        <th class="text-start">Status</th>
                        <th class="text-start">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; ?>
                      <?php foreach ($jadwal as $j) : ?>
                      <tr>
                        <th scope="row"><?= $i; ?></th>
                        <td><?= $j['nama_jadwal']; ?></td>
                        <td><?= date('d-M-Y', $j['created_at']); ?></td>
                        <td>
                          <?php ( $j['status'] == 'draft' ) ? $color = 'warning' : $color = 'success' ?>
                            <span class="badge text-bg-<?= $color; ?>">
                                <?= $j['status']; ?>
                            </span>
                        </td>
                        <td>
                          <small>
                          <a href="detail_jadwal/<?= $j['id']; ?>" class="btn btn-outline-primary mb-2">
                              <span>
                                <i class="ti ti-info-circle"></i>
                              </span>
                              Detail
                            </a>
                          </small>
                          <small>
                          <?php ( $j['status'] == 'published' ) ? $secondary = 'outline-dark border-0 disabled': $secondary = 'secondary' ?>
                          <a href="do_publish_jadwal/<?= $j['id']; ?>" class="btn btn-<?= $secondary ?> mb-2" onclick="return confirm('Publikasikan jadwal ?')">
                              <span>
                              <?php ($j['status'] == 'published') ? $icon = 'check' : $icon = 'upload' ?>
                                <i class="ti ti-<?= $icon; ?>"></i>
                              <?php ($j['status'] == 'published') ? $str = 'published' : $str = 'publish' ?>
                              </span>
                              <?= $str; ?>
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
                        <th class="text-start">Nama jadwal</th>
                        <th class="text-start">Dibuat pada</th>
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
    </div>
  </div>