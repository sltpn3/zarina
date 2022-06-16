<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Track_order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->helper('tgl_indo');
    }

    public function index()
    {
        $data['title'] = 'Track Order';
        $data['web'] =  $this->db->get('website')->row_array();
        
        $this->load->view('frontend/header', $data);
        $this->load->view('frontend/track_order', $data);
        $this->load->view('frontend/footer', $data);
    }
}
