<div class="container-fluid">
    <!-- <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1> -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header">
                    Detail Jadwal
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Nama Jadwal</th>
                            <td><?= $jadwal['nama_jadwal']; ?></td>
                        </tr>
                        <tr>
                            <th>Dibuat pada</th>
                            <td><?= date('d-M-Y', $jadwal['created_at']); ?></td>
                        </tr>
                        <tr>
                            <th>Diupdate pada</th>
                            <td><?= date('d-M-Y', $jadwal['updated_at']); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <?php $color = ($jadwal['status'] == 'draft') ? 'warning' : 'success'; ?>
                                <span class="badge text-bg-<?= $color; ?>">
                                    <?= $jadwal['status']; ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                    
                    <h5 class="mt-4">Daftar Kegiatan</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>Nama Kegiatan</th>
                                <th>Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($kegiatan)) : ?>
                                <?php $i = 1; ?>
                                <?php foreach ($kegiatan as $k) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= date('d-M-Y', strtotime($k['tgl_awal'])); ?></td>
                                        <td><?= date('d-M-Y', strtotime($k['tgl_selesai'])); ?></td>
                                        <td><?= $k['nama_kegiatan']; ?></td>
                                        <td><?= html_entity_decode($k['deskripsi'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada kegiatan</td> <!-- Mengubah colspan menjadi 5 -->
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                    <a href="<?= base_url('koordinator/kelola_jadwal'); ?>" class="btn btn-primary">Kembali</a>
                    <?php ( $jadwal['status'] == 'published' ) ? $secondary = 'outline-dark border-0 disabled': $secondary = 'success' ?>
                    <a href="<?= base_url('koordinator/do_publish_jadwal/') . $jadwal['id']; ?>" class="btn btn-<?= $secondary ?>" onclick="return confirm('Publikasikan jadwal ?')">
                        <span>
                            <?php ($jadwal['status'] == 'published') ? $icon = 'check' : $icon = 'upload' ?>
                                <i class="ti ti-<?= $icon; ?>"></i>
                            <?php ($jadwal['status'] == 'published') ? $str = 'published' : $str = 'publish' ?>
                        </span>
                        <?= $str; ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>