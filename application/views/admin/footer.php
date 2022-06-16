    <!-- Footer -->
      <footer class="main-footer">
          <strong>Copyright &copy; <?= date('Y') ?> <a target="_blank"
                  href="<?= base_url('/') ?>"><?= $web['nama'] ?></a>.</strong> All rights reserved.
          <div class="float-right d-none d-sm-inline-block">
              <b>Version</b> 3.1.0
          </div>
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
      </div>
      <!-- ./wrapper -->

      <!-- jQuery -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/jquery/jquery.min.js"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
      <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
      <script>
        $.widget.bridge('uibutton', $.ui.button)
      </script>
      <!-- Bootstrap 4 -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
      <!-- ChartJS -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/chart.js/Chart.min.js"></script>
      <!-- Sparkline -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/sparklines/sparkline.js"></script>
      <!-- JQVMap -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
      <!-- jQuery Knob Chart -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
      <!-- daterangepicker -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/moment/moment.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
      <!-- Tempusdominus Bootstrap 4 -->
      <script
          src="<?= base_url('assets/adminlte/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js">
      </script>
      <!-- Summernote -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
      <!-- overlayScrollbars -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js">
      </script>
      <!-- AdminLTE App -->
      <script src="<?= base_url('assets/adminlte/'); ?>dist/js/adminlte.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="<?= base_url('assets/adminlte/'); ?>dist/js/demo.js"></script>

      <!-- DataTables  & Plugins -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js">
      </script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js">
      </script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js">
      </script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js">
      </script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/jszip/jszip.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      <!-- bs-custom-file-input -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js">
      </script>
      <!-- Bootstrap Switch -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
      <!-- SweetAlert2 -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
      <!-- Toastr -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/toastr/toastr.min.js"></script>
      <!-- Select2 -->
      <script src="<?= base_url('assets/adminlte/'); ?>plugins/select2/js/select2.full.min.js"></script>




<?php if($this->session->flashdata('message') == 'login'): ?>
    <script type="text/javascript">
        Swal.fire({
            confirmButtonText: "Oke!",
            icon: "success",
            title: "Berhasil!",
            text: "Anda berhasil login ke dashboard."
            });
    </script>
<?php elseif($this->session->flashdata('tersimpan')): ?>
    <script type="text/javascript">
        Swal.fire({
            confirmButtonText: "Oke!",
            icon: "success",
            title: "Berhasil!",
            text: "Berhasil menyimpan perubahan data."
            });
    </script>
<?php elseif($this->session->flashdata('terkirim')): ?>
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
    $(function() {
        //Add text editor
        $('#compose-textarea').summernote()
        $('.select2').select2()

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })

    });
</script>
<script type="text/javascript">
function Logout() {
        swal.fire({
            title: "Keluar dari dashboard?",
            icon: 'info',
            confirmButtonText: "Oke!",
            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            cancelButtonText: "<i class='fa fa-times'></i> Batal",
            confirmButtonText: "<i class='fa fa-sign-out-alt'></i> Keluar",
            closeOnCancel: true,
            closeOnConfirm: true
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Keluar!",
                    text: 'Anda Berhasil keluar.',
                    icon: 'success',
                    confirmButtonText: "Oke!",
                }).then(function(isConfirm) {
                    window.location.href = "<?= base_url('auth/logout/admin') ?>";
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: "Oke!",
                });
            }
        });
    }
</script>

<script type="text/javascript">
$(function() {
    $("input[data-bootstrap-switch]").each(function() {
        $(this).bootstrapSwitch('state', $(this).prop('checked'));
    })
    bsCustomFileInput.init();
  
    $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["excel", "pdf", "print"],
        buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: <?= json_encode($columns) ?>
                    },

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: <?= json_encode($columns) ?>
                    },

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: <?= json_encode($columns) ?>
                    },
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' );
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                },
            ],
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
    });
});
</script>

      </body>

      </html>