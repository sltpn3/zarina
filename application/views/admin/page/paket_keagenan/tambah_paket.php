<script type="text/javascript">
function load_data_temp(){
    var fk  =  $("#fk").val();
    $.ajax({
        type:"GET",
        url:"<?php echo base_url('get/load_temp')?>",
        data:"fk="+fk,
        success:function(hasilajax){
            $('#list_ku').html(hasilajax);
            document.getElementById('fk').focus();
        }
    });
            
}

function load_data_temp1(){
    var fk  =  $("#fk").val();
    $.ajax({
        url:"<?php echo base_url('get/load_temp1')?>",
        method: "POST",
        data: {"fk": fk},
        success:function(hasilajax1){
            $('#list_ku1').html(hasilajax1);
            document.getElementById('fk').focus();
        }
    });
            
}

function load_data_temp2(){
    var fk  =  $("#fk").val();
    $.ajax({
        url:"<?php echo base_url('get/load_temp2')?>",
        method: "POST",
        data: {"fk": fk},
        success:function(hasilajax1){
            $('#list_ku2').html(hasilajax1);
            document.getElementById('fk').focus();
        }
    });
            
}

function hapus(id){
    $.ajax({
        type:"GET",
        url:"<?php echo base_url('hapus/hapus_temp')?>",
        data:"id="+id,
        success:function(html){
            $("#dataku"+id).hide(500);
            load_data_temp();
            load_data_temp2();
        }
    });
}

function hapusAa(id){
    $.ajax({
        type:"GET",
        url:"<?php echo base_url('hapus/hapus_temp1')?>",
        data:"idA="+id,
        success:function(html){
            $("#datakuAa"+id).hide(500);
            load_data_temp1();
        }
    });
}

function tambah(){
    var fk     = $("#fk").val();
    var produk   = $("#produk").val();
            
    if(produk == '' ||fk =='' ){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
            $.ajax({
            url:"<?php echo base_url('tambah/input_ajax')?>",
            method: "POST",
            data: {"fk": fk, "produk":produk},
            success:function(html){
                load_data_temp();
                load_data_temp2();
                var produk             = $("#produk").val('');
                document.getElementById("produk").focus();
                
            }
        });
    }
}

