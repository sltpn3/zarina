<style>

.display-flex {
	display: flex;
}

.product-count .qtyminus,
.product-count .qtyplus {
	width: 34px;
    height: 34px;
    background: #007660;
    text-align: center;
    font-size: 19px;
    line-height: 36px;
    color: #fff;
    cursor: pointer;
}
.product-count .qtyminus {
	border-radius: 3px 0 0 3px;
}
.product-count .qtyplus {
	border-radius: 0 3px 3px 0; 
}
.product-count .qty {
	width: 60px;
	text-align: center;
}
.product-count .btn-ungu{
    background: #007660;
    padding: 7px 45px;
    display: inline-block;
    transition: all 0.5s ease-in-out 0s;
}

</style>
<main id="main">

    <section class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="<?= base_url('home'); ?>">Home</a></li>
                <li><a href="#">Produk</a></li>
            </ol>
            <h2>Detail Produk</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
        <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-8">
                        <div class="portfolio-details-slider swiper-container">
                            <div class="swiper-wrapper align-items-center">

                                <div class="swiper-slide">
                                    <img src="<?= base_url('assets/'); ?>img/produk/<?= $produk->img; ?>" alt="">
                                </div>

                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="portfolio-description">
                            <h2><?= ucwords($produk->nama); ?></h2>
                            <p>
                                <?= $produk->deskripsi; ?>
                            </p>
                        </div>
                        <div class="portfolio-info mt-5">
                            <h4>Informasi Produk</h4>
                            
                            <ul>
                                <li><strong>Harga</strong>: <?= number_format($produk->harga, 0, ',', '.'); ?></li>
                                <li><strong>SKU</strong>: <?= $produk->sku; ?></li>
                            
                                
                                <li class="mt-4">
                                <div class="product-count">
                                    <?= form_open_multipart('orderan/'.$produk->slug); ?>
                                        <div class="form-group display-flex">
                                            <div class="qtyminus">-</div>
                                                <input type="text" name="qty" value="1" class="qty">
                                            <div class="qtyplus">+</div>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success btn-ungu"><i class="bx bxs-cart-alt"></i> Beli Produk</button> 
                                        </div>
                                    <?= form_close() ?>
                                </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>.

        </div>
    </section><!-- End Portfolio Details Section -->

</main><!-- End #main -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".qtyminus").on("click",function(){
            var now = $(".qty").val();
            if ($.isNumeric(now)){
                if (parseInt(now) -1> 0)
                { now--;}
                $(".qty").val(now);
            }
        })            
        $(".qtyplus").on("click",function(){
            var now = $(".qty").val();
            if ($.isNumeric(now)){
                $(".qty").val(parseInt(now)+1);
            }
        });
    });
</script>