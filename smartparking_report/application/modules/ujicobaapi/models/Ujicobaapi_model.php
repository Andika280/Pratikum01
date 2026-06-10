<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujicobaapi_model extends CI_Model {

    private $table = 'ujicoba';

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
                    'constraint' => 100
                ),
                'keterangan' => array(
                    'type' => 'TEXT',
                    'null' => TRUE
                )
            );

            $this->dbforge->add_field($fields);
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table($this->table, TRUE);
        }
    }

    public function get_all()
    {
        $this->db->order_by('id', 'desc');
        return $this->db->get($this->table)->result();
    }

    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, array('id' => $id))->row();
    }

    public function insert($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete($this->table);
    }

    public function exists($id)
    {
        return $this->get_by_id($id) !== null;
    }
}
