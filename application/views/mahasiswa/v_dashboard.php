<div class="container-fluid">
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-8 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                        <div class="mb-3 mb-sm-0">
                            <h5 class="card-title fw-semibold">Kalender Proyek 2</h5>
                        </div>
                        <div>
                            <!-- Tombol "Tambah Acara" -->
                            <button type="button" class="btn btn-dark" id="add-event-button">Tambah Acara</button>
                        </div>
                    </div>
                    <!-- Kalender disini -->
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12">
                    <!-- List Event -->
                    <div class="card overflow-hidden">
                        <div class="card-body p-4">
                            <h5 class="card-title mb-3 fw-semibold">List Event</h5>
                            <div class="event-list" id="event-list">
                                <!-- Daftar event akan ditambahkan di sini -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <!-- Monthly Earnings -->
                    <div class="card">
                        <div class="card-body">
                            <div class="row align-items-start">
                                <div class="col-8">
                                    <h5 class="card-title mb-9 fw-semibold">Monthly Earnings</h5>
                                    <h4 class="fw-semibold mb-3">$6,820</h4>
                                    <div class="d-flex align-items-center pb-1">
                                        <span class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-arrow-down-right text-danger"></i>
                                        </span>
                                        <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                        <p class="fs-3 mb-0">last year</p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="d-flex justify-content-end">
                                        <div class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                            <i class="ti ti-currency-dollar fs-6"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="earning"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Programmed and Developed by <span class="text-muted fw-semibold">Muhamad Ridwan</span><br> Source of Template from <a href="https://themewagon.com">ThemeWagon</a></p>
    </div>
</div>

<!-- Modal untuk menambahkan acara -->
<div class="modal fade" id="form" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="formModalLabel">Tambah Acara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="myForm">
                <div class="modal-body">
                    <div class="alert alert-danger" role="alert" id="danger-alert" style="display: none;">
                        Tanggal akhir harus lebih besar dari tanggal awal.
                    </div>
                    <div class="form-group mb-3">
                        <label for="event-title">Nama Acara <span class="text-danger">*</span></label>
                        <input type="text" class="form-control mt-1" id="event-title" placeholder="Masukkan nama acara" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="start-date">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" class="form-control mt-1" id="start-date" placeholder="Tanggal mulai" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="end-date">Tanggal Akhir - <small class="text-muted">Opsional</small></label>
                        <input type="date" class="form-control mt-1" id="end-date" placeholder="Tanggal akhir">
                    </div>
                    <div class="form-group mb-3">
                        <label for="event-color">Warna</label>
                        <input type="color" class="form-control mt-1" id="event-color" value="#3788d8">
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success" id="submit-button">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal untuk detail acara -->
<div class="modal fade" id="event-detail-modal" tabindex="-1" aria-labelledby="eventDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="eventDetailModalLabel">Detail Acara</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="event-detail-title"></h5>
                <p id="event-detail-dates"></p>
                <p id="event-detail-color"></p>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
