<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form ubah data jadwal sidang</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('koordinator/update_jadwal_sidang'); ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $jadwal_sidang['id']; ?>">
                            <input type="hidden" name="project_id" value="<?= $jadwal_sidang['project_id']; ?>">
                            <input type="hidden" name="plotting_id" value="<?= $jadwal_sidang['plotting_id']; ?>">
                            <div class="mb-3">
                                <label for="project_nama" class="form-label">Nama Proyek</label>
                                <input type="text" class="form-control" id="project_nama" value="<?= $jadwal_sidang['project_nama']; ?>" readonly>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="penguji_1_nidn" class="form-label">NIDN</label>
                                    <input type="text" class="form-control" id="penguji_1_nidn" value="<?= $jadwal_sidang['penguji_1_nidn']; ?>" readonly>
                                </div>
                                <div class="col-lg-9">
                                    <label for="penguji_1_nama" class="form-label">Nama Penguji 1</label>
                                    <input type="text" class="form-control" id="penguji_1_nama" value="<?= $jadwal_sidang['penguji_1_nama']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="penguji_2_nidn" class="form-label">NIDN</label>
                                    <input type="text" class="form-control" id="penguji_2_nidn" value="<?= $jadwal_sidang['penguji_2_nidn']; ?>" readonly>
                                </div>
                                <div class="col-lg-9">
                                    <label for="penguji_2_nama" class="form-label">Nama Penguji 2</label>
                                    <input type="text" class="form-control" id="penguji_2_nama" value="<?= $jadwal_sidang['penguji_2_nama']; ?>" readonly>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <label for="mahasiswa_npm" class="form-label">NPM</label>
                                    <input type="text" class="form-control" id="mahasiswa_npm" value="<?= $jadwal_sidang['mahasiswa_npm']; ?>" readonly>
                                </div>
                                <div class="col-lg-7">
                                    <label for="mahasiswa_nama" class="form-label">Nama Mahasiswa</label>
                                    <input type="text" class="form-control" id="mahasiswa_nama" value="<?= $jadwal_sidang['mahasiswa_nama']; ?>" readonly>
                                </div>
                                <div class="col-lg-2">
                                    <label for="nama_kelas" class="form-label">Kelas</label>
                                    <input type="text" class="form-control" id="nama_kelas" value="<?= $jadwal_sidang['nama_kelas']; ?>" readonly>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="tgl_sidang" class="form-label">Tanggal Sidang</label>
                                <input type="date" class="form-control" id="tgl_sidang" name="tgl_sidang" value="<?= set_value('tgl_sidang', $jadwal_sidang['tgl_sidang']); ?>">
                                <?= form_error('tgl_sidang', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="waktu_sidang" class="form-label">Waktu Sidang</label>
                                <input type="time" class="form-control" id="waktu_sidang" name="waktu_sidang" value="<?= set_value('waktu_sidang', $jadwal_sidang['waktu_sidang']); ?>">
                                <?= form_error('waktu_sidang', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="no_ruangan" class="form-label">Nomor Ruangan</label>
                                <input type="text" class="form-control" id="no_ruangan" name="no_ruangan" value="<?= set_value('no_ruangan', $jadwal_sidang['no_ruangan']); ?>" inputmode="numeric">
                                <?= form_error('no_ruangan', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                                <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" value="<?= set_value('nama_ruangan', $jadwal_sidang['nama_ruangan']); ?>">
                                <?= form_error('nama_ruangan', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
