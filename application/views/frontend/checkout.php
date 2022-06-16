<style type="text/css">
.checkout {
    max-width: 100%;
}
.checkout__header {
    display: flex;
    -ms-align-items: flex-start;
    align-items: flex-start;
    padding: 30px 30px 45px;
    background: #fff;
    border-top-right-radius: 5px;
    border-top-left-radius: 5px;
}
.checkout__logo-wrapper {
    flex: 1 0 40%;
}
.checkout__logo {
    display: block;
    width: 50px;
    height: auto;
    margin-left: 15px;
}
.checkout__header-info {
    flex: 1 0 50%;
}
.checkout__date,
.checkout__ref {
    display: block;
    font-size: 15px;
    color: #262626;
    font-weight: 300;
}
.checkout__date {
    margin-bottom: 5px;
}
.checkout__subheader-wrapper {
    background: #fff;
    padding-bottom: 20px;
}
.checkout__subheader {
    padding: 0 45px 0 40px;
    border-left: 5px solid #00b300;
}
.checkout__subheader_warning {
    padding: 0 45px 0 40px;
    border-left: 5px solid #fbfa00;
}
.checkout__username {
    margin: 0 0 10px 0;
    font-size: 19px;
    font-weight: 600;
}
.checkout__help-text {
    color: #262626;
    font-weight: 300;
}
.checkout__cart {
    display: block;
    padding: 5px 5px 45px;
}
.checkout__cart-title {
    display: block;
    margin-top: 0;
    margin-bottom: 10px;
    text-align: center;
}
.checkout__cart-list {
    margin: 0;
    padding: 0 15px;
    list-style: none;
}
.checkout__cart-item {
    display: block;
    padding-top: 20px;
    margin-bottom: 20px;
    border-top: 2px dashed #aaa;
    font-size: 16px;
}
.checkout__cart-item:first-child {
    border-top: 0;
}
.checkout__cart-item:last-child {
    margin-bottom: 0;
    border-top: 2px solid #FFE155;
}
.checkout__index {
    padding-right: 15px;
    color: #aaa;
    font-weight: 300;
}
.checkout__item-name {
    color: #666666;
    font-weight: 300;
}
.checkout__item-price {
    float: right;
    letter-spacing: 1px;
}
.checkout__cart-total {
    font-size: 20px;
    text-transform: uppercase;
}
.checkout__footer {
    position: relative;
    padding: 30px 20px;
    border-top: 2px dashed #FF84A1;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
}
.checkout__footer::before,
.checkout__footer::after {
    content: '';
    position: absolute;
    top: 0;
    border: 4px solid transparent;
    -webkit-transform: translateY(calc(-50% - 1px));
    -ms-transform: translateY(calc(-50% - 1px));
    -o-transform: translateY(calc(-50% - 1px));
    transform: translateY(calc(-50% - 1px));
}
.checkout__footer::before {
    left: 0;
    border-left: 7px solid #ff85a1;
}
.checkout__footer::after {
    right: 0;
    border-right: 7px solid #ff85a1;
}
.checkout__barcode {
    display: block;
    margin: 0 auto;
    max-width: 300px;
    height: auto;
}
/**
 * checkout Animations
 */
