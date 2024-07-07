<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data Plotting</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_plotting'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $plotting['id']; ?>">
                            <div class="mb-3">
                                <label for="jenis_plotting_id" class="form-label">Jenis Plotting</label>
                                <select class="form-select" id="jenis_plotting_id" name="jenis_plotting_id" onchange="togglePengujiFields()">
                                    <?php foreach ($jenis_plotting as $jenis) : ?>
                                        <option value="<?= $jenis['id']; ?>" <?= ($jenis['id'] == $plotting['jenis_plotting_id']) ? 'selected' : ''; ?>><?= $jenis['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('jenis_plotting_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="koordinator_nama" class="form-label">Nama Koordinator</label>
                                <input type="text" class="form-control" id="koordinator_nama" name="koordinator_nama" value="<?= $plotting['koordinator_nama']; ?>" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="dosen_pembimbing_id" class="form-label">Dosen Pembimbing</label>
                                <select name="dosen_pembimbing_id" id="dosen_pembimbing_id" class="form-control" required>
                                    <option value="">-- Pilih Dosen Pembimbing --</option>
                                    <?php foreach ($dosen as $d) : ?>
                                        <option value="<?= $d['id']; ?>" <?= $d['id'] == $plotting['dosen_pembimbing_id'] ? 'selected' : ''; ?>><?= $d['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('dosen_pembimbing_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="mb-3" id="dosenPenguji1Field" style="display: none;">
                                <label for="dosen_penguji_1_id" class="form-label">Dosen Penguji 1</label>
                                <select class="form-select" id="dosen_penguji_1_id" name="dosen_penguji_1_id">
                                    <option value="">-- Pilih Dosen Penguji 1 --</option>
                                    <?php foreach ($dosen as $dsn) : ?>
                                        <option value="<?= $dsn['id']; ?>" <?= $dsn['id'] == $plotting['dosen_penguji_1_id'] ? 'selected' : ''; ?>><?= $dsn['nidn']; ?> - <?= $dsn['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('dosen_penguji_1_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3" id="dosenPenguji2Field" style="display: none;">
                                <label for="dosen_penguji_2_id" class="form-label">Dosen Penguji 2</label>
                                <select class="form-select" id="dosen_penguji_2_id" name="dosen_penguji_2_id">
                                    <option value="">-- Pilih Dosen Penguji 2 --</option>
                                    <?php foreach ($dosen as $dsn) : ?>
                                        <option value="<?= $dsn['id']; ?>" <?= $dsn['id'] == $plotting['dosen_penguji_2_id'] ? 'selected' : ''; ?>><?= $dsn['nidn']; ?> - <?= $dsn['nama']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('dosen_penguji_2_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="mahasiswa_nama" class="form-label">Mahasiswa</label>
                                <input type="text" class="form-control" id="mahasiswa_nama" name="mahasiswa_nama" value="<?= $plotting['mahasiswa_nama']; ?>" disabled readonly>
                            </div>
                            <div class="mb-3">
                                <label for="project_id" class="form-label">Project</label>
                                <input type="text" class="form-control" id="project_id" name="project_id" value="<?= $plotting['project_nama']; ?>" disabled readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>