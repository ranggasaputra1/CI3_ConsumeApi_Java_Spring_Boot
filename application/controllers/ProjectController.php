<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $api_url = 'http://localhost:8080/proyek'; 

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            $data['error'] = 'Error: ' . curl_error($ch);
            $data['result'] = [];
        } else {
            curl_close($ch);
            $data['result'] = json_decode($response, true);
        }

        $this->load->view('project_view', $data);
    }

    public function show_add_project_form() {
        $this->load->view('add_project_view');
    }

    public function add_project() {
        if ($this->input->post()) {
            $data = [
                'namaProyek' => $this->input->post('namaProyek'),
                'client' => $this->input->post('client'),
                'tglMulai' => $this->input->post('tglMulai'),
                'tglSelesai' => $this->input->post('tglSelesai'),
                'pimpinanProyek' => $this->input->post('pimpinanProyek'),
                'keterangan' => $this->input->post('keterangan'),
            ];
        
            $api_url = 'http://localhost:8080/proyek';
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
    
            // Debugging output
            log_message('debug', 'API Response: ' . $response);
            log_message('debug', 'HTTP Code: ' . $http_code);
        
            if ($http_code == 200) {
                $this->session->set_flashdata('message', ['success' => 'Proyek berhasil ditambahkan!']);
            } else {
                $this->session->set_flashdata('message', ['error' => 'Error: ' . $response]);
            }
        
            redirect('ProjectController');
        }
    }

    public function delete_project($id) {
        // URL endpoint API untuk menghapus proyek
        $api_url = 'http://localhost:8080/proyek/' . $id;
    
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Menggunakan metode DELETE
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
    
        if ($http_code == 200) {
            $this->session->set_flashdata('message', ['success' => 'Proyek berhasil dihapus!']);
        } else {
            $this->session->set_flashdata('message', ['success' => 'Error: ' . $response]);
        }
    
        redirect('ProjectController');
    }
    
    
    
}
