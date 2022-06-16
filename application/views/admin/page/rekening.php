
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Rekening</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Rekening</li>
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
                <h3 class="card-title">Data Rekening</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah"><i
                            class="fa fa-plus"></i> Tambah Rekening</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama Rekening</th>
                    <th>Nomor Rekening</th>
                    <th>Nama Bank</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                  <?php $no = 1; 
                  foreach ($rekening as $d) : ?>
                  <?php 
                  if($d->status == 'on'){
                    $status = 'btn-success';
                    $nama_stat = 'Aktif';
                  }else if($d->status == 'off'){
                    $status = 'btn-danger';
                    $nama_stat = 'Nonaktif';
                  }
                  ?>
                    <tr>
                      <td><?= $no ?></td>
                      <td><?= $d->nama ?></td>
                      <td><?= $d->no_rek ?></td>
                      <td><?= $d->bank ?></td>
                      <td><button class="btn btn-sm <?= $status ?>"><?= $nama_stat ?></button> </td>
                      <td>
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-edit<?= $d->id ?>"><i class="fa fa-edit"></i> Edit</button>
                        <button class="btn btn-xs btn-danger" onclick="Hapus('<?= $d->id ?>');"><i class="fa fa-trash"></i> Hapus</button> 
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

          <?php foreach ($rekening as $d) : ?>
            <div class="modal fade" id="modal-edit<?= $d->id ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Rekening</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('update/rekening') ?>" enctype="multipart/form-data">
                            <div class="modal-body">

                                <input type="hidden" name="id" value="<?= $d->id ?>">
                                <div class="form-group">
                                    <label>Nama Rekening</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Rekening" value="<?= $d->nama ?>" require>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="number" class="form-control" id="no_rek" name="no_rek" placeholder="Nomor Rekening" value="<?= $d->no_rek ?>" require>
                                </div>
                             
                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control" id="bank" name="bank" placeholder="Nama Bank" value="<?= $d->bank ?>" require>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option>- Pilih Status -</option>
                                        <option <?php if($d->status == 'on') : ?>selected<?php endif ?> value="on">Aktif</option>
                                        <option <?php if($d->status == 'off') : ?>selected<?php endif ?> value="off">Nonaktif</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="button" id="update" class="btn btn-primary"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit2">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          <?php endforeach ?>


            <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Rekening</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('tambah/rekening') ?>" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Nama Rekening</label>
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Rekening" require>
                                </div>

                                <div class="form-group">
                                    <label>Nomor Rekening</label>
                                    <input type="number" class="form-control" id="no_rek" name="no_rek" placeholder="Nomor Rekening" require>
                                </div>

                                <div class="form-group">
                                    <label>Nama Bank</label>
                                    <input type="text" class="form-control" id="bank" name="bank" placeholder="Nama Bank" require>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option>- Pilih Status -</option>
                                        <option value="on">Aktif</option>
                                        <option value="off">Nonaktif</option>
                                    </select>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="button" id="simpan" class="btn btn-primary"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

        </div>
    </section>
</div>


<script type="text/javascript">
$("#simpan").on('click', function(){
    var nama   = $("#nama").val();
    var no_rek   = $("#no_rek").val();
    var bank   = $("#bank").val();
    var status   = $("#status").val();
        
    if(nama =='' || no_rek =='' || bank =='' || status ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
    swal.fire({
            title: "Yakin ingin menyimpan data?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Simpan",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil menyimpan data.',
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


$("#update").on('click', function(){
    swal.fire({
            title: "Yakin ingin mengupdate data?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Simpan",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil mengupdate data.',
                    icon: 'success',
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit2').trigger('click');
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
                    url: "<?php echo base_url('hapus/rekening'); ?>",
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