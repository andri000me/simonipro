<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data kelas</h5>
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('staff/update_kelas'); ?>" method="post">
                            <input type="hidden" name="id" value="<?= $kelas['id']; ?>">
                            <div class="mb-3">
                                <label for="nama_kelas" class="form-label">Nama kelas</label>
                                <input type="text" class="form-control" id="nama_kelas" name="nama_kelas" autocomplete="off" maxlength="2" value="<?= set_value('nama_kelas', $kelas['nama_kelas']); ?>">
                                <?= form_error('nama_kelas', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="prodi_id" class="form-label">Program Studi</label>
                                <select class="form-select" id="prodi_id" name="prodi_id">
                                    <option value="" selected>-- Pilih Program Studi --</option>
                                    <?php foreach ($prodi as $p) : ?>
                                        <option value="<?= $p['id']; ?>" <?= set_select('prodi_id', $p['id'], $p['id'] == $kelas['prodi_id']); ?>><?= $p['nama_prodi']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('prodi_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
