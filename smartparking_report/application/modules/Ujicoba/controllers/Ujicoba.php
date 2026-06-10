<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujicoba extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ujicoba_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['data_ujicoba'] = $this->Ujicoba_model->get_all();
        $data['title'] = 'Data Ujicoba';

        $this->load->view('index', $data);
    }

    public function create()
    {
        $data['title'] = 'Tambah Data Ujicoba';

        $this->load->view('create', $data);
    }

    public function store()
    {
        $data = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->Ujicoba_model->insert($data);
        redirect('Ujicoba');
    }

    public function show($id)
    {
        $data_ujicoba = $this->Ujicoba_model->get_by_id($id);

        if (!$data_ujicoba) {
            show_404();
            return;
        }

        $data['data_ujicoba'] = $data_ujicoba;
        $data['title'] = 'Detail Data Ujicoba';

        $this->load->view('show', $data);
    }

    public function edit($id)
    {
        $data_ujicoba = $this->Ujicoba_model->get_by_id($id);

        if (!$data_ujicoba) {
            show_404();
            return;
        }

        $data['data_ujicoba'] = $data_ujicoba;
        $data['title'] = 'Ubah Data Ujicoba';

        $this->load->view('edit', $data);
    }

    public function update($id)
    {
        if (!$this->Ujicoba_model->exists($id)) {
            show_404();
            return;
        }

        $data = array(
            'nama' => $this->input->post('nama'),
            'keterangan' => $this->input->post('keterangan')
        );

        $this->Ujicoba_model->update($id, $data);
        redirect('Ujicoba');
    }

    public function delete($id)
    {
        if (!$this->Ujicoba_model->exists($id)) {
            show_404();
            return;
        }

        $this->Ujicoba_model->delete($id);
        redirect('Ujicoba');
    }

    public function tambah()
    {
        $this->store();
    }

    public function ubah()
    {
        $id = $this->input->post('id');
        $this->update($id);
    }

    public function hapus($id)
    {
        $this->delete($id);
    }
}
