<?php
class M_Produk extends CI_Model {
    public function get_all() {
        return $this->db->order_by('id', 'DESC')->get('produk')->result_array();
    }
    public function get_by_id($id) {
        return $this->db->get_where('produk', ['id' => $id])->row_array();
    }
    public function insert($data) {
        $this->db->insert('produk', $data);
    }
    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('produk', $data);
    }
    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete('produk');
    }
}