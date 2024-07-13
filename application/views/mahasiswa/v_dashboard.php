<style>
    iconify-icon {
        color: #d9d9d9;
    }
    .card .icon-container {
        font-size: 2.65rem;
    }
    .card .fw-bolder {
        font-size: 0.595rem;
    }
    .card .total-value {
        font-size: 1.25rem;
    }

    /* Media queries for responsive design */
    @media (max-width: 1200px) {
        .card .icon-container {
            font-size: 2.5rem;
        }
        .card .fw-bolder {
            font-size: 0.7rem;
        }
        .card .total-value {
            font-size: 1.15rem;
        }
    }

    @media (max-width: 992px) {
        .card .icon-container {
            font-size: 2.2rem;
        }
        .card .fw-bolder {
            font-size: 0.75rem;
        }
        .card .total-value {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 768px) {
        .card .icon-container {
            font-size: 2rem;
        }
        .card .fw-bolder {
            font-size: 0.8rem;
        }
        .card .total-value {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .card .icon-container {
            font-size: 1.8rem;
        }
        .card .fw-bolder {
            font-size: 0.75rem;
        }
        .card .total-value {
            font-size: 0.9rem;
        }
        .card .card-body {
            padding: 1rem;
        }
    }
</style>

<div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-danger rounded start">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:clipboard" width="2.65rem"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-8 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">65</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-primary rounded start">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:users" width="2.65rem"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-8 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">9</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-warning rounded start">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:github" width="2.65rem"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-8 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">22</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12">
                <div class="card w-100">
                    <div class="card-body border-start border-4 border-success rounded start">
                        <div class="row">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <span>
                                    <iconify-icon icon="lucide:plane" width="2.65rem"></iconify-icon>
                                </span>
                            </div>
                            <div class="col-8 text-start">
                                <span class="fw-bolder text-uppercase" style="font-size: 0.595rem;">Total Bimbingan</span>
                                <span class="d-block fw-bolder" style="font-size: 1.25rem;">12</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>