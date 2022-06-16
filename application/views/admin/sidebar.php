<?php 
$admin = $this->db->get_where('admin', ['email' => $this->session->userdata('email')])->row_array(); 
$this->db->where('level =', '0');
$notif_order = $this->db->get_where('orderan', ['status' => 'Pending'])->num_rows();
$this->db->where('level !=', '0');
$notif_agen = $this->db->get_where('orderan', ['status' => 'Pending'])->num_rows();
$notif_kontak = $this->db->get_where('kontak', ['status' => 'Pending'])->num_rows();
$notif_point = $this->db->get_where('klaim_point', ['status' => 'Pending'])->num_rows();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin'); ?>" class="brand-link">
        <img src="<?= base_url('assets/adminlte/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $web['nama'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/'); ?>img/admin/<?= $admin['img'] ?>" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('admin/akun'); ?>" class="d-block"><?= $admin['nama'] ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('admin'); ?>"
                        class="nav-link <?php if($title == 'Dashboard') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Order Masuk' || $title == 'Data Order') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Data Order
                            <i class="fas fa-angle-left right"></i>

                            <?php if($notif_order == TRUE) : ?>
                                <span class="badge badge-danger right">New</span>
                            <?php endif ?>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/order_masuk'); ?>" class="nav-link <?php if($title == 'Order Masuk') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Masuk</p>

                                <?php if($notif_order == TRUE) : ?>
                                    <span class="badge badge-danger right"><?= $notif_order ?></span>
                                <?php endif ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/data_order'); ?>" class="nav-link <?php if($title == 'Data Order') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Order</p>
                            </a>
                        </li>

                    </ul>
                </li>

                
                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Data Order Keagenan' || $title == 'Orderan Baru Keagenan') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Orderan Agen
                            <i class="right fas fa-angle-left"></i> 

                            <?php if($notif_agen == TRUE) : ?>
                                <span class="badge badge-danger right">New</span>
                            <?php endif ?>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/order_masuk_keagenan'); ?>" class="nav-link <?php if($title == 'Orderan Baru Keagenan') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Order Masuk Agen</p>
                                
                                <?php if($notif_agen == TRUE) : ?>
                                    <span class="badge badge-danger right"><?= $notif_agen ?></span>
                                <?php endif ?>

                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/data_order_keagenan'); ?>" class="nav-link <?php if($title == 'Data Order Keagenan') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Order Agen</p>
                            </a>
                        </li>
                    </ul>
                </li>

                
                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Data Point' || $title == 'Data Klaim') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Reward Point
                            <i class="right fas fa-angle-left"></i> 

                            <?php if($notif_point == TRUE) : ?>
                                <span class="badge badge-danger right">New</span>
                            <?php endif ?>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/data_point'); ?>" class="nav-link <?php if($title == 'Data Point') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Point</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/data_klaim'); ?>" class="nav-link <?php if($title == 'Data Klaim') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Klaim</p>
                                               
                                <?php if($notif_point == TRUE) : ?>
                                    <span class="badge badge-danger right"><?= $notif_point ?></span>
                                <?php endif ?>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/setting_point'); ?>" class="nav-link <?php if($title == 'Setting Point') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Setting Point</p>
                            </a>
                        </li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Data Produk' || $title == 'Tambah Produk' || $title == 'Update Produk') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Produk
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/data_produk'); ?>" class="nav-link <?php if($title == 'Data Produk') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Produk</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('tambah/produk'); ?>" class="nav-link <?php if($title == 'Tambah Produk') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Produk</p>
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Data Keagenan' || $title == 'Tambah Keagenan') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Keagenan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/data_keagenan'); ?>" class="nav-link <?php if($title == 'Data Keagenan') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Keagenan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('tambah/keagenan'); ?>" class="nav-link <?php if($title == 'Tambah Keagenan') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Keagenan</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Paket Keagenan' || $title == 'Testimoni' || $title == 'Faq' || $title == 'Tambah Paket Keagenan' || $title == 'Edit Paket Keagenan') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-globe"></i>
                        <p>
                            Pages
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/paket_keagenan'); ?>" class="nav-link <?php if($title == 'Paket Keagenan') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Paket Keagenan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/testimoni'); ?>" class="nav-link <?php if($title == 'Testimoni') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Testimoni</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/faq'); ?>" class="nav-link <?php if($title == 'Faq') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Faq</p>
                            </a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('admin/data_users'); ?>"
                        class="nav-link <?php if($title == 'Data Users') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('admin/data_gallery'); ?>"
                        class="nav-link <?php if($title == 'Data Gallery') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-image"></i>
                        <p>
                            Gallery
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('admin/data_kontak'); ?>"
                        class="nav-link <?php if($title == 'Data Kontak') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-address-book"></i>
                        <p>
                            Kontak
                            <?php if($notif_kontak == TRUE) : ?>
                                <span class="badge badge-danger right"><?= $notif_kontak ?></span>
                            <?php endif ?>
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('admin/laporan'); ?>"
                        class="nav-link <?php if($title == 'Laporan') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="#"
                        class="nav-link <?php if($title == 'Website' || $title == 'Akun' || $title == 'Rekening' || $title == 'Email Sender') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= base_url('admin/website'); ?>" class="nav-link <?php if($title == 'Website') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>website</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/slideshow'); ?>" class="nav-link <?php if($title == 'Slideshow') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Slideshow</p>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a href="<?= base_url('admin/front_image'); ?>" class="nav-link <?php if($title == 'Front Image') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Front Image</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?= base_url('admin/rekening'); ?>" class="nav-link <?php if($title == 'Rekening') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Rekening Bank</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/email_sender'); ?>" class="nav-link <?php if($title == 'Email Sender') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Email Sender</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url('admin/akun'); ?>" class="nav-link <?php if($title == 'Akun') : ?>active<?php endif ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Akun</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="#" onclick="Logout();" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>