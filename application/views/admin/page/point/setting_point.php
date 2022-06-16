
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Setting Point</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Setting Point</li>
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
              <h3 class="card-title">Data Reward Point</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-data"><i class="fa fa-plus"></i> Reward Point</a>
                </div>
                
              </div>
              <!-- /.card-header -->
              <div class="card-body row">

              <?php foreach ($keagenan as $d) : ?>
              <?php     $this->db->order_by('point', 'ASC');
              $reward_point =  $this->db->get_where('reward_point', ['fk_agen' => $d->fk])->result(); ?>
                <div class="col-md-4 d-flex">
                  <div class="card bg-light d-flex flex-fill">
                  <div class="card-header text-muted border-bottom-0">
                      <b><?= $d->nama ?></b>
                      <div class="card-tools">
                    <a href="#" class="btn btn-default" onclick="Hapus(<?= $d->id ?>);"><i class="fa fa-trash"></i></a>
                </div>
                    </div>
                    <div class="card-body pt-0">
                      <div class="form-group">
                        <div class="table-responsive">
                            <table class="table table-md">
                            <tr>
                            <form method="post" action="<?= base_url('tambah/list_point') ?>" enctype="multipart/form-data">
                                <th>
                                <label>Points</label>
                                    <input type="number" name="point" class="form-control" id="point" placeholder="Points">
                                </th>
                                <th>
                                <label>Nilai Rupiah</label>
                                    <input type="number" name="nominal" class="form-control" id="nominal" placeholder="Nilai Rupiah">
                                </th>
                                <th>
                                    <br>
                                    <a class="btn btn-success btn-md mt-2" id="tambahPoint<?= $d->id ?>" style="color:white;"><i class="fas fa-plus"></i></a>
                                </th>
                                <input type="hidden" id="fk" name="fk" value="<?= $d->fk ?>">
                                <input hidden type="submit" id="submit_u<?= $d->id ?>">
                            </form>
                            </tr>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered mb-3">
                        <tbody>
                            <tr>
                                <td>
                                    <b>Points</b>
                                </td>
                                <td>
                                    <b>Nilai Rupiah</b>
                                </td>
                                <td>
                                    <b>Aksi</b>
                                </td>
                            </tr>
                            <?php foreach ($reward_point as $zz) : ?>
                                <tr>
                                    <td>
                                        <?= $zz->point ?>
                                    </td>
                                    <td>
                                        Rp. <?= number_format($zz->nominal, 0, ',', '.') ?>,-
                                    </td>
                                    <td width="50px"><button type ="button" class="btn btn-icon btn-sm btn-danger" onClick="hapusPoint(<?= $zz->id ?>)"><i class="fa fa-trash"></i></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
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

        <div class="modal fade" id="modal-data">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Reward Point</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        
                            <div class="modal-body">

                                <div class="form-group">
                                    <label>Keagenan</label>
                                    <select class="form-control" id="keagenan" name="keagenan">
                                        <option value="">- Pilih Keagenan -</option>
                                        <?php foreach ($data_keagenan as $d) : ?>
                                          <option value="<?= $d->id ?>"><?= $d->nama ?></option>
                                        <?php endforeach ?>
                                    </select>
                                    <?= form_error('role', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button class="btn btn-success" onclick="Tambah();"><i class="fa fa-check"></i> Simpan Data</button>
                            </div>
                        
                    </div>
                
                </div>
            </div>
            <!-- /.modal -->

            </div>
    </section>
</div>

<script type="text/javascript">

function Tambah() {
    var keagenan = $('#keagenan').val();

    if(keagenan ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {

        $.ajax({
            url: "<?= base_url('update/reward_point'); ?>",
            method: "POST",
            data: {"keagenan":keagenan,},
            success: function (data) {
                Swal.fire({
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data reward point berhasil di tambahkan.'
                }).then(function(isConfirm) {
                    location.reload();
                });
            }
        });
    }
}

<?php foreach ($keagenan as $d) : ?>
$("#tambahPoint<?= $d->id ?>").on('click', function(){
    swal.fire({
            title: "Yakin ingin menambah data?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='fa fa-check'></i> Tambah",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Tersimpan!",
                    text: 'Berhasil menambah data.',
                    icon: 'success',
                    confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit_u<?= $d->id ?>').trigger('click');
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
<?php endforeach ?>

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
                    url: "<?php echo base_url('hapus/reward_point'); ?>",
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

function hapusPoint(id) {
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
                    url: "<?php echo base_url('hapus/list_point'); ?>",
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


