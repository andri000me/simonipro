<!-- Row 1 -->
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Daftar Penilaian</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <?= $this->session->flashdata('pesan'); ?>
                            <table id="myTable" class="table table-hover text-wrap mb-0 align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-start">#</th>
                                        <th class="text-start">Mahasiswa</th>
                                        <th class="text-start">Nilai Pembimbing</th>
                                        <th class="text-start">Nilai Penguji 1</th>
                                        <th class="text-start">Nilai Penguji 2</th>
                                        <th class="text-start">Grade</th>
                                        <th class="text-start">Status</th>
                                        <th class="text-start">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($penilaian as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td>
                                                <?= $row['mahasiswa_nama']; ?><br>
                                                <small><?= $row['mahasiswa_npm']; ?></small>
                                            </td>
                                            <td><?= $row['nilai_pembimbing']; ?></td>
                                            <td><?= $row['nilai_penguji_1']; ?></td>
                                            <td><?= $row['nilai_penguji_2']; ?></td>
                                            <td><?= $row['grade']; ?></td>
                                            <td><?= $row['status_kelulusan']; ?></td>
                                            <td>
                                                <small>
                                                    <a href="detail_penilaian/<?= $row['id']; ?>" class="btn btn-outline-primary mb-2">
                                                        <span>
                                                            <i class="ti ti-info-circle me-1"></i>
                                                        </span>
                                                        Detail
                                                    </a>
                                                </small>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                    <?php endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="text-start">#</th>
                                        <th class="text-start">Mahasiswa</th>
                                        <th class="text-start">Nilai Pembimbing</th>
                                        <th class="text-start">Nilai Penguji 1</th>
                                        <th class="text-start">Nilai Penguji 2</th>
                                        <th class="text-start">Grade</th>
                                        <th class="text-start">Status</th>
                                        <th class="text-start">Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>