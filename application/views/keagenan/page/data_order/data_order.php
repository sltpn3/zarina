
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Order</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('keagenan'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Order</li>
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
                <h3 class="card-title">Data Semua Order</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>ID Order</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $no = 1; 
                  foreach ($orderan as $d) : ?>
                  <?php $this->db->select_sum('qty');
                   $sum_qty = $this->db->get_where('order_detail', ['idorder' => $d['idorder']])->row(); ?>
                  <?php 
                  if($d['status'] == 'Pending'){
                    $status = 'btn-warning';
                  }else if($d['status'] == 'Selesai'){
                    $status = 'btn-success';
                  }else if($d['status'] == 'Canceled'){
                    $status = 'btn-danger';
                  }
                  ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $d['idorder'] ?></td>
                      <td><?= $sum_qty->qty ?></td>
                      <td>Rp. <?= number_format($d['total'], 0, ',', '.') ?></td>
                      <td><?= mediumdate_indo(date($d['orderdate'])); ?> - <?= $d['time'] ?></td>
                      <td>
                        <button class="btn btn-sm <?= $status ?>" disabled><?= $d['status'] ?></button>
                      </td>
                      <td>
                        <a href="<?= base_url('keagenan/detail_order/' . $d['idorder']) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a> 
                      </td>
                    </tr>
                  <?php $no++;
                   endforeach ?>

                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>