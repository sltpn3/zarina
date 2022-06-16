<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Testimoni</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Testimoni</li>
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
                            <h3 class="card-title">Data Testimoni</h3>
                            <div class="card-tools">
                                <button href="#" class="btn btn-default"
                                    data-toggle="modal" data-target="#modal-xl"><i class="fa fa-plus"></i> Tambah
                                    Testimoni</button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">

                            <?php foreach ($testimoni as $d) : ?>
                                <!-- Post -->
                                <div class="post">
                                <div class="user-block">
                                    <img class="img-circle img-bordered-sm" src="<?= base_url('assets/') ?>img/testimoni/<?= $d['img'] ?>" alt="user image">
                                    <span class="username">
                                    <a href="#"><?= $d['nama'] ?>.</a>
                                    <a href="#" class="float-right btn-tool" onclick="Hapus('<?= $d['id'] ?>');"><i class="fas fa-trash"></i></a>
                                    <a href="#" class="float-right btn-tool" data-toggle="modal" data-target="#modal-edit<?= $d['id'] ?>"><i class="fas fa-pencil-alt"></i></a>
                                    </span>
                                    <span class="description"><?= $d['job'] ?></span>
                                </div>
                                <!-- /.user-block -->
                                <p>
                                <?= $d['testi'] ?>
                                </p>

                                </div>
                                <!-- /.post -->
                            <?php endforeach ?>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <?php foreach ($testimoni as $d) : ?>

            <div class="modal fade" id="modal-edit<?= $d['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Testimoni</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('update/testimoni') ?>" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $d['nama'] ?>" placeholder="Nama" require>
                                    <input type="hidden" id="id" name="id" value="<?= $d['id'] ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Job</label>
                                    <input type="text" class="form-control" name="job" value="<?= $d['job'] ?>"
                                        placeholder="Nama" require>
                                    <?= form_error('job', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Testimoni</label>
                                    <textarea type="text" class="form-control" name="testi" 
                                        placeholder="Testimoni" require><?= $d['testi'] ?></textarea>
                                    <?= form_error('testi', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group row col-md-6">
                                    <div class="col-sm-12">
                                        <label for="">Foto Profile</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="<?= base_url('assets/img/testimoni/' . $d['img']) ?>" width="100" height="85" id="preview<?= $d['id'] ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <input hidden type="file" name="gambar" class="file<?= $d['id'] ?>" accept="image/*" id="imgInp<?= $d['id'] ?>">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Pilih Gambar" id="file<?= $d['id'] ?>">
                                            <div class="input-group-append">
                                                <button type="button" class="browse<?= $d['id'] ?> btn btn-primary">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="button" id="update" class="btn btn-success"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit_u">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <?php endforeach ?>

            <div class="modal fade" id="modal-xl">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Testimoni</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('tambah/testimoni') ?>" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama" require>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Job</label>
                                    <input type="text" class="form-control" id="job" name="job"
                                        placeholder="Nama" require>
                                    <?= form_error('job', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Testimoni</label>
                                    <textarea type="text" class="form-control" id="testi" name="testi" 
                                        placeholder="Testimoni" require></textarea>
                                    <?= form_error('testi', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group row col-md-6">
                                    <div class="col-sm-12">
                                        <label for="">Foto Profile</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="" width="100" height="85" id="preview" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <input hidden type="file" name="gambar" class="file" accept="image/*" id="imgInp">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Pilih Gambar" id="file">
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-primary">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="button" id="simpan" class="btn btn-success"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


        </div>
    </section>
</div>

<script type="text/javascript">
$("#simpan").on('click', function(){
    var nama   = $("#nama").val();
    var job   = $("#job").val();
    var testi   = $("#testi").val();
    var gambar   = $("#gambar").val();
        
    if(nama =='' || job =='' || testi =='' || gambar ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
    swal.fire({
            title: "Yakin ingin menyimpan data?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Simpan",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil menyimpan data.',
                    icon: 'success',
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit').trigger('click');
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Oke!',
                });
            }
        });
    }
});

$("#update").on('click', function(){
    swal.fire({
            title: "Yakin ingin mengupdate data?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Simpan",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil mengupdate data.',
                    icon: 'success',
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit_u').trigger('click');
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: '<i class="fa fa-thumbs-up"></i> Oke!',
                });
            }
        });
});


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
                    url: "<?php echo base_url('hapus/testimoni'); ?>",
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


<script type="text/javascript">
<?php foreach ($testimoni as $d) : ?>
$(document).on("click", ".browse<?= $d['id'] ?>", function() {
    var file = $(this).parents().find(".file<?= $d['id'] ?>");
    file.trigger("click");
});


$('#imgInp<?= $d['id'] ?>').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file<?= $d['id'] ?>").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview<?= $d['id'] ?>").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
<?php endforeach ?>

$(document).on("click", ".browse", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});

$('#imgInp').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
</script>
