<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Points</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Points</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Points</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>No Telp</th>
                                        <th>Kota</th>
                                        <th>Level</th>
                                        <th>Points</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php $no=1; foreach($user as $d) : ?>
                                <?php $kota = $this->db->get_where('kabupaten', ['id_kab' => $d['kab']])->row_array(); ?>    
                                <?php $level = $this->db->get_where('keagenan', ['id' => $d['level']])->row_array(); 
                                if(empty($level)){
                                    $lev = 'User';
                                }else{
                                    $lev = $level['nama'];
                                }

                                if ($d['status'] == 'on') {
                                    $label1 = "btn-success";
                                }else{
                                    $label1 = "btn-danger";
                                }

                                if ($d['level'] == 4) {
                                    $label = "btn-warning";
                                } else if ($d['level'] == 3) {
                                    $label = "btn-primary";
                                } else if ($d['level'] == 2) {
                                    $label = "btn-info";
                                } else if ($d['level'] == 1) {
                                    $label = "btn-success";
                                } else if ($d['level'] == 0) {
                                    $label = "btn-secondary";
                                } ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $d['nama'] ?></td>
                                        <td><?= $d['email'] ?></td>
                                        <td><?= $d['no_hp'] ?></td>
                                        <td><?= $kota['nama_kab'] ?></td>
                                        <td><button class="btn btn-xs <?= $label ?> disabled"><?= $lev ?></button></td>
                                        <td><?= $d['point'] ?></td>
                                    </tr>
                                   <?php $no++; endforeach ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
    </section>
</div>