<?php
class M_Auth extends CI_Model {

    public function cek_login($username, $password) {
        return $this->db->get_where('users', ['username' => $username, 'password' => $password]);
    }

    public function cek_username($username) {
        return $this->db->get_where('users', ['username' => $username])->num_rows();
    }

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }
}