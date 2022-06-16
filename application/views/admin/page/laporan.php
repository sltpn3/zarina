
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Laporan</li>
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
                <h3 class="card-title">Data Laporan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

                <form action="<?= base_url('admin/laporan') ?>" method="post">

                  <div class="form-row">

                      <div class="form-group col-lg-2">
                          <label>Type</label>
                          <select class="form-control" name="type">
                              <option value="">- Semua -</option>
                              <option <?php if($this->input->post('type') == 'Order'): ?>selected<?php endif ?> value="Order">Orderan</option>
                              <option <?php if($this->input->post('type') == 'Agen'): ?>selected<?php endif ?> value="Agen">Keagenan</option>
                          </select>
                      </div>

                      <div class="form-group col-lg-2">
                          <label>Status</label>
                          <select class="form-control" name="status">
                              <option value="">- Semua -</option>
                              <option <?php if($this->input->post('status') == 'Selesai'): ?>selected<?php endif ?> value="Selesai">Selesai</option>
                              <option <?php if($this->input->post('status') == 'Pending'): ?>selected<?php endif ?> value="Pending">Pending</option>
                          </select>
                      </div>

                      <div class="form-group col-lg-2">
                          <label>Tanggal Awal</label>
                          <input type="date" class="form-control" id="tgl_awal" name="tgl_awal" <?php if(!empty($this->input->post('tgl_awal'))): ?>value="<?= $this->input->post('tgl_awal') ?>"<?php endif ?>>
                      </div>
                      
                      <div class="form-group col-lg-2">
                          <label>Tanggal Akhir</label>
                          <input type="date" class="form-control" id="tgl_akhir" name="tgl_akhir" <?php if(!empty($this->input->post('tgl_akhir'))): ?>value="<?= $this->input->post('tgl_akhir') ?>"<?php endif ?>>
                      </div>

                      <div class="form-group col-lg-2">
                          <label>Cetak</label>
                          <button class="btn btn-block btn-secondary" type="submit" name="print" value="print" onclick="this.form.target='_blank';return true;"><i class="fa fa-print" style="font-size:12px"></i> Print</button>
                      </div>

                      <div class="form-group col-lg-2">
                          <label>Submit</label>
                          <button class="btn btn-block btn-primary" type="submit" name="filter" value="filter"><i class="fa fa-filter" style="font-size:12px"></i> Filter</button>
                      </div>

                  </div>

                </form>


                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>ID Order</th>
                    <th>QTY</th>
                    <th>Total</th>
                    <th>Kota</th>
                    <th>Type</th>
                    <th>Level</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php $no=1; foreach($laporan as $d) : ?> 
                  <?php $user =  $this->db->get_where('user', ['id' => $d['iduser']])->row_array();
                  if($user == NULL){
                    $user['kab'] = '';
                    $user['level'] = '';
                    $user['nama'] = '- User telah dihapus -';
                  }else{
                    $user['kab'] = $user['kab'];
                    $user['level'] = $user['level'];
                    $user['nama'] = $user['nama'];
                  }
                  // var_dump($d['iduser']);
                  // die();
                   ?>
                  <?php $kota = $this->db->get_where('kabupaten', ['id_kab' => $user['kab']])->row_array(); 
                  if($kota == NULL){
                    $kota['nama_kab'] = '- Data telah dihapus -';
                  }else{
                    $kota['nama_kab'] = $kota['nama_kab'];
                  }
                  ?>
 
                  <?php $level = $this->db->get_where('keagenan', ['id' => $user['level']])->row_array(); ?>
                  <?php
                    if(empty($level)){
                        $lev = 'User';
                    }else{
                        $lev = $level['nama'];
                    }

                    if ($user['level'] == 4) {
                        $label = "btn-warning";
                    } else if ($user['level'] == 3) {
                        $label = "btn-primary";
                    } else if ($user['level'] == 2) {
                        $label = "btn-info";
                    } else if ($user['level'] == 1) {
                        $label = "btn-success";
                    } else if ($user['level'] == 0) {
                        $label = "btn-secondary";
                    } 

                    if($d['status'] == 'Pending'){
                      $status = 'btn-warning';
                    }else if($d['status'] == 'Selesai'){
                      $status = 'btn-success';
                    }

                    if($user['level'] == 0){
                      $type = 'Orderan';
                    }else{
                      $type = 'Keagenan';
                    }

                    $this->db->select_sum('qty');
                    $qty = $this->db->get_where('order_detail', ['idorder' => $d['idorder']])->row_array();
                    $this->db->select_sum('subtotal');
                    $total = $this->db->get_where('order_detail', ['idorder' => $d['idorder']])->row_array();
                    ?>
                    
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $user['nama'] ?></td>
                      <td><?= $d['idorder'] ?></td>
                      <td><?= $qty['qty'] ?></td>
                      <td>Rp. <?= number_format($total['subtotal'], 0, ',', '.') ?>,-</td>
                      <td><?= $kota['nama_kab'] ?></td>
                      <td><?= $type ?></td>
                      <td><button class="btn btn-xs <?= $label ?> disabled"><?= $lev ?></button></td>
                      <td><?= mediumdate_indo($d['orderdate']); ?> - <?= $d['time'] ?></td>
                      <td><a href="<?= base_url('admin/detail_order/'.$d['idorder']) ?>" class="btn btn-sm <?= $status ?>"><?= $d['status'] ?></a></td>
                    </tr>
                  <?php $no++; endforeach ?>

                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Laporan Penjualan Tahun <?php echo date('Y'); ?>
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 500px;">
                      <canvas id="revenue-chart-canvas" height="500" style="height: 500px;"></canvas>
                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>

        </div>
      </div>
    </section>
</div>


<script type="text/javascript">
$(function() {

    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
    // $('#revenue-chart').get(0).getContext('2d');
    <?php foreach ($grafik_agen as $data1) {
    $bulanan_agen[] = (float) $data1->total;
    }foreach ($grafik_order as $data2) {
    $bulanan_order[] = (float) $data2->total;
    }
     ?>
    var salesChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Keagenan',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: <?= json_encode($bulanan_agen); ?>
        },
      {
        label: 'Orderan',
        backgroundColor: 'rgba(210, 214, 222, 1)',
        borderColor: 'rgba(210, 214, 222, 1)',
        pointRadius: true,
        pointColor: 'rgba(210, 214, 222, 1)',
        pointStrokeColor: '#c1c7d1',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(220,220,220,1)',
        data: <?= json_encode($bulanan_order); ?>
      }
    ]
    }

    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: true
        },
        scales: {
            xAxes: [{
                gridLines: {
                    display: true
                }
            }],
            yAxes: [{
                gridLines: {
                    display: true
                },
                ticks: {
                  beginAtZero: true,
                    callback: function(value) {
                      return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                    }
                    }
            }]
        },
        tooltips: {
          mode: 'index',
          intersect: false,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ' : Rp.' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
          }
        },
        hover: {
            mode: 'nearest',
            intersect: true
        }
    }

    // This will get the first returned node in the jQuery collection.
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
        type: 'line',
        data: salesChartData,
        options: salesChartOptions
    })


})
</script>