<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {

	function __construct(){
		parent::__construct();
		// $this->load->model('PostModel');
	}

	public function index($slug_url)
	{
		$data['web'] =  $this->db->get('website')->row_array();
		$this->db->select('id,sku,nama,deskripsi,harga,img,stok,slug,count(slug) as cek');
		$this->db->where('slug ',$slug_url);
		$cek_row = $this->db->get('produk')->row();
		if($cek_row->cek > 0){
			$data['produk'] = $cek_row;
			$this->load->view('frontend/header', $data);
        	$this->load->view('frontend/detail_produk', $data);
        	$this->load->view('frontend/footer', $data);

		}elseif(empty($slug_url)){
			return redirect('home'); 
		}elseif($slug_url == 'home'){
			return redirect('home'); 
		}else{
			$this->load->view('frontend/header', $data);
        	$this->load->view('errors/404', $data);
        	$this->load->view('frontend/footer', $data);
		}
	}

}
