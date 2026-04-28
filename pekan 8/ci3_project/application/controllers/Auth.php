<?php
class Auth extends CI_Controller {
    
    public function index() {
        if($this->session->userdata('login')) redirect('dashboard');
        $this->load->view('login');
    }

    public function proses_login() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        
        $this->load->model('M_Auth');
        $cek = $this->M_Auth->cek_login($user, $pass)->num_rows();

        if($cek > 0) {
            $this->session->set_userdata(['login' => TRUE, 'username' => $user]);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('error', 'Username atau Password salah!');
            redirect('auth');
        }
    }

    public function register() {
        if($this->session->userdata('login')) redirect('dashboard');
        $this->load->view('register');
    }

    public function proses_register() {
        $user = $this->input->post('username');
        $pass = $this->input->post('password');
        
        $this->load->model('M_Auth');

        if($this->M_Auth->cek_username($user) > 0) {
            $this->session->set_flashdata('error', 'Username sudah terdaftar! Silakan cari nama lain.');
            redirect('auth/register');
        } else {
            $data = [
                'username' => $user,
                'password' => $pass
            ];
            $this->M_Auth->register_user($data);
            
            $this->session->set_flashdata('success', 'Akun berhasil dibuat! Silakan login.');
            redirect('auth');
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth');
    }
}