
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
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
                        <?php if($this->uri->segment(4) == 'keagenan'): ?>
                          <a href="<?= base_url('admin/data_order_keagenan') ?>" class="btn btn-default"><i class="fa fa-list"></i> Data Order Keagenan</a>
                        <?php else : ?>
                          <a href="<?= base_url('admin/data_order') ?>" class="btn btn-default"><i class="fa fa-list"></i> Data Order</a>
                        <?php endif ?>
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
                <div class="col-6 mt-5">
                  <p class="lead">Informasi :</p>

                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                  <i>Harap di perhatikan cek terlebih dahulu data orderan dengan benar sebelum konfirmasi orderan.<br>
                    Terutama untuk cek bukti tranfer terlebih dahulu.</i>
                  </p>
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
                        <button type="button" class="btn btn-primary float-right" id="simpan"><i class="fa fa-check"></i> Konfirmasi</button>
                      <?php elseif($order['status'] == 'Selesai') : ?>
                        <button type="button" class="btn btn-success float-right" disabled><i class="fa fa-thumbs-up"></i> Selesai</button>
                        <button type="button" class="btn btn-danger float-right mr-3" id="batal"><i class="fa fa-times"></i> Batalkan</button>
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
$("#simpan").on('click', function(){
  var idorder   = $("#idorder").val();
swal.fire({
        title: "Yakin ingin mengkonfirmasi data?",
        icon: "info",
        showCancelButton: true,
        // confirmButtonColor: "#DC3545",
        confirmButtonText: "<i class='fa fa-check'></i> Konfirmasi",
        cancelButtonText: "<i class='fa fa-times'></i> Batal",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function (result) {
        if (result.value) {
          $.ajax({
            url: "<?= base_url('update/konfirmasi_order'); ?>",
            method: "POST",
            data: {"idorder":idorder},
            success: function (data) {
                Swal.fire({
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                    icon: 'success',
                    title: 'Terkonfirmasi!',
                    text: 'Berhasil mengkonfirmasi data.'
                }).then(function(isConfirm) {
                  location.reload();
                });
            }
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

$("#batal").on('click', function(){
  var idorder   = $("#idorder").val();
swal.fire({
        title: "Yakin ingin membatalkan konfirmasi order?",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#DC3545",
        confirmButtonText: "<i class='fa fa-check'></i> Batalkan",
        cancelButtonText: "<i class='fa fa-times'></i> Batal",
        closeOnConfirm: false,
        closeOnCancel: false
    }).then(function (result) {
        if (result.value) {
          $.ajax({
            url: "<?= base_url('update/batal_konfirmasi'); ?>",
            method: "POST",
            data: {"idorder":idorder},
            success: function (data) {
                Swal.fire({
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                    icon: 'success',
                    title: 'Batal Konfirmasi!',
                    text: 'Berhasil membatalkan konfirmasi order.'
                }).then(function(isConfirm) {
                  location.reload();
                });
            }
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