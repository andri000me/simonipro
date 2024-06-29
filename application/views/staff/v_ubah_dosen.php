<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data dosen</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('staff/update_dosen'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $dosen['id']; ?>">
                            <input type="hidden" name="gambarLama" value="<?= $dosen['gambar']; ?>">
                            <div class="mb-3">
                                <label for="nidn" class="form-label">NIDN</label>
                                <input type="text" class="form-control" id="nidn" name="nidn" value="<?= set_value('nidn', $dosen['nidn']); ?>" maxlength="10">
                                <?= form_error('nidn', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama dosen</label>
                                <input type="text" class="form-control" value="<?= $dosen['nama']; ?>" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Profil</label>
                                <?php if (!empty($dosen['gambar'])) : ?>
                                    <img id="gambar-preview" src="<?= base_url('assets/images/upload/' . $dosen['gambar']); ?>" alt="default" class="img-thumbnail d-block" style="width: 150px;">
                                <?php else : ?>
                                    <span id="gambar-label"><?= $dosen['gambar']; ?></span>
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
