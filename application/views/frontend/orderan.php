
<main id="main">

<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="<?= base_url('home'); ?>">Home</a></li>
            <li><a href="#"> Keagenan</a></li>
        </ol>
        <h2>Form Checkout</h2>

    </div>
</section><!-- End Breadcrumbs -->

<?php if(!empty($qty)) : ?>
<section class="inner-page">
        <div class="container" style="padding-left:3px;padding-right:3px">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-info"><i class="fa fa-list-alt fa-fw"></i> <b>Data Penerima Produk</b></h5>
                            </div>
                            <div class="card-body">

                            <form method="post" action="<?= base_url('orderan/checkout') ?>" enctype="multipart/form-data">

                                <div class="row">
                                    <div class="col-md-6">
                                      
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>" require>
                                            <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" require>
                                            <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Nomor Hp</label>
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" placeholder="Nomor Telepon" value="<?= set_value('no_hp') ?>" require>
                                            <?= form_error('no_hp', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Provinsi</label>
                                            <select class="form-control" id="prov" name="prov">
                                                <option>- Pilih Provinsi -</option>
                                                <?php foreach ($prov as $v) : ?>
                                                    <option value="<?= $v['id_prov'] ?>"><?= $v['nama'] ?></option>
                                                <?php endforeach ?>
                                            </select>
                                            <?= form_error('prov', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Kota</label>
                                            <select class="form-control" id="kab" name="kab">
                                                <option>- Pilih provinsi dahulu -</option>
                                            </select>
                                            <?= form_error('kab', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Kecamatan</label>
                                            <select class="form-control" id="kec" name="kec">
                                                <option>- Pilih kabupaten dahulu -</option>
                                            </select>
                                            <?= form_error('kec', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <textarea type="text" rows="4" class="form-control" id="alamat" name="alamat" placeholder="Alamat Lengkap"><?= set_value('alamat') ?></textarea>
                                            <?= form_error('alamat', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                    <div class="card shadow mb-3">

                                        
                                        <div class="card-body">
                                            <?php foreach ($produk as $d) : ?> 
                                                
                                                <div class="form-group row">
                                                    <div class="col-sm-3">
                                                        <img src="<?= base_url('assets/') ?>img/produk/<?= $d['img'] ?>" style="height:100px;width:200px;" class="img-thumbnail">
                                                    </div>
                                                    <div class="col-sm-9">
                                                        <b><?= $d['nama'] ?></b>
                                                        <p><?= $d['sku'] ?></p>
                                                        <p>Rp.<?= number_format($d['harga'], 0, ',', '.'); ?>,-/Paket</p>
                                                    </div>
                                                </div>

                                                <input type="hidden" name="idproduk" value="<?= $d['id'] ?>">
                                                <input type="hidden" name="harga" value="<?= $d['harga'] ?>">
                                                
                                            <?php endforeach ?>

                                            <div class="form-group row mt-5">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                            <tr>
                                                                <td><div class="mt-2 font-weight-bold"> Qty </div></td>
                                                                <td><input type="text" class="form-control" id="qty" value="<?= $qty ?>" disabled></td>
                                                            </tr>
                                                            <tr>
                                                                <td><div class="mt-2 font-weight-bold"> Total </div></td>
                                                                <td><input type="text" class="form-control" id="total" value="Rp.<?= number_format($qty*$d['harga'], 0, ',', '.'); ?>,-" disabled></td>
                                                            </tr>
                                                    </tbody>
                                                </table>

                                                <input type="hidden" name="qtyy" value="<?= $qty ?>">
                                                <input type="hidden" name="total" value="<?= $qty*$d['harga'] ?>">
                                            </div>

                                        </div>

                                    </div>

                                        <div class="form-group">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-university fa-fw"></i> Data Pembayaran</h6>
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <div class="form-group">
                                                        <label>Nama Rekening</label>
                                                        <input type="text" class="form-control" id="nama_rek" name="nama_rek" placeholder="Nama Rekening" require>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nomor Rekening</label>
                                                        <input type="number" class="form-control" id="nomor_rek" name="nomor_rek" placeholder="Nomor Rekening" value="<?= set_value('nomor_rek') ?>" require>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Metode Pembayaran</label>
                                                        <select class="form-control" id="bank" name="bank">
                                                            <option value="">- Pilih Bank -</option>
                                                        <?php foreach ($data_bank as $v) : ?>
                                                            <option value="<?= $v['bank'] ?>"><?= $v['bank'] ?></option>
                                                        <?php endforeach ?>
                                                        </select>
                                                    </div>      

                                                </div>
                                            </div>
                                        </div>
                                          
                                    </div>
                                </div>

                                <div class="pt-3 form-group row">
                                    <div class="col-md-12">
                                        <button type="button" id="simpan" class="btn-block btn btn-info">Lanjut Checkout</button>
                                        <input hidden type="submit" id="submit">
                                    </div>
                                </div>

                            </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->


        </div>
    </section>
<?php endif ?>

</main><!-- End #main -->


<script type="text/javascript">
$("#simpan").on('click', function(){
    var nama   = $("#nama").val();
    var email   = $("#email").val();
    var no_hp   = $("#no_hp").val();
    var prov   = $("#prov").val();
    var kab   = $("#kab").val();
    var kec   = $("#kec").val();
    var alamat   = $("#alamat").val();
    var bank   = $("#bank").val();

    if(nama =='' || email =='' || no_hp =='' || prov =='' || kab =='' || kec =='' || alamat =='' || bank ==''){
        Swal.fire({
                confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
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
                            confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'Email ini sudah di gunakan.'
                        })
                    }
                }
        });

    swal.fire({
            title: "Yakin ingin membuat pesanan?",
            text: 'Silahkan cek kembali data anda dengan benar.',
            icon: "info",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='bx bx-check'></i> Buat Pesanan",
            cancelButtonText: "<i class='bx bx-undo'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil membuat pesanan.',
                    icon: 'success',
                    confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit').trigger('click');
                });
            } 
        });
    }
});

</script>

<script type="text/javascript">
    var input = document.getElementById('password'),
        icon = document.getElementById('icon');

    icon.onclick = function() {

        if (input.className == 'active form-control') {
            input.setAttribute('type', 'text');
            icon.className = 'bx bx-show';
            input.className = 'form-control';

        } else {
            input.setAttribute('type', 'password');
            icon.className = 'bx bx-hide';
            input.className = 'active form-control';
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