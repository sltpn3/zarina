<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reward Point</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Reward Point</li>
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
                            <h3 class="card-title">Reward Point</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('tambah/produk') ?>" class="btn btn-default"  data-toggle="modal" data-target="#modal-klaim"><i
                                        class="fa fa-plus"></i> Klaim</a>
                            </div>
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
                                    }
                                 ?>

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

        
        <div class="modal fade" id="modal-klaim">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Reward Point</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                            <div class="modal-body">

                            <div class="col-12">
                                <div class="small-box bg-primary">
                                    <div class="inner">
                                        <h3><b><?= number_format($user_a['point'], 0, ',', '.') ?></b></h3>
                                        
                                        <p>Reward Point</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-coins"></i>
                                    </div>
                                </div>
                            </div>

                            <?php $this->db->select_min('point');
                                  $get_min = $this->db->get_where('reward_point', ['fk_agen' => $reward_point['fk_agen']])->row(); ?> 

                                <div class="form-group">
                                    <label>jumlah points </label>

                                    <select class="form-control" id="point" name="point">
                                        <option value="">- Pilih Point -</option>
                                        <?php foreach ($reward_point2 as $d) : ?>
                                          <option value="<?= $d->point ?>"><?= $d->point ?> Point - Rp. <?= number_format($d->nominal, 0, ',', '.') ?>,-</option>
                                        <?php endforeach ?>
                                    </select>

                                    <small>Minimal klaim adalah <?= $get_min->point ?> points</small>
                                </div>
                                <div class="form-group">
                                    <label>Nama Rekening </label>
                                    <input type="text" class="form-control" id="nama_rek" value="<?= $user_a['nama_rek'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nomor Rekening </label>
                                    <input type="number" class="form-control" id="nomor_rek" value="<?= $user_a['no_rek'] ?>">
                                </div>
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <select class="form-control" id="bank" name="bank">
                                        <option value="">- Pilih Bank -</option>
                                        <option <?php if($user_a['nama_bank'] == 'BRI') : ?>selected<?php endif ?> value="BRI">Bank BRI</option>
                                        <option <?php if($user_a['nama_bank'] == 'BCA') : ?>selected<?php endif ?> value="BCA">Bank BCA</option>
                                        <option <?php if($user_a['nama_bank'] == 'BNI') : ?>selected<?php endif ?> value="BNI">Bank BNI</option>
                                        <option <?php if($user_a['nama_bank'] == 'MANDIRI') : ?>selected<?php endif ?> value="MANDIRI">Bank MANDIRI</option>
                                        <option <?php if($user_a['nama_bank'] == 'LAINNYA') : ?>selected<?php endif ?> value="LAINNYA">LAINNYA</option>
                                    </select>
                                </div>

                            </div>
                            <input type="hidden" id="id_user" value="<?= $user_a['id'] ?>">
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button class="btn btn-success" onclick="tambahKlaim();"><i class="fa fa-check"></i> Klaim Point</button>
                            </div>
                        
                    </div>
                
                </div>
            </div>
            <!-- /.modal -->

    </section>
</div>


<script type="text/javascript">

function tambahKlaim() {
    var id_user = $('#id_user').val();
    var point = $('#point').val();
    var nama_rek = $('#nama_rek').val();
    var nomor_rek = $('#nomor_rek').val();
    var bank = $('#bank').val();


    $.ajax({
            url: "<?= base_url('get/get_user_point'); ?>",
            type: "POST",
            data: {"id_user":id_user, "point":point},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Point kamu tidak cukup untuk klaim.'
                        })
                    }
                }
        });

    $.ajax({
        url: "<?= base_url('tambah/klaim_point'); ?>",
        method: "POST",
        data: {"id_user":id_user, "point":point, "nama_rek":nama_rek, "nomor_rek":nomor_rek, "bank":bank},
        success: function (data) {
            Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'success',
                title: 'Berhasil!',
                text: 'Permintaan klaim point berhasil di buat.'
            }).then(function(isConfirm) {
                location.reload();
            });
        }
    });
}
</script>