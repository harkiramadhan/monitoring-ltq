<?php
class Kelas extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar'
        ]);

        if($this->session->userdata('masuk') != TRUE)
            redirect('', 'refresh');
    }
    
    function index(){
        $userid = $this->session->userdata('userid');
        $idlembaga = $this->session->userdata('idlembaga');
        $role = $this->session->userdata('role');
        $roleString = $this->session->userdata('role_string');

        $var = [
            'title' => 'Semester',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'ajax' => [
                'ajax_kelas'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/kelas', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }
}