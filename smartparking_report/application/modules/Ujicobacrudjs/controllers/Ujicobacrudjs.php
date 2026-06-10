<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujicobacrudjs extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ujicobacrudjs_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $this->load->view('index');
    }

    public function get_data()
    {
        $data = $this->Ujicobacrudjs_model->get_all();
        echo json_encode($data);
    }

    public function get_by_id($id)
    {
        $data = $this->Ujicobacrudjs_model->get_by_id($id);
        echo json_encode($data);
    }

    public function tambah()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->Ujicobacrudjs_model->insert($data);
        
        echo json_encode(array("status" => TRUE));
    }

    public function ubah()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );
        $this->Ujicobacrudjs_model->update(array('id' => $this->input->post('id')), $data);
        
        echo json_encode(array("status" => TRUE));
    }

    public function hapus($id)
    {
        $this->Ujicobacrudjs_model->delete($id);
        echo json_encode(array("status" => TRUE));
    }
}
