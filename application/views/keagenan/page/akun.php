<script type="text/javascript">

$(document).ready(function(){
    //semua element dengan class text-danger akan di sembunyikan saat load
    $('.text-danger').hide();
    //untuk mengecek bahwa semua textbox tidak boleh kosong
    $('input').each(function(){ 
        $(this).blur(function(){ //blur function itu dijalankan saat element kehilangan fokus
            if (! $(this).val()){ //this mengacu pada text box yang sedang fokus
                return get_error_text(this); //function get_error_text ada di bawah
            } else {
                $(this).removeClass('no-valid'); 
                $(this).parent().find('.text-danger').hide();
                $(this).parent().find('.text-info').hide();//cari element dengan class has-warning dari element induk text yang sedang focus
                $(this).closest('div').removeClass('has-warning');
                $(this).closest('div').addClass('has-success');
                $(this).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-warning-sign');
                $(this).parent().find('.form-control-feedback').addClass('glyphicon glyphicon-ok');
                $(this).parent().find('.form-control').removeClass("is-invalid"); 
            }
        });
    });

    //mengecek konfirmasi password
    $('#password_ulang').blur(function(){
        var pass = $("#password_new<?= $users['id'] ?>").val();
        var conf=$(this).val();
        var len=conf.length;
        if (len>0 && pass!==conf) {
            $(this).parent().find('.text-danger').text("");
            $(this).parent().find('.text-danger').text("Konfirmasi Password tidak sama.");
            return apply_feedback_error(this);
        }
    });


//menerapkan gaya validasi form bootstrap saat terjadi eror
function apply_feedback_error(textbox){
    $(textbox).addClass('no-valid'); //menambah class no valid
    $(textbox).parent().find('.text-danger').show();
    $(textbox).parent().find('.text-info').show();
    $(textbox).closest('div').removeClass('has-success');
    $(textbox).closest('div').addClass('has-warning');
    $(textbox).parent().find('.form-control-feedback').removeClass('glyphicon glyphicon-ok');
    $(textbox).parent().find('.form-control-feedback').addClass('glyphicon glyphicon-warning-sign'); 
}

//untuk mendapat eror teks saat textbox kosong, digunakan saat submit form dan blur fungsi
function get_error_text(textbox){
    $(textbox).parent().find('.text-danger').text("");
    $(textbox).parent().find('.text-danger').text("*Tidak Boleh Kosong");  
    $(textbox).parent().find('.form-control').addClass("is-invalid");  
    return apply_feedback_error(textbox);
}

//untuk mendapat eror teks saat textbox kosong, digunakan saat submit form dan blur fungsi
});
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Data Akun</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('keagenan'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Data Akun</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item"><a class="nav-link active" href="#edit-akun" data-toggle="tab">Edit
                                        Akun</a></li>
                                <li class="nav-item"><a class="nav-link" href="#ganti-password" data-toggle="tab">Ganti
                                        Password</a></li>
                            </ul>
                        </div>


                        <div class="tab-content">
                            <div class="active tab-pane row" id="edit-akun">
                                <form method="post" action="<?= base_url('update/update_user_agen') ?>" enctype="multipart/form-data">
                                    <div class="card-body row">
                                        <div class="col-lg-6 col-md-6">

                                            <input type="hidden" name="id" id="id" value="<?= $users['id'] ?>">

                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" id="nama" name="nama" value="<?= $users['nama'] ?>"
                                                    placeholder="Nama Lengkap" value="<?= set_value('nama') ?>" require>
                                            </div>

                                            <div class="form-group">
                                                <label>Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $users['email'] ?>" require>
                                                <input type="hidden" id="email1" name="email1" value="<?= $users['email'] ?>">
                                            </div>

                                            <div class="form-group">
                                                <label>Nomor Hp</label>
                                                <input type="number" class="form-control" id="no_hp" name="no_hp"
                                                    placeholder="Nomor Telepon" value="<?= $users['no_hp'] ?>" require>
                                            </div>

                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select class="form-control" id="prov" name="prov">
                                                    <option value="">- Pilih Provinsi -</option>
                                                    <?php foreach ($prov as $v) : ?>
                                                    <option <?php if($users['prov'] == $v['id_prov']) : ?>selected<?php endif ?> value="<?= $v['id_prov'] ?>"><?= $v['nama'] ?></option>
                                                    <?php endforeach ?>
                                                </select>
                                            </div>

                                            <?php $kota = $this->db->get_where('kabupaten', ['id_kab' => $users['kab']])->row_array(); ?>
                                            <div class="form-group">
                                                <label>Kota</label>
                                                <select class="form-control" id="kab" name="kab">
                                                    <option value="<?= $users['kab'] ?>"><?= $kota['nama_kab'] ?></option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select class="form-control" id="kec" name="kec">
                                                    <option value="<?= $users['kec'] ?>"><?= $users['kec'] ?></option>
                                                </select>
                                            </div>

                                        </div>

                                        <div class="col-lg-6 col-md-6">

                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea type="text" rows="4" class="form-control" id="alamat"
                                                    name="alamat"
                                                    placeholder="Alamat Lengkap"><?= $users['alamat'] ?></textarea>
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Rekening</label>
                                                <input type="text" class="form-control" id="nama_rek" name="nama_rek"
                                                    placeholder="Nama Rekening" value="<?= $users['nama_rek'] ?>"
                                                    require>
                                            </div>

                                            <div class="form-group">
                                                <label>Nomor Rekening</label>
                                                <input type="number" class="form-control" id="nomor_rek" name="nomor_rek"
                                                    placeholder="Nomor Rekening" value="<?= $users['no_rek'] ?>"
                                                    require>
                                            </div>

                                            <div class="form-group">
                                                <label>Nama Bank</label>
                                                <select class="form-control" id="bank" name="bank">
                                                    <option value="">- Pilih Bank -</option>
                                                    <option <?php if($users['nama_bank'] == 'BRI') : ?>selected<?php endif ?> value="BRI">Bank BRI</option>
                                                    <option <?php if($users['nama_bank'] == 'BCA') : ?>selected<?php endif ?> value="BCA">Bank BCA</option>
                                                    <option <?php if($users['nama_bank'] == 'BNI') : ?>selected<?php endif ?> value="BNI">Bank BNI</option>
                                                    <option <?php if($users['nama_bank'] == 'MANDIRI') : ?>selected<?php endif ?> value="MANDIRI">Bank MANDIRI</option>
                                                    <option <?php if($users['nama_bank'] == 'LAINNYA') : ?>selected<?php endif ?> value="LAINNYA">LAINNYA</option>
                                                </select>
                                            </div>

                                        </div>
                                        
                                    </div>   
                                    <div class="card-footer">

                                    <button type="button" id="update" class="btn btn-primary btn-block"><i class="fa fa-redo"></i> Simpan Data</button>
                                            <input hidden type="submit" id="submit_u">
                                    </div> 
                                </form>  

                            </div>


                            <div class="tab-pane row" id="ganti-password">
                                <div class="card-body col-md-6">

                                        <div class="form-group form-box">
                                            <label>Password </label>
                                            <div class="input-group" onchange="onChanges()">
                                                <div class="input-group-prepend">
                                                    <div onclick="myFunction()" class="input-group-text pointer"><i id="icon" class="fa fa-eye-slash"></i></div>
                                                </div>
                                                <input type="password" class="form-control active" onchange="onChanges()" id="password" name="password" placeholder="Password" value="" require>
                                            </div>
                                            <small class="text-danger font-13 pull-left font-weight-bold" ></small>
                                            
                                        </div>
                                        <div class="form-group form-box">
                                            <label>Password Baru</label>
                                            <input type="password" class="form-control" id="password_new<?= $users['id'] ?>" onchange="onChanges()" name="password_new" placeholder="Password baru" value="" require>
                                            <small class="text-danger font-13 pull-left font-weight-bold" ></small>
                                            
                                        </div>
                                        <div class="form-group form-box">
                                            <label>Ulangi Password Baru</label>
                                            <input type="password" class="form-control" id="password_ulang" name="password_ulang" placeholder="Ulangi password baru" value="" onchange="onChanges()" require>
                                            <small class="text-danger font-13 pull-left font-weight-bold" ></small>
                                            
                                        </div>
                                       
                                        <button id="submit" class="btn btn-primary" onclick="updatePassword('<?= $users['id'] ?>');"><b><i class="fa fa-redo"></i> Update Password</b></button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>

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

<script type="text/javascript">
$("#update").on('click', function(){
    var nama   = $("#nama").val();
    var email   = $("#email").val();
    var email1   = $("#email1").val();
    var no_hp   = $("#no_hp").val();
    var prov   = $("#prov").val();
    var kab   = $("#kab").val();
    var kec   = $("#kec").val();
    var alamat   = $("#alamat").val();
    
    if(nama =='' || email =='' || no_hp =='' || prov =='' || kab =='' || kec =='' || alamat ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'warning',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
        
    $.ajax({
            url: "<?= base_url('get/get_email/edit'); ?>",
            type: "POST",
            data: {"email":email, "email1":email1},
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
    }
});

</script>


<script type="text/javascript">
function updatePassword(id) {

   if($('#password_new<?= $users['id'] ?>').val() == ''){
        Swal.fire({
            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
            icon: 'error',
            title: 'Gagal!',
            text: 'Kolom Password baru tidak boleh kosong.'
        })
   }else if($('#password_ulang').val() == ''){
        Swal.fire({
            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
            icon: 'error',
            title: 'Gagal!',
            text: 'Kolom Ulangi password baru tidak boleh kosong.'
        })
   }else if($('#password_new<?= $users['id'] ?>').val() !== $('#password_ulang').val()){
        Swal.fire({
            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
            icon: 'error',
            title: 'Gagal!',
            text: 'Password tidak sama.'
        })
   }else{

        var password = $('#password').val();
        var email = $('#email').val();
        var password_new = $('#password_new' + id).val();
        var password_ulang = $('#password_ulang').val();
             
        $.ajax({
            url: "<?= base_url('get/get_password/user'); ?>",
            type: "POST",
            data: {"id": id, "password":password},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'error',
                            title: 'Gagal!',
                            text: 'Password lama tidak sesuai.'
                        })
                    }else{
                        $.ajax({
                            url: "<?= base_url('update/password/user'); ?>",
                            method: "POST",
                            data: {"id": id, "password_ulang":password_ulang},
                            success: function (data) {
                                Swal.fire({
                                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                                    icon: 'success',
                                    title: 'Terupdate!',
                                    text: 'Data password berhasil di update.'
                                }).then(function(isConfirm) {
                                    location.reload();
                                });
                            }
                        });
                    }
                }
        });
    }
}

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
        input.setAttribute('type', 'password');
        icon.className = 'fa fa-eye-slash';
        input.className = 'form-control';

    } else {
        input.setAttribute('type', 'text');
        icon.className = 'fa fa-eye';
        input.className = 'active form-control';
    }

}
</script>