<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Get extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }


    public function get_kota()
    {
        $prov = $this->input->post('prov');
        if (isset($prov)) {
            $this->db->order_by('nama_kab', 'asc');
            $this->db->where('id_prov', $prov);
            $query  =  $this->db->get('kabupaten');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                $options = '';
                    $options .= '<option value="" selected disabled>- Pilih Kota -</option>';
                foreach ($result as $value) {
                    $options  .= '<option value="' . $value['id_kab'] . '">' .
                        $value['nama_kab'] . '</option>';
                }
                echo $options;
            }
        }
    }


    public function get_kec()
    {
        $kab = $this->input->post('kab');
        if (isset($kab)) {
            $this->db->order_by('nama', 'asc');
            $this->db->where('id_kab', $kab);
            $query  =  $this->db->get('kecamatan');
            $result =  $query->result_array();
            if (isset($result[0]) && is_array($result)) {
                $options = '';
                $options .= '<option value="" selected disabled>- Pilih Kecamatan -</option>';
                foreach ($result as $value) {
                    $options  .= '<option value="' . $value['nama'] . '">' .
                        $value['nama'] . '</option>';
                }
                echo $options;
            }
        }
    }

    public function get_password($segmen)
    {
        $id = $this->input->post('id');
        $pw = $this->input->post('password');

        $this->db->where('id', $id);

        if($segmen == 'user'){
            $user  =  $this->db->get('user')->row_array();
        }else{
            $user  =  $this->db->get('admin')->row_array();
        }
        
        if(password_verify($pw, $user['password']) == true) {
            echo 0; // Tampilkan pesan
        }else{ // Jika belum ada
            echo 1; // Tampilkan pula pesan
        }
    }

    
    public function load_temp()
    {
        echo "<table class='table table-md table-bordered'>";
        $id=$_GET['fk'];
        $data = $this->db->query("SELECT * FROM paket_agen where fk_agen='$id'")->result();

        foreach ($data as $d) {
          $prod = $this->db->get_where('produk', ['id' => $d->id_produk])->row_array();
          
          echo '<tr id="dataku'.$d->id.'">
                    <td>
                        <img src="' . base_url('assets/img/produk/' . $prod['img']) . '" class="img-fluid img-thumbnail" alt="' . $prod['nama'] . '" width="50" height="50"/>  
                        ' . $prod['sku'] . '
                    </td>
                    <td><div class="mt-2">' . $prod['nama'] . '</div></td>
                    <td width="50px"><button type ="button" class="btn btn-icon btn-sm btn-danger mt-1" onClick="hapus('.$d->id.')"><i class="fa fa-trash"></i></td>
                </tr>';
            
        }
        echo '</table>';
                   
    }

    
    public function load_temp1()
    {
        echo "<table class='table table-md table-bordered'>
                <thead class='bg-secondary'>
                    <tr>th>
                        <th>Minimal</th>
                        <th>Maximal</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>";
        $id_fk   = $this->input->post('fk');
        $data = $this->db->query("SELECT * FROM harga_paket where fk_agen='$id_fk'")->result();

        foreach ($data as $d) {
          $prod = $this->db->get_where('produk', ['id' => $d->id_produk])->row_array();
          
          echo '<tr id="datakuAa'.$d->id.'">
                    <td>' . $prod['nama'] . '</td>
                    <td>' . $d->min . '</td>
                    <td>' . $d->max . '</td>
                    <td>Rp.' . $d->harga. ' </td>
                    <td width="50px"><button type ="button" class="btn btn-icon btn-sm btn-danger mt-1" onClick="hapusAa('.$d->id.')"><i class="fa fa-trash"></i></td>
                </tr>';
            
        }
        echo '</table>';
                   
    }
    
    public function load_temp2()
    {
        echo '<label>Produk</label>
                <select class="form-control select2bs4" style="width: 100%;" name="produk1" id="produk1">
                    <option selected="selected" value="">- Pilih Produk -</option>';

        $id_fk   = $this->input->post('fk');
        $data = $this->db->query("SELECT * FROM paket_agen where fk_agen='$id_fk'")->result();

        foreach ($data as $d) {
          $prod = $this->db->get_where('produk', ['id' => $d->id_produk])->row_array();
          
          echo '<option value="'. $prod['id'] .'">'. $prod['sku'] ,' - '. $prod['nama'] .'</option>';
             $prod['sku'] .' - '. $prod['sku'] .' -'; 
        }
        echo '      </select>';
                   
    }
    
    
    public function get_email()
    {
        $segmen = $this->uri->segment(3);
        $email = $this->input->post('email');
        $email1 = $this->input->post('email1');

        if($segmen == 'edit'){
            $this->db->where('email !=', $email1);
        }else{
            $this->db->where('email', $email);
        }
        $data  =  $this->db->get('user')->row_array();

        if($data['email'] == $email) {
            echo 1; 
        }else{
            echo 0; 
        }
    }
    
    
    public function get_nama_produk()
    {
        $segmen = $this->uri->segment(3);
        $nama = $this->input->post('nama');
        $slug1 = $this->input->post('slug');
        $slug       = url_title($nama, '-', TRUE);

        if($segmen == 'edit'){
            $this->db->where('slug !=', $slug1);
        }else{
            $this->db->where('slug', $slug);
        }
        $user  =  $this->db->get('produk')->row_array();

        if($user['slug'] == $slug) {
            echo 1; 
        }else{
            echo 0; 
        }
    }
    
    
    public function get_sku()
    {
        $segmen = $this->uri->segment(3);
        $sku = $this->input->post('sku');
        $sku1 = $this->input->post('sku1');

        if($segmen == 'edit'){
            $this->db->where('sku !=', $sku1);
        }else{
            $this->db->where('sku', $sku);
        }
        $data  =  $this->db->get('produk')->row_array();

        if($data['sku'] == $sku) {
            echo 1; 
        }else{
            echo 0; 
        }
    }
    
    
    public function get_slug_paket_keagenan()
    {
        $segmen = $this->uri->segment(3);
        $nama = $this->input->post('nama');
        $slug1 = $this->input->post('slug');
        $slug       = url_title($nama, '-', TRUE);

        if($segmen == 'edit'){
            $this->db->where('slug !=', $slug1);
        }else{
            $this->db->where('slug', $slug);
        }
        $user  =  $this->db->get('keagenan')->row_array();

        if($user['slug'] == $slug) {
            echo 1; 
        }else{
            echo 0; 
        }
    }

    public function get_idorder()
    {
        $id = $this->input->post('idorder');
        $this->db->where('idorder', $id);
        $data  =  $this->db->get('orderan')->num_rows();

        if($data == 1) {
            echo 2; 
        }else{
            echo 1; 
        }
    }

    public function get_user_point()
    {
        $id = $this->input->post('id_user');
        $point = $this->input->post('point');

        $this->db->where('id', $id);
        $data  =  $this->db->get('user')->row();

        if($data->point < $point) {
            echo 1; 
        }else{
            echo 0; 
        }
    }
    
}
