
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
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
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
                    <th>User</th>
                    <th>Tanggal Order</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $no = 1; 
                  foreach ($orderan as $d) : ?>
                  <?php $user = $this->db->get_where('user', ['id' => $d['iduser']])->row_array(); ?>
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
                      <td><?= !empty($user['nama']) ? $user['nama'] : '- User sudah dihapus -' ?></td>
                      <td><?= mediumdate_indo(date($d['orderdate'])); ?> - <?= date('H:i:s', strtotime($d['time'])) ?></td>
                      <td><button class="btn btn-sm <?= $status ?>"><?= $d['status'] ?></button> </td>
                      <td>
                        <a href="<?= base_url('admin/detail_order/' . $d['idorder']) ?>" class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> Detail</a> 
                        <button class="btn btn-xs btn-danger" onclick="Hapus('<?= $d['idorder'] ?>');"><i class="fa fa-trash"></i> Hapus</button> 
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


<script type="text/javascript">
function Hapus(id) {
    swal.fire({
            title: "Hapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-trash'></i> Hapus",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url('hapus/orderan'); ?>",
                    method: "GET",
                    data:"id="+id,
                    success: function (data) {
                        swal.fire({
                            title: "Terhapus!",
                            text: 'Berhasil menghapus data.',
                            icon: 'success',
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                        }).then(function(isConfirm) {
                            location.reload();
                        });
                    }
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                });
            }
        });
    }
</script>