
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
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
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $sum_agen ?></h3>

                <p>Orderan Keagenan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= base_url('admin/order_masuk_keagenan'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $sum_order ?></h3>

                <p>Orderan Baru</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= base_url('admin/data_order'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $sum_user ?></h3>

                <p>Total Member </p>
              </div>
              <div class="icon">
                <i class="ion ion-android-people"></i>
              </div>
              <a href="<?= base_url('admin/data_users'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $sum_produk ?></h3>

                <p>Total Produk</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= base_url('admin/data_produk'); ?>" class="small-box-footer">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
     
          <section class="col-lg-7 connectedSortable">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Stok Produk</h3>

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
                      <th>Produk</th>
                      <th>Persentase</th>
                      <th style="width: 40px">Stok</th>
                    </tr>
                  </thead>
                  <tbody>
                    
                  <?php $no = 1; foreach($produk as $p) : ?>

                  <?php 
                    $nilai1 = $p['stok'];
                    $nilai2 = $p['restok'];
                    $persen = round($nilai1/$nilai2*100); ?>

                    <?php if ($persen > 85) {
                        $label = "bg-success";
                    } else if ($persen > 69) {
                        $label = "bg-primary";
                    } else if ($persen > 20) {
                        $label = "bg-warning";
                    } else if ($persen > 0) {
                        $label = "bg-danger";
                    } ?>

                    <tr>
                      <td><?= $no ?>.</td>
                      <td><?= $p['nama'] ?></td>
                      <td>
                        <div class="progress">
                        <div class="progress-bar <?= $label ?>" role="progressbar" style="width: <?= $persen ?>%;" aria-valuenow="<?= $persen ?>" aria-valuemin="0" aria-valuemax="100"><?= $persen ?>%</div>
                        </div>
                      </td>
                      <td><?= $p['stok'] ?></td>
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
          <section class="col-lg-5 connectedSortable">

              <!-- PIE CHART -->
              <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Chart Keagenan</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                 
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 300px; height: 300px; max-height: 300px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </section>
          <!-- right col -->

               <!-- Left col -->
          <section class="col-lg-12 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Data Penjualan Tahun <?php echo date('Y'); ?>
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

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var donutData = {
        labels: [
            'User',
            <?php foreach($keagenan as $p) : ?>
            '<?= $p['nama'] ?>',
            <?php endforeach ?>
        ],
        datasets: [{
          data: [
              <?php $sum_u = $this->db->get_where('user', ['level' => '0'])->num_rows(); ?>
              <?= $sum_u ?>,
              <?php foreach($keagenan as $p) : ?>
              <?php $sum = $this->db->get_where('user', ['level' => $p['id']])->num_rows(); ?>
              <?= $sum ?>,
              <?php endforeach ?>
            ],
            backgroundColor: ['#f56954', '#00a65a', '#f39c12', '#00c0ef'],
        }]
    }

    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData = donutData;
    var pieOptions = {
        maintainAspectRatio: false,
        responsive: true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
        type: 'pie',
        data: pieData,
        options: pieOptions
    })

})
</script>