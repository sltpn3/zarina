<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Email Sender</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin'); ?>">Home</a></li>
                        <li class="breadcrumb-item active">Email Sender</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Update Email Sender</h6>
                        </div>
                        <div class="card-body">

                            <?php foreach ($email_sender as $d) : ?>

                                <form action="<?= base_url('admin/email_sender') ?>" method="post">
                                    <div class="body">
                                        <input type="hidden" name="id" id="id" value="<?= $d['id'] ?>">

                                        <div class="form-group row">
                                            <label>Protocol</label>
                                            <input type="text" class="form-control" id="protocol" name="protocol" placeholder="Protocol" value="<?= $d['protocol'] ?>" />
                                        </div>

                                        <div class="form-group row">
                                            <label>Host</label>
                                            <input type="text" class="form-control" id="host" name="host" placeholder="Host" value="<?= $d['host'] ?>" />
                                        </div>

                                        <div class="form-group row">
                                            <label>Port</label>
                                            <input type="text" class="form-control" id="port" name="port" placeholder="Port" value="<?= $d['port'] ?>" />
                                        </div>

                                        <div class="form-group row">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= $d['email'] ?>" />
                                        </div>

                                        <div class="form-group row">
                                            <label>Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= $d['password'] ?>" />
                                        </div>

                                        <div class="form-group row">
                                            <label>Charset</label>
                                            <input type="text" class="form-control" id="charset" name="charset" placeholder="Charset" value="<?= $d['charset'] ?>" />
                                        </div>

                                    </div>

                                    <div class="pt-3 form-group row">
                                        <label></label>
                                        <button onclick="return confirm('Lanjutkan Simpan Data?');" type="submit" class="btn btn-block btn-primary">Simpan</button>
                                    </div>
                                </form>

                            <?php endforeach ?>

                        </div>
                    </div>
                  
                    <!-- /.card -->
                </div>
                <div class="col-md-6">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-cogs fa-fw"></i> Test Email Sender</h6>
                        </div>
                        <div class="card-body">
                            
                            <form action="<?= base_url('admin/test_email_sender') ?>" method="post">
                                <div class="body">

                                    <div class="form-group">
                                        <label>Email Penerima</label>
                                        <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label>Subjek</label>
                                        <input type="text" class="form-control" id="subjek" name="subjek" placeholder="Subjek" value="<?= set_value('subjek') ?>" />
                                    </div>

                                    <div class="form-group">
                                        <label for="pesan">Isi Pesan</label>
                                        <textarea name="pesan" id="compose-textarea"><?= set_value('pesan') ?></textarea>
                                    </div>

                                </div>

                                <div class="pt-3 form-group">
                                    <label></label>
                                    <button onclick="return confirm('Lanjutkan Kirim Pesan?');" type="submit" class="btn btn-block btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
                                </div>
                            </form>
                        </div>

                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
</div>


