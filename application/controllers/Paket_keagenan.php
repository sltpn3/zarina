<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Paket_keagenan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    public function index($slug_url)
    {

        if($slug_url == 'pendaftaran'){
            $this->_pendaftaran();
            die;
        }

        $data['web'] =  $this->db->get('website')->row_array();
      
        $data['prov'] =  $this->db->get('provinsi')->result_array();
        
        $this->db->where('slug ',$slug_url);
        $data['keagenan'] =  $this->db->get('keagenan')->row_array();
        $this->db->where('status', 'on');
        $data['data_bank'] =  $this->db->get('data_bank')->result_array();
        
        $data['produk'] =  $this->db->get_where('paket_agen', ['fk_agen' => $data['keagenan']['fk']])->result_array();
        $data['harga_paket'] =  $this->db->get_where('harga_paket', ['fk_agen' => $data['keagenan']['fk']])->result_array();

        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/keagenan', $data);
        $this->load->view('frontend/footer', $data);
    }

    private function _pendaftaran()
    {
        $data1 = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'prov' => $this->input->post('prov'),
            'kab' => $this->input->post('kab'),
            'kec' => $this->input->post('kec'),
            'alamat' => $this->input->post('alamat'),
            'nama_rek' => $this->input->post('nama_rek'),
            'no_rek' => $this->input->post('nomor_rek'),
            'nama_bank' => $this->input->post('bank'),
            'level' => $this->input->post('level'),
            'status' => 'off',
            'date' => date('Y-m-d'),
            'no_ref' => $this->input->post('no_ref'),
            'nik' => $this->input->post('nik')
        ];
        $this->db->insert('user', $data1);

        $iduser = $this->db->insert_id();

        $order_id = random_string('numeric', 7);

        $data2 = [
            'idorder' => $order_id,
            'iduser' => $iduser,
            'total' => $this->input->post('subtotal'),
            'ongkir' => '0',
            'type' => 'Order',
            'status' => 'Pending',
            'level' => '0',
            'orderdate' => date('Y-m-d'),
            'time' => date('h:i:s')
        ];
        $this->db->insert('orderan', $data2);

        $result = array();
        foreach ($this->input->post('idproduk') as $key => $val) {
            $result[] = array(   
                'idorder' => $order_id,
                'idproduk' => $this->input->post('idproduk')[$key],
                'harga' => $this->input->post('harga_prod')[$key],
                'qty' => $this->input->post('jumlah')[$key],
                'subtotal' => $this->input->post('total')[$key]     
            );      
        }      
        $this->db->insert_batch('order_detail',$result);

        redirect('checkout?idorder='.$order_id);
    }
}
