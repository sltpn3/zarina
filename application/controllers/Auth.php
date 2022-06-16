<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('keagenan');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login Keagenan';
            $data['web'] =  $this->db->get('website')->row_array();

            $this->load->view('auth/header', $data);
            $this->load->view('auth/login');
            $this->load->view('auth/footer');
        } else {
            // validasinya success
            $this->_login();
        }
    }

    public function admin()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {

            $data['title'] = 'Login Admin';
            $data['web'] =  $this->db->get('website')->row_array();

            $this->load->view('auth/header', $data);
            $this->load->view('auth/login_admin');
            $this->load->view('auth/footer');
        } else {
            // validasinya success
            $this->_login_admin();
        }
    }


    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['status'] == 'on') {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'level' => $user['level']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['level'] !== 0) {

                        $this->session->set_flashdata(
                            'message',
                            'login'
                        );
                        redirect('keagenan');
                    } else {
                        $this->load->view('auth/blocked');
                    }
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Password salah!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>'
                    );
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    User ini belum diaktifkan!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             </div>'
                );
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata(
                'message',
               '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email tidak terdaftar!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             </div>'
            );
            redirect('auth');
        }
    }


    private function _login_admin()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('admin', ['email' => $email])->row_array();

        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['status'] == 'on') {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);

                    $this->session->set_flashdata(
                        'message',
                        'login'
                    );
                    redirect('admin');
                } else {
                    $this->session->set_flashdata(
                        'message',
                        '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                     Password salah!
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
                 </div>'
                    );
                    redirect('auth/admin');
                }
            } else {
                $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email ini belum diaktifkan!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             </div>'
                );
                redirect('auth/admin');
            }
        } else {
            $this->session->set_flashdata(
                'message',
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Email tidak terdaftar!
             <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                 <span aria-hidden="true">&times;</span>
             </button>
             </div>'
            );
            redirect('auth/admin');
        }
    }


    public function logout()
    {
        $segmen = $this->uri->segment(3);
        $this->session->unset_userdata('email');

        $this->session->set_flashdata(
            'message',
            '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Anda berhasil Keluar :)
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div>'
        );

        if($segmen == 'admin'){
            redirect('auth/admin');
        }else{
            redirect('auth');
        }
    }

    public function blocked()
    {
        $data['web'] =  $this->db->get('website')->row_array();
        $this->load->view('auth/header', $data);
        $this->load->view('auth/blocked', $data);
        $this->load->view('auth/footer', $data);
    }
}
