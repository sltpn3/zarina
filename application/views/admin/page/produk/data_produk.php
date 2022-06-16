<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Produk</li>
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
                            <h3 class="card-title">Data Produk</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('tambah/produk') ?>" class="btn btn-default"><i
                                        class="fa fa-plus"></i> Tambah Produk</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SKU</th>
                                        <th>gambar</th>
                                        <th>Produk</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th width="100">Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php $no=1; foreach($produk as $d) : ?>
                                    <?php
                                       if ($d['status'] == 'on') {
                                        $status = 'Aktif';
                                        $label1 = "btn-success";
                                    }else{
                                        $status = 'Nonaktif';
                                        $label1 = "btn-danger";
                                    }?>
                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $d['sku'] ?></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#modal-img<?= $d['id'] ?>">
                                                <img src="<?= base_url('assets/img/produk/' . $d['img']) ?>" class="img-fluid img-thumbnail" alt="<?= $d['nama'] ?>" width="50" height="50"/>
                                            </a>
                                        </td>
                                        <td><?= $d['nama'] ?></td>
                                        <td>Rp.<?= number_format($d['harga'], 0, ',', '.'); ?></td>
                                        <td><?= $d['stok'] ?></td>
                                        <td><button class="btn btn-xs <?= $label1 ?> disabled"><?= $status ?></button></td>
                                        <td>
                                            <a href="<?= base_url('update/produk/' . $d['slug']) ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> 
                                            <button class="btn btn-xs btn-danger" onclick="Hapus('<?= $d['id'] ?>');"><i class="fa fa-trash"></i> Hapus</button> 
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
            

            <?php foreach ($produk as $d) : ?>

            <div class="modal fade" id="modal-img<?= $d['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?= $d['nama'] ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <img src="<?= base_url('assets/img/produk/' . $d['img']) ?>" style="display:block;width:100%;height:100%;object-fit:cover;" class="img-fluid" alt="<?= $d['nama'] ?>"/>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <?php endforeach ?>

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
                    url: "<?php echo base_url('hapus/produk'); ?>",
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