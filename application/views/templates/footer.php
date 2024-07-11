
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
      var eventListEl = document.getElementById('event-list');
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
          events: []
      });
      calendar.render();

      // Tangkap data dari modal ketika formulir disubmit
      $('#myForm').on('submit', function(event) {
          event.preventDefault(); // Mencegah reload halaman
          var title = $('#event-title').val();
          var startDate = $('#start-date').val();
          var endDate = $('#end-date').val();
          var color = $('#event-color').val();

          if (endDate && new Date(endDate) <= new Date(startDate)) {
              $('#danger-alert').show();
              return;
          } else {
              $('#danger-alert').hide();
          }

          // Tambahkan acara ke kalender
          var newEvent = {
              title: title,
              start: startDate,
              end: endDate ? new Date(new Date(endDate).setDate(new Date(endDate).getDate() + 1)).toISOString().slice(0, 10) : null, // end date harus eksklusif
              color: color // Gunakan warna yang dipilih
          };
          calendar.addEvent(newEvent);

          // Tambahkan acara ke daftar event
          var eventHTML = `
              <div class="alert alert-primary w-100 d-flex justify-content-between align-items-center" data-event='${JSON.stringify(newEvent)}'>
                  <span>${title}</span>
                  <small><button class="btn btn-info" data-event='${JSON.stringify(newEvent)}'>Detail</button></small>
              </div>
          `;
          eventListEl.insertAdjacentHTML('beforeend', eventHTML);

          // Sembunyikan modal
          $('#form').modal('hide');
      });

      // Tangani klik tombol detail di daftar event
      $(document).on('click', '.btn-info', function() {
          var eventData = $(this).closest('.alert').data('event');
          document.getElementById('event-detail-title').textContent = eventData.title;
          document.getElementById('event-detail-dates').textContent = `Dari: ${eventData.start} ${eventData.end ? `s/d ${eventData.end}` : ''}`;
          document.getElementById('event-detail-color').textContent = `Warna: ${eventData.color}`;
          $('#event-detail-modal').modal('show');
      });

      // Tangani klik tombol "Tambah Acara"
      document.getElementById('add-event-button').addEventListener('click', function() {
          $('#form').modal('show');
      });
  });
  </script>
</body>

</html>