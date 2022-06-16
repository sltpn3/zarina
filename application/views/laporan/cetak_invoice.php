<!DOCTYPE html>
<html lang="en">

<head>
    <style type="text/css">
        html {
            font-size: 12px;
            line-height: 1.5;
            color: #000;
            background: #ddd;
        }

        body {
            background: white;
            border: 1px solid #aaa;
            padding: 2rem;
            height: calc(100% - 60px);
            padding-bottom: -50px;
        }

        .col,
        .logoholder,
        .me_img,
        .me,
        .info,
        .bank,
        [class*="col-"] {
            vertical-align: top;
            display: inline-block;
            font-size: 1rem;
            padding: 0 1rem;
            min-height: 1px;
        }

        .col-4 {
            width: 25%;
        }

        .col-3 {
            width: 33.33%;
        }

        .col-2 {
            width: 50%;
        }

        .col-2-4 {
            width: 75%;
        }

        .col-1 {
            width: 100%;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        a {
            color: #F14C4C;
            text-decoration: none;
        }

        p {
            margin:
                0;
        }

        header {
            padding: 0 0 4rem 0;
            border-bottom: 2pt solid #825a2c;
        }

        header p {
            font-size: .9rem;
        }

        header a {
            color: #000;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            /*postion: absolute;*/
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
            padding-bottom: 10px;
        }

        .headline {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #ffffff;
            font-size: 1.5em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 10px 0;
            padding-bottom: 5px;
            background-color: #343a40;
        }

        .logo {
            margin: 0 auto;
            width: auto;
            height:
                auto;
            border: none;
            fill: #F14C4C;
        }

        .logoholder {
            width: 15%;
        }

        .logoholder img {
            width: 100%;
            height: 70px;
            width: 150px;
        }

        .me_img {
            width: 30%;
            margin-top: -10px;
        }

        .me {
            width: 30%;
            margin-top: 15px;
        }
        
        .info {
            width: 30%;
            float: right;
            margin-top: 15px;
            margin-bottom: 3px;
        }

        .bank {
            width: 30%;
        }

        .desc {
            margin-top: 20px;
        }

        .section {
            margin: 3rem 0 0;
        }

        .smallme {
            display: inline-block;
            text-transform: uppercase;
            margin: 0 0 2rem 0;
            font-size: .9rem;
        }

        .client {
            margin: 0 0 3rem 0;
        }

        h1 {
            margin: 0;
            padding: 0;
            font-size: 2rem;
            color:
                #F14C4C;
        }

        .invoicelist-body {
            margin: 1rem;
        }

        .invoicelist-body table {
            width: 100%;
        }

        .invoicelist-body thead {
            text-align: left;
            border-bottom: 2pt solid #666;
        }

        .invoicelist-body td,
        .invoicelist-body th {
            position: relative;
            padding: 1rem;
        }

        .invoicelist-body .newRow {
            margin: .5rem 0;
            float: left;
        }

        .invoicelist-body .removeRow {
            display: none;
            position: absolute;
            top: .1rem;
            bottom: .1rem;
            left: -1.3rem;
            font-size: .7rem;
            border-radius: 3px 0 0 3px;
            padding: .5rem;
        }

        .invoicelist-footer {
            margin: 1rem;
        }

        .invoicelist-footer table {
            float: right;
            width: 25%;
        }

        .invoicelist-footer table td {
            padding:
                1rem 2rem 0 1rem;
            text-align: right;
        }

        .invoicelist-footer table #total_price {
            font-size: 2rem;
            color: #F14C4C;
        }

        .note {
            margin: 1rem;
        }

        .hidenote .note {
            display: none;
        }

        .note h2 {
            margin: 0;
            font-size: 1rem;
            font-weight: bold;
        }

        @media print {
            html {
                margin: 0;
                padding: 0;
                background: #fff;
            }

            body {
                width: 100%;
                border: none;
                background: #fff;
                margin: 0;
                padding: 0;
            }

            .control,
            .control-bar {
                display: none !important;
            }

            [contenteditable]:hover,
            [contenteditable]:focus {
                outline: none;
            }
        }
    </style>
</head>

<body>
    <header class="row">
        <div class="me_img">
            <div class="logoholder text-center header-desc">
                <img class="logo" src="<?= base_url('assets/img/'.$web->logo) ?>">
            </div><br />
        </div>
        <div class="me">
            <p>
                <strong><?= $web->title ?></strong><br>
                <?= $web->alamat ?>
            </p>
        </div>
        <div class="info">
            <p>
                Web: <?= base_url(); ?><br>
                Email: <?= $web->email ?><br>
                Tel: <?= $web->telp ?>
            </p>
        </div>
    </header>
    <div class="headline">
        <?php
        if (empty($order)) {
            echo "Maaf Data Kosong, Cek kembali nomor id order";
        } else {
        ?>
            <p style="color:#ffffff">INVOICE <?= $order['idorder'] ?></p>
    </div>
    <div class="desc">
        <div class="me">
            <p>
                <strong>Ditagihkan Kepada</strong><br>
                <?= $user['nama'] ?><br>
                <?= $user['alamat'] ?><br>
                <?= $user['no_hp'] ?>
            </p>
        </div>
    </div>

    <div class="invoicelist-body">
        <table>
            <thead>
                <tr>
                    <th class="border-0 text-uppercase small font-weight-bold">#</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Produk</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Harga</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Quantity</th>
                    <th class="border-0 text-uppercase small font-weight-bold">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; $sum = 0; 
                    foreach($order_detail as $d) : ?>
                    <?php $sum += $d['subtotal']; ?>
                    <?php $prod = $this->db->get_where('produk', ['id' => $d['idproduk']])->row_array(); ?>

                    <tr>
                        <td><center><?= $no ?></center></td>
                        <!-- <td><center><?= $prod['sku'] ?></center></td> -->
                        <td><center><?= $prod['nama'] ?></center></td>
                        <td><center><?= number_format($prod['harga'], 0, ',', '.'); ?></center></td>
                        <td><center><?= $d['qty'] ?></center></td>
                        <td><center><?= number_format($d['subtotal'], 0, ',', '.'); ?></center></td>
                    </tr>

                    <?php $no++; endforeach ?>
               
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Subtotal</td>
                    <td><center>Rp. <span class="money"><?= number_format($sum, 0, ',', '.') ?>,-</span></center></td>
                </tr>

                <?php if(!empty($order['ongkir'])): ?>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Pengiriman</td>
                    <td><center>Rp. <span class="money"><?= number_format($order['ongkir'], 0, ',', '.') ?>,-</span></center></td>
                </tr>
                <?php endif ?>

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>Total</td>
                    <td><center><b class="text-danger h5">Rp. <?= number_format($sum + $order['ongkir'], 0, ',', '.') ?>,-</b></center></td>
                </tr>
            </tbody>
        </table>
    </div>
<?php } ?>
<footer>
    <div class="footer">
        Invoice dibuat di komputer dan berlaku tanpa tanda tangan dan stempel.
    </div>
</footer>
</body>

</html>