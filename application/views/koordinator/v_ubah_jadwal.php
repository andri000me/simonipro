<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data jadwal</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_jadwal'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $jadwal['id']; ?>">
                            <input type="hidden" name="created_at" value="<?= $jadwal['created_at']; ?>">
                            <div class="mb-3">
                                <label for="nama_jadwal" class="form-label">Nama jadwal</label>
                                <input type="text" class="form-control" id="nama_jadwal" name="nama_jadwal" value="<?= set_value('nama_jadwal', $jadwal['nama_jadwal']); ?>">
                                <?= form_error('nama_jadwal', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
