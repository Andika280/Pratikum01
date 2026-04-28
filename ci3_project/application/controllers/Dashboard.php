<?php
class Dashboard extends CI_Controller {
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('login')) redirect('auth');
        $this->load->model('M_Produk');
    }
    public function index() {
        $data['produk'] = $this->M_Produk->get_all();
        $data['edit'] = ['id'=>'', 'nama_produk'=>'', 'kategori'=>'', 'harga'=>'', 'gambar'=>''];
        if($this->input->get('edit_id')) {
            $data['edit'] = $this->M_Produk->get_by_id($this->input->get('edit_id'));
        }
        $this->load->view('dashboard', $data);
    }
    public function simpan() {
        $id = $this->input->post('id');
        $gambar = $this->input->post('gambar_lama');
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['file_name']     = time() . "_" . $_FILES['gambar']['name'];
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            $gambar = $this->upload->data('file_name');
        }
        $data = [
            'nama_produk' => $this->input->post('nama_produk'),
            'kategori'    => $this->input->post('kategori'),
            'harga'       => $this->input->post('harga'),
            'gambar'      => $gambar
        ];
        if(empty($id)) {
            $this->M_Produk->insert($data);
        } else {
            $this->M_Produk->update($id, $data);
        }
        redirect('dashboard');
    }
    public function hapus($id) {
        $this->M_Produk->delete($id);
        redirect('dashboard');
    }
}