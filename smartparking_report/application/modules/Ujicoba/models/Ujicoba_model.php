<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujicoba_model extends CI_Model {

    private $table = 'ujicoba';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
     * Get all data ujicoba
     */
    public function get_all()
    {
        $this->db->order_by('id', 'desc');
        $query = $this->db->get($this->table);

        return $query->result();
    }

    /**
     * Get data ujicoba by ID
     */
    public function get_by_id($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));

        return $query->row();
    }

    /**
     * Insert new data ujicoba
     */
    public function insert($data)
    {
        $this->db->insert($this->table, $data);

        return $this->db->insert_id();
    }

    /**
     * Update data ujicoba
     */
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    /**
     * Delete data ujicoba
     */
    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    /**
     * Check if data ujicoba exists
     */
    public function exists($id)
    {
        $query = $this->db->get_where($this->table, array('id' => $id));
        return $query->num_rows() > 0;
    }
}
