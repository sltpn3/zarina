<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Checkout extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->helper('tgl_indo');
    }

    public function index()
    {
        $idorder = $this->input->get('idorder');
        $data['web'] =  $this->db->get('website')->row_array();

        $cek_id = $this->db->get_where('orderan', ['idorder' => $idorder])->num_rows();
        
        if(!empty($idorder) && $cek_id == 1) {

            $data['orderan'] =  $this->db->get_where('orderan', ['idorder' => $idorder])->row();
            $data['order_detail'] =  $this->db->get_where('order_detail', ['idorder' => $idorder])->result();
            $data['users'] =  $this->db->get_where('user', ['id' => $data['orderan']->iduser])->row();
            $data['data_bank'] =  $this->db->get_where('data_bank', ['bank' => $data['users']->nama_bank])->row();

        }
        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/checkout', $data);
        $this->load->view('frontend/footer', $data);
    }
}
