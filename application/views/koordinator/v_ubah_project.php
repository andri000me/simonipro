<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data project</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_project'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $projects['id']; ?>">
                            <div class="mb-3">
                                <label for="nama_project" class="form-label">Nama Project</label>
                                <input type="text" class="form-control" id="nama_project" name="nama_project" value="<?= set_value('nama_project', $projects['nama_project']); ?>">
                                <?= form_error('nama_project', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" class="form-control"><?= $projects['deskripsi']; ?></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tgl_mulai" class="form-label">Tanggal Dimulai</label>
                                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" value="<?= set_value('tgl_mulai', $projects['tgl_mulai']); ?>">
                                        <?= form_error('tgl_mulai', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="<?= set_value('tgl_selesai', $projects['tgl_selesai']); ?>">
                                        <?= form_error('tgl_selesai', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="prodi_id" class="form-label">Program studi</label>
                                <select class="form-select" id="prodi_id" name="prodi_id">
                                    <option value="" disabled>-- Pilih Prodi --</option>
                                    <?php foreach ($prodi as $p) : ?>
                                        <option value="<?= $p['id']; ?>" <?= set_select('prodi_id', $p['id'], $p['id'] == $projects['prodi_id']); ?>>
                                            <?= $p['nama_prodi']; ?>
                                        </option>
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
