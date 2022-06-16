<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orderan Baru Keagenan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Orderan Baru Keagenan</li>
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
                            <h3 class="card-title">Orderan Baru Keagenan</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Telepon</th>
                                        <th>Kota</th>
                                        <th>Level</th>
                                        <th>Tanggal Order</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php $no=1; foreach($agen as $d) : ?>
                                <?php $user =  $this->db->get_where('user', ['id' => $d['iduser']])->row_array(); ?>
                                <?php $kota = $this->db->get_where('kabupaten', ['id_kab' => $user['kab']])->row_array(); ?>    
                                <?php $order = $this->db->get_where('orderan', ['idorder' => $d['idorder']])->row_array(); ?> 
                                <?php $level = $this->db->get_where('keagenan', ['id' => $user['level']])->row_array(); ?> 
                                <?php
                                if(empty($level)){
                                    $lev = 'User';
                                }else{
                                    $lev = $level['nama'];
                                }
                                if ($user['level'] == 4) {
                                    $label = "btn-warning";
                                } else if ($user['level'] == 3) {
                                    $label = "btn-primary";
                                } else if ($user['level'] == 2) {
                                    $label = "btn-info";
                                } else if ($user['level'] == 1) {
                                    $label = "btn-success";
                                } else if ($user['level'] == 0) {
                                    $label = "btn-secondary";
                                } 
                                  if($order['status'] == 'Pending'){
                                    $status = 'btn-warning';
                                  }else if($order['status'] == 'Selesai'){
                                    $status = 'btn-success';
                                  }else if($order['status'] == 'Canceled'){
                                    $status = 'btn-danger';
                                  }
                                ?>
                                
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $user['nama'] ?></td>
                                        <td><?= $user['no_hp'] ?></td>
                                        <td><?= $kota['nama_kab'] ?></td>
                                        <td><button class="btn btn-xs <?= $label ?> disabled"><?= $lev ?></button></td>
                                        <td><?= mediumdate_indo(date($order['orderdate'])); ?> - <?= $order['time'] ?></td>
                                        <td><button class="btn btn-sm <?= $status ?>"><?= $d['status'] ?></button></td>
                                        <td>
                                            <a href="<?= base_url('admin/detail_order/' . $d['idorder'] .'/keagenan') ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a> 
                                            <button class="btn btn-xs btn-danger" onclick="Hapus('<?= $d['idorder'] ?>');"><i class="fa fa-trash"></i> Hapus</button> 
                                        </td>
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


<script type="text/javascript">
function Hapus(id) {
    swal.fire({
            title: "Hapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-trash'></i> Hapus",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url('hapus/orderan'); ?>",
                    method: "GET",
                    data:"id="+id,
                    success: function (data) {
                        swal.fire({
                            title: "Terhapus!",
                            text: 'Berhasil menghapus data.',
                            icon: 'success',
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                        }).then(function(isConfirm) {
                            location.reload();
                        });
                    }
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                });
            }
        });
    }
</script>