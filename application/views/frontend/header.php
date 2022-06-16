<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title><?= $web['title']; ?></title>
  <meta content="<?= $web['title']; ?>" name="description">
  <meta content="<?= $web['title']; ?>" name="keywords">
  <meta content="<?= $web['deskripsi']; ?>" name="description" />
  <meta content="Dahrey" name="author" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <meta name="theme-color" content="#007660">
  <meta name="msapplication-navbutton-color" content="#007660">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" charset="#007660">

  <!----------------------- Snipet Open graph Fcebook ---------------------->
  <meta property="og:title" content="<?= $web['title']; ?>" />
  <meta property="og:description" content="<?= $web['deskripsi']; ?>" />
  <meta property="og:image" content="<?= base_url('assets/img/' . $web['og']); ?>" />

  <!-- Favicons -->
  <link href="<?= base_url('assets/') ?>img/<?= $web['fav']; ?>" rel="icon">
  <link href="<?= base_url('assets/') ?>img/<?= $web['fav']; ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/') ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?= base_url('assets/') ?>vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?= base_url('assets/') ?>css/style.css" rel="stylesheet">
  <!-- jQuery library -->
  <script src="<?= base_url('assets/') ?>js/jquery-1.12.1.min.js"></script>

  <!-- Select2 CSS -->
  <link href="<?= base_url('assets/') ?>select2/dist/css/select2.min.css" rel="stylesheet" />
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="<?= base_url('assets/adminlte/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- =======================================================
  * Template Name: Bootslander - v2.3.1
  * Template URL: https://bootstrapmade.com/bootslander-free-bootstrap-landing-page-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style type="text/css">
        img[src=""] {
            display: none;
        }

        .ck-editor__editable_inline {
            min-height: 300px !important;
        }
    </style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center ">
    <div class="container d-flex align-items-center">

      <div class="logo mr-auto">
        <!--<h1 class="text-light"><a href="<?= base_url(); ?>"><span><?= $web['nama']; ?>.</span></a></h1>-->
        <!-- Uncomment below if you prefer to use an image logo -->
         <!--<a href="<?= base_url(); ?>"><img src="<?= base_url('assets/') ?>img/<?= $web['logo']; ?>" alt="" class="img-fluid"></a>-->
        <a href="<?= base_url('home'); ?>"><img style="max-height: 60px;width: 170px;margin-top: 10px;" src="<?= base_url('assets/') ?>img/<?= $web['logo']; ?>" alt="" class="img-fluid pb-3"></a>
      </div>

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?= base_url(); ?>">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#produk">Produk</a></li>
          <li><a href="#keagenan">Keagenan</a></li>
          <li><a href="#gallery">Gallery</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="<?= base_url('track_order'); ?>">Track Order</a></li>
          <li><a href="<?= base_url('auth'); ?>">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

    </div>
  </header><!-- End Header -->