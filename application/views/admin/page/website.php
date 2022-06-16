<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Website</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Website</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-7">

                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="tab-satu" href="#edit-web"data-toggle="pill" role="tab" aria-selected="true">Edit Website</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-dua" href="#ganti-logo"data-toggle="pill" role="tab" aria-selected="false">Logo</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="tab-tiga" href="#ganti-sosmed"data-toggle="pill" role="tab" aria-selected="false">Sosial Media</a>
                                </li>
                            </ul>
                        </div>


                        <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">

                            <div class="tab-pane fade show active" id="edit-web" role="tabpanel" aria-labelledby="tab-satu">
                                <div class="card-body">
                                <!-- /.card-header -->
                                        <div class="form-group">
                                            <label>Nama Website</label>
                                            <input type="text" class="form-control" id="nama<?= $web['id'] ?>" name="nama"
                                                placeholder="Nama Website" value="<?= $web['nama'] ?>" require>
                                            <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" class="form-control" id="title" name="title"
                                                placeholder="Title" value="<?= $web['title'] ?>" require>
                                            <?= form_error('title', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Short Deskripsi</label>
                                            <textarea type="text" class="form-control" id="short_desk" name="short_desk"
                                                placeholder="Short Deskripsi"><?= $web['short_desk'] ?></textarea>
                                            <?= form_error('short_desk', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Email" value="<?= $web['email'] ?>" require>
                                            <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Telepon</label>
                                            <input type="number" class="form-control" id="telp" name="telp"
                                                placeholder="Nomor Telepon" value="<?= $web['telp'] ?>" require>
                                            <?= form_error('telp', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Jam Kerja</label>
                                            <input type="text" class="form-control" id="jam" name="jam"
                                                placeholder="Jam Kerja" value="<?= $web['jam'] ?>" require>
                                            <?= form_error('jam', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi"
                                                class="form-control"><?= $web['deskripsi'] ?>
                                            </textarea>
                                        </div>
                                        <br />
                                        <button class="btn btn-primary btn-block" onclick="updateWebsite('<?= $web['id'] ?>');"><b><i class="fa fa-redo"></i> Update Website</b></button>
                                    </div>
                            </div>


                            <div class="tab-pane fade" id="ganti-logo" role="tabpanel" aria-labelledby="tab-dua">
                                <div class="card-body">
                                    <form method="post" action="<?= base_url('update/logo') ?>" enctype="multipart/form-data">
                                        <input type="hidden" id="id" name="id" value="<?= $web['id'] ?>">
                                        <div class="form-group row col-md-6">
                                            <div class="col-sm-12">
                                                <label for="">Logo Website</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <img src="<?= base_url("assets/img/" . $web['logo']) ?>" width="100" height="85" id="preview1" class="img-thumbnail">
                                            </div>
                                            <div class="col-sm-9">
                                                <input hidden type="file" name="logo" class="file1" accept="image/*" id="imgInp1">
                                                <div class="input-group my-3">
                                                    <input type="text" class="form-control" disabled placeholder="Logo website" id="file1">
                                                    <div class="input-group-append">
                                                        <button type="button" class="browse1 btn btn-primary">Browse</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row col-md-6">
                                            <div class="col-sm-12">
                                                <label for="">Favicon</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <img src="<?= base_url("assets/img/" . $web['fav']) ?>" width="100" height="85" id="preview2" class="img-thumbnail">
                                            </div>
                                            <div class="col-sm-9">
                                                <input hidden type="file" name="fav" class="file2" accept="image/*" id="imgInp2">
                                                <div class="input-group my-3">
                                                    <input type="text" class="form-control" disabled placeholder="Favicon" id="file2">
                                                    <div class="input-group-append">
                                                        <button type="button" class="browse2 btn btn-primary">Browse</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row col-md-6">
                                            <div class="col-sm-12">
                                                <label for="">Open Graph Facebook</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <img src="<?= base_url("assets/img/" . $web['og']) ?>" width="100" height="85" id="preview3" class="img-thumbnail">
                                            </div>
                                            <div class="col-sm-9">
                                                <input hidden type="file" name="og" class="file3" accept="image/*" id="imgInp3">
                                                <div class="input-group my-3">
                                                    <input type="text" class="form-control" disabled placeholder="Favicon" id="file3">
                                                    <div class="input-group-append">
                                                        <button type="button" class="browse3 btn btn-primary">Browse</button>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>

                                        <div class="alert alert-primary" role="alert">
                                        <p>Setelah melakukan perubahan Open graph Facebook, <br>Silahkan melakukan debuger dahulu untuk menyimpan perubahan cache di Facebook.</p>
                                        <a target="_blank" rel="nofollow" href="https://developers.facebook.com/tools/debug"><b>Debug open graph →</b></a>
                                        </div>
                                        <br />
                                        <button type="button" id="updateLogo" class="btn btn-primary btn-block"><i class="fa fa-redo"></i> Update Logo</button>
                                        <input hidden type="submit" id="submit_u">
                                    </form>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="ganti-sosmed" role="tabpanel" aria-labelledby="tab-tiga">
                                <div class="card-body">
                                   
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" class="form-control" id="fb<?= $web['id'] ?>" name="fb"
                                                placeholder="Facebook" value="<?= $web['fb'] ?>" require>
                                            <?= form_error('fb', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Twitter</label>
                                            <input type="text" class="form-control" id="tw" name="tw"
                                                placeholder="Twitter" value="<?= $web['tw'] ?>" require>
                                            <?= form_error('tw', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Instagram</label>
                                            <input type="text" class="form-control" id="ig" name="ig"
                                                placeholder="Instagram" value="<?= $web['ig'] ?>" require>
                                            <?= form_error('ig', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <!-- /.card-body -->
                                        <br />
                                        <button type="button" class="btn btn-primary btn-block" onclick="updateSosmed('<?= $web['id'] ?>');"><b><i class="fa fa-redo"></i> Update Sosmed</b></button>
                                    </div>
                            </div>

                        </div>
                    </div>
                </div>    

                    <!-- /.card -->
                </div>

                <div class="col-md-5">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <?= $web['maps'] ?>
                            </div>

                            <br />
                            
                                <div class="form-group">
                                    <label>Lokasi G-Maps</label>
                                    <textarea type="text" class="form-control" id="maps<?= $web['id'] ?>" name="maps" rows="5"
                                        placeholder="Link Maps"><?= $web['maps'] ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea type="text" class="form-control" id="alamat" name="alamat"
                                        placeholder="Alamat"><?= $web['alamat'] ?></textarea>
                                    <?= form_error('alamat', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>
                                <button class="btn btn-primary btn-block" onclick="updateMaps('<?= $web['id'] ?>');"><b><i class="fa fa-redo"></i> Update Maps</b></button>
                            
                            </ul>
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

   function updateWebsite(id) {
    var nama = $('#nama' + id).val();
    var title = $('#title').val();
    var short_desk = $('#short_desk').val();
    var email = $('#email').val();
    var telp = $('#telp').val();
    var jam = $('#jam').val();
    var deskripsi = $('#deskripsi').val();
    $.ajax({
        url: "<?php echo base_url('update/website'); ?>",
        method: "POST",
        data: {"id": id, "nama":nama, "title":title, "short_desk":short_desk, "email":email, "telp":telp,
        "jam":jam, "deskripsi":deskripsi},
        success: function (data) {
            Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'success',
                title: 'Terupdate!',
                text: 'Data website berhasil di update.'
            }).then(function(isConfirm) {
                location.reload();
            });
        }
    });
}


$("#updateLogo").on('click', function(){
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


   function updateSosmed(id) {
    var fb = $('#fb' + id).val();
    var tw = $('#tw').val();
    var ig = $('#ig').val();
    $.ajax({
        url: "<?php echo base_url('update/sosmed'); ?>",
        method: "POST",
        data: {"id": id, "fb":fb, "tw":tw, "ig":ig},
        success: function (data) {
            Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'success',
                title: 'Terupdate!',
                text: 'Data sosmed berhasil di update.'
            }).then(function(isConfirm) {
                location.reload();
            });
        }
    });
}

function updateMaps(id) {
    var maps = $('#maps' + id).val();
    var alamat = $('#alamat').val();
    $.ajax({
        url: "<?php echo base_url('update/maps'); ?>",
        method: "POST",
        data: {"id": id, "maps":maps, "alamat":alamat},
        success: function (data) {
            Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'success',
                title: 'Terupdate!',
                text: 'Data maps berhasil di update.'
            }).then(function(isConfirm) {
                location.reload();
            });
        }
    });
}

</script>

<script type="text/javascript">

$(document).on("click", ".browse1", function() {
        var file = $(this).parents().find(".file1");
        file.trigger("click");
    });

    $(document).on("click", ".browse2", function() {
        var file = $(this).parents().find(".file2");
        file.trigger("click");
    });

    $(document).on("click", ".browse3", function() {
        var file = $(this).parents().find(".file3");
        file.trigger("click");
    });

    $('#imgInp1').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file1").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview1").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    $('#imgInp2').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file2").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview2").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });

    $('#imgInp3').change(function(e) {
        var fileName = e.target.files[0].name;
        $("#file3").val(fileName);

        var reader = new FileReader();
        reader.onload = function(e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview3").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>