<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data Mahasiswa</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('staff/update_mahasiswa'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $mahasiswa['id']; ?>">
                            <input type="hidden" name="gambarLama" value="<?= $mahasiswa['gambar']; ?>">
                            <div class="mb-3">
                                <label for="npm" class="form-label">NPM</label>
                                <input type="text" class="form-control" id="npm" name="npm" value="<?= set_value('npm', $mahasiswa['npm']); ?>" maxlength="9">
                                <?= form_error('npm', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama mahasiswa</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama', $mahasiswa['nama']); ?>">
                                <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="program_studi" class="form-label">Program studi</label>
                                <select class="form-select" id="prodi_id" name="prodi_id">
                                    <option value="" disabled>-- Pilih Prodi --</option>
                                    <?php foreach ($prodi as $p) : ?>
                                        <option value="<?= $p['id']; ?>" <?= set_select('prodi_id', $p['id'], $p['id'] == $mahasiswa['prodi_id']); ?>>
                                            <?= $p['nama_prodi']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('prodi_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label for="kelas_id" class="form-label">Kelas</label>
                                        <select class="form-select" id="kelas_id" name="kelas_id">
                                            <option value="" disabled>-- Pilih Kelas --</option>
                                            <?php foreach ($kelas as $kls) : ?>
                                                <option value="<?= $kls['id']; ?>" <?= set_select('kelas_id', $kls['id'], $kls['id'] == $mahasiswa['kelas_id']); ?>>
                                                    <?= $kls['nama_kelas']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <?= form_error('kelas', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="mb-3">
                                        <label for="semester" class="form-label">Semester</label>
                                        <input type="text" class="form-control" id="semester" name="semester" value="<?= set_value('semester', $mahasiswa['semester']); ?>" maxlength="2">
                                        <?= form_error('semester', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tahun_angkatan" class="form-label">Tahun Angkatan</label>
                                <select class="form-control" id="tahun_angkatan" name="tahun_angkatan">
                                    <option value="" disabled>Pilih Tahun</option>
                                    <?php for ($year = 2020; $year <= date('Y'); $year++): ?>
                                        <option value="<?= $year ?>" <?= set_select('tahun_angkatan', $year, $year == $mahasiswa['tahun_angkatan']); ?>><?= $year ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?= form_error('tahun_angkatan', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Profil</label>
                                <?php if (!empty($mahasiswa['gambar'])) : ?>
                                    <img id="gambar-preview" src="<?= base_url('assets/images/upload/' . $mahasiswa['gambar']); ?>" alt="default" class="img-thumbnail d-block" style="width: 150px;">
                                <?php else : ?>
                                    <span id="gambar-label"><?= $mahasiswa['gambar']; ?></span>
                                <?php endif; ?>
                                <input type="file" class="form-control" id="gambar" name="gambar">
                                <?= form_error('gambar', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
