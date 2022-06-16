<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keagenan extends CI_Controller
{
    public $data = array();
    public function __construct()
    {
        parent::__construct();
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
        $this->load->model('Main_model');
        $this->load->helper('tgl_indo');
        $this->load->library('email');
        $this->load->library('Pdf');

        if (!$sess_email) {
            $this->session->set_flashdata(   'message',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       <i class="fa fa-exclamation-triangle"></i> Silahkan Login dahulu!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
        );
            redirect('auth');
        }

        $user = $this->db->get_where('user', ['email' => $sess_email])->row_array();
        if($user['level'] == 0) {
            redirect('auth/blocked');
        }
    }

 
    public function index()
    {
        $user_a =  $this->db->get_where('user', ['email' => $this->data['sess_email']])->row_array();
        $data['title'] = 'Dashboard';
        // $data['user'] = $this->db->get_where('pengurus', ['email' => $this->session->userdata('email')])->row_array();
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('iduser', $user_a['id']);
        $this->db->order_by('id', 'desc');
        $data['orderan'] = $this->db->get("orderan", 5)->result_array();
        
        $this->db->select_sum('total');
        $data['sum_pembelian'] = $this->db->get_where("orderan", ['iduser' => $user_a['id']])->row();
        
        $data['users'] = $user_a;
        $data['level'] = $this->db->get_where("keagenan", ['id' => $user_a['level']])->row();

        $data['grafik_agen'] = $this->Main_model->laporan_pembelian($user_a['id']);

        $this->db->where('iduser', $user_a['id']);
        $data['sum_order'] = $this->db->get_where("orderan", ['status' => 'Pending'])->num_rows();
        $this->db->where('iduser', $user_a['id']);
        $data['sum_tot_order'] = $this->db->get("orderan")->num_rows();

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/index', $data);
        $this->load->view('keagenan/footer', $data);
    }

    
    public function repeat_order()
    {
        $user_a =  $this->db->get_where('user', ['email' => $this->data['sess_email']])->row();
        $data['title'] =  'Repeat Order';
        $data['web'] =  $this->db->get('website')->row_array();

        $data_agen = $this->db->get_where("keagenan", ['id' => $user_a->level])->row();
        $data['keagenan'] = $data_agen;
        $data['users'] = $user_a;

        $data['paket_agen'] = $this->db->get_where('paket_agen', ['fk_agen' => $data_agen->fk])->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5];

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/page/order/beli_produk', $data);
        $this->load->view('keagenan/footer', $data);
    }

    
    public function data_order()
    {
        $user_a =  $this->db->get_where('user', ['email' => $this->data['sess_email']])->row_array();
        $data['title'] =  'Data Order';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('iduser', $user_a['id']);
        $data['orderan'] = $this->db->get('orderan')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5];

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/page/data_order/data_order', $data);
        $this->load->view('keagenan/footer', $data);
    }

    public function detail_order()
    {
        $idorder = $this->uri->segment(3);
        $data['title'] =  'Detail Order';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['order'] = $this->db->get_where('orderan', ['idorder' => $idorder])->row_array();
        $data['order_detail'] = $this->db->get_where('order_detail', ['idorder' => $data['order']['idorder']])->result_array();
        $data['user'] = $this->db->get_where('user', ['id' => $data['order']['iduser']])->row_array();

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/page/data_order/detail_order', $data);
        $this->load->view('keagenan/footer', $data);
    }
    
    public function laporan()
    {
        $user_a =  $this->db->get_where('user', ['email' => $this->data['sess_email']])->row();
        $data['title'] =  'Laporan';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5];


        if(isset($_POST['filter'])){
           
            $status = $this->input->post('status');
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if (!empty($status)) {
            $this->db->where('status', $status);
            }
            if (!empty($tgl_awal)) {
            $this->db->where('orderdate >=', $tgl_awal);
            }
            if (!empty($tgl_akhir)) {
            $this->db->where('orderdate <=', $tgl_akhir);
            }
        }else if(isset($_POST['print'])){
            
            $status = $this->input->post('status');
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if (!empty($status)) {
            $this->db->where('status', $status);
            }
            if (!empty($tgl_awal)) {
            $this->db->where('orderdate >=', $tgl_awal);
            }
            if (!empty($tgl_akhir)) {
            $this->db->where('orderdate <=', $tgl_akhir);
            }
    
            $data['laporan'] = $this->db->get_where('orderan', ['iduser' => $user_a->id])->result_array();
    
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
    
            $this->pdf->setPaper('A4', 'potrait');

            if(!empty($tgl_awal) || !empty($tgl_akhir)){
            $this->pdf->filename = 'laporan-pembelian ' . mediumdate_indo($tgl_awal) . '_' . mediumdate_indo($tgl_akhir) . ' .pdf';
            }else{
            $this->pdf->filename = 'laporan-pembelian_' . date('Y') . ' .pdf';
            }
            $this->pdf->load_view('laporan/laporan_pembelian', $data);
        }

        $data['laporan'] = $this->db->get_where('orderan', ['iduser' => $user_a->id])->result_array();

        $data['grafik_agen'] = $this->Main_model->laporan_pembelian($user_a->id);

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/page/laporan', $data);
        $this->load->view('keagenan/footer', $data);
    }

    public function akun()
    {
        $data['title'] =  'Akun';
        $data['users'] =  $this->db->get_where('user', ['email' => $this->data['sess_email']])->row_array();
        $data['web'] =  $this->db->get('website')->row_array();

        $data['prov'] =  $this->db->get('provinsi')->result_array();

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/page/akun', $data);
        $this->load->view('keagenan/footer', $data);
    }
    
    public function reward_point()
    {
        $user_a =  $this->db->get_where('user', ['email' => $this->data['sess_email']])->row_array();
        $level =  $this->db->get_where('keagenan', ['id' => $user_a['level']])->row_array();
        $data['title'] =  'Reward Point';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['user_a'] =  $user_a;
        $data['reward_point'] =  $this->db->get_where('reward_point', ['fk_agen' => $level['fk']])->row_array();
        $this->db->order_by('point', 'ASC');
        $data['reward_point2'] =  $this->db->get_where('reward_point', ['fk_agen' => $level['fk']])->result();
        
        $this->db->order_by('id', 'desc');
        $this->db->order_by('status', 'pending');
        $data['klaim_point'] = $this->db->get('klaim_point')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];

        $this->load->view('keagenan/header', $data);
        $this->load->view('keagenan/sidebar', $data);
        $this->load->view('keagenan/topbar', $data);
        $this->load->view('keagenan/page/point/data_klaim', $data);
        $this->load->view('keagenan/footer', $data);
    }
    
}
