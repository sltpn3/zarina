<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error_404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['web'] =  $this->db->get('website')->row_array();
      
        $this->load->view('frontend/header', $data);
        $this->load->view('errors/404', $data);
        $this->load->view('frontend/footer', $data);
    }
}
