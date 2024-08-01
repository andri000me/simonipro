  <script src="<?= base_url('assets'); ?>/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url('assets'); ?>/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets'); ?>/js/sidebarmenu.js"></script>
  <script src="<?= base_url('assets'); ?>/js/app.min.js"></script>
  <script src="<?= base_url('assets'); ?>/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="<?= base_url('assets'); ?>/libs/simplebar/dist/simplebar.js"></script>
  <!-- <script src="<?= base_url('assets'); ?>/js/dashboard.js"></script> -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
        var breakup = {
            series: [
                <?= round($percent_siap_sidang, 2); ?>,
                <?= round($percent_rekomendasi, 2); ?>,
                <?= round($percent_belum_terpenuhi, 2); ?>
            ],
            labels: ['Siap Sidang', 'Rekomendasi', 'Belum Terpenuhi'],
            chart: {
                width: 180,
                type: "donut",
                fontFamily: "Plus Jakarta Sans', sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return val + "%"; // Format data label as percentage
                }
            },
            legend: {
                show: false,
            },
            colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],
            responsive: [
                {
                    breakpoint: 991,
                    options: {
                        chart: {
                            width: 150,
                        },
                    },
                },
            ],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        var chartElement = document.querySelector("#breakup");
        if (chartElement) {
            var chart = new ApexCharts(chartElement, breakup);
            chart.render();
        } else {
            console.error("Element with ID 'breakup' not found.");
        }
    });
</script>

    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- using sweet alert -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const logoutLink = document.querySelector('.sidebar-link[href="<?= base_url('auth/logout'); ?>"]');
            if (logoutLink) {
                logoutLink.addEventListener('click', function(event) {
                    event.preventDefault(); // Mencegah link dari tindakan default

                    Swal.fire({
                        title: "Apakah Anda yakin?",
                        text: "Anda akan keluar dari akun ini!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Ya, keluar!",
                        cancelButtonText: "Batal"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "<?= base_url('auth/logout'); ?>"; // Mengarahkan ke URL logout jika dikonfirmasi
                        }
                    });
                });
            }
        });
    </script>


  <script>
    new DataTable('#myTable');

    $(document).ready(function() {
        $('[data-toggle="dropdown"]').dropdown();
    });

    document.getElementById('gambar').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('gambar-preview').src = e.target.result;
                document.getElementById('gambar-label').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    });

    // auto name fill
    document.getElementById('user_id').addEventListener('change', function() {
      var selectedOption = this.options[this.selectedIndex];
      var nama = selectedOption.getAttribute('data-nama');
      var npm = selectedOption.getAttribute('data-npm');
      document.getElementById('nama').value = nama;
      document.getElementById('npm').value = npm;
    });

    // memunculkan field plotting penguji when user pick jenis plotting as penguji
    function togglePengujiFields() {
    var jenisPlotting = document.getElementById('jenis_plotting_id').value;
    var dosenPenguji1Field = document.getElementById('dosenPenguji1Field');
    var dosenPenguji2Field = document.getElementById('dosenPenguji2Field');
    
    // Ganti '2' dengan ID sebenarnya dari opsi 'Penguji'
    if (jenisPlotting == '2') {
      dosenPenguji1Field.style.display = 'block';
      dosenPenguji2Field.style.display = 'block';
    } else {
      dosenPenguji1Field.style.display = 'none';
      dosenPenguji2Field.style.display = 'none';
    }
  }

  // Panggil fungsi ini saat halaman dimuat untuk menyembunyikan field penguji jika default jenis plotting bukan penguji
  document.addEventListener('DOMContentLoaded', togglePengujiFields);
  </script>

    <!-- catatan penolakan -->
     <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');
            const catatanPenolakanField = document.getElementById('catatan_penolakan').closest('.mb-3');

            // Awalnya sembunyikan field catatan penolakan
            if (statusSelect.value !== 'rejected') {
                catatanPenolakanField.style.display = 'none';
            }

            statusSelect.addEventListener('change', function() {
                if (this.value === 'rejected') {
                    catatanPenolakanField.style.display = 'block';
                } else {
                    catatanPenolakanField.style.display = 'none';
                }
            });
        });
     </script>

    <script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>
    
</body>

</html>