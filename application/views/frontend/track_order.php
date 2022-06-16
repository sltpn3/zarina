<main id="main">

    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url('home'); ?>">Home</a></li>
                <li><a href="#">Track Order</a></li>
            </ol>
            <h2>Lacak Orderan</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
        <div class="container" style="padding-left:3px;padding-right:3px">

            <div class="container-fluid">

                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h5 class="m-0 font-weight-bold text-info"><i class="fa fa-list-alt fa-fw"></i> Lacak ID Order</h5>
                            </div>
                            <div class="card-body">
                               
                                <div class="form-group">
                                    <label>ID Order</label>
                                    <input type="number" class="form-control" id="idorder" placeholder="Masukan ID Order" name="idorder">
                                </div>

                               
                                
                            </div>
                            <div class="card-footer">
                                <button type="button" id="lacak" class="btn btn-success btn-block"><i class="bx bx-search"></i> Lacak Orderan</button>     
                            </div>
                        </div>
                    </div>
                </div>             
            </div>
        </div>
    </section>

</main>

<script type="text/javascript">
$("#lacak").on('click', function(){
    var idorder   = $("#idorder").val();
        
    if(idorder ==''){
        Swal.fire({
                confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Silahkan masukan ID Order anda.'
        });
            die;
    } else {
        $.ajax({
            url: "<?= base_url('get/get_idorder'); ?>",
            type: "POST",
            data: {"idorder":idorder},
            dataType: "text",
                success: function(data){
                    if (data==1){ 
                        Swal.fire({
                            confirmButtonText: "<i class='fa fa-thumbs-up'></i> Oke!",
                            icon: 'warning',
                            title: 'Oops!',
                            text: 'ID Order tidak di temukan.'
                        })
                    }else{
                        window.location.href = '<?= base_url('checkout?idorder=') ?>'+idorder;
                    }
                }
        });
    }
});
</script>