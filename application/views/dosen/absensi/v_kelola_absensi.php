<!-- Row 1 -->
<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                    <div class="mb-3 mb-sm-0">
                        <h5 class="card-title fw-semibold">Daftar Absensi Bimbingan</h5>
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
                                        <th class="text-start">Tanggal Bimbingan</th>
                                        <th class="text-start">Mahasiswa</th>
                                        <th class="text-start">Topik</th>
                                        <th class="text-start">Status</th>
                                        <th class="text-start">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 1; ?>
                                    <?php foreach ($absensi_bimbingan as $absensi) : ?>
                                        <tr>
                                            <th scope="row"><?= $i; ?></th>
                                            <td>
                                                <?php
                                                $bulanIndo = array(
                                                    'January' => 'Januari',
                                                    'February' => 'Februari',
                                                    'March' => 'Maret',
                                                    'April' => 'April',
                                                    'May' => 'Mei',
                                                    'June' => 'Juni',
                                                    'July' => 'Juli',
                                                    'August' => 'Agustus',
                                                    'September' => 'September',
                                                    'October' => 'Oktober',
                                                    'November' => 'November',
                                                    'December' => 'Desember'
                                                );
    
                                                $date = new DateTime($absensi['tgl_bimbingan']);
                                                $bulan = $date->format('F');
                                                $tanggal = $date->format('d');
                                                $tahun = $date->format('Y');
    
                                                echo $tanggal . ' ' . $bulanIndo[$bulan] . ' ' . $tahun; // Output: 15 Juli 2024
                                                ?><br>
                                                <span>
                                                    <i class="ti ti-clock"></i>
                                                    <?= substr($absensi['waktu'], 0, 5); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= $absensi['nama_mahasiswa']; ?><br>
                                                <small><?= $absensi['mahasiswa_npm']; ?></small>
                                            </td>
                                            <td><?= $absensi['topik']; ?></td>
                                            <td>
                                                <?php if ($absensi['is_confirmed'] == 'pending') : ?> 
                                                    <?php $color = 'warning'; ?>
                                                    <small class="badge text-bg-<?= $color; ?>">
                                                        Belum Dikonfirmasi
                                                    </small>
                                                <?php elseif ($absensi['is_confirmed'] == 'confirmed') : ?>
                                                    <?php $color = 'success'; ?>
                                                    <small class="badge text-bg-<?= $color; ?>">
                                                        Terkonfirmasi
                                                    </small>
                                                <?php elseif ($absensi['is_confirmed'] == 'rejected') : ?>
                                                    <?php $color = 'danger'; ?>
                                                    <small class="badge text-bg-<?= $color; ?>">
                                                        Ditolak
                                                    </small>
                                                <?php else : ?>
                                                    <?php $color = 'secondary'; ?>
                                                    <small class="badge text-bg-<?= $color; ?>">
                                                        Tidak Dikenal
                                                    </small>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small>
                                                    <a href="detail_absensi/<?= $absensi['id']; ?>" class="btn btn-outline-primary mb-2">
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
                                        <th class="text-start">Tanggal Bimbingan</th>
                                        <th class="text-start">Mahasiswa</th>
                                        <th class="text-start">Topik</th>
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
