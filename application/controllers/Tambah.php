<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tambah extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Main_model');
        $this->load->helper('string');
    }

    public function produk()
    {
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $data['title'] =  'Tambah Produk';
        $data['web'] =  $this->db->get('website')->row_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/produk/tambah_produk', $data);
        $this->load->view('admin/footer', $data);
    }

    function tambah_produk(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $nama = $this->input->post('nama');
        $slug       = url_title($nama, '-', TRUE);
        $img  = $_FILES['gambar'];

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/produk/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                echo '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>';
                    redirect('update/produk/'.$slug);
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = '';
        }
        
        if($this->input->post('status') == NULL){
            $status = 'off';
        } else {
            $status = 'on';
        }

        $data = [
            'sku' => $this->input->post('sku'),
            'nama' => $nama,
            'deskripsi' => $this->input->post('deskripsi'),
            'harga' => $this->input->post('harga'),
            'img' => $gambar,
            'stok' => $this->input->post('stok'),
            'restok' => $this->input->post('stok'),
            'slug' => $slug,
            'status' => $status
        ];
        $this->db->insert('produk', $data);

        redirect('update/produk/'.$slug);
    }


    public function keagenan()
    {
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $data['title'] =  'Tambah Keagenan';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['prov'] =  $this->db->get('provinsi')->result_array();
        
        $data['agen'] =  $this->db->get('keagenan')->result_array();


        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/user/tambah_user', $data);
        $this->load->view('admin/footer', $data);
    }

    function tambah_user(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $email = $this->input->post('email');
        if($this->input->post('status') == NULL){
            $status = 'off';
        } else {
            $status = 'on';
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $email,
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'no_hp' => $this->input->post('no_hp'),
            'prov' => $this->input->post('prov'),
            'kab' => $this->input->post('kab'),
            'kec' => $this->input->post('kec'),
            'alamat' => $this->input->post('alamat'),
            'nama_rek' => $this->input->post('nama_rek'),
            'no_rek' => $this->input->post('nomor_rek'),
            'nama_bank' => $this->input->post('bank'),
            'level' => $this->input->post('level'),
            'status' => $status,
            'date' => date('Y-m-d'),
            'no_ref' => $this->input->post('no_ref'),
            'nik' => $this->input->post('nik')
        ];

        $this->db->insert('user', $data);

        $cek = $this->db->get_where('user', ['email' => $email])->row_array();
        redirect('update/user/'.$cek['id']);
    }

    public function paket_keagenan()
    {
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $data['title'] =  'Tambah Paket Keagenan';
        $data['web']   =  $this->db->get('website')->row_array();

        $data['kode']  =  $this->Main_model->kode();
        $this->db->where('status', 'on');
        $data['produk'] =  $this->db->get('produk')->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/paket_keagenan/tambah_paket', $data);
        $this->load->view('admin/footer', $data);
    }

    public function tambah_paket_keagenan()
    {
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $nama = $this->input->post('nama');
        $slug       = url_title($nama, '-', TRUE);
        $this->Main_model->insert_paket_keagenan();
        redirect('update/paket_keagenan/'.$slug);
    }

    function faq(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $data = [
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban' => $this->input->post('jawaban'),
            'role' => $this->input->post('role')
        ];
        $this->db->insert('faq', $data);
    }
    
    public function input_ajax()
    {
        $this->Main_model->insert_temp();
    }
    
    public function input_ajax1()
    {
        $this->Main_model->insert_temp1();
    }

    
    function testimoni(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $img  = $_FILES['gambar'];

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/testimoni/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                echo '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>';
                redirect('admin/testimoni');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = '';
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'job' => $this->input->post('job'),
            'testi' => $this->input->post('testi'),
            'img' => $gambar
        ];
        $this->db->insert('testimoni', $data);
        redirect('admin/testimoni');
    }
    
    function gallery(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $img  = $_FILES['gambar'];

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/gallery/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                echo '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>';
                redirect('admin/data_gallery');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = '';
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => $this->input->post('status'),
            'tgl' => date('Y-m-d'),
            'img' => $gambar
        ];
        $this->db->insert('gallery', $data);
        redirect('admin/data_gallery');
    }


    function fronttambah(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $img  = $_FILES['gambar'];

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/gallery/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                echo '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>';
                redirect('admin/front_image');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = '';
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => $this->input->post('status'),
            'tgl' => date('Y-m-d'),
            'img' => $gambar
        ];
        $this->db->insert('front_foto', $data);
        redirect('admin/front_image');
    }


    function slidetambah(){
        $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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

        $img  = $_FILES['gambar'];

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/slideshow/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                echo '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>';
                redirect('admin/slideshow');
            } else {
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = '';
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => $this->input->post('status'),
            'tgl' => date('Y-m-d'),
            'img' => $gambar
        ];
        $this->db->insert('slideshow', $data);
        redirect('admin/slideshow');
    }



    function rekening(){
    $this->data['sess_email'] = $this->session->userdata('email');
        $sess_email = $this->session->userdata('email');
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
        
        $data = [
            'nama' => $this->input->post('nama'),
            'no_rek' => $this->input->post('no_rek'),
            'bank' => $this->input->post('bank'),
            'status' => $this->input->post('status')
        ];
        $this->db->insert('data_bank', $data);

        redirect('admin/rekening');
    }

    function repeat_order(){
        $iduser = $this->input->post('iduser');

        $data_u = $this->db->get_where('user', ['id' => $iduser])->row(); 

        $order_id = random_string('numeric', 7);

        $data2 = [
            'idorder' => $order_id,
            'iduser' => $iduser,
            'total' => $this->input->post('subtotal'),
            'ongkir' => '0',
            'type' => 'Agen',
            'status' => 'Pending',
            'level' => $data_u->level,
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

        redirect('keagenan/detail_order/'.$order_id);

    }

    function klaim_point(){
        $iduser = $this->input->post('id_user');
        $point = $this->input->post('point');
        $data_u = $this->db->get_where('user', ['id' => $iduser])->row(); 
        $level = $this->db->get_where('keagenan', ['id' => $data_u->level])->row(); 

        $rewpo = $this->db->get_where('reward_point', ['fk_agen' => $level->fk, 'point' => $point])->row(); 

        $data2 = [
            'id_user' => $iduser,
            'point' => $point,
            'nominal' => $rewpo->nominal,
            'nama_rek' => $this->input->post('nama_rek'),
            'nomor_rek' => $this->input->post('nomor_rek'),
            'bank' => $this->input->post('bank'),
            'status' => 'Pending',
            'tgl' => date('Y-m-d')
        ];
        $this->db->insert('klaim_point', $data2);

        $this->db->set('point', $data_u->point - $point);
        $this->db->where('id', $iduser);
        $this->db->update('user');

    }

    function list_point(){
        $data = [
            'fk_agen' => $this->input->post('fk'),
            'point' => $this->input->post('point'),
            'nominal' => $this->input->post('nominal')
        ];
        $this->db->insert('reward_point', $data);
        redirect('admin/setting_point');
    }
}