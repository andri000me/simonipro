<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data koordinator</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('staff/update_koordinator'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $koordinator['id']; ?>">
                            <input type="hidden" name="gambarLama" value="<?= $koordinator['gambar']; ?>">
                            <div class="mb-3">
                                <label for="nidn" class="form-label">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" value="<?= set_value('nidn', $koordinator['nidn']); ?>" maxlength="10">
                                <?= form_error('nidn', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama koordinator</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama', $koordinator['nama']); ?>">
                                <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Profil</label>
                                <?php if (!empty($koordinator['gambar'])) : ?>
                                    <img id="gambar-preview" src="<?= base_url('assets/images/upload/' . $koordinator['gambar']); ?>" alt="default" class="img-thumbnail d-block" style="width: 150px;">
                                <?php else : ?>
                                    <span id="gambar-label"><?= $koordinator['gambar']; ?></span>
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