function TambahAa(){
    var fk     = $("#fk").val();
    var produk1   = $("#produk1").val();
    var min   = $("#min").val();
    var max   = $("#max").val();
    var harga   = $("#harga1").val();
            
    if(produk1 == '' || fk =='' || min =='' || max =='' || harga ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
            $.ajax({
            url:"<?php echo base_url('tambah/input_ajax1')?>",
            method: "POST",
            data: {"fk": fk, "produk1":produk1, "min": min, "max": max, "harga": harga},
            success:function(html){
                load_data_temp1();
                var produk1             = $("#produk1").val('');
                document.getElementById("produk1").focus();
                
            }
        });
    }
}
</script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Paket Keagenan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Paket keagenan</li>
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
                            <h3 class="card-title">Tambah Keagenan</h3>
                            <div class="card-tools">
                                <a href="<?= base_url('admin/paket_keagenan') ?>" class="btn btn-default"><i
                                        class="fa fa-list"></i> Paket keagenan</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <form role="form" method="post" action="<?= base_url('tambah/tambah_paket_keagenan') ?>" enctype="multipart/form-data" id="myForm">
                            <div class="card-body">
                                <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '
                                    </div>') ?>
                                <?= $this->session->flashdata('message') ?>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">

                                        <div class="form-group">
                                            <label>Kode Agen</label>
                                            <input type="text" class="form-control" value="<?= $kode; ?>" disabled/>
                                            <input type="hidden" name="fk" id="fk" value="<?= $kode; ?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Keagenan</label>
                                            <input type="text" class="form-control" id="nama" name="nama" value=""
                                                placeholder="Nama Paket Keagenan" require>
                                            <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group ck-editor__editable_inline mb-0 mb-0">
                                            <label>Deskripsi</label>
                                            <textarea id="compose-textarea" class="form-control mb-0 mb-0" name="deskripsi"></textarea>
                                        </div>

                                        <div class="form-group ck-editor__editable_inline mt-0 mt-0">
                                            <label>Informasi</label>
                                            <textarea id="compose-textarea100" class="form-control mt-0 mt-0" name="informasi"></textarea>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 col-md-6">

                                        <div class="form-group">
                                            <label>Minimal Order</label><br>
                                            <input type="number" name="minimal" class="form-control" id="minimal">
                                        </div>

                                        <div class="form-group">
                                            <label>Repeat Order</label><br>
                                            <input type="number" name="repeat_order" class="form-control" id="repeat_order">
                                        </div>

                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table class="table table-md">
                                                <tr>
                                                    <th>
                                                        <label>Paket Produk</label>
                                                        <select class="form-control select2bs4" style="width: 100%;" name="produk" id="produk">
                                                            <option selected="selected" value="">- Pilih Produk -</option>
                                                            <?php foreach($produk as $d) : ?>
                                                                <option value="<?= $d['id'] ?>"><?= $d['sku'] ?> - <?= $d['nama'] ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </th>
                                                    <th>
                                                        <br>
                                                        <a class="btn btn-success btn-md mt-2" onclick="tambah();" style="color:white;"><i class="fas fa-plus"></i></a>
                                                    </th>
                                                </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div id="list_ku" class="table-responsive col-md-7"></div>
                                        </div>

                                        <div class="form-group" id="Frame1">
                                            <div class="table-responsive">
                                                <table class="table table-md">
                                                <tr>
                                                    <th>
                                                        <div id="list_ku2"></div>
                                                    </th>
                                                    <th>
                                                    <label>Min</label>
                                                        <input type="number" name="min" class="form-control" id="min" placeholder="Minimal Order">
                                                    </th>
                                                    <th>
                                                    <label>Max</label>
                                                        <input type="number" name="max" class="form-control" id="max" placeholder="Maximal Order">
                                                    </th>
                                                    <th>
                                                    <label>Harga</label>
                                                        <input type="number" name="harga1" class="form-control" id="harga1" placeholder="Harga Paket">
                                                    </th>
                                                    <th>
                                                        <br>
                                                        <a class="btn btn-success btn-md mt-2" onclick="TambahAa();" style="color:white;"><i class="fas fa-plus"></i></a>
                                                    </th>
                                                </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div id="list_ku1" class="table-responsive"></div>
                                        </div>

                                        <div class="form-group">
                                            <label>Status Promo</label><br>
                                            <input type="checkbox" name="status" data-bootstrap-switch data-off-color="danger" data-on-color="success" class="make-switch" id="checkbox" value="">
                                        </div>
                                      

                                    </div>

                                </div>
                            </div>

                            <div class="card-footer">
                                <button class="btn btn-primary" type="button" id="simpan"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit">
                            </div>
                        </form>
                    </div>

                </div>

            </div>
        </div>
    </section>
</div>

<script type="text/javascript">
$("#simpan").on('click', function(){
    var nama   = $("#nama").val();
    var desk   = $("#compose-textarea").val();
    var info   = $("#compose-textarea100").val();
    var minimal   = $("#minimal").val();
    var repeat_order   = $("#repeat_order").val();
    var harga   = $("#rupiah").val();
        
    if(nama =='' || desk =='' || info =='' || harga =='' || minimal =='' || repeat_order ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'warning',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
          
    $.ajax({
            url: "<?= base_url('get/get_slug_paket_keagenan'); ?>",
            type: "POST",
            data: {"nama":nama},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Paket keagenan sudah ada.'
                        })
                    }
                }
        });

    swal.fire({
            title: "Yakin ingin menyimpan data?",
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

</script>

<script type="text/javascript">
$(function() {
    $('#compose-textarea100').summernote()
});
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
</script>