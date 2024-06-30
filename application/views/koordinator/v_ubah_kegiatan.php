<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data kegiatan</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_kegiatan'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $kegiatan['id']; ?>">
                            <div class="mb-3">
                                <label for="jadwal_id" class="form-label">Jadwal</label>
                                    <select class="form-select" id="jadwal_id" name="jadwal_id">
                                        <option value="<?= $kegiatan['jadwal_id']; ?>" selected><?= $kegiatan['nama_jadwal']; ?></option>
                                        <option value="">-- Pilih Jadwal --</option>
                                        <?php foreach ($jadwal as $j) : ?>
                                            <option value="<?= $j['id']; ?>"><?= $j['nama_jadwal']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                <?= form_error('jadwal_id', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tgl_awal" class="form-label">Tanggal Dimulai</label>
                                        <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" value="<?= set_value('tgl_awal', $kegiatan['tgl_awal']); ?>">
                                        <?= form_error('tgl_awal', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tgl_selesai" class="form-label">Tanggal Selesai</label>
                                        <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" value="<?= set_value('tgl_selesai', $kegiatan['tgl_selesai']); ?>">
                                        <?= form_error('tgl_selesai', '<small class="text-danger fst-italic">', '</small>'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="nama_kegiatan" class="form-label">Nama kegiatan</label>
                                <input type="text" class="form-control" id="nama_kegiatan" name="nama_kegiatan" value="<?= set_value('nama_kegiatan', $kegiatan['nama_kegiatan']); ?>">
                                <?= form_error('nama_kegiatan', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="tiny" class="form-label">Deskripsi</label>
                                <textarea name="deskripsi" id="tiny" class="form-control"><?= $kegiatan['deskripsi']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
