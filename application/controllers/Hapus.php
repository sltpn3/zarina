<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Hapus extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function user()
  {
      $id=$_GET['id'];
      $this->db->query("DELETE FROM user where id='$id'");
  }

  public function produk()
  {
      $id=$_GET['id'];
      $g =  $this->db->get_where('produk', ['id' => $id])->row_array();
      unlink("./assets/img/produk/" . $g['img']);
      $this->db->query("DELETE FROM produk where id='$id'");
  }

  public function orderan()
  {
      $id=$_GET['id'];
      $g =  $this->db->get_where('orderan', ['idorder' => $id])->row_array();
      unlink("./assets/img/bukti-tf/" . $g['bukti_tf']);
      $this->db->query("DELETE FROM orderan where idorder='$id'");
      $this->db->query("DELETE FROM order_detail where idorder='$id'");
  }

  function faq(){
    $id = $this->input->post('id');
    $this->db->where('id', $id);
    $this->db->delete('faq');
  }

  public function hapus_temp()
  {
      $id=$_GET['id'];
      $this->db->query("DELETE FROM paket_agen where id='$id'");
  }

  public function hapus_temp1()
  {
      $id=$_GET['idA'];
      $this->db->query("DELETE FROM harga_paket where id='$id'");
  }

  public function paket_keagenan()
  {
      $id = $_GET['id'];
      $get_data = $this->db->get_where('keagenan', ['id' => $id])->row_array();
      $data = $get_data['fk'];

      $this->db->query("DELETE FROM paket_agen where fk_agen='$data'");
      $this->db->query("DELETE FROM harga_paket where fk_agen='$id'");
      $this->db->query("DELETE FROM keagenan where id='$id'");
  }
  
  public function testimoni()
  {
      $id=$_GET['id'];
      $g =  $this->db->get_where('testimoni', ['id' => $id])->row_array();
      unlink("./assets/img/testimoni/" . $g['img']);
      $this->db->query("DELETE FROM testimoni where id='$id'");
  }
  
  public function gallery()
  {
      $id=$_GET['id'];
      $g =  $this->db->get_where('gallery', ['id' => $id])->row_array();
      unlink("./assets/img/gallery/" . $g['img']);
      $this->db->query("DELETE FROM gallery where id='$id'");
  }

  public function slidehapus()
  {
      $id=$_GET['id'];
      $g =  $this->db->get_where('slideshow', ['id' => $id])->row_array();
      unlink("./assets/img/slideshow/" . $g['img']);
      $this->db->query("DELETE FROM slideshow where id='$id'");
  }

  public function fronthapus()
  {
      $id=$_GET['id'];
      $g =  $this->db->get_where('front_foto', ['id' => $id])->row_array();
      unlink("./assets/img/gallery/" . $g['img']);
      $this->db->query("DELETE FROM front_foto where id='$id'");
  }

  public function kontak()
  {
      $id=$_GET['id'];
      $this->db->query("DELETE FROM kontak where id='$id'");
  }

  public function rekening()
  {
      $id=$_GET['id'];
      $this->db->query("DELETE FROM data_bank where id='$id'");
  }

  public function reward_point()
  {
      $id=$_GET['id'];
      $d =  $this->db->get_where('keagenan', ['id' => $id])->row();

      $this->db->query("DELETE FROM reward_point where fk_agen='$d->fk'");

      $this->db->set('status_point', 'off');
      $this->db->where('id', $id);
      $this->db->update('keagenan');
  }

  public function list_point()
  {
      $id=$_GET['id'];
      $this->db->query("DELETE FROM reward_point where id='$id'");
  }

  public function data_klaim()
  {
      $id=$_GET['id'];
      $this->db->query("DELETE FROM klaim_point where id='$id'");
  }
}
