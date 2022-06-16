<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tambah Keagenan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Tambah Keagenan</li>
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
                                <a href="<?= base_url('admin/data_keagenan') ?>" class="btn btn-default"><i
                                        class="fa fa-list"></i> Data Keagenan</a>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <form method="post" action="<?= base_url('tambah/tambah_user') ?>" enctype="multipart/form-data">

                            <div class="card-body"> 

                                <div class="row">
                                    <div class="col-lg-6 col-md-6">

                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" require>
                                        </div>


                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor NIK" require>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email" name="email"
                                                placeholder="Email" value="<?= set_value('email') ?>" require>
                                            <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group form-box">
                                            <label>Password </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div onclick="myFunction()" class="input-group-text pointer"><i id="icon" class="fa fa-eye"></i></div>
                                                </div>
                                                <input type="text" class="active form-control" id="password" name="password" placeholder="Password" require>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Hp</label>
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor Telepon" require>
                                        </div>

                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control" id="prov" name="prov">
                                                <option value="">- Pilih Provinsi -</option>
                                                <?php foreach ($prov as $v) : ?>
                                                <option value="<?= $v['id_prov'] ?>"><?= $v['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Kota</label>
                                            <select class="form-control" id="kab" name="kab">
                                                <option value="">- Pilih provinsi dahulu -</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control" id="kec" name="kec">
                                                <option value="">- Pilih kabupaten dahulu -</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-lg-6 col-md-6">

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea type="text" rows="4" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Rekening</label>
                                            <input type="text" class="form-control" id="nama_rek" name="nama_rek" placeholder="Nama Rekening" require>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Rekening</label>
                                            <input type="number" class="form-control" id="nomor_rek" name="nomor_rek" placeholder="Nomor Rekening" value="<?= set_value('nomor_rek') ?>" require>
                                        </div>

                                        <div class="form-group">
                                            <label>Nama Bank</label>
                                            <select class="form-control" id="bank" name="bank">
                                                <option value="">- Pilih Bank -</option>
                                                <option value="BRI">Bank BRI</option>
                                                <option value="BCA">Bank BCA</option>
                                                <option value="BNI">Bank BNI</option>
                                                <option value="MANDIRI">Bank MANDIRI</option>
                                                <option value="LAINNYA">LAINNYA</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Level Keagenan</label>
                                            <select class="form-control" id="level" name="level">
                                                <option value="" selected>- Pilih Level -</option>
                                                <?php foreach ($agen as $v) : ?>
                                                <option value="<?= $v['id'] ?>"><?= $v['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Status</label><br>
                                            <input type="checkbox" name="status" data-bootstrap-switch data-off-color="danger" data-on-color="success" class="make-switch" id="checkbox" value="">
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Referensi</label>
                                            <input type="text" class="form-control" id="no_ref" name="no_ref" placeholder="Nomor Referensi" require>
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
    var nik   = $("#nik").val();
    var no_ref  = $("#no_ref").val();
    var email   = $("#email").val();
    var password   = $("#password").val();
    var no_hp   = $("#no_hp").val();
    var prov   = $("#prov").val();
    var kab   = $("#kab").val();
    var kec   = $("#kec").val();
    var alamat   = $("#alamat").val();
    var level   = $("#level").val();

    if(nama =='' || no_ref =='' || nik =='' ||  email =='' || password =='' || no_hp =='' || prov =='' || kab =='' || kec =='' || alamat =='' || level ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'warning',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
         
    $.ajax({
            url: "<?= base_url('get/get_email'); ?>",
            type: "POST",
            data: {"email":email},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Email ini sudah di gunakan.'
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
$(document).ready(function() {

    $('#prov').change(function() {
        $.ajax({
            type: 'POST',
            url: '<?= site_url('get/get_kota'); ?>',
            data: {
                prov: this.value
            },
            cache: false,
            success: function(response) {
                $('#kab').html(response);
            }
        });
    });

    $('#kab').change(function() {
        $.ajax({
            type: 'POST',
            url: '<?= site_url('get/get_kec'); ?>',
            data: {
                kab: this.value
            },
            cache: false,
            success: function(response) {
                $('#kec').html(response);
            }
        });
    });

});
</script>

<script type="text/javascript">
var input = document.getElementById('password'),
    icon = document.getElementById('icon');

icon.onclick = function() {

    if (input.className == 'active form-control') {
        input.setAttribute('type', 'text');
        icon.className = 'fa fa-eye';
        input.className = 'form-control';

    } else {
        input.setAttribute('type', 'password');
        icon.className = 'fa fa-eye-slash';
        input.className = 'active form-control';
    }

}
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
</script>