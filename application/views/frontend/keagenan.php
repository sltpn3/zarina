
<main id="main">

<section class="breadcrumbs">
    <div class="container">

        <ol>
            <li><a href="<?= base_url('home'); ?>">Home</a></li>
            <li><a href="#"> Keagenan</a></li>
        </ol>
        <h2>Pendaftaran <?= $keagenan['nama'] ?></h2>

    </div>
</section><!-- End Breadcrumbs -->


<section class="inner-page">
        <div class="container" style="padding-left:3px;padding-right:3px">

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-info"><i class="fa fa-list-alt fa-fw"></i> <b>Form Pendaftaran</b></h5>
                            </div>
                            <div class="card-body">

                                <?= form_open_multipart('paket_keagenan/pendaftaran'); ?>
                                <div class="row">
                                    <div class="col-md-6">
                                      
                                        <div class="form-group">
                                            <label>Nama Lengkap</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" value="<?= set_value('nama') ?>" require>
                                            <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="Nomor NIK" value="<?= set_value('nik') ?>" require>
                                            <?= form_error('nik', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" require>
                                            <?= form_error('email', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>

                                        <div class="form-group form-box">
                                            <label>Password </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div onclick="myFunction()" class="input-group-text pointer"><i id="icon" class="bx bx-show"></i></div>
                                                </div>
                                                <input type="text" class="active form-control" id="password" name="password" placeholder="Password" require>
                                            </div>
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

                                        <div class="form-group">
                                            <label>Nomor Referensi</label>
                                            <input type="text" class="form-control" id="no_ref" name="no_ref" placeholder="Nomor Referensi" value="<?= set_value('nama') ?>" require>
                                            <?= form_error('no_ref', '<small class="text-danger pl-3">', ' </small>') ?>
                                        </div>



                                        <div class="form-group">
                                            <div class="card shadow mb-4">
                                                <div class="card-header py-3">
                                                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-university fa-fw"></i> Data Pembayaran</h6>
                                                </div>
                                                <div class="card-body">
                                                    
                                                    <div class="form-group">
                                                        <label>Nama Rekening</label>
                                                        <input type="text" class="form-control" id="nama_rek" name="nama_rek" placeholder="Nama Rekening" value="<?= set_value('nama_rek') ?>" require>
                                                        <?= form_error('nama_rek', '<small class="text-danger pl-3">', ' </small>') ?>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Nomor Rekening</label>
                                                        <input type="number" class="form-control" id="nomor_rek" name="nomor_rek" placeholder="Nomor Rekening" value="<?= set_value('nomor_rek') ?>" require>
                                                        <?= form_error('nomor_rek', '<small class="text-danger pl-3">', ' </small>') ?>
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

                                    <div class="col-md-6">

                                        <div class="card shadow mb-3">
                                            <div class="card-body">
                                                <?php foreach ($produk as $dd) : ?>
                                                <?php $d = $this->db->get_where('produk', ['id' => $dd['id_produk']])->row_array(); ?>  
                                                <?php $harga_paket = $this->db->get_where('harga_paket', ['fk_agen' => $dd['fk_agen'], 'id_produk' => $d['id']])->result(); ?>   
                                                <?php $this->db->select_max('harga');
                                                      $get_max = $this->db->get_where('harga_paket', ['fk_agen' => $dd['fk_agen'], 'id_produk' => $d['id']])->row(); ?> 

                                                            <div class="form-group row">
                                                                <div class="col-sm-3">
                                                                    <img src="<?= base_url('assets/') ?>img/produk/<?= $d['img'] ?>" style="height:100px;width:200px;" class="img-thumbnail">
                                                                </div>
                                                                <div class="col-sm-9">
                                                                <b><?= $d['nama'] ?></b>
                                                                <a href="#" data-toggle="modal" data-target="#modal-view<?= $d['id'] ?>">
                                                                    <p><i class="bx bx-show"></i> Rp.<?= number_format($get_max->harga, 0, ',', '.'); ?>,-/Paket</p>
                                                                </a>

                                                                    <input type="hidden" id="idproduk[]" name="idproduk[]" value="<?= $d['id'] ?>">
                                                                    <input type="hidden" id="harga<?= $d['id'] ?>" class="form-control" value="<?= $get_max->harga ?>">
                                                                    <input type="number" id="jumlah<?= $d['id'] ?>" class="form-control jumlah" name="jumlah[]" placeholder="Jumlah Paket">
                                                                    
                                                                </div>
                                                            </div>
                                                        
                                                            <script type="text/javascript">
                                                                $(document).ready(function() {
                                                                    $("#jumlah<?= $d['id'] ?>, #harga<?= $d['id'] ?>").keyup(function() {

                                                                        var harga<?= $d['id'] ?>  = $("#harga<?= $d['id'] ?>").val();
                                                                        var jumlah<?= $d['id'] ?> = $("#jumlah<?= $d['id'] ?>").val();

                                                                        <?php foreach ($harga_paket as $zz) : ?>

                                                                            if (jumlah<?= $d['id'] ?> < <?= $zz->max + 1 ?>){
                                                                                var total<?= $d['id'] ?> = parseInt(<?= $zz->harga ?>) * parseInt(jumlah<?= $d['id'] ?>);
                                                                                var harga_prod<?= $d['id'] ?> = <?= $zz->harga ?>;
                                                                            }else

                                                                        <?php endforeach ?>

                                                                        <?php $this->db->select_min('min');
                                                                            $get_min = $this->db->get_where('harga_paket', ['fk_agen' => $dd['fk_agen'], 'id_produk' => $d['id']])->row(); ?> 
                                                                        if (jumlah<?= $d['id'] ?> > <?= $get_min->min ?>){
                                                                        var total<?= $d['id'] ?> = parseInt(harga<?= $d['id'] ?>) * parseInt(jumlah<?= $d['id'] ?>);
                                                                        }

                                                                            $("#total<?= $d['id'] ?>").val('Rp ' + total<?= $d['id'] ?>.toLocaleString() + ',-');
                                                                            $("#total_sum<?= $d['id'] ?>").val(total<?= $d['id'] ?>);
                                                                            $("#harga_prod<?= $d['id'] ?>").val(harga_prod<?= $d['id'] ?>);
                                                                    });
                                                                });
                                                            </script>

                                                <?php endforeach ?>
                                
                                                <div class="form-group row mt-5">
                                                    <table class="table table-bordered">
                                                        <tbody>
                                                            <?php foreach ($produk as $dd) : ?>
                                                            <?php $d = $this->db->get_where('produk', ['id' => $dd['id_produk']])->row_array(); ?>      
                                                                <tr>
                                                                    <p id="total"></p>
                                                                    <td><?= $d['nama'] ?></td>
                                                                    <td><input type="text" class="form-control" id="total<?= $d['id'] ?>" placeholder="0" value="" readonly></td>
                                                                </tr>
                                                                <input type="hidden" id="harga_prod<?= $d['id'] ?>" name="harga_prod[]" value="">
                                                                <input type="hidden" class="form-control total" id="total_sum<?= $d['id'] ?>" name="total[]" value="">
                                                            <?php endforeach ?>
                                                            
                                                            <input type="hidden" class="form-control" id="total_qty" name="total_qty" value="">
                                                        </tbody>
                                                    </table>
                                                    <table class="table">
                                                        <tr>
                                                            <td><b class="float-right mt-2">Subtotal</b></td>
                                                            <input type="hidden" id="subtotal2" name="subtotal" value=""> 
                                                            <td class="col-md-7"><input type="text" class="form-control font-weight-bold text-danger" id="subtotal" placeholder="0" value="" readonly></td>
                                                        </tr>
                                                    </table>
                                                </div>


                                            </div>
                                        </div>

                                        <br />
                                        <?= $keagenan['informasi'] ?>
                                          
                                    </div>
                                </div>

                                <div class="pt-3 form-group row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="level" value="<?= $keagenan['id'] ?>">
                                        <button type="button" class="btn-block btn btn-info" id="buatAgen">Kirim Pendaftaran</button>
                                        <input hidden type="submit" id="submit">
                                    </div>
                                    <div class="col-md-12 text-center mt-5">
                                        <p>Sudah mendaftar? <a href="<?= base_url('auth') ?>">Login</a> ke dashboard.</p>
                                    </div>
                                </div>

                                <?php form_close() ?>
                            </div>
                        </div>
                    </div>

                </div>

                            
                        <?php foreach ($produk as $dd) : ?>
                        <?php $d = $this->db->get_where('produk', ['id' => $dd['id_produk']])->row_array(); ?>
                        <?php $harga_paket = $this->db->get_where('harga_paket', ['fk_agen' => $dd['fk_agen'], 'id_produk' => $d['id']])->result(); ?> 
                        <div class="modal fade" id="modal-view<?= $d['id'] ?>">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Detail Harga</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                            <table class="table table-bordered mb-3">
                                                <thead class=" bg-secondary">
                                                    <tr>
                                                        <td colspan="2" class="text-white">
                                                        <?= $d['nama'] ?>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <b>Jumlah Paket</b>
                                                        </td>
                                                        <td>
                                                            <b>Harga</b>
                                                        </td>
                                                    </tr>
                                                    <?php foreach ($harga_paket as $zz) : ?>
                                                        <tr>
                                                            <td>
                                                                <?= $zz->min ?> s/d <?= $zz->max ?>
                                                            </td>
                                                            <td>
                                                                Rp. <?= number_format($zz->harga, 0, ',', '.') ?>,-
                                                            </td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>

                        <?php endforeach ?>

            </div>
            <!-- /.container-fluid -->


        </div>
    </section>


</main><!-- End #main -->


<script type="text/javascript">
    $(document).ready(function() {
        //this calculates values automatically 
        calculateSum();

        $(".jumlah").on("keydown keyup", function() {
            calculateSum();
        });

        $(".total").on("keydown keyup", function() {
            calculateSum();
        });
    });

    function calculateSum() {
        var sum = 0;
        var sum_total = 0;
        //iterate through each textboxes and add the values
        $(".jumlah").each(function() {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                sum += parseFloat(this.value);
            }
        });
        $(".total").each(function() {
            //add only if the value is number
            if (!isNaN(this.value) && this.value.length != 0) {
                sum_total += parseFloat(this.value);
            }
        });

        $("#total_qty").val(sum);
        $("#subtotal").val('Rp ' + sum_total.toLocaleString() + ',-');
        $("#subtotal2").val(sum_total);
    }
</script>

<script type="text/javascript">
 $("#buatAgen").on('click', function(){
    var nama = $('#nama').val();
    var nik = $('#nik').val();
    var no_ref = $('#no_ref').val();
    var email = $('#email').val();
    var password = $('#password').val();
    var no_hp = $('#no_hp').val();
    var prov = $('#prov').val();
    var kab = $('#kab').val();
    var kec = $('#kec').val();
    var alamat = $('#alamat').val();
    var nama_rek = $('#nama_rek').val();
    var nomor_rek = $('#nomor_rek').val();
    var bank = $('#bank').val();
    var total_qty = $('#total_qty').val();

    if(nama == "" || nik == "" || no_ref == "" || email == "" || password == "" || no_hp == "" || prov == "" || kab == "" || kec == "" || alamat == "" || nama_rek == "" || nomor_rek == "" || bank == ""){
        Swal.fire({
                confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                icon: 'warning',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    }else if(total_qty < <?= $keagenan['minimal'] ?>){
          
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

        Swal.fire({
                confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Minimal pembelian adalah <?= $keagenan['minimal'] ?> produk.'
        });
            die;
        } else {
        swal.fire({
            title: "Yakin ingin mendaftar paket keagenan?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='bx bx-check'></i> Mendaftar",
            cancelButtonText: "<i class='bx bx-undo'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil mendaftar paket keagenan.',
                    icon: 'success',
                    confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit').trigger('click');
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
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