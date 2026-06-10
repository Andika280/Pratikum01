<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function login($username, $password) {
        $user = $this->db->get_where('users2', ['username' => $username, 'password' => $password])->row_array();
        return $user;
    }

    public function register($data) {
        return $this->db->insert('users2', $data);
    }
}