@keyframes show-checkout {
    0% {
        opacity: 0;
        transform: scale(0) translateX(-50%);
    }
    85% {
        opacity: 0;
    }
    100% {
        opacity: 1;
        transform: scale(1) translateX(-50%);
    }
}
.checkout {
    transform-origin: top left;
    animation: show-checkout 1s ease-out forwards;
}
@keyframes show-subheader {
    0% {
        opacity: 0;
        transform: scale(0);
    }
    65% {
        opacity: 0;
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}
.checkout__subheader {
    opacity: 0;
    animation: show-subheader 1s 0.5s ease-out forwards;
}
@keyframes slide-down {
    to {
        transform: perspective(100px) rotateX(0) translate3d(0, 0, 0);
    }
}
.checkout__cart {
    background-color: #fff;
    transform-style: preserve-3d;
    transform-origin: top center;
    transform: perspective(100px) rotateX(-90deg) translate3d(0, 0, 0);
    animation: slide-down 0.4s 2s ease-out forwards;
}
.checkout__footer {
    background-color: #fff;
    transform-style: preserve-3d;
    transform-origin: top center;
    transform: perspective(100px) rotateX(-90deg) translate3d(0, 0, 0);
    animation: slide-down 0.4s 2.5s ease-out forwards;
}
@keyframes show-cart-title {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.checkout__cart-title {
    opacity: 0;
    transform: translateY(10px);
    animation: show-cart-title 0.5s 2.25s ease-in forwards;
}
@keyframes show-cart-item {
    to {
        opacity: 1;
        transform: translateX(0);
    }
}
.checkout__cart-item {
    opacity: 0;
    transform: translateX(-30px);
    animation: show-cart-item 0.3s 2.75s ease-in forwards;
}
.checkout__cart-item:nth-child(2) {
    animation-delay: 2.9s;
}
.checkout__cart-item:nth-child(3) {
    animation-delay: 3.05s;
}
.checkout__cart-item:nth-child(4) {
    animation-delay: 3.2s;
}
.checkout__cart-item:nth-child(5) {
    animation-delay: 3.2s;
}
.checkout__cart-item:nth-child(6) {
    animation-delay: 3.2s;
}
.checkout__cart-item:nth-child(7) {
    animation-delay: 3.2s;
}
/* end chechout */    
</style>
<main id="main">

    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url('home'); ?>">Home</a></li>
                <li><a href="#">Orderan Checkout</a></li>
            </ol>
            <h2>Checkout</h2>

        </div>
    </section><!-- End Breadcrumbs -->
    <section class="inner-page">
        <div class="container" style="padding-left:3px;padding-right:3px">

            <div class="container-fluid">

<?php if(!empty($orderan)) : ?>
    
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                               
                                <div class="row mt-3 mb-4">
                                    <div class="col-md-6 mb-3">
                                        <img src="<?= base_url('assets/') ?>img/<?= $web['logo']; ?>" alt="Tsabita Halal Bakery" style="height: 70px;width: 150px;">
                                    </div>
                                    <?php 
                                        if($orderan->status == 'Pending'){
                                            $status = 'btn-warning';
                                        }else if($orderan->status == 'Selesai'){
                                            $status = 'btn-success';
                                        }else if($orderan->status == 'Canceled'){
                                            $status = 'btn-danger';
                                        }
                                    ?>
                                    <div class="col-md-6">
                                        <span class="checkout__date"><?= longdate_indo(date($orderan->orderdate)); ?></span>
                                        <span class="checkout__ref">ID Order : <b><?= $orderan->idorder ?></b></span>
                                        <span class="checkout__ref float-right">
                                            <button class="btn btn-sm <?= $status ?>" disabled><b><?= $orderan->status ?></b></button></span>
                                    </div>
                                </div>

<?php if($orderan->status == 'Pending') : ?>


                                <div class="checkout__subheader-wrapper">
                                    <div class="checkout__subheader">
                                        <h1 class="checkout__username"> Hi, <?= $users->nama ?></h1>
                                        <span class="checkout__help-text">Order Anda Berhasil di buat, Silahkan Cek kembali sebelum Anda melakukan Pemabayaran.</span>
                                        <br>
                                    </div>
                                </div>

                                <div class="checkout__subheader-wrapper">
                                    <div class="checkout__subheader_warning">
                                        <span class="checkout__help-text">
                                             Simpan ID order anda, Apabila melakukan pembayaran di lain waktu. <br />
                                                <div class="input-group mb-3 col-sm-4 mt-3">
                                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2" id="copy_text" value="<?= $orderan->idorder ?>" readonly>
                                                    <div class="input-group-append">
                                                        <button class="input-group-text btn btn-primary" id="basic-addon2" onclick="copyText()"><i class="bx bx-copy"></i></button>
                                                    </div>
                                                </div>
                                        </span>
                                        <br>
                                    </div>
                                </div>

                                <div class="checkout__cart">
                                    <h2 class="checkout__cart-title">Detail Pembelian :</h2>

                                    <ul class="checkout__cart-list">

                                        <table class="table table-border">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama</th>
                                                    <th>Harga</th>
                                                    <th>Qty</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php $no=1; $sum=0; foreach($order_detail as $d): ?>
                                            <?php $sum += $d->subtotal; ?>
                                            <?php $prod = $this->db->get_where('produk', ['id' => $d->idproduk])->row(); ?>

                                                <tr>
                                                    <td weight="50"><?= $no; ?></td>
                                                    <td><?= $prod->nama ?> </td>
                                                    <td>Rp. <?= number_format($d->harga, 0, ',', '.') ?></td>
                                                    <td><center><?= $d->qty ?></center></td>
                                                    <td>Rp. <?= number_format($d->subtotal, 0, ',', '.') ?></td>
                                                </tr>

                                            <?php $no++; endforeach ?>
                                            </tbody>
                                        </table>

                                        <li class="checkout__cart-item">
                                            <span class="checkout__cart-total">Total yang harus dibayar</span>
                                            <h4 class="checkout__item-price">
                                                <b>Rp. <?= number_format($sum, 0, ',', '.') ?>,-</b>
                                            </h4>
                                        </li>
                                    </ul>
                                </div>

                                <div class="checkout__footer">
                                    <h6 class="text-center font-weight-bold p-b-10">Silahkan melakukan pembayaran dengan Transfer ke rekening <br>Bank di bawah ini</h6>
                                    <div class="row mt-3 mb-4">
                                        <div class="col-md-12">
                                            <table class="table table-bordered mb-3">
                                                <thead class=" bg-secondary">
                                                    <tr>
                                                        <td colspan="2" class="text-white text-center">
                                                        <b><?= $data_bank->bank ?></b>
                                                        </td>
                                                    </tr>
                                                </thead>
                                            
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <b>Nama Rekening</b>
                                                        </td>
                                                        <td>
                                                            <b>Nomor Rekening</b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                        <?= $data_bank->nama ?>
                                                        </td>
                                                        <td>
                                                        <?= $data_bank->no_rek ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <form method="post" action="<?= base_url('update/konfirmasi_checkout/'.$orderan->idorder) ?>" enctype="multipart/form-data">
                                        <div class="form-group row col-md-12">
                                            <div class="col-sm-12">
                                                <label for="">Upload Bukti Transfer</label>
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

                                        <div class="p-t-20 row mt-5" id="btn-confirm">
                                            <div class="col-md-6 mb-3">
                                                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#modalPayment" onclick="Batal('<?= $orderan->idorder ?>');">Batal Pembayaran</button>
                                            </div>
                                            <div class="col-md-6">
                                                <input type="hidden" name="idorder" id="idorder" value="<?= $orderan->idorder ?>">
                                                <button type="button" id="konfirmasi" class="btn btn-success btn-block" data-toggle="modal" data-target="#modalPayment">Konfirmasi Pembayaran</button>
                                                <input hidden type="submit" id="submit">
                                            </div>
                                        </div>
                                    </form>
<?php endif ?>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                </div>
<?php endif ?>                
            </div>
        </div>
    </section>

</main>
<script type="text/javascript">
function copyText(){
    var copy = $('#copy_text').val();
    $('#copy_text').select();
    document.execCommand('copy');

    Swal.fire({
        icon: 'success',
        title: 'ID Order berhasil di copy.',
        text: copy,
        showConfirmButton: false,
        timer: 3000
    });
}
</script>
<script type="text/javascript">
$("#konfirmasi").on('click', function(){
    var gambar   = $("#imgInp").val();
    var idorder   = $("#idorder").val();
        
    if(gambar ==''){
        Swal.fire({
                confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                icon: 'info',
                title: 'Oops!',
                text: 'Silahkan upload bukti transfer dahulu.'
        });
            die;
    } else {
    swal.fire({
            title: "Yakin ingin konfirmasi orderan?",
            icon: "warning",
            showCancelButton: true,
            // confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='bx bx-check'></i> Konfirmasi",
            cancelButtonText: "<i class='bx bx-undo'></i> Batal",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                swal.fire({
                    title: "Terkonfirmasi!",
                    text: 'Berhasil konfirmasi orderan.',
                    icon: 'success',
                    confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                }).then(function(isConfirm) {
                    $('#submit').trigger('click');
                });
            } else {
                swal.fire({
                    title: "Membatalkan!",
                    icon: 'error',
                    confirmButtonText: '<i class="bx bxs-like"></i> Oke!',
                });
            }
        });
    }
});


function Batal(id) {
    swal.fire({
            title: "Yakin ingin membatalkan orderan?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DC3545",
            confirmButtonText: "<i class='bx bx-check'></i> Batalkan",
            cancelButtonText: "<i class='bx bx-undo'></i> Close",
            closeOnConfirm: false,
            closeOnCancel: false
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: "<?php echo base_url('update/batal_order'); ?>",
                    method: "GET",
                    data:"idorder="+id,
                    success: function (data) {
                        swal.fire({
                            title: "Membatalkan!",
                            text: 'Berhasil membatalkan orderan.',
                            icon: 'success',
                            confirmButtonText: "<i class='bx bxs-like'></i> Oke!",
                        }).then(function(isConfirm) {
                            location.reload();
                        });
                    }
                });
            } 
        });
    }
</script>
<script type="text/javascript">
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