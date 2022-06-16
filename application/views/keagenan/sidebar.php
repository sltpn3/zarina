<?php 
$user = $this->db->get_where('user', ['email' => 'contoh@gmail.com'])->row(); 
$this->db->where('iduser', $user->id);
$notif_order = $this->db->get_where('orderan', ['status' => 'Pending'])->num_rows();
?>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('keagenan'); ?>" class="brand-link">
        <img src="<?= base_url('assets/adminlte/'); ?>dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $web['nama'] ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 d-flex">
            <div class="info">
                <h5><a href="<?= base_url('keagenan/akun'); ?>" class="d-block font-weight-bold"><?= $user->nama ?></a></h5>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="<?= base_url('keagenan'); ?>"
                        class="nav-link <?php if($title == 'Dashboard') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('keagenan/repeat_order'); ?>"
                        class="nav-link <?php if($title == 'Repeat Order') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Repeat Order
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('keagenan/data_order'); ?>"
                        class="nav-link <?php if($title == 'Data Order' || $title == 'Detail Order') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-shopping-bag"></i>
                        <p>
                            Data Order

                            <?php if($notif_order == TRUE) : ?>
                                    <span class="badge badge-danger right"><?= $notif_order ?></span>
                            <?php endif ?>

                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('keagenan/reward_point'); ?>"
                        class="nav-link <?php if($title == 'Reward Point') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-coins"></i>
                        <p>
                            Reward Point
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('keagenan/laporan'); ?>"
                        class="nav-link <?php if($title == 'Laporan') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('keagenan/akun'); ?>"
                        class="nav-link <?php if($title == 'Akun') : ?>active<?php endif ?>">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Akun
                        </p>
                    </a>
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