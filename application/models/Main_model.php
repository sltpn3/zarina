<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Main_model extends CI_Model
{

    function statistik_bulanan_agen() {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT total, COUNT(id) as total FROM orderan WHERE LEFT(orderdate, 7)='" . $date . "' AND status='Selesai' AND type='Agen'");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }

    function statistik_bulanan_order() {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT total, COUNT(id) AS total FROM orderan WHERE LEFT(orderdate, 7)='" . $date . "' AND status='Selesai' AND type='Order'");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }

    function laporan_bulanan_agen() {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT SUM(total) AS total FROM orderan WHERE LEFT(orderdate, 7)='" . $date . "' AND status='Selesai' AND type='Agen'");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }

    function laporan_bulanan_order() {
        $year = date('Y') . '-';
        $mount = 13;
        for ($i = 1; $i < $mount; $i++) {
            $date = sprintf('%s%02s', $year, $i);
            $query = $this->db->query("SELECT SUM(total) AS total FROM orderan WHERE LEFT(orderdate, 7)='" . $date . "' AND status='Selesai' AND type='Order'");
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $data) {
                    $hasil[] = $data;
                }
            }
        }
        return $hasil;
    }

    function kode()
    {
             $this->db->select('RIGHT(keagenan.fk,2) as fk', FALSE);
             $this->db->order_by('fk','DESC');    
             $this->db->limit(1);    
             $query = $this->db->get('keagenan');  //cek dulu apakah ada sudah ada kode di tabel.    
             if($query->num_rows() <> 0){      
                  //cek kode jika telah tersedia    
                  $data = $query->row();      
                  $kode = intval($data->fk) + 1; 
             }
             else{      
                  $kode = 1;  //cek jika kode belum terdapat pada table
             }
                 $tgl=date('dmY'); 
                 $batas = str_pad($kode, 3, "0", STR_PAD_LEFT);    
                 $kodetampil = "AGN-".$batas;  //format kode
                 return $kodetampil;  
   }
   
   function insert_temp()
   {

   $fk_agen   = $this->input->post('fk');
   $produk = $this->input->post('produk');
   
       $data=array(
            'fk_agen'=>$fk_agen,
            'id_produk'=>$produk,
           );
       $this->db->insert('paket_agen',$data);
   }
   
   function insert_temp1()
   {

   $fk_agen   = $this->input->post('fk');
   $produk = $this->input->post('produk1');
   $min = $this->input->post('min');
   $max = $this->input->post('max');
   $harga = $this->input->post('harga');
   
       $data=[
           'id_produk'=>$produk,
           'min'=>$min,
           'max'=>$max,
           'harga'=>$harga,
           'fk_agen'=>$fk_agen,
       ];
       $this->db->insert('harga_paket',$data);
   }

   function insert_paket_keagenan(){
        $nama = $this->input->post('nama');
        $slug       = url_title($nama, '-', TRUE);
        if($this->input->post('status') == NULL){
            $promo = 'off';
        } else {
            $promo = 'on';
        }
        $data=[
            'fk'    =>  $this->input->post('fk'),
            'nama'  =>  $nama,
            'deskripsi'    =>  $this->input->post('deskripsi'),
            'informasi'    =>  $this->input->post('informasi'),
            'minimal'    =>  $this->input->post('minimal'),
            'repeat_order'    =>  $this->input->post('repeat_order'),
            'promo'    =>  $promo,
            'slug'    =>  $slug,
        ];
        $this->db->insert('keagenan',$data);
   }

   function update_paket_keagenan(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        if($this->input->post('status') == NULL){
            $promo = 'off';
        } else {
            $promo = 'on';
        }
        $slug       = url_title($nama, '-', TRUE);
        $data=[
            'fk'    =>  $this->input->post('fk'),
            'nama'  =>  $nama,
            'deskripsi'    =>  $this->input->post('deskripsi'),
            'informasi'    =>  $this->input->post('informasi'),
            'minimal'    =>  $this->input->post('minimal'),
            'repeat_order'    =>  $this->input->post('repeat_order'),
            'promo'    =>  $promo,
            'slug'    =>  $slug,
        ];
        $this->db->where('id',$id);
        $this->db->update('keagenan',$data);
   }

   function laporan_pembelian($iduser) {
    $year = date('Y') . '-';
    $mount = 13;
    for ($i = 1; $i < $mount; $i++) {
        $date = sprintf('%s%02s', $year, $i);
        $query = $this->db->query("SELECT SUM(total) AS total FROM orderan WHERE LEFT(orderdate, 7)='" . $date . "' AND status='Selesai' AND type='Agen' AND iduser='$iduser'");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
        }
    }
    return $hasil;
}


}
