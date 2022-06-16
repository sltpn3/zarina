<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak_invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->helper('tgl_indo');
        $this->load->library('Pdf');
    }
    
    public function index()
    {
        $idorder = $this->input->get('idorder');
        $data['title'] =  'Cetak Invoice';
        $data['web'] =  $this->db->get('website')->row();

        $data['order'] = $this->db->get_where('orderan', ['idorder' => $idorder])->row_array();
        $data['order_detail'] = $this->db->get_where('order_detail', ['idorder' => $data['order']['idorder']])->result_array();
        $data['user'] = $this->db->get_where('user', ['id' => $data['order']['iduser']])->row_array();

        $this->pdf->set_option('isHtml5ParserEnabled', true);
        $this->pdf->set_option('isRemoteEnabled', true);  
        $this->pdf->setPaper(array(0, 0, 837, 515), 'potrait');
        $this->pdf->filename = 'invoice_' . $idorder . '.pdf';
        $this->pdf->load_view('laporan/cetak_invoice', $data);
    }
}