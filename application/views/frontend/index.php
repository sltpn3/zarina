
  <!-- ======= Hero Section ======= -->
<style>
.mySlides {display:none;}
.bungkus{
  /*z-index: 0;*/
  /*background: #009f7f;*/
  width: 100%;
  /*height: 500px; */
  overflow: hidden;
  padding-top: 80px;
}
.bungkus img{
  width: 100%;
  /*background-size: contain;*/
  object-fit: cover;
}
#hero:before {
  background: #ddd !important;
}
#hero {
    width: 100%;
    background: url(../img/hero-bg.jpg);
    position: relative;
    padding: 150px 0 0 0;
}
.tulisan{
  position: absolute;
  top: 170px;
  left: 100px;
  width: 90%;
  margin: 0 auto;
}
.tulisan h1{
  color: #fff;
}
.tulisan h2{
  color: #fff;
}
.btn-slide{
  background: #1acc8d;
  color: #fff;
  padding: 20px 40px;
  border-radius: 40px;
  /*margin-top: 20px;*/
}
.btn-slide:hover{
  background: #17b57f;
  color: #fff;
}
@media only screen and (max-width: 1000px) {
  .bungkus{
    /*height: 400px; */
    padding-top: 64px;
  }
  .tulisan{
    position: absolute;
    top: 150px;
    left: 20px;
    width: 90%;
    margin: 0 auto;
  }
}

@media only screen and (max-width: 500px) {
  .bungkus{
    /*height: 300px; */
  }
  .tulisan{
    position: absolute;
    top: 150px;
    left: 20px;
    width: 90%;
    margin: 0 auto;
  }
}


</style>
  
<div class="bungkus" >
  <?php 
    if(!empty($slideshow)){
   ?>
  <?php foreach ($slideshow as $d) : ?>
  <img class="mySlides" src="<?= base_url('assets/') ?>img/slideshow/<?= $d['img'] ?>">
  <?php endforeach  ?>
  <?php 
    }else{

    }
   ?>
