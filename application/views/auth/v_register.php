
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
                <p class="text-center text-capitalize">Silahkan daftarkan akun Anda</p>
                <form action="<?= base_url('auth/register'); ?>" method="POST">
                  <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" autofocus>
                    <?= form_error('nama', '<small class="text-danger fst-italic">', '</small>'); ?>
                  </div>
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" autofocus>
                    <?= form_error('username', '<small class="text-danger fst-italic">', '</small>'); ?>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                        <div class="mb-4">
                          <label for="password1" class="form-label">Password</label>
                          <input type="password" class="form-control" id="password1" name="password1">
                          <?= form_error('password1', '<small class="text-danger fst-italic">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-4">
                          <label for="password2" class="form-label">Konfirmasi password</label>
                          <input type="password" class="form-control" id="password2" name="password2">
                        </div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <label for="role" class="form-label d-block">Daftar Sebagai</label>
                    <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="role_id" id="role" value="1" checked>
                        <label class="form-check-label" for="role">
                                Admin
                        </label>
                    </div>
                    <!-- <div class="form-check d-inline-block me-3">
                        <input class="form-check-input" type="radio" name="exampleRadios" id="role" value="option1">
                        <label class="form-check-label" for="role">
                                Koordinator
                        </label>
                    </div> -->
                  </div>
                  <button class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Daftar</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Sudah punya akun?</p>
                    <a class="text-primary fw-bold ms-2" href="<?= base_url('auth'); ?>">Login</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>