
  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Menu</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#about">About</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#details">Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#testimonials">Testimoni</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#faq">Pertanyaan umum</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="#keagenan">Keagenan</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#gallery">Gallery</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#produk">Produk</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#contact">Contact</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="<?= base_url('track_order'); ?>">Track Order</a></li>
            </ul>
          </div>

          <div class="col-lg-6 col-md-6 footer-newsletter">
            <h4>Lokasi G-Maps</h4>
            <?= $web['maps']; ?>

          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span><?= $web['nama']; ?></span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>
  <div id="preloader"></div>

  

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.mask.js"></script>
<!-- Select2 JS -->
<script src="<?= base_url('assets/') ?>select2/dist/js/select2.min.js"></script>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/php-email-form/validate.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/venobox/venobox.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/counterup/counterup.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url('assets/') ?>vendor/aos/aos.js"></script>
  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/') ?>js/main.js"></script>

  <!-- SweetAlert2 -->
  <script src="<?= base_url('assets/adminlte/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>

<?php if($this->session->flashdata('message') == 'order'): ?>
<script type="text/javascript">
    Swal.fire({
        confirmButtonText: "Oke!",
        icon: "success",
        title: "Berhasil!",
        text: "Kamu berhasil membuat pesanan, Tunggu konfirmasi dari admin."
        });
</script>
<?php endif ?>
<?php if($this->session->flashdata('message') == 'gagal_order'): ?>
<script>
Swal.fire({
  confirmButtonText: "Oke!",
  icon: "error",
  title: "Gagal!",
  text: "Gambar tidak mendukung."})
</script>
<?php endif ?>
</body>

</html>