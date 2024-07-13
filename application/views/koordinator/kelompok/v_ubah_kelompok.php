
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data kelompok</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_kelompok'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $kelompok['id']; ?>">
                            <div class="mb-3">
                                <label for="dosen_pembimbing_id" class="form-label">Nama Dosen</label>
                                <select class="form-select" id="dosen_pembimbing_id" name="dosen_pembimbing_id">
                                    <?php foreach ($dosen as $dsn) : ?>
                                        <option value="<?= $dsn['id']; ?>" <?= set_select('dosen_pembimbing_id', $dsn['id'], $dsn['id'] == $kelompok['dosen_pembimbing_id']); ?>><?= $dsn['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('dosen_pembimbing_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Semester</label>
                                        <input type="text" class="form-control" id="semester" name="semester" maxlength="2" value="<?= set_value('semester', $kelompok['semester']); ?>">
                                        <?= form_error('semester', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="tahun_ajaran" class="form-label">Tahun Ajaran</label>
                                        <input type="text" class="form-control" id="tahun_ajaran" name="tahun_ajaran" value="<?= set_value('tahun_ajaran', $kelompok['tahun_ajaran']); ?>">
                                        <?= form_error('tahun_ajaran', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="kelas_id" class="form-label">Kelas</label>
                                        <select class="form-select" id="kelas_id" name="kelas_id">
                                            <?php foreach ($kelas as $kls) : ?>
                                                <option value="<?= $kls['id']; ?>" <?= set_select('kelas_id', $kls['id'], $kls['id'] == $kelompok['kelas_id']); ?>><?= $kls['jenjang'] . '-' . getShortProdi($kls['nama_prodi']) . '-' . $kls['nama_kelas']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('kelas_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="kode_kelompok" class="form-label">Kode kelompok</label>
                                        <input type="text" class="form-control" id="kode_kelompok" name="kode_kelompok" value="<?= set_value('kode_kelompok', $kelompok['kode_kelompok']); ?>">
                                        <?= form_error('kode_kelompok', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
