
<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
  <div class="container">

	<div class="d-flex justify-content-between align-items-center">
	  <h2>Error 404</h2>
	  <ol>
		<li><a href="<?= base_url(); ?>">Home</a></li>
		<li>Error 404</li>
	  </ol>
	</div>

  </div>
</section><!-- End Breadcrumbs Section -->

<section class="inner-page">
  <div class="container">
  <div class="section-title" data-aos="fade-up">
          <h2>404</h2>
          <p>Error 404</p>
        </div>
	<p>
	  Maaf halaman "<b><?= $this->uri->segment(1) ?></b>" tidak di temukan.
	</p>
  </div>
</section>