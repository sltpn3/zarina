
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('keagenan'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">

          <div class="col-lg-3 col-6">
            <div class="small-box bg-primary">
              <div class="inner">
                <h3><b><?= number_format($users['point'], 0, ',', '.') ?></b></h3>
                
                <p>Reward Point</p>
              </div>
              <div class="icon">
                <i class="fas fa-coins"></i>
              </div>
              <a href="<?= base_url('keagenan/reward_point'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $sum_order ?></h3>

                <p>Orderan Pending</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('keagenan/data_order'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $sum_tot_order ?></h3>

                <p>Total Orderan </p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('keagenan/data_order'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= number_format($sum_pembelian->total, 0, ',', '.') ?></h3>

                <p>Total Pembelian</p>
              </div>
              <div class="icon">
                <i class="ion ion-cash"></i>
              </div>
              <a href="<?= base_url('keagenan/laporan'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
     
          <section class="col-lg-5 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Riwayat Pembelian Terakhir</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>ID Order</th>
                      <th>Qty</th>
                      <th>Subtotal</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <?php $no = 1;
                  foreach($orderan as $p) : ?>
                  <?php $this->db->select_sum('qty');
                   $sum_qty = $this->db->get_where('order_detail', ['idorder' => $p['idorder']])->row_array(); ?>
                  <?php 
                  if($p['status'] == 'Pending'){
                    $status = 'btn-warning';
                  }else if($p['status'] == 'Selesai'){
                    $status = 'btn-success';
                  }else if($p['status'] == 'Canceled'){
                    $status = 'btn-danger';
                  }
                  ?>
                    <tr>
                      <td><?= $no ?>.</td>
                      <td><b>#<?= $p['idorder'] ?></b></td>
                      <td><?= $sum_qty['qty'] ?></td>
                      <td>Rp. <?= number_format($p['total'], 0, ',', '.') ?>,-</td>
                      <td><a href="<?= base_url('keagenan/detail_order/'.$p['idorder']) ?>" class="btn btn-sm <?= $status ?>"><?= $p['status'] ?></a></td>
                    </tr>
                  <?php $no++; endforeach ?>
                
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
               
              </div>
            </div>
            <!-- /.card -->
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-7 connectedSortable">

              <!-- PIE CHART -->
            <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Laporan Pembelian Tahun <?php echo date('Y'); ?>
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
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- right col -->

        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<script type="text/javascript">
$(function() {

    /* Chart.js Charts */
    // Sales chart
    var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
    // $('#revenue-chart').get(0).getContext('2d');
    <?php foreach ($grafik_agen as $data1) {
    $bulanan_agen[] = (float) $data1->total;
    }
     ?>
    var salesChartData = {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'Total',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: true,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: <?= json_encode($bulanan_agen); ?>
        }
    ]
    }

 
    var salesChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
            display: false
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
                  min: 0,
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
              return datasetLabel + ' : ' + tooltipItem.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
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
        type: 'bar',
        data: salesChartData,
        options: salesChartOptions
    })

})
</script>