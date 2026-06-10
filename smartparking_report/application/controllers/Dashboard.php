<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('login')) {
            redirect('auth/login');
        }
        $this->load->model('Monitoring_model');
    }

    public function index($edit_id = null) {
        $data['monitoring'] = $this->Monitoring_model->get_all();
        $data['edit'] = [
            "id"=>"",
            "lokasi"=>"",
            "waktu_laporan"=>"",
            "jumlah_kendaraan"=>"",
            "status_pelanggaran"=>"",
            "deskripsi"=>"",
            "foto_bukti"=>""
        ];

        $id = $edit_id ? $edit_id : $this->input->get('edit');

        if ($id) {

            $edit_data = $this->Monitoring_model->get_by_id($id);

            if ($edit_data) {
                $data['edit'] = $edit_data;
            }

        }

        $this->load->view('dashboard/index', $data);
    }

    public function save() {
        $id = $this->input->post('id');
        $lokasi = $this->input->post('lokasi');
        $waktu = $this->input->post('waktu_laporan');
        $jumlah_kendaraan = (int)$this->input->post('jumlah_kendaraan');
        $deskripsi = $this->input->post('deskripsi');

        // Logika Status: 1-5 Ringan, 6-15 Sedang, >15 Berat
        if ($jumlah_kendaraan <= 5) {
            $status = 1; // Ringan
        } elseif ($jumlah_kendaraan <= 15) {
            $status = 2; // Sedang
        } else {
            $status = 3; // Berat
        }

        $foto = $this->input->post('foto_lama');

        if (!empty($_FILES['foto_bukti']['name'])) {
            $config['upload_path']   = './assets/uploads/';
            $config['allowed_types'] = 'jpg|jpeg|png';
            $config['file_name']     = time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_bukti')) {
                $upload_data = $this->upload->data();
                $foto = $upload_data['file_name'];
                
                // Hapus foto lama jika ada dan sedang update
                $old_foto = $this->input->post('foto_lama');
                if ($id && $old_foto && file_exists('./assets/uploads/' . $old_foto)) {
                    unlink('./assets/uploads/' . $old_foto);
                }
            }
        }

        // Ambil user_id dari database berdasarkan session username
        $user = $this->db->get_where('users2', ['username' => $this->session->userdata('username')])->row_array();

        $data = [
            'user_id' => $user['id'],
            'lokasi' => $lokasi,
            'waktu_laporan' => $waktu,
            'jumlah_kendaraan' => $jumlah_kendaraan,
            'status_pelanggaran' => $status,
            'deskripsi' => $deskripsi,
            'foto_bukti' => $foto
        ];

        if ($id) {
            $this->Monitoring_model->update($id, $data);
            $this->session->set_flashdata('success', 'Data berhasil diupdate!');
        } else {
            $this->Monitoring_model->insert($data);
            $this->session->set_flashdata('success', 'Data berhasil disimpan!');
        }

        redirect('dashboard');
    }

    public function delete($id = null) {
        if (empty($id)) {
            redirect('dashboard');
        }

        $data = $this->Monitoring_model->get_by_id($id);
        if ($data) {
            if ($data['foto_bukti'] && file_exists('./assets/uploads/' . $data['foto_bukti'])) {
                unlink('./assets/uploads/' . $data['foto_bukti']);
            }

            $this->Monitoring_model->delete($id);
            $this->session->set_flashdata('success', 'Data berhasil dihapus!');
        }
        redirect('dashboard');
    }
}
