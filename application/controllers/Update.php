<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('tgl_indo');
        $this->load->model('Main_model');
    }

    function konfirmasi_order(){
        $idorder = $this->input->post('idorder');
        
        $this->db->set('status', 'Selesai');
        $this->db->where('idorder', $idorder);
        $this->db->update('orderan');
       
        $get_od = $this->db->get_where('order_detail', ['idorder' =>  $idorder])->row();
        $get_prod = $this->db->get_where('produk', ['id' => $get_od->idproduk])->row();
     
        $this->db->set('stok', $get_prod->stok - $get_od->qty);
        $this->db->where('id', $get_prod->id);
        $this->db->update('produk');

        $dat_order = $this->db->get_where('orderan', ['idorder' => $idorder])->row();
        $data_u = $this->db->get_where('user', ['id' => $dat_order->iduser])->row();
        
        $this->db->select_sum('qty');
        $data_odet = $this->db->get_where('order_detail', ['idorder' => $idorder])->row();

        $this->db->set('point', $data_u->point + $data_odet->qty);
        $this->db->where('id', $data_u->id);
        $this->db->update('user');

    }

    function batal_order(){
        $idorder = $this->input->get('idorder');
        
        $this->db->set('status', 'Canceled');
        $this->db->where('idorder', $idorder);
        $this->db->update('orderan');
    }

    function konfirmasi_checkout($url){
        $idorder = $this->input->post('idorder');
        
        $img  = $_FILES['gambar'];

        $this->db->where('idorder', $idorder);
        $g =  $this->db->get('orderan')->row_array();

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/bukti-tf/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata(
                    'message',
                    'gagal_order'
                );
                redirect('home ');
            } else {
                unlink("./assets/img/bukti-tf/" . $g['bukti_tf']);
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = '';
        }

        $this->db->set('bukti_tf', $gambar);
        $this->db->where('idorder', $idorder);
        $this->db->update('orderan');

        $get_order = $this->db->get_where('orderan', ['idorder' => $idorder])->row();

        $this->db->set('status', 'on');
        $this->db->where('id', $get_order->iduser);
        $this->db->update('user');

        if($url == 'keagenan'){
        redirect('keagenan/detail_order/'.$idorder);
        }else{
        redirect('cetak_invoice?idorder='.$idorder);
        }
    }

    function batal_konfirmasi(){
        $id = $this->input->post('idorder');
        $this->db->set('status', 'Pending');
        $this->db->where('idorder', $id);
        $this->db->update('orderan');

        $get_od = $this->db->get_where('order_detail', ['idorder' => $id])->row();
        $get_prod = $this->db->get_where('produk', ['id' => $get_od->idproduk])->row();

        $this->db->set('stok', $get_prod->stok + $get_od->qty);
        $this->db->where('id', $get_prod->id);
        $this->db->update('produk');
    }

    public function produk()
    {
        $slug = $this->uri->segment(3);
        $data['title'] =  'Update Produk';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['produk'] = $this->db->get_where('produk', ['slug' => $slug])->row_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/produk/edit_produk', $data);
        $this->load->view('admin/footer', $data);
      
    }

    function update_produk(){
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $slug       = url_title($nama, '-', TRUE);
        $img  = $_FILES['gambar'];

        $this->db->where('id', $id);
        $g =  $this->db->get('produk')->row_array();

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
                unlink("./assets/img/produk/" . $g['img']);
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = $g['img'];
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
        $this->db->where('id', $id);
        $this->db->update('produk', $data);

        redirect('update/produk/'.$slug);
    }


    public function user()
    {
        $id = $this->uri->segment(3);
        $data['title'] =  'Update User';
        $data['web'] =  $this->db->get('website')->row_array();

        $data['user'] = $this->db->get_where('user', ['id' => $id])->row_array();

        $data['prov'] =  $this->db->get('provinsi')->result_array();
        $data['agen'] =  $this->db->get('keagenan')->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/user/edit_user', $data);
        $this->load->view('admin/footer', $data);
    }

    function update_user(){
        
        $id = $this->input->post('id');
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        if($this->input->post('status') == NULL){
            $status = 'off';
        } else {
            $status = 'on';
        }

        $cek_pass = $this->db->get_where('user', ['id' => $id])->row_array();

        if(empty($password)){
            $pass = $cek_pass['password'];
        }else{
            $pass = password_hash($password, PASSWORD_DEFAULT);
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $email,
            'password' => $pass,
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
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        redirect('update/user/'.$id);
    }

    function update_user_agen(){
        
        $id = $this->input->post('id');
        $email = $this->input->post('email');

        $data = [
            'nama' => $this->input->post('nama'),
            'email' => $email,
            'no_hp' => $this->input->post('no_hp'),
            'prov' => $this->input->post('prov'),
            'kab' => $this->input->post('kab'),
            'kec' => $this->input->post('kec'),
            'alamat' => $this->input->post('alamat'),
            'nama_rek' => $this->input->post('nama_rek'),
            'no_rek' => $this->input->post('nomor_rek'),
            'nama_bank' => $this->input->post('bank')
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);

        redirect('keagenan/akun');
    }


    function faq(){
        $id = $this->input->post('id');
        $data = [
            'pertanyaan' => $this->input->post('pertanyaan'),
            'jawaban' => $this->input->post('jawaban'),
            'role' => $this->input->post('role')
        ];
        $this->db->where('id', $id);
        $this->db->update('faq', $data);
    }

    function website(){
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'title' => $this->input->post('title'),
            'short_desk' => $this->input->post('short_desk'),
            'email' => $this->input->post('email'),
            'telp' => $this->input->post('telp'),
            'jam' => $this->input->post('jam'),
            'deskripsi' => $this->input->post('deskripsi')
        ];
        $this->db->where('id', $id);
        $this->db->update('website', $data);
    }

    function rekening(){
        $id = $this->input->post('id');
        $data = [
            'nama' => $this->input->post('nama'),
            'no_rek' => $this->input->post('no_rek'),
            'bank' => $this->input->post('bank'),
            'status' => $this->input->post('status')
        ];
        $this->db->where('id', $id);
        $this->db->update('data_bank', $data);

        redirect('admin/rekening');
    }


    function sosmed(){
        $id = $this->input->post('id');
        $data = [
            'fb' => $this->input->post('fb'),
            'tw' => $this->input->post('tw'),
            'ig' => $this->input->post('ig')
        ];
        $this->db->where('id', $id);
        $this->db->update('website', $data);
    }

    function maps(){
        $id = $this->input->post('id');
        $data = [
            'maps' => $this->input->post('maps'),
            'alamat' => $this->input->post('alamat')
        ];
        $this->db->where('id', $id);
        $this->db->update('website', $data);
    }

    function akun(){
        $id   = $this->input->post('id');
        $img  = $_FILES['gambar'];
     
        if ($img['name'] == '') {
            $data = [
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'no_hp' => $this->input->post('no_hp')
            ];
        } else {
            $config['upload_path'] = './assets/img/admin/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('message', '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>');
                redirect('admin/akun');
            } else {
                $this->db->where('id', $id);
                $g =  $this->db->get('admin')->row_array();
                unlink("./assets/img/admin/" . $g['img']);
                $gambar = $this->upload->data('file_name');

                $data = [
                    'nama' => $this->input->post('nama'),
                    'email' => $this->input->post('email'),
                    'no_hp' => $this->input->post('no_hp'),
                    'img' => $gambar
                ];
            }
        }

        $this->db->where('id', $id);
        $this->db->update('admin', $data);
        redirect('admin/akun');
    }

    function password($url){
      
        $id = $this->input->post('id');
        $data = [
            'password' => password_hash($this->input->post('password_ulang'), PASSWORD_DEFAULT),
        ];
        $this->db->where('id', $id);

        if($url == 'user'){
            $this->db->update('user', $data);
        }else{
            $this->db->update('admin', $data);
        }
    }

    
    public function paket_keagenan()
    {
        $slug = $this->uri->segment(3);
        $data['title'] =  'Edit Paket Keagenan';
        $data['web'] =  $this->db->get('website')->row_array();
        
        $data['agen'] =  $this->db->get_where('keagenan', ['slug' => $slug])->row_array();
        $this->db->where('status', 'on');
        $data['produk'] =  $this->db->get('produk')->result_array();

        $this->load->view('admin/header', $data);
        $this->load->view('admin/sidebar', $data);
        $this->load->view('admin/topbar', $data);
        $this->load->view('admin/page/paket_keagenan/edit_paket', $data);
        $this->load->view('admin/footer', $data);
    }

    public function update_paket_keagenan()
    {
        $nama = $this->input->post('nama');
        $slug       = url_title($nama, '-', TRUE);
        $this->Main_model->update_paket_keagenan();

        redirect('update/paket_keagenan/'.$slug);
    }

    
    function testimoni(){
        $id   = $this->input->post('id');
        $img  = $_FILES['gambar'];

        $this->db->where('id', $id);
        $g =  $this->db->get('testimoni')->row_array();

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/testimoni/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('message', '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>');
                redirect('admin/testimoni');
            } else {
                unlink("./assets/img/testimoni/" . $g['img']);
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = $g['img'];
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'job' => $this->input->post('job'),
            'testi' => $this->input->post('testi'),
            'img' => $gambar
        ];
        $this->db->where('id', $id);
        $this->db->update('testimoni', $data);
        redirect('admin/testimoni');
    }

    
    function logo(){
        $id   = $this->input->post('id');

        $config['upload_path'] = './assets/img/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size']  = '8048';
        $config['remove_space'] = TRUE;

        $this->load->library('upload', $config); // Load konfigurasi uploadnya
        
        $this->db->where('id', $id);
        $g =  $this->db->get('website')->row_array();

        if ($this->upload->do_upload('logo')) {
            $logo  = $this->upload->data('file_name');
            unlink("./assets/img/" . $g['logo']);
        } else {
            $logo  = $g['logo'];
        }
        if ($this->upload->do_upload('fav')) {
            $fav  = $this->upload->data('file_name');
            unlink("./assets/img/" . $g['fav']);
        } else {
            $fav  = $g['fav'];
        }
        if ($this->upload->do_upload('og')) {
            $og  = $this->upload->data('file_name');
            unlink("./assets/img/" . $g['og']);
        } else {
            $og  = $g['og'];
        }
        
        $data = [
            'logo' => $logo,
            'fav' => $fav,
            'og' => $og
        ];
        $this->db->where('id', $id);
        $this->db->update('website', $data);
        redirect('admin/website');
    }

    
    function gallery(){
        $id   = $this->input->post('id');
        $img  = $_FILES['gambar'];

        $this->db->where('id', $id);
        $g =  $this->db->get('gallery')->row_array();

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/gallery/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('message', '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>');
                redirect('admin/data_gallery');
            } else {
                unlink("./assets/img/gallery/" . $g['img']);
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = $g['img'];
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => $this->input->post('status'),
            'img' => $gambar
        ];
        $this->db->where('id', $id);
        $this->db->update('gallery', $data);
        redirect('admin/data_gallery');
    }

    function frontedit(){
        $id   = $this->input->post('id');
        $img  = $_FILES['gambar'];
        // $img   = $this->input->post('gambar');

        // echo $id;
        // die();
        // $id=$GET['id'];

        $this->db->where('id', $id);
        $g = $this->db->get('front_foto')->row_array();

        // echo "<pre>";
        // print_r($g);
        // echo "</pre>";
        // die();

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/front/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('message', '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>');
                redirect('admin/front_image');
            } else {
                unlink("./assets/img/front/" . $g['img']);
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = $g['img'];
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => $this->input->post('status'),
            'img' => $gambar,
            'text' => $this->input->post('text')
        ];
        $this->db->where('id', $id);
        $this->db->update('front_foto', $data);
        redirect('admin/front_image');
    }


    function slideedit(){
        $id   = $this->input->post('id');
        $img  = $_FILES['gambar'];

        $this->db->where('id', $id);
        $g =  $this->db->get('slideshow')->row_array();

        if ($img['name'] !== '') {
            $config['upload_path'] = './assets/img/slideshow/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '8048';
            $config['remove_space'] = TRUE;

            $this->load->library('upload', $config); // Load konfigurasi uploadnya
            if (!$this->upload->do_upload('gambar')) {
                $this->session->set_flashdata('message', '<script>Swal.fire({
                    confirmButtonText: "Oke!",
                    icon: "error",
                    title: "Gagal!",
                    text: "Gambar gagal di upload."})</script>');
                redirect('admin/front_image');
            } else {
                unlink("./assets/img/slideshow/" . $g['img']);
                $gambar = $this->upload->data('file_name');
            }
        }else{
            $gambar = $g['img'];
        }
        $data = [
            'nama' => $this->input->post('nama'),
            'status' => $this->input->post('status'),
            'img' => $gambar
        ];
        $this->db->where('id', $id);
        $this->db->update('slideshow', $data);
        redirect('admin/slideshow');
    }


    function baca_kontak(){
        $id=$_GET['id'];
        
        $this->db->set('status', 'Terbaca');
        $this->db->where('id', $id);
        $this->db->update('kontak');
    }

    function reward_point(){
        $id = $this->input->post('keagenan');
        
        $this->db->set('status_point', 'on');
        $this->db->where('id', $id);
        $this->db->update('keagenan');
    }

    function status_point(){
        $id = $this->input->post('id');
        $status = $this->input->post('status');

        $data_point = $this->db->get_where('klaim_point', ['id' => $id])->row();
        $data_u = $this->db->get_where('user', ['id' => $data_point->id_user])->row();

        if($status == 'Error'){
            $this->db->set('point', $data_u->point + $data_point->point);
            $this->db->where('id', $data_u->id);
            $this->db->update('user');
        }

        $this->db->set('status', $status);
        $this->db->where('id', $id);
        $this->db->update('klaim_point');
    }

}
