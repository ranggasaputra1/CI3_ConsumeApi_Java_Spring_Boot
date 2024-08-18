<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomeController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        $api_url = 'http://localhost:8080/lokasi'; 

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

        $this->load->view('home_view', $data);
    }

    public function show_add_location_form() {
        // Show the form to add a new location
        $this->load->view('add_location_view');
    }

    public function add_location() {
        if ($this->input->post()) {
            $namaLokasi = $this->input->post('namaLokasi');
            $negara = $this->input->post('negara');
            $provinsi = $this->input->post('provinsi');
            $kota = $this->input->post('kota');
            $createdAt = $this->input->post('createdAt');
        
            $api_url = 'http://localhost:8080/lokasi';
        
            $data_to_send = json_encode([
                'namaLokasi' => $namaLokasi,
                'negara' => $negara,
                'provinsi' => $provinsi,
                'kota' => $kota,
                'createdAt' => $createdAt
            ]);
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data_to_send);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        
            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
        
            if ($http_code == 200) {
                $result = json_decode($response, true);
                if (isset($result['success']) && $result['success']) {
                    $this->session->set_flashdata('message', ['success' => 'Lokasi berhasil ditambahkan!']);
                } else {
                    $this->session->set_flashdata('message', ['success' => 'Lokasi berhasil ditambahkan!']);
                }
            } else {
                $this->session->set_flashdata('message', ['error' => 'Error: ' . $response]);
            }

            redirect('HomeController');
        }
    }

    public function edit_location($id) {
        $api_url = 'http://localhost:8080/lokasi/' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET'); // Gunakan GET jika Anda hanya ingin mengambil data
        $response = curl_exec($ch);
        curl_close($ch);
    
        $location = json_decode($response, true);
        if (empty($location)) {
            $this->session->set_flashdata('message', ['error' => 'Data tidak ditemukan!']);
            redirect('HomeController');
        }
    
        $data['location'] = $location;
        $this->load->view('update_location_view', $data);
    }
    public function update_location() {
        $id = $this->input->post('id');
        $data = [
            'namaLokasi' => $this->input->post('namaLokasi'),
            'negara' => $this->input->post('negara'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'createdAt' => $this->input->post('createdAt')
        ];
    
        $api_url = 'http://localhost:8080/lokasi/' . $id;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT'); // Gunakan PUT untuk update data
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen(json_encode($data))
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
    
        $result = json_decode($response, true);
        if (isset($result['error'])) {
            $this->session->set_flashdata('message', ['error' => $result['error']]);
        } else {
            $this->session->set_flashdata('message', ['success' => 'Data berhasil diupdate!']);
        }
    
        redirect('HomeController');
    }    

    public function delete_location($id) {
        $api_url = 'http://localhost:8080/lokasi/' . $id;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Gunakan DELETE untuk menghapus data
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($http_code == 204) { // HTTP status code 204 No Content untuk sukses
            $this->session->set_flashdata('message', ['success' => 'Lokasi berhasil dihapus.']);
        } else {
            $this->session->set_flashdata('message', ['error' => 'Gagal menghapus lokasi.']);
        }
        
        redirect('HomeController');
    }
    
}
