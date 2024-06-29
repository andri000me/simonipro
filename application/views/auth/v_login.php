
  <!--  Body Wrapper -->
  <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div
      class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
      <div class="d-flex align-items-center justify-content-center w-100">
        <div class="row justify-content-center w-100">
          <div class="col-md-8 col-lg-6 col-xxl-3">
            <div class="card mb-0">
              <div class="card-body">
                <a href="<?= base_url('auth'); ?>" class="text-nowrap logo-img text-center d-block py-3 w-100">
                  <img src="<?= base_url('assets'); ?>/images/logos/logo-simonipro.svg" width="180" alt="">
                </a>
                <p class="text-center">Sistem Informasi Monitoring Proyek</p>

                <!-- alert pesan -->
                <?php if ( $this->session->flashdata('pesan') ) : ?>
                    <div class="alert alert-success"><?= $this->session->flashdata('pesan'); ?></div>
                <?php endif; ?>
                <?php if ( $this->session->flashdata('error') ) : ?>
                    <div class="alert alert-danger"><?= $this->session->flashdata('error'); ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['alert']) == 'logout') : ?>
                  <div class="alert alert-success">Berhasil logout.</div>
                <?php endif; ?>

                <form action="<?= base_url('auth'); ?>" method="POST">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" autofocus>
                    <?= form_error('username', '<small class="text-danger fst-italic">', '</small>'); ?>
                  </div>
                  <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                    <?= form_error('password', '<small class="text-danger fst-italic">', '</small>'); ?>
                  </div>
                  <div class="d-flex align-items-center justify-content-end mb-4">
                    <a class="text-primary fw-bold" href="#">Lupa password ?</a>
                  </div>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Login</button>
                  <!-- <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Belum punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="<?= base_url('auth/register'); ?>">Daftar</a>
                  </div> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>