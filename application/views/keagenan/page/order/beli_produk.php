
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Repeat Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('keagenan'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Repeat Order</li>
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
                    <h3 class="card-title">Repeat Order</h3>
                </div>
              <!-- /.card-header -->
            
            <form method="post" action="<?= base_url('tambah/repeat_order') ?>" enctype="multipart/form-data">  
              
                <div class="card-body row">
                    <div class="col-md-6">

                    <div class="card shadow mb-3">
                        <div class="card-body">

                            <?php foreach ($paket_agen as $dd) : ?>
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
                                                    <p><i class="fa fa-eye"></i> Rp.<?= number_format($get_max->harga, 0, ',', '.'); ?>,-/Paket</p>
                                                </a>
                                                
                                                <input type="hidden" id="idproduk[]" name="idproduk[]" value="<?= $d['id'] ?>">
                                                <input type="hidden" id="harga<?= $d['id'] ?>" value="<?= $get_max->harga ?>">
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
                                        <?php foreach ($paket_agen as $dd) : ?>
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

                    </div>

                    <div class="col-md-6">
                            <?= $keagenan->informasi ?>
                    </div>
              
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    <input type="hidden" name="iduser" id="iduser" value="<?= $users->id ?>">
                    <button class="btn btn-primary" type="button" id="buatOrder"><i class="fa fa-check"></i> Proses Pembelian</button>
                    <input hidden type="submit" id="submit">
                </div>

            </form>
                
            </div>
            <!-- /.card -->
                </div>
            </div>

            <?php foreach ($paket_agen as $dd) : ?>
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
                                            <td colspan="2">
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
    </section>
</div>

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
 $("#buatOrder").on('click', function(){
    var total_qty = $('#total_qty').val();

    if(total_qty < <?= $keagenan->repeat_order ?>){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Minimal repeat order adalah <?= $keagenan->repeat_order ?> produk.'
        });
            die;
        } else {
        swal.fire({
            title: "Yakin ingin membuat repeat order?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Buat Pesanan",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil membuat repeat order.',
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