
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
    var dosenPembimbingField = document.getElementById('dosen_pembimbing_id');
    var dosenPenguji1Field = document.getElementById('dosenPenguji1Field');
    var dosenPenguji2Field = document.getElementById('dosenPenguji2Field');
    
    // Ganti '2' dengan ID sebenarnya dari opsi 'Penguji'
    if (jenisPlotting == '2') {
      dosenPenguji1Field.style.display = 'block';
      dosenPenguji2Field.style.display = 'block';
      dosenPembimbingField.disabled = true;
    } else {
      dosenPenguji1Field.style.display = 'none';
      dosenPenguji2Field.style.display = 'none';
      dosenPembimbingField.disabled = false;
    }
  }

  // Panggil fungsi ini saat halaman dimuat untuk menyembunyikan field penguji jika default jenis plotting bukan penguji
  document.addEventListener('DOMContentLoaded', togglePengujiFields);
  </script>
</body>

</html>