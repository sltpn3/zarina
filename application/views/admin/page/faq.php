<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Faq</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Faq</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12" id="accordion">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Faq</h3>
                            <div class="card-tools">
                                <button href="<?= base_url('tambah/produk') ?>" class="btn btn-default"
                                    data-toggle="modal" data-target="#modal-xl"><i class="fa fa-plus"></i> Tambah
                                    Faq</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php foreach ($faq as $d) : ?>
                            <div class="card card-primary card-outline">
                                
                                    <div class="card-header">
                                        <a class="d-block w-100" data-toggle="collapse" href="#collapseOne">
                                            <h4 class="card-title">
                                                <?= $d['role'] ?>. <?= $d['pertanyaan'] ?>
                                            </h4>
                                        </a>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-toggle="modal" data-target="#modal-edit<?= $d['id'] ?>"><i class="fas fa-pencil-alt"></i></button>
                                            <input type="hidden" name="id" id="data<?= $d['id'] ?>" value="<?= $d['id'] ?>">
                                            <button type="button" class="btn btn-tool" onclick="Hapus('<?= $d['id'] ?>');"><i class="fas fa-trash"></i></button>
                                        </div>
                                    
                                    </div>
                                <div id="collapseOne"
                                    class="collapse <?php if($d['role'] == '1') : ?>show<?php endif ?>"
                                    data-parent="#accordion">
                                    <div class="card-body">
                                        <?= $d['jawaban'] ?>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <?php foreach ($faq as $d) : ?>

            <div class="modal fade" id="modal-edit<?= $d['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit FAQ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('update/website') ?>">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <textarea type="text" class="form-control" id="pertanyaan<?= $d['id'] ?>" name="pertanyaan" 
                                        placeholder="Pertanyaan" require><?= $d['pertanyaan'] ?></textarea>
                                    <?= form_error('pertanyaan', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Jawaban</label>
                                    <textarea type="text" class="form-control" id="jawaban<?= $d['id'] ?>" name="jawaban" 
                                        placeholder="Jawaban" require><?= $d['jawaban'] ?></textarea>
                                    <?= form_error('jawaban', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role<?= $d['id'] ?>" name="role">
                                        <option>- Pilih Role -</option>
                                        <option <?php if($d['role'] == '1'): ?>selected<?php endif ?> value="1">Satu</option>
                                        <option <?php if($d['role'] == '2'): ?>selected<?php endif ?>  value="2">Dua</option>
                                        <option <?php if($d['role'] == '3'): ?>selected<?php endif ?>  value="3">Tiga</option>
                                        <option <?php if($d['role'] == '4'): ?>selected<?php endif ?>  value="4">Empat</option>
                                        <option <?php if($d['role'] == '5'): ?>selected<?php endif ?>  value="5">Lima</option>
                                    </select>
                                    <?= form_error('role', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="button" class="btn btn-success" onclick="updateFaq('<?= $d['id'] ?>');"><i class="fa fa-check"></i> Simpan Data</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php endforeach ?>

            <div class="modal fade" id="modal-xl">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah FAQ</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Pertanyaan</label>
                                    <textarea type="text" class="form-control" id="pertanyaan" name="pertanyaan"
                                        placeholder="Pertanyaan" require></textarea>
                                    <?= form_error('pertanyaan', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Jawaban</label>
                                    <textarea type="text" class="form-control" id="jawaban" name="jawaban"
                                        placeholder="Jawaban" require></textarea>
                                    <?= form_error('jawaban', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Role</label>
                                    <select class="form-control" id="role" name="role">
                                        <option>- Pilih Role -</option>
                                        <option value="1">Satu</option>
                                        <option value="2">Dua</option>
                                        <option value="3">Tiga</option>
                                        <option value="4">Empat</option>
                                        <option value="5">Lima</option>
                                    </select>
                                    <?= form_error('role', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button class="btn btn-success" onclick="tambahFaq();"><i class="fa fa-check"></i> Simpan Data</button>
                            </div>
                        
                    </div>
                
                </div>
            </div>
            <!-- /.modal -->


        </div>
    </section>
</div>


<script type="text/javascript">

function tambahFaq() {
    var pertanyaan = $('#pertanyaan').val();
    var jawaban = $('#jawaban').val();
    var role = $('#role').val();

    if(pertanyaan =='' || jawaban =='' || role ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
        $.ajax({
            url: "<?= base_url('tambah/faq'); ?>",
            method: "POST",
            data: {"pertanyaan":pertanyaan, "jawaban":jawaban, "role":role},
            success: function (data) {
                Swal.fire({
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data FAQ berhasil di tambahkan.'
                }).then(function(isConfirm) {
                    location.reload();
                });
            }
        });
    }
}

function updateFaq(id) {
    var pertanyaan = $('#pertanyaan' + id).val();
    var jawaban = $('#jawaban' + id).val();
    var role = $('#role' + id).val();
    $.ajax({
        url: "<?= base_url('update/faq'); ?>",
        method: "POST",
        data: {"id": id, "pertanyaan":pertanyaan, "jawaban":jawaban, "role":role},
        success: function (data) {
            Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'success',
                title: 'Berhasil!',
                text: 'Data FAQ berhasil di update.'
            }).then(function(isConfirm) {
                location.reload();
            });
        }
    });
}

function Hapus(id) {
    var data = $('#data' + id).val();
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
                    url: "<?php echo base_url('hapus/faq'); ?>",
                    method: "POST",
                    data: {"id": id},
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