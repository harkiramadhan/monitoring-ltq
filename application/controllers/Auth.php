<?php
class Auth extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Mauth'
        ]);
    }
    function index(){

    }

    function login(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
        
        $cek = $this->Mauth->auth($username, $password);
        if($cek->num_rows() > 0){
            $data = $cek->row_array();
            if($data['status'] == 1){
                $this->session->set_userdata('masuk', TRUE);
                $this->session->set_userdata('userid', $data['id']);
                $this->session->set_userdata('idlembaga', $data['id_lembaga']);
                $this->session->set_userdata('nama', $data['nama']);
                $this->session->set_userdata('role', $data['role']);
                $this->session->set_userdata('role_string', $data['string']);

                redirect('dashboard', 'refresh');
            }else{
                $this->session->set_flashdata('msg', "Silahkan Hubungi Admin Anda Untuk Mengaktifkan Akun ");
                redirect($_SERVER['HTTP_REFERER']);
            }

        }else{
            $this->session->set_flashdata('msg', "Username atau Password TIdak Cocok");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function logout(){

    }
}