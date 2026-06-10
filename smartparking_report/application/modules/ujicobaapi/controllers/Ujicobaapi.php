<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ujicobaapi extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Ujicobaapi_model');
    }

    public function handle($id = null)
    {
        $method = $this->input->server('REQUEST_METHOD');

        if ($method === 'GET') {
            $id ? $this->show($id) : $this->index();
            return;
        }

        if ($method === 'POST') {
            $this->store();
            return;
        }

        if ($method === 'PUT' || $method === 'PATCH') {
            $this->update($id);
            return;
        }

        if ($method === 'DELETE') {
            $this->delete($id);
            return;
        }

        $this->json_response(405, false, 'Method not allowed');
    }

    public function index()
    {
        $data = $this->Ujicobaapi_model->get_all();
        $this->json_response(200, true, 'Data ujicoba berhasil diambil', $data);
    }

    public function show($id)
    {
        if (!$this->is_valid_id($id)) {
            $this->json_response(400, false, 'ID tidak valid');
            return;
        }

        $data = $this->Ujicobaapi_model->get_by_id($id);

        if (!$data) {
            $this->json_response(404, false, 'Data ujicoba tidak ditemukan');
            return;
        }

        $this->json_response(200, true, 'Detail ujicoba berhasil diambil', $data);
    }

    public function store()
    {
        $input = $this->get_input();

        if (empty($input['nama'])) {
            $this->json_response(400, false, 'Nama wajib diisi');
            return;
        }

        $data = array(
            'nama' => $this->clean_value($input['nama']),
            'keterangan' => isset($input['keterangan']) ? $this->clean_value($input['keterangan']) : null
        );

        $id = $this->Ujicobaapi_model->insert($data);
        $created = $this->Ujicobaapi_model->get_by_id($id);

        $this->json_response(201, true, 'Data ujicoba berhasil ditambahkan', $created);
    }

    public function update($id = null)
    {
        $input = $this->get_input();
        $id = $id ?: (isset($input['id']) ? $input['id'] : null);

        if (!$this->is_valid_id($id)) {
            $this->json_response(400, false, 'ID tidak valid');
            return;
        }

        if (!$this->Ujicobaapi_model->exists($id)) {
            $this->json_response(404, false, 'Data ujicoba tidak ditemukan');
            return;
        }

        if (empty($input['nama'])) {
            $this->json_response(400, false, 'Nama wajib diisi');
            return;
        }

        $data = array(
            'nama' => $this->clean_value($input['nama']),
            'keterangan' => isset($input['keterangan']) ? $this->clean_value($input['keterangan']) : null
        );

        $this->Ujicobaapi_model->update($id, $data);
        $updated = $this->Ujicobaapi_model->get_by_id($id);

        $this->json_response(200, true, 'Data ujicoba berhasil diubah', $updated);
    }

    public function delete($id = null)
    {
        if (!$this->is_valid_id($id)) {
            $this->json_response(400, false, 'ID tidak valid');
            return;
        }

        if (!$this->Ujicobaapi_model->exists($id)) {
            $this->json_response(404, false, 'Data ujicoba tidak ditemukan');
            return;
        }

        $this->Ujicobaapi_model->delete($id);
        $this->json_response(200, true, 'Data ujicoba berhasil dihapus');
    }

    public function get_data()
    {
        $this->index();
    }

    public function get_by_id($id)
    {
        $this->show($id);
    }

    public function tambah()
    {
        $this->store();
    }

    public function ubah()
    {
        $this->update();
    }

    public function hapus($id)
    {
        $this->delete($id);
    }

    private function get_input()
    {
        $input = json_decode(file_get_contents('php://input'), true);

        if (is_array($input)) {
            return $input;
        }

        if (!empty($_POST)) {
            return $_POST;
        }

        parse_str(file_get_contents('php://input'), $parsed);

        return is_array($parsed) ? $parsed : array();
    }

    private function json_response($code, $status, $message, $data = null)
    {
        $response = array(
            'status' => $status,
            'message' => $message
        );

        if ($data !== null) {
            $response['data'] = $data;
        }

        return $this->output
            ->set_status_header($code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($response, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
    }

    private function clean_value($value)
    {
        return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
    }

    private function is_valid_id($id)
    {
        return is_numeric($id) && (int) $id > 0;
    }
}
