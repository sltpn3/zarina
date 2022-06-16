<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
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
        $this->load->library('form_validation');

        if (!$sess_email) {
            $this->session->set_flashdata(   'message',
            '<div class="alert alert-danger alert-dismissible fade show" role="alert">
       <i class="fa fa-exclamation-triangle"></i> Silahkan Login dahulu!
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
        );
            redirect('auth/admin');
        }

        $admin = $this->db->get_where('admin', ['email' => $sess_email])->row_array();
        if ($admin['role_id'] == 2) {
            redirect('pengurus');
        } elseif ($admin['role_id'] == 3) {
            redirect('user');
        } elseif ($admin['role_id'] < 1) {
            redirect('auth/blocked');
        }

    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('stok', 'asc');
        $data['produk'] = $this->db->get("produk", 5)->result_array();

        $data['sum_produk'] = $this->db->get("produk")->num_rows();
        $this->db->where('status', 'on');
        $data['sum_user'] = $this->db->get("user")->num_rows();
       
        $data['grafik_agen'] = $this->Main_model->statistik_bulanan_agen();
        $data['grafik_order'] = $this->Main_model->statistik_bulanan_order();

        $this->db->where('status', 'Pending');
        $this->db->where('level =', '0');
        $data['sum_order'] = $this->db->get("orderan")->num_rows();
        $this->db->where('status', 'Pending');
        $this->db->where('level !=', '0');
        $data['sum_agen'] = $this->db->get("orderan")->num_rows();

        $this->db->order_by('id', 'asc');
        $data['keagenan'] = $this->db->get('keagenan')->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('admin/footer', $data);
    }


    public function order_masuk()
    {
        $data['title'] =  'Order Masuk';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('level', '0');
        $this->db->where('status', 'Pending');
        $this->db->order_by('id', 'desc');
        $data['orderan'] = $this->db->get('orderan')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/order/order_masuk', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_order()
    {
        $data['title'] =  'Data Order';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('level', '0');
        $data['orderan'] = $this->db->get('orderan')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/order/data_order', $data);
        $this->load->view('admin/footer', $data);
    }

    public function detail_order()
    {
        $idorder = $this->uri->segment(3);
        $data['title'] =  'Detail Order';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['order'] = $this->db->get_where('orderan', ['idorder' => $idorder])->row_array();
        $data['order_detail'] = $this->db->get_where('order_detail', ['idorder' => $data['order']['idorder']])->result_array();
        $data['user'] = $this->db->get_where('user', ['id' => $data['order']['iduser']])->row_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/order/detail_order', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_produk()
    {
        $data['title'] =  'Data Produk';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['produk'] = $this->db->get('produk')->result_array();

        $data['columns'] = [0, 1, 3, 4, 5];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/produk/data_produk', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_users()
    {
        $data['title'] =  'Data Users';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['user'] = $this->db->get('user')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/user/data_user', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_keagenan()
    {
        $data['title'] =  'Data Keagenan';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('level !=', '0');
        $this->db->order_by('id', 'desc');
        $data['user'] = $this->db->get('user')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/user/data_keagenan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_order_keagenan()
    {
        $data['title'] =  'Data Order Keagenan';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $this->db->where('level !=', '0');
        $data['agen'] = $this->db->get('orderan')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/keagenan/data_keagenan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function order_masuk_keagenan()
    {
        $data['title'] =  'Orderan Baru Keagenan';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('status', 'Pending');
        $this->db->where('level !=', '0');
        $this->db->order_by('id', 'desc');
        $data['agen'] = $this->db->get('orderan')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/keagenan/keagenan_baru', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_gallery()
    {
        $data['title'] =  'Data Gallery';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['gallery'] = $this->db->get('gallery')->result_array();

        $data['columns'] = [0, 2, 3, 4];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/data_gallery', $data);
        $this->load->view('admin/footer', $data);
    }

    public function front_image()
    {
        $data['title'] =  'Front Image';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['front_foto'] = $this->db->get('front_foto')->result_array();

        $data['columns'] = [0, 2, 3, 4];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/front_image', $data);
        $this->load->view('admin/footer', $data);
    }

    public function slideshow()
    {
        $data['title'] =  'Slideshow';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['slideshow'] = $this->db->get('slideshow')->result_array();

        $data['columns'] = [0, 2, 3, 4];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/slideshow', $data);
        $this->load->view('admin/footer', $data);
    }

    public function data_kontak()
    {
        $data['title'] =  'Data Kontak';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['kontak'] = $this->db->get('kontak')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/data_kontak', $data);
        $this->load->view('admin/footer', $data);
    }

    public function laporan()
    {
        $data['title'] =  'Laporan';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9];


        if(isset($_POST['filter'])){
           
            $type = $this->input->post('type');
            $status = $this->input->post('status');
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if (!empty($type)) {
            $this->db->where('type', $type);
            }
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
            
            $type = $this->input->post('type');
            $status = $this->input->post('status');
            $tgl_awal = $this->input->post('tgl_awal');
            $tgl_akhir = $this->input->post('tgl_akhir');

            if (!empty($type)) {
            $this->db->where('type', $type);
            }
            if (!empty($status)) {
            $this->db->where('status', $status);
            }
            if (!empty($tgl_awal)) {
            $this->db->where('orderdate >=', $tgl_awal);
            }
            if (!empty($tgl_akhir)) {
            $this->db->where('orderdate <=', $tgl_akhir);
            }
    
            $data['laporan'] = $this->db->get('orderan')->result_array();
    
            $data['tgl_awal'] = $tgl_awal;
            $data['tgl_akhir'] = $tgl_akhir;
    
            $this->pdf->setPaper('A4', 'potrait');

            if(!empty($tgl_awal) || !empty($tgl_akhir)){
            $this->pdf->filename = 'laporan-penjualan ' . mediumdate_indo($tgl_awal) . '_' . mediumdate_indo($tgl_akhir) . ' .pdf';
            }else{
            $this->pdf->filename = 'laporan-penjualan_' . date('Y') . ' .pdf';
            }
            $this->pdf->load_view('laporan/laporan_penjualan', $data);
        }

        $data['laporan'] = $this->db->get('orderan')->result_array();

        $data['grafik_agen'] = $this->Main_model->laporan_bulanan_agen();
        $data['grafik_order'] = $this->Main_model->laporan_bulanan_order();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/laporan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function paket_keagenan()
    {
        $data['title'] =  'Paket Keagenan';
        $data['web'] =  $this->db->get('website')->row_array();
        $this->db->order_by('id', 'asc');
        $data['keagenan'] =  $this->db->get('keagenan')->result_array();

        $data['columns'] = [0, 1, 2];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/paket_keagenan/paket_keagenan', $data);
        $this->load->view('admin/footer', $data);
    }

    public function testimoni()
    {
        $data['title'] =  'Testimoni';
        $data['web'] =  $this->db->get('website')->row_array();
        $this->db->order_by('id', 'desc');
        $data['testimoni'] =  $this->db->get('testimoni')->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/testimoni', $data);
        $this->load->view('admin/footer', $data);
    }

    public function faq()
    {
        $data['title'] =  'Faq';
        $data['web'] =  $this->db->get('website')->row_array();
        $this->db->order_by('role', 'asc');
        $data['faq'] =  $this->db->get('faq')->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/faq', $data);
        $this->load->view('admin/footer', $data);
    }

    public function website()
    {
        $data['title'] =  'Website';
        $data['admin'] =  $this->db->get_where('admin', ['email' => $this->data['sess_email']])->row_array();
        $data['web'] =  $this->db->get('website')->row_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/website', $data);
        $this->load->view('admin/footer', $data);
    }

    public function rekening()
    {
        $data['title'] =  'Rekening';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->order_by('id', 'desc');
        $data['rekening'] = $this->db->get('data_bank')->result();
        $data['columns'] = [0, 1, 2, 3, 4];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/rekening', $data);
        $this->load->view('admin/footer', $data);
    }


    public function akun()
    {
        $data['title'] =  'Akun';
        $data['admin'] =  $this->db->get_where('admin', ['email' => $this->data['sess_email']])->row_array();
        $data['web'] =  $this->db->get('website')->row_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/akun', $data);
        $this->load->view('admin/footer', $data);
    }

    

    public function email_sender()
    {
        $data['title'] = 'Email Sender';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['email_sender'] =  $this->db->get('email_sender')->result_array();

        $this->form_validation->set_rules('email', 'Email', 'required');

        $id = $this->input->post('id');

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/header', $data);
            $this->load->view('admin/sidebar', $data);
            $this->load->view('admin/topbar', $data);
            $this->load->view('admin/page/email_sender', $data);
            $this->load->view('admin/footer', $data);
        } else {
            $data = [
                'protocol' => $this->input->post('protocol'),
                'host' => $this->input->post('host'),
                'port' => $this->input->post('port'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'charset' => $this->input->post('charset')
            ];

            $this->db->where('id', $id);
            $this->db->update('email_sender', $data);

            $this->session->set_flashdata(
                'tersimpan',
                'tersimpan'
            );
            redirect('admin/email_sender');
        }
    }


    // ---------------- SEND EMAIL SENDER ----------------- //

    private function sendEmail($id, $email, $subjek, $pesan, $type)
    {
        $data['web'] =  $this->db->get('website')->row_array();
        $data['kontak'] =  $this->db->get_where('kontak', ['id' => $id])->row_array();

        $web = $data['web'];

        $esen =  $this->db->get('email_sender')->row_array();

        $config = [
            'protocol'  => $esen['protocol'],
            'smtp_host' => $esen['host'],
            'smtp_user' => $esen['email'],
            'smtp_pass' => $esen['password'],
            'smtp_port' => $esen['port'],
            'mailtype'  => 'html',
            'charset'   => $esen['charset'],
            'newline'   => "\r\n"
        ];

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->set_header('Content-Type', 'text/html');

        $this->email->from($esen['email'], $web['nama']);
        $this->email->to($email);

        $data['link_web'] = base_url();
        $data['email'] = $email;
        $data['pesan']   = $pesan;

        $body_test = $this->load->view('email/test', $data, TRUE);
        $body_balas = $this->load->view('email/balas', $data, TRUE);

        if ($type == 'test') {
            $this->email->subject($subjek . ' - ' . $web['nama']);
            $this->email->message($body_test);
        } else if ($type == 'balas') {
            $this->email->subject($subjek . ' - ' . $web['nama']);
            $this->email->message($body_balas);
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    
    public function test_email_sender()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            redirect('admin/email_sender');
        } else {
            $id = NULL;
            $email = $this->input->post('email');
            $subjek = $this->input->post('subjek');
            $pesan = $this->input->post('pesan');

            $this->sendEmail($id, $email, $subjek, $pesan, 'test');

            $this->session->set_flashdata('terkirim','terkirim');
            redirect('admin/email_sender');
        }
    }


    public function balas_kontak()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        $id = $this->input->post('id');
        $email = $this->input->post('email');
        $subjek = $this->input->post('subjek');
        $pesan = $this->input->post('pesan');

        $this->sendEmail($id, $email, $subjek, $pesan, 'balas');

        $this->db->set('status', 'Terbalas');
        $this->db->where('id', $id);
        $this->db->update('kontak');

        $this->session->set_flashdata('terkirim','terkirim');
        redirect('admin/data_kontak');
    }

    public function data_point()
    {
        $data['title'] =  'Data Point';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->db->where('point !=', 0);
        $this->db->order_by('point', 'desc');
        $data['user'] = $this->db->get('user')->result_array();
        
        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];
        
        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/point/data_point', $data);
        $this->load->view('admin/footer', $data);
    }
    
    public function data_klaim()
    {
        $data['title'] =  'Data Klaim';
        $data['web'] =  $this->db->get('website')->row_array();
        
        $this->db->order_by('id', 'desc');
        $this->db->order_by('status', 'pending');
        $data['klaim_point'] = $this->db->get('klaim_point')->result_array();

        $data['columns'] = [0, 1, 2, 3, 4, 5, 6];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/point/data_klaim', $data);
        $this->load->view('admin/footer', $data);
    }
    
    public function setting_point()
    {
        $data['title'] =  'Setting Point';
        $data['web'] =  $this->db->get('website')->row_array();
        $data['keagenan'] =  $this->db->get_where('keagenan', ['status_point' => 'on'])->result();
        $data['data_keagenan'] =  $this->db->get('keagenan')->result();

        $data['columns'] = [0, 1, 2];

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/point/setting_point', $data);
        $this->load->view('admin/footer', $data);
    }
}