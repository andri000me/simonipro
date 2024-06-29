
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
  </script>
</body>

</html>