
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Kontak</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Kontak</li>
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
                <h3 class="card-title">Data Kontak</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Subjek</th>
                    <th width="450">Pesan</th>
                    <th width="110">Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php $no=1; foreach($kontak as $d) : ?>
                    <?php 
                  if($d['status'] == 'Pending'){
                    $status = 'btn-warning';
                    $icon = '<i class="fa fa-clock"></i>';
                  }else if($d['status'] == 'Terbaca'){
                    $status = 'btn-primary';
                    $icon = '<i class="fa fa-eye"></i>';
                  }else if($d['status'] == 'Terbalas'){
                    $status = 'btn-success';
                    $icon = '<i class="fa fa-check"></i>';
                  }
                  ?>
                    <tr>
                      <td width="80"><?= $no ?></td>
                      <td><?= $d['nama'] ?></td>
                      <td><?= $d['email'] ?></td>
                      <td><?= $d['subjek'] ?></td>
                      <td><?= $d['pesan'] ?></td>
                      <td><?= mediumdate_indo(date($d['tgl'])); ?> </td>
                      <td>
                        <button class="btn btn-sm <?= $status ?>" disabled>
                          <?= $icon . ' ' . $d['status'] ?>
                        </button>
                      <?php if($d['status'] == 'Pending'): ?>
                        <button class="btn btn-primary btn-sm" onclick="Baca('<?= $d['id'] ?>');"><i class="fa fa-eye"></i> Sudah baca</button>
                      <?php endif ?>
                      </td>
                      <td width="200">
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-balas<?= $d['id'] ?>"><i class="fa fa-paper-plane"></i> Balas</button>
                        <button class="btn btn-xs btn-danger" onclick="Hapus('<?= $d['id'] ?>');"><i class="fa fa-trash"></i> Hapus</button> 
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
        </div>

        
          <?php foreach ($kontak as $d) : ?>

            <div class="modal fade" id="modal-balas<?= $d['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Balas Kontak</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                       
                            <div class="modal-body">
                                <input type="hidden" id="email" name="email" value="<?= $d['email'] ?>">
                                <input type="hidden" id="subjek" name="subjek" value="<?= $d['subjek'] ?>">

                                <div class="form-group">
                                    <label>Email Penerima</label>
                                    <input type="text" class="form-control" value="<?= $d['email'] ?>" placeholder="Email" disabled>
                                </div>

                                <div class="form-group">
                                    <label>Subjek</label>
                                    <input type="text" class="form-control" name="subjek" value="<?= $d['subjek'] ?>" disabled>
                                </div>

                                <div class="form-group ck-editor__editable_inline">
                                    <label>Pesan</label>
                                    <textarea id="compose-textarea<?= $d['id'] ?>" name="pesan" class="form-control" rows="10"></textarea>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="button" id="kirim<?= $d['id'] ?>" class="btn btn-primary"><i class="fa fa-paper-plane"></i> Kirim</button>
                            </div>
                        

                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <script type="text/javascript">
                $(function() {
                    //Add text editor
                    $('#compose-textarea<?= $d['id'] ?>').summernote()

                });
            </script>
          <?php endforeach ?>

        </div>
    </section>
</div>
<?php if($this->session->flashdata('message') == 'terkirim'): ?>
    <script type="text/javascript">
        Swal.fire({
            confirmButtonText: "Oke!",
            icon: "success",
            title: "Berhasil!",
            text: "Email berhasil terkirim."
            });
    </script>
<?php endif ?>

<script type="text/javascript">

<?php foreach ($kontak as $d) : ?>
  $("#kirim<?= $d['id'] ?>").on('click', function(){
    var pesan = $('#compose-textarea<?= $d['id'] ?>').val();
    var id = '<?= $d['id'] ?>';
        
    if(pesan ==''){
        Swal.fire({
                confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Data belum lengkap.'
        });
            die;
    } else {
        $.ajax({
          url: "<?php echo base_url('update/website'); ?>",
          method: "POST",
          data: {"id": id, "pesan":pesan},
          success: function (data) {
              Swal.fire({
                  confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                  icon: 'success',
                  title: 'Terkirim!',
                  text: 'Pesan email berhasil di kirim.'
              }).then(function(isConfirm) {
                  location.reload();
              });
          }
        });
    }
});
<?php endforeach ?>


function Baca(id) {
  $.ajax({
      url: "<?php echo base_url('update/baca_kontak'); ?>",
      method: "GET",
      data:"id="+id,
      success: function (data) {
          swal.fire({
              title: "Terbaca!",
              text: 'Berhasil membaca pesan.',
              icon: 'success',
              confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
          }).then(function(isConfirm) {
              location.reload();
          });
      }
  });
}

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
                    url: "<?php echo base_url('hapus/kontak'); ?>",
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