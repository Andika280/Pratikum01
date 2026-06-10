<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login() {
        if ($this->session->userdata('login')) {
            redirect('dashboard');
        }

        if ($this->input->post('login') !== NULL) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->login($username, $password);

            if ($user) {
                $this->session->set_userdata([
                    'login' => TRUE,
                    'username' => $user['username']
                ]);
                redirect('dashboard');
            } else {
                $this->session->set_flashdata('error', 'Username atau Password salah!');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    public function register() {
        if ($this->input->post('register') !== NULL) {
            $data = [
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            ];

            if ($this->User_model->register($data)) {
                $this->session->set_flashdata('success', 'Registrasi sukses! Silakan login.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/register');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
