
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Detail Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('keagenan'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Detail Order</li>
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

            <!-- <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
            </div> -->


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> <?= $web['nama'] ?>.
                    <div class="card-tools float-right">
                        <a href="<?= base_url('keagenan/data_order') ?>" class="btn btn-default"><i class="fa fa-list"></i> Data Order</a>
                    </div>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-md-6 invoice-col">
                  <address>
                    <strong><?= $user['nama'] ?>.</strong><br>
                    <?= $user['alamat'] ?><br>
                    Telepon: <?= $user['no_hp'] ?><br>
                    Email: <?= $user['email'] ?>
                  </address>
                </div>
                <!-- /.col -->
               
                <!-- /.col -->
                <div class="col-md-6 invoice-col">
                  <b>Invoice : </b> <?= $order['idorder']; ?><br>
                  <b>Tanggal Order : </b> <?= mediumdate_indo(date($order['orderdate'])); ?><br>
                  <b>Waktu Order : </b> <?= $order['time'] ?>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">

                <div class="col-md-4 table-responsive">
                  <table class="table table-bordered">
                    <thead class="bg-secondary">
                    <tr>
                      <th colspan="2">Detail Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td>Nama Rekening</td>
                      <td><?= $user['nama_rek'] ?></td>
                    </tr>
                    <tr>
                      <td>Nomor Rekening</td>
                      <td><?= $user['no_rek'] ?></td>
                    </tr>
                    <tr>
                      <td>Nama Bank</td>
                      <td><?= $user['nama_bank'] ?></td>
                    </tr>
                    
                    <tr>
                      <td width="200px">Bukti Transfer</td>
                      <td>
                        <?php if(empty($order['bukti_tf'])) : ?>
                          <b>Belum Membayar</b>
                        <?php else : ?>
                          <div class="col-sm-2">
                            <a href="#" data-toggle="modal" data-target="#modal-img">
                              <img src="<?= base_url('assets/img/bukti-tf/' . $order['bukti_tf']) ?>" class="img-fluid img-thumbnail" alt="Bukti Transfer"/>
                            </a>
                          </div>
                        <?php endif ?> 
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                
                <div class="col-md-8 table-responsive">
                  <table class="table table-bordered">
                    <thead class="bg-secondary">
                    <tr>
                      <th>#</th>
                      <th>SKU</th>
                      <th>Produk</th>
                      <th>Harga</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $no = 1; $sum = 0; 
                    foreach($order_detail as $d) : ?>
                    <?php $sum += $d['subtotal']; ?>
                    <?php $prod = $this->db->get_where('produk', ['id' => $d['idproduk']])->row_array(); ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $prod['sku'] ?></td>
                      <td><?= $prod['nama'] ?></td>
                      <td><?= number_format($d['harga'], 0, ',', '.'); ?></td>
                      <td><?= $d['qty'] ?></td>
                      <td><?= number_format($d['subtotal'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php $no++; endforeach ?>

                    </tbody>
                  </table>
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6 mt-2">
                  <?php if($order['status'] == 'Pending'): ?>
                    <form method="post" action="<?= base_url('update/konfirmasi_checkout/keagenan') ?>" enctype="multipart/form-data">
                        <div class="form-group row col-md-6">
                            <div class="col-sm-12">
                                <label for="">Kirim ulang bukti transfer</label>
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
                        <div class="col-md-3">
                            <input type="hidden" name="idorder" id="idorder" value="<?= $order['idorder'] ?>">
                            <button type="button" id="kirim" class="btn btn-primary btn-block" data-toggle="modal" data-target="#modalPayment">Kirim <i class="fa fa-paper-plane"></i></button>
                            <input hidden type="submit" id="submit">
                        </div>
                    </form>

                    <?php endif ?>
                </div>

                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Jumlah yang harus dibayar.</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>Rp. <?= number_format($sum, 0, ',', '.') ?>,-</td>
                      </tr>

                      <tr>
                        <th>Pengiriman:</th>
                        <td>Rp. <?= number_format($order['ongkir'], 0, ',', '.') ?>,-</td>
                      </tr>

                      <tr>
                        <th>Total:</th>
                        <td><b class="text-danger h5">Rp. <?= number_format($sum + $order['ongkir'], 0, ',', '.') ?>,-</b></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="<?= base_url('cetak_invoice?idorder='.$order['idorder']); ?>" rel="noopener" target="_blank" class="btn btn-default" type="button" id="print"><i class="fas fa-print"></i> Print</a>
                  <input type="hidden" id="idorder" name="idorder" value="<?= $order['idorder'] ?>">
                  <?php if($order['status'] == 'Pending') : ?>
                    <button type="button" class="btn btn-warning float-right" disabled><i class="fa fa-clock"></i> Pending</button>
                  <?php elseif($order['status'] == 'Selesai') : ?>
                    <button type="button" class="btn btn-success float-right" disabled><i class="fa fa-thumbs-up"></i> Selesai</button>
                  <?php elseif($order['status'] == 'Canceled') : ?>
                    <button type="button" class="btn btn-danger float-right" disabled><i class="fa fa-times"></i> Canceled</button>
                  <?php endif ?>
                </div>
              </div>

            </div>
            <!-- /.invoice -->


            <!-- /.card -->
                </div>
            </div>


            <div class="modal fade" id="modal-img">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Bukti Transfer</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <img src="<?= base_url('assets/img/bukti-tf/' . $order['bukti_tf']) ?>" style="display:block;width:100%;height:100%;object-fit:cover;" class="img-fluid" alt="Bukti Transfer"/>
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
$("#kirim").on('click', function(){
    var gambar   = $("#imgInp").val();
    var idorder   = $("#idorder").val();
        
    if(gambar ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Silahkan pilih gambar dahulu.'
        });
            die;
    } else {
    swal.fire({
            title: "Yakin ingin mengirim ulang bukti transfer?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Kirim",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Terkirim!",
                    text: 'Berhasil mengirim ulang bukti transfer.',
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