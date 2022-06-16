
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Paket Keagenan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Paket Keagenan</li>
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
                <h3 class="card-title">Data Keagenan</h3>
                <div class="card-tools">
                    <a href="<?= base_url('tambah/paket_keagenan') ?>" class="btn btn-default"><i class="fa fa-plus"></i> Tambah Paket</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                      <tr>
                          <th>#</th>
                          <th>Keagenan</th>
                          <th>Informasi</th>
                          <th>Aksi</th>
                      </tr>
                  </thead>
                  <tbody>

                    <?php $no=1; foreach($keagenan as $d) : ?>
                      <tr>
                          <td><?= $no ?></td>
                          <td><?= $d['nama'] ?></td>
                          <td><?= $d['informasi'] ?></td>
                          <td width="200">
                            <a href="<?= base_url('update/paket_keagenan/'.$d['slug']) ?>" class="btn btn-sm btn-success">
                              <i class="fas fa-pencil-alt"></i> Edit
                            </a>
                            <a href="#" class="btn btn-sm btn-danger" onclick="Hapus('<?= $d['id'] ?>');">
                              <i class="fas fa-trash"></i> Hapus
                            </a>
                          </td>
                      </tr>
                    <?php $no++; endforeach ?>
                     
                  </tbody>
                 
              </table>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>


          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Paket Keagenan</h3>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body row">

              <?php foreach ($keagenan as $d) : ?>
                <div class="col-md-4 d-flex">
                  <div class="card bg-light d-flex flex-fill">

                  <?php if($d['promo'] == 'on') : ?>
                    <div class="ribbon-wrapper">
                      <div class="ribbon bg-primary">
                        Promo
                      </div>
                    </div>
                  <?php endif ?>

                    <div class="card-header text-muted border-bottom-0">
                      <?= $d['nama'] ?>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-12">
                          <h2 class="lead pb-3 pt-2"><b><sup>Rp</sup><?= substr($d['harga'], 0, 3); ?>K<span> / paket</span></b></h2>
                          <?= $d['deskripsi'] ?>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                </div>
                <?php endforeach ?>


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
                    url: "<?php echo base_url('hapus/paket_keagenan'); ?>",
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


