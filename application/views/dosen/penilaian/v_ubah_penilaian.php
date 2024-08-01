<div class="container-fluid">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4 text-capitalize">Form Ubah Data Penilaian</h5>
                <div class="card">
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <form action="<?= base_url('dosen/update_penilaian'); ?>" method="post">
                            <input type="hidden" name="id" value="<?= $penilaian['id']; ?>">
                            <div class="mb-3">
                                <label for="nilai_penguji_1" class="form-label">Nilai Penguji 1</label>
                                <input type="number" class="form-control" id="nilai_penguji_1" name="nilai_penguji_1" value="<?= set_value('nilai_penguji_1', $penilaian['nilai_penguji_1']); ?>">
                                <?= form_error('nilai_penguji_1', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="nilai_penguji_2" class="form-label">Nilai Penguji 2</label>
                                <input type="number" class="form-control" id="nilai_penguji_2" name="nilai_penguji_2" value="<?= set_value('nilai_penguji_2', $penilaian['nilai_penguji_2']); ?>">
                                <?= form_error('nilai_penguji_2', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="grade" class="form-label">Grade</label>
                                <input type="text" class="form-control" id="grade" name="grade" value="<?= set_value('grade', $penilaian['grade']); ?>" readonly>
                                <?= form_error('grade', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <div class="mb-3">
                                <label for="status_kelulusan" class="form-label">Status Kelulusan</label>
                                <input type="text" class="form-control" id="status_kelulusan" name="status_kelulusan" value="<?= set_value('status_kelulusan', $penilaian['status_kelulusan']); ?>" readonly>
                                <?= form_error('status_kelulusan', '<small class="text-danger fst-italic">', '</small>'); ?>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
