
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Data Gallery</li>
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
                <h3 class="card-title">Data Semua Gallery</h3>
                <div class="card-tools">
                    <a href="#" class="btn btn-default" data-toggle="modal" data-target="#modal-tambah"><i
                            class="fa fa-plus"></i> Tambah Gallery</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Gambar</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>

                  <?php $no=1; foreach($gallery as $d) : ?>
                    <tr>
                      <td width="80"><?= $no ?></td>
                      <td>
                          <a href="#" data-toggle="modal" data-target="#modal-img<?= $d['id'] ?>">
                            <img src="<?= base_url('assets/img/gallery/' . $d['img']) ?>" class="img-fluid img-thumbnail" alt="<?= $d['nama'] ?>" width="50" height="50"/>
                          </a>
                      </td>
                      <td><?= $d['nama'] ?></td>
                      <td><?= mediumdate_indo(date($d['tgl'])); ?> </td>
                      <td width="150">
                        <?php if($d['status'] == 'on') : ?>
                        <button class="btn btn-sm btn-success">Aktif</button>
                        <?php elseif($d['status'] == 'off') : ?>
                        <button class="btn btn-sm btn-danger">Nonaktif</button>
                        <?php endif ?>
                      </td>
                      <td width="200">
                        <button class="btn btn-xs btn-success" data-toggle="modal" data-target="#modal-edit<?= $d['id'] ?>"><i class="fa fa-edit"></i> Edit</button>
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

        
          <?php foreach ($gallery as $d) : ?>

            <div class="modal fade" id="modal-edit<?= $d['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Gallery</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('update/gallery') ?>" enctype="multipart/form-data">
                            <div class="modal-body">
                                <input type="hidden" id="id" name="id" value="<?= $d['id'] ?>">
                                <div class="form-group row col-md-6">
                                    <div class="col-sm-12">
                                        <label for="">Gambar</label>
                                    </div>
                                    <div class="col-md-3">
                                        <img src="<?= base_url('assets/') ?>img/gallery/<?= $d['img'] ?>" width="100" height="85" id="preview<?= $d['id'] ?>" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <input hidden type="file" name="gambar" class="file<?= $d['id'] ?>" accept="image/*" id="imgInp<?= $d['id'] ?>">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Pilih Gambar" id="file<?= $d['id'] ?>">
                                            <div class="input-group-append">
                                                <button type="button" class="browse<?= $d['id'] ?> btn btn-primary">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" name="nama" value="<?= $d['nama'] ?>"
                                        placeholder="Nama" require>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option>- Pilih Status -</option>
                                        <option <?php if($d['status'] == 'on') : ?>selected<?php endif ?> value="on">Aktif</option>
                                        <option <?php if($d['status'] == 'off') : ?>selected<?php endif ?> value="off">Nonaktif</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Batal</button>
                                <button type="submit" id="update" class="btn btn-primary"><i class="fa fa-check"></i> Simpan Data</button>
                                <input hidden type="submit" id="submit_u">
                            </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->


            <div class="modal fade" id="modal-img<?= $d['id'] ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title"><?= $d['nama'] ?></h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                          <img src="<?= base_url('assets/img/gallery/' . $d['img']) ?>" style="display:block;width:100%;height:100%;object-fit:cover;" class="img-fluid" alt="<?= $d['nama'] ?>"/>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

          <?php endforeach ?>


            <div class="modal fade" id="modal-tambah">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Gallery</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form method="post" action="<?= base_url('tambah/gallery') ?>" enctype="multipart/form-data">
                            <div class="modal-body">

                                <div class="form-group row col-md-6">
                                    <div class="col-sm-12">
                                        <label for="">Gambar</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <img src="" width="100" height="85" id="preview" class="img-thumbnail">
                                    </div>
                                    <div class="col-sm-9">
                                        <input hidden type="file" name="gambar" class="file" accept="image/*" id="imgInp">
                                        <div class="input-group my-3">
                                            <input type="text" class="form-control" disabled placeholder="Pilih Gambar" id="file">
                                            <div class="input-group-append">
                                                <button type="button" class="browse btn btn-primary">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama" require>
                                    <?= form_error('nama', '<small class="text-danger pl-3">', ' </small>') ?>
                                </div>

                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" id="status" name="status">
                                        <option>- Pilih Status -</option>
                                        <option value="on">Aktif</option>
                                        <option value="off">Nonaktif</option>
                                    </select>
                                    <?= form_error('status', '<small class="text-danger pl-3">', ' </small>') ?>
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
    var status   = $("#status").val();
    var gambar   = $("#imgInp").val();
        
    if(nama =='' || status =='' || gambar ==''){
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
                    $('#submit_u').trigger('click');
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
                    url: "<?php echo base_url('hapus/gallery'); ?>",
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

<script type="text/javascript">
<?php foreach ($gallery as $d) : ?>
$(document).on("click", ".browse<?= $d['id'] ?>", function() {
    var file = $(this).parents().find(".file<?= $d['id'] ?>");
    file.trigger("click");
});


$('#imgInp<?= $d['id'] ?>').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file<?= $d['id'] ?>").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview<?= $d['id'] ?>").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
<?php endforeach ?>

$(document).on("click", ".browse", function() {
    var file = $(this).parents().find(".file");
    file.trigger("click");
});

$('#imgInp').change(function(e) {
    var fileName = e.target.files[0].name;
    $("#file").val(fileName);

    var reader = new FileReader();
    reader.onload = function(e) {
        // get loaded data and render thumbnail.
        document.getElementById("preview").src = e.target.result;
    };
    // read the image file as a data URL.
    reader.readAsDataURL(this.files[0]);
});
</script>