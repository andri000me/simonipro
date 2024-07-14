
  <script src="<?= base_url('assets'); ?>/libs/jquery/dist/jquery.min.js"></script>
  <script src="<?= base_url('assets'); ?>/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets'); ?>/js/sidebarmenu.js"></script>
  <script src="<?= base_url('assets'); ?>/js/app.min.js"></script>
  <script src="<?= base_url('assets'); ?>/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="<?= base_url('assets'); ?>/libs/simplebar/dist/simplebar.js"></script>
  <script src="<?= base_url('assets'); ?>/js/dashboard.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.js"></script>
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


    <!-- kalender -->
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var events = <?= json_encode($events) ?>; // Pastikan $events didefinisikan di PHP
        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid' ],
            initialView: 'dayGridMonth',
            locale: 'id', // Bahasa Indonesia
            dateClick: function(info) {
                // Atur tanggal mulai dan akhir ketika mengklik tanggal di kalender
                document.getElementById('start-date').value = info.dateStr;
                document.getElementById('end-date').value = info.dateStr;
                $('#form').modal('show'); // Tampilkan modal
            },
            events: [],
                eventDidMount: function(info) {
                var today = new Date().toISOString().split('T')[0];

                if (info.event.extendedProps.start < today) {
                    info.el.classList.add('past-event');
                } else if (info.event.extendedProps.start > today) {
                    info.el.classList.add('upcoming-event');
                }
            },
                eventContent: function(arg) {
                return { html: `<div class="event-title">${arg.event.title}</div>` };
            }
        });
        calendar.render();
        });
    </script>
</body>

</html>