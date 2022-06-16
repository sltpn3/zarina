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
        var pass = $("#password_new<?= $admin['id'] ?>").val();
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
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
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
                <div class="col-md-4">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                    src="<?= base_url('assets/'); ?>img/admin/<?= $admin['img'] ?>"
                                    alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $admin['nama'] ?></h3>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right"><?= $admin['email'] ?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Nomor HP</b> <a class="float-right"><?= $admin['no_hp'] ?></a>
                                </li>
                                <br />
                                <button class="btn btn-primary btn-block" onclick="Logout();"><b><i class="fa fa-sign-out-alt"></i> Logout</b></button>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-8">

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
                            <div class="active tab-pane" id="edit-akun">

                                <!-- /.card-header -->

                                <div class="card-body">
                                    <form method="post" action="<?= base_url('update/akun') ?>" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= $admin['nama'] ?>" require>
                                            <input type="hidden" id="id" name="id" value="<?= $admin['id'] ?>">
                                            <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $admin['email'] ?>" require>
                                            <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Hp</label>
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor Telepon" value="<?= $admin['no_hp'] ?>" require>
                                            <?= form_error('no_hp', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group row col-md-6">
                                            <div class="col-sm-12">
                                                <label for="">Foto Admin</label>
                                            </div>
                                            <div class="col-sm-3">
                                                <img src="<?= base_url("assets/img/admin/" . $admin['img']) ?>" width="100" height="85" id="preview" class="img-thumbnail">
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
                                        <button type="button" id="update" class="btn btn-primary btn-block"><i class="fa fa-redo"></i> Simpan Data</button>
                                        <input hidden type="submit" id="submit_u">
                                    </form>    
                                </div>

                            </div>


                            <div class="tab-pane" id="ganti-password">
                                <div class="card-body">

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
                                            <input type="password" class="form-control" id="password_new<?= $admin['id'] ?>" onchange="onChanges()" name="password_new" placeholder="Password baru" value="" require>
                                            <small class="text-danger font-13 pull-left font-weight-bold" ></small>
                                            
                                        </div>
                                        <div class="form-group form-box">
                                            <label>Ulangi Password Baru</label>
                                            <input type="password" class="form-control" id="password_ulang" name="password_ulang" placeholder="Ulangi password baru" value="" onchange="onChanges()" require>
                                            <small class="text-danger font-13 pull-left font-weight-bold" ></small>
                                            
                                        </div>
                                       
                                        <button id="submit" class="btn btn-primary btn-block" onclick="updatePassword('<?= $admin['id'] ?>');"><b><i class="fa fa-redo"></i> Update Password</b></button>
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
</script>

<script type="text/javascript">
function updatePassword(id) {

   if($('#password_new<?= $admin['id'] ?>').val() == ''){
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
   }else if($('#password_new<?= $admin['id'] ?>').val() !== $('#password_ulang').val()){
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
                
        var valid = false;
        $.ajax({
            url: "<?= base_url('get/get_password'); ?>",
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
                            url: "<?= base_url('update/password'); ?>",
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
<script type="text/javascript">
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