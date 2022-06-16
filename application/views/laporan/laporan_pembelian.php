<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Laporan Pembelian</title>
</head>

<body>
    <br />
    <h3 align="center">Laporan Pembelian Tahun <?php echo date('Y'); ?>
    </h3>
    <?php if(!empty($tgl_awal) || !empty($tgl_akhir)) :?>
    <h5> Tanggal : <?= mediumdate_indo(date($tgl_awal)) ?> - <?= mediumdate_indo(date($tgl_akhir)) ?></h5>
    <?php endif ?>

    <table border="1" cellspacing="0" cellpadding="5" width="100%">
        <thead>
            <tr>
                <th>No.</th>
                <!-- <th>Nama</th> -->
                <th>ID Order</th>
                <th>QTY</th>
                <th>Total</th>
                <!-- <th>Kota</th> -->
                <!-- <th>Type</th> -->
                <th>Level</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1; $sum_total = 0; $sum_qty = 0;
            foreach ($laporan as $d) : ?>
                <?php $user =  $this->db->get_where('user', ['id' => $d['iduser']])->row_array(); ?>
                <?php $kota = $this->db->get_where('kabupaten', ['id_kab' => $user['kab']])->row_array(); ?>
                <?php $level = $this->db->get_where('keagenan', ['id' => $user['level']])->row_array(); ?>
                <?php 
                    $this->db->select_sum('qty');
                    $qty = $this->db->get_where('order_detail', ['idorder' => $d['idorder']])->row_array();
                    $this->db->select_sum('subtotal');
                    $total = $this->db->get_where('order_detail', ['idorder' => $d['idorder']])->row_array(); 
                    $sum_total += $d['total'];
                    $sum_qty += $qty['qty'];
                ?>
                <tr>
                    <td>
                        <center><?= $i ?></center>
                    </td>
                    <!-- <td>
                        <?= $user['nama'] ?>
                    </td> -->
                    <td>
                        <center><?= $d['idorder'] ?></center>
                    </td>
                    <td>
                        <center><?= $qty['qty'] ?></center>
                    </td>
                    <td>
                        <center><?= number_format($d['total'], 0, ',', '.') ?></center>
                    </td>
                    <!-- <td>
                        <center><?= $kota['nama_kab'] ?></center>
                    </td> -->
                    <!-- <td>
                        <center><?= $d['type'] ?></center>
                    </td> -->
                    <td>
                        <center><?= $level['nama'] ?></center>
                    </td>
                    <td>
                        <center><?= mediumdate_indo($d['orderdate']); ?></center>
                    </td>
                    <td>
                        <center><?= $d['status'] ?></center>
                    </td>
                </tr>
               
            <?php $i++;
            endforeach ?>
                <tr>
                    <td colspan="2"><div style="float: right;">Total QTY </div></td>
                    <td colspan="5"><div style="padding-left:29px;"><b><?= number_format($sum_qty, 0, ',', '.') ?></b></div></td>
                </tr>
                <tr>
                    <td colspan="3"><div style="float: right;">Subtotal </div></td>
                    <td colspan="4" style="float:right;"><b>Rp. <?= number_format($sum_total, 0, ',', '.') ?>,-</b></td>
                </tr>
        </tbody>
    </table>
</body>

</html>