<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujicobacrudjs_model extends CI_Model {

    var $table = 'ujicoba';

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        
        if (!$this->db->table_exists($this->table)) {
            $this->load->dbforge();
            $fields = array(
                'id' => array(
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => TRUE,
                    'auto_increment' => TRUE
                ),
                'nama' => array(
                    'type' => 'VARCHAR',
                    'constraint' => '100',
                ),
                'keterangan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE,
                ),
            );
            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function get_all()
    {
        $this->db->from($this->table);
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