</div>
<!-- <section id="hero">

    <div class="container">
      <div class="row">
        <div class="col-lg-12 pt-5 pt-lg-0 order-2 order-lg-1 d-flex align-items-center">
          <div data-aos="zoom-out">
            <h1><?= $web['title']; ?></h1>
            <h2><?= $web['short_desk']; ?></h2>
            <div class="text-center text-lg-left">
              <a href="#keagenan" class="btn-get-started scrollto">Daftar Sekarang</a>
            </div>
          </div>
        </div>
      </div>
    </div>


  </section> -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 d-flex " data-aos="fade-right">
            <!-- <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a> -->
            <!-- front image 1 -->
            <img src="<?= base_url('assets/') ?>img/front/<?= $front_1['img'] ?>" class="img-fluid" alt="">
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5" data-aos="fade-left">
            
            <?= $front_1['text'] ?>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Counts Section ======= -->
    <section id="counts" class="counts">
      <div class="container">

        <div class="row" data-aos="fade-up">

          <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="count-box">
              <i class="icofont-users-social"></i>
              <span data-toggle="counter-up"><?= $sum_user ?></span>
              <p>Member</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 mt-5 mt-md-0">
            <div class="count-box">
              <i class="icofont-users-alt-2"></i>
              <span data-toggle="counter-up"><?= $sum_reseller ?></span>
              <p>Reseller</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="icofont-ui-home"></i>
              <span data-toggle="counter-up"><?= $sum_agen ?></span>
              <p>Agen</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 col-sm-6 mt-5 mt-lg-0">
            <div class="count-box">
              <i class="icofont-bank-alt"></i>
              <span data-toggle="counter-up"><?= $sum_stokis ?></span>
              <p>Stokis</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Counts Section -->

    
    <!-- ======= Produk Section ======= -->
    <section id="produk" class="team">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Produk</h2>
          <p>Produk <?= $web['nama']; ?></p>
        </div>

        <div class="row" data-aos="fade-left">

        <?php foreach ($produk as $d) : ?>

          <div class="col-lg-3 col-md-6 mb-3">
            <div class="member" data-aos="zoom-in" data-aos-delay="100">
              <div class="pic"><img style="height: 250px;width: 450px;" src="<?= base_url('assets/') ?>img/produk/<?= $d['img'] ?>" class="img-thumbnail" alt=""></div>
              <div class="member-info">
                <a href="<?= base_url('produk/' . $d['slug']) ?>"><h4><?= $d['nama'] ?></h4></a>
                <span style="padding: 7px 20px;color:black;"><?= nl2br(substr($d['deskripsi'], 0, 70)); ?>...</span>
                <div class="social">
                  <a href="<?= base_url('produk/' . $d['slug']) ?>">Rp.<?= number_format($d['harga'], 0, ',', '.'); ?>,-</a>
                </div>
              </div>
            </div>
          </div>

          <?php endforeach ?>


        </div>

      </div>
    </section><!-- End Team Section -->

    <!-- ======= Details Section ======= -->
    <section id="details" class="details">
      <div class="container">

        <div class="row content">
          
          <div class="col-md-8 pt-4" data-aos="fade-up">
            <?= $front_2['text'] ?>
            <p>
              <!-- Voluptas nisi in quia excepturi nihil voluptas nam et ut. Expedita omnis eum consequatur non. Sed in asperiores aut repellendus. Error quisquam ab maiores. Quibusdam sit in officia -->
            </p>
          </div>
          <div class="col-md-4" data-aos="fade-right">
            <!-- front image 2 -->
            <img src="<?= base_url('assets/') ?>img/front/<?= $front_2['img'] ?>" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Pricing Section ======= -->
    <section id="keagenan" class="pricing">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Keagenan</h2>
          <p>Paket Keagenan</p>
        </div>

        <div class="row" data-aos="fade-left">

        <?php foreach ($keagenan as $d) : ?>
          <?php $dd = $this->db->get_where('paket_agen', ['fk_agen' => $d['fk']])->row_array(); ?> 
          <?php $this->db->select_max('harga');
                $get_max = $this->db->get_where('harga_paket', ['fk_agen' => $d['fk'], 'id_produk' => $dd['id_produk']])->row(); ?>

          <div class="col-lg-4 col-md-6 mt-4 mt-md-0 mb-3">
            <div class="box" data-aos="zoom-in" data-aos-delay="200">
              <?php if($d['promo'] == 'on') : ?>
            <span class="advanced">Promo</span>
            <?php endif ?>
              <h3><?= $d['nama'] ?></h3>
              <h4><sup>Rp</sup><?= substr($get_max->harga, 0, 3); ?>K<span> / paket</span></h4>
              <?= $d['deskripsi'] ?>
              <div class="btn-wrap">
                <a href="<?= base_url('paket_keagenan/' . $d['slug']) ?>" class="btn-buy">Order Paket</a>
              </div>
            </div>
          </div>

          <?php endforeach ?>


        </div>

      </div>
    </section><!-- End Pricing Section -->

       

      </div>
    </section><!-- End Details Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Gallery</h2>
          <p><?= $web['nama']; ?> Gallery</p>
        </div>

        <div class="row no-gutters" data-aos="fade-left">

        <?php foreach($gallery as $d) : ?>

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item" data-aos="zoom-in" data-aos-delay="100">
              <a href="<?= base_url('assets/') ?>img/gallery/<?= $d['img'] ?>" class="venobox" data-gall="gallery-item">
                <img src="<?= base_url('assets/') ?>img/gallery/<?= $d['img'] ?>" alt="<?= $d['nama'] ?>" class="img-fluid">
              </a>
            </div>
          </div>
          
        <?php endforeach ?>


        </div>

      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
      <div class="container">

        <div class="owl-carousel testimonials-carousel" data-aos="zoom-in">

        <?php foreach ($testi as $d) : ?>

          <div class="testimonial-item">
            <img src="<?= base_url('assets/') ?>img/testimoni/<?= $d['img'] ?>" class="testimonial-img" alt="">
            <h3><?= $d['nama'] ?></h3>
            <h4><?= $d['job'] ?></h4>
            <p>
              <i class="bx bxs-quote-alt-left quote-icon-left"></i>
              <?= $d['testi'] ?>
              <i class="bx bxs-quote-alt-right quote-icon-right"></i>
            </p>
          </div>

          <?php endforeach ?>

        </div>

      </div>
    </section><!-- End Testimonials Section -->

    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>F.A.Q</h2>
          <p>Pertanyaan Umum</p>
        </div>

        <div class="faq-list">
          <ul>

          <?php foreach ($faq as $d) : ?>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-<?= $d['role'] ?>"><?= $d['pertanyaan'] ?> <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-<?= $d['role'] ?>" class="collapse" data-parent=".faq-list">
                <p>
                <?= $d['jawaban'] ?>
                </p>
              </div>
            </li>
            <?php endforeach ?>

          </ul>
        </div>

      </div>
    </section><!-- End F.A.Q Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>Contact</h2>
          <p>Contact Us</p>
        </div>

        <div class="row">

          <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
            <div class="info">
              <div class="address">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p><?= $web['alamat']; ?></p>
              </div>

              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><?= $web['email']; ?></p>
              </div>

              <div class="phone">
                <i class="icofont-whatsapp"></i>
                <h4>WhatsApp:</h4>
                <a target="_blank" href="https://wa.me/62<?= $web['telp']; ?>">
                <p><?= $web['telp']; ?></p>
                </a>
              </div>

              <div class="phone">
                <i class="icofont-clock-time"></i>
                <h4>Jam Kerja</h4>
                <p><?= $web['jam']; ?></p>
                </a>
              </div>
  
            <div class="social-links mt-5">
                <a target="_blank" href="<?= $web['tw']; ?>" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a target="_blank" href="<?= $web['fb']; ?>" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a target="_blank" href="<?= $web['ig']; ?>" class="instagram"><i class="bx bxl-instagram"></i></a>
              </div>
              
            </div>

          </div>

          <div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">

            <form action="<?= base_url('home/kontak') ?>" method="post" role="form" class="php-email-form">
              <div class="form-row">
                <div class="col-md-6 form-group">
                  <input type="text" name="nama" class="form-control" id="name" placeholder="Nama" data-rule="minlen:4" data-msg="Harap masukkan setidaknya 4 karakter" />
                  <div class="validate"></div>
                </div>
                <div class="col-md-6 form-group">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Email" data-rule="email" data-msg="Tolong masukkan email yang benar" />
                  <div class="validate"></div>
                </div>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" name="subjek" id="subject" placeholder="Subjek" data-rule="minlen:5" data-msg="Silakan masukkan setidaknya 5 karakter subjek" />
                <div class="validate"></div>
              </div>
              <div class="form-group">
                <textarea class="form-control" name="pesan" rows="5" data-rule="required" data-msg="Tolong tuliskan sesuatu untuk kami" placeholder="Pesan yang di sampaikan"></textarea>
                <div class="validate"></div>
              </div>
              <div class="mb-3">
                <div class="loading">Loading...</div>
                <div class="sent-message"><strong>Terimakasih!</strong> Pesan kamu berhasil di kirim.</div>
                <div class="error-message">Maaf pesan gagal di kirim.</div>
              </div>
              <div class="text-center"><button type="submit">Kirim Pesan</button></div>
            </form>

          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->
<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 3000); // Change image every 3 seconds
}
</script>