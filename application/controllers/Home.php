<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Home';
        $data['web'] =  $this->db->get('website')->row_array();
      
        $data['produk'] =  $this->db->get('produk')->result_array();
        $data['keagenan'] =  $this->db->get('keagenan')->result_array();
        $this->db->order_by('role', 'asc');
        $data['faq'] =  $this->db->get('faq')->result_array();
        $data['testi'] =  $this->db->get('testimoni')->result_array();
        $this->db->where('status', 'on');
        $this->db->order_by('id', 'desc');
        $data['gallery'] = $this->db->get('gallery', 8)->result_array();

        $this->db->where('status', 'on');
        $data['sum_user'] = $this->db->get("user")->num_rows();
        $this->db->where('status', 'on');
        $this->db->where('level', '1');
        $data['sum_reseller'] = $this->db->get("user")->num_rows();
        $this->db->where('status', 'on');
        $this->db->where('level', '2');
        $data['sum_agen'] = $this->db->get("user")->num_rows();
        $this->db->where('status', 'on');
        $this->db->where('level', '3');
        $data['sum_stokis'] = $this->db->get("user")->num_rows();

        $query = $this->db->get_where('front_foto', array('id' => 1));
        $data['front_1'] = $query->row_array();

        $query = $this->db->get_where('front_foto', array('id' => 2));
        $data['front_2'] = $query->row_array();

        $data['slideshow'] = $this->db->get('slideshow')->result_array();

        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/index', $data);
        $this->load->view('frontend/footer', $data);
    }
    public function kontak()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'subjek' => $this->input->post('subjek'),
            'pesan' => $this->input->post('pesan'),
            'status' => 'Pending',
            'tgl' => date('Y-m-d')
        ];

        $input = $this->db->insert('kontak', $data);
        if ($input) {
            return true;
        } else {
            return false;
        }
    }
}
