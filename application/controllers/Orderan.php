<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orderan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    public function index($slug)
    {
        if($slug == 'checkout'){
            $this->_checkout();
        }

        $data['web'] =  $this->db->get('website')->row_array();
      
        $data['prov'] =  $this->db->get('provinsi')->result_array();
        $this->db->where('status', 'on');
        $data['data_bank'] =  $this->db->get('data_bank')->result_array();
        
        $data['qty'] =  $this->input->post('qty');
        
        $data['produk'] =  $this->db->get_where('produk', ['slug' => $slug])->result_array();

        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/orderan', $data);
        $this->load->view('frontend/footer', $data);
    }

    
    private function _checkout()
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
            'level' => '0',
            'status' => 'off',
            'date' => date('Y-m-d')
        ];
        $this->db->insert('user', $data1);

        $iduser = $this->db->insert_id();

        $order_id = random_string('numeric', 7);

        $data2 = [
            'idorder' => $order_id,
            'iduser' => $iduser,
            'total' => $this->input->post('total'),
            'ongkir' => '0',
            'type' => 'Order',
            'status' => 'Pending',
            'level' => '0',
            'orderdate' => date('Y-m-d'),
            'time' => date('h:i:s')
        ];
        $this->db->insert('orderan', $data2);

        $data3 = [
            'idorder' => $order_id,
            'idproduk' => $this->input->post('idproduk'),
            'harga' => $this->input->post('harga'),
            'qty' => $this->input->post('qtyy'),
            'subtotal' => $this->input->post('total')
        ];
        $this->db->insert('order_detail', $data3);

        redirect('checkout?idorder='.$order_id);
    }
}
