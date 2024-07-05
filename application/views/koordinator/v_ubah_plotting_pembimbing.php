<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data Plotting</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_plotting_pembimbing'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $plotting['id']; ?>">
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
                            <div class="mb-3">
                                <label for="mahasiswa_nama" class="form-label">Mahasiswa</label>
                                <input type="text" class="form-control" id="mahasiswa_nama" name="mahasiswa_nama" value="<?= $plotting['mahasiswa_nama']; ?>" disabled readonly>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
