<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Permintaan Klaim</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Klaim</li>
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
                            <h3 class="card-title">Permintaan Klaim</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Nama Rek</th>
                                        <th>Nomor Rek</th>
                                        <th>Bank</th>
                                        <th>Points</th>
                                        <th>Nominal</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                <?php $no=1; foreach($klaim_point as $d) : ?>

                                <?php $users = $this->db->get_where('user', ['id' => $d['id_user']])->row_array(); ?>
                                <?php   

                                if ($d['status'] == 'Success') {
                                    $label1 = "btn-success";
                                }else if ($d['status'] == 'Pending') {
                                    $label1 = "btn-warning";
                                }else{
                                    $label1 = "btn-danger";
                                } ?>

                                    <tr>
                                        <td><?= $no ?></td>
                                        <td><?= $users['nama'] ?></td>
                                        <td><?= $d['nama_rek'] ?></td>
                                        <td><?= $d['nomor_rek'] ?></td>
                                        <td><?= $d['bank'] ?></td>
                                        <td><?= $d['point'] ?></td>
                                        <td>Rp. <?= number_format($d['nominal'], 0, ',', '.'); ?></td>
                                        <td><?= mediumdate_indo(date($d['tgl'])); ?></td>
                                        <td><button class="btn btn-xs <?= $label1 ?> disabled"><?= $d['status'] ?></button></td>
                                        <td>
                                            <?php if($d['status'] !== 'Error'): ?>
                                                <a href="#" class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-data<?= $d['id'] ?>"><i class="fa fa-redo"></i> Ubah Status</a> 
                                            <?php endif ?>
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

        <?php foreach($klaim_point as $d) : ?>
            <div class="modal fade" id="modal-data<?= $d['id'] ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Update Data Klaim</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Update Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option value="">- Pilih Status -</option>
                                        <?php if($d['status'] !== 'Error'): ?>
                                          <option value="Success">Success</option>
                                          <option value="Error">Batal</option>
                                          <?php endif ?>
                                    </select>
                                    <?= form_error('role', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>
                                <input type="hidden" name="id_klaim" id="id_klaim" value="<?= $d['id'] ?>">

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button class="btn btn-success" onclick="updateStatus();"><i class="fa fa-check"></i> Simpan Data</button>
                            </div>
                        
                    </div>
                
                </div>
            </div>
            <!-- /.modal -->
        <?php endforeach ?> 

        </div>
    </section>
</div>

<script type="text/javascript">

function updateStatus() {
    var status = $('#status').val();
    var id = $('#id_klaim').val();

    if(status ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {

        $.ajax({
            url: "<?= base_url('update/status_point'); ?>",
            method: "POST",
            data: {"status":status, "id":id,},
            success: function (data) {
                Swal.fire({
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data reward point berhasil di tambahkan.'
                }).then(function(isConfirm) {
                    location.reload();
                });
            }
        });
    }
}

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
                    url: "<?php echo base_url('hapus/data_klaim'); ?>",
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