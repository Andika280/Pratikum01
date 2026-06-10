<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring_model extends CI_Model {

    public function get_all() {
        return $this->db->order_by('id', 'DESC')->get('laporan')->result_array();
    }

    public function get_by_id($id) {
        return $this->db->get_where('laporan', ['id' => $id])->row_array();
    }

    public function insert($data) {
        return $this->db->insert('laporan', $data);
    }

    public function update($id, $data) {
        return $this->db->where('id', $id)->update('laporan', $data);
    }

    public function delete($id) {
        if (empty($id)) return false;
        return $this->db->where('id', $id)->limit(1)->delete('laporan');
    }
}
