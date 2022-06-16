<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Produk</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Produk</li>
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
                            <h3 class="card-title">Edit Produk</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('admin/data_produk') ?>" class="btn btn-default"><i class="fa fa-list"></i> Data Produk</a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <form method="post" action="<?= base_url('update/update_produk') ?>" enctype="multipart/form-data">

                            <div class="card-body">

                                <div class="row">
                                    <input type="hidden" name="id" id="id" value="<?= $produk['id'] ?>">
                                    <input type="hidden" name="slug" id="slug" value="<?= $produk['slug'] ?>">
                                    <input type="hidden" name="sku1" value="<?= $produk['sku'] ?>">
                                    <div class="col-lg-8 col-md-8">
                                        <div class="form-group">
                                            <label>Nama Produk</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $produk['nama'] ?>" placeholder="Nama Produk">
                                        </div>
                                        <div class="form-group">
                                            <label>SKU</label>
                                            <input type="text" class="form-control" id="sku" name="sku" value="<?= $produk['sku'] ?>" placeholder="SKU Produk">
                                        </div>
                                        <div class="form-group ck-editor__editable_inline">
                                            <label>Deskripsi</label>
                                            <textarea id="deskripsi" name="deskripsi" class="form-control" rows="8"><?= $produk['deskripsi'] ?></textarea>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4">
                                        <div class="form-group">
                                            <label>Harga</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp.</span>
                                                </div>
                                                <input type="text" name="harga" class="harga form-control" id="rupiah" value="<?= $produk['harga'] ?>" placeholder="Harga Produk">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Stok Produk</label>
                                            <input type="text" name="stok" class="form-control" id="stok" value="<?= $produk['stok'] ?>" placeholder="Stok Produk" id="stok">
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <label for="">Foto Produk</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <a href="#" data-toggle="modal" data-target="#modal-img">
                                                    <img src="<?= base_url('assets/img/produk/' . $produk['img']) ?>" width="100" height="85" id="preview" class="img-thumbnail">
                                                </a>
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

                                        <div class="form-group">
                                            <label>Status Produk</label><br>
                                            <input type="checkbox" name="status" <?php if($produk['status'] == 'on') : ?>checked<?php endif ?> data-bootstrap-switch data-off-color="danger" data-on-color="success" class="make-switch"
                                                id="checkbox" value="<?= $produk['status'] ?>">
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="button" id="simpan" class="btn btn-primary"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit">
                            </div>
                        </form>
                    </div>

                </div>

            </div>

            
            <div class="modal fade" id="modal-img">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Gambar Produk</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="<?= base_url('assets/img/produk/' . $produk['img']) ?>" style="display:block;width:100%;height:100%;object-fit:cover;" id="preview1" class="img-fluid">
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>


        </div>
    </section>
</div>

<script type="text/javascript">
$("#simpan").on('click', function(){
    var sku   = $("#sku").val();
    var nama   = $("#nama").val();
    var deskripsi   = $("#deskripsi").val();
    var harga   = $("#rupiah").val();
    var stok   = $("#stok").val();
    var slug   = $("#slug").val();
    var sku1   = $("#sku").val();
    

    if(nama =='' || sku =='' || deskripsi =='' || harga =='' || stok ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'warning',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
        
    $.ajax({
            url: "<?= base_url('get/get_sku/edit'); ?>",
            type: "POST",
            data: {"sku":sku, "sku1":sku1},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'SKU ini sudah di gunakan.'
                        })
                    }
                }
        });

    $.ajax({
            url: "<?= base_url('get/get_nama_produk/edit'); ?>",
            type: "POST",
            data: {"nama":nama, "slug":slug},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Nama produk ini sudah di gunakan.'
                        })
                    }
                }
        });


    swal.fire({
            title: "Yakin ingin mengupdate data?",
            icon: "info",
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

</script>


<script type="text/javascript">
$(function() {
    $('.make-switch').bootstrapSwitch('state');
    $('.make-switch').on('switchChange.bootstrapSwitch', function() {
        var check = $('.bootstrap-switch-on');
        if (check.length > 0) {
            $("#checkbox").val('on');
        } else {
            $("#checkbox").val('off');
        }
    });
});

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
        document.getElementById("preview1").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
</script>