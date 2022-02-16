<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model([
            'Muser',
            'Mlembaga'
        ]);

        if($this->session->userdata('masuk') != TRUE)
            redirect('');
    }

    function index(){
        $userid = $this->session->userdata('userid');
        $idlembaga = $this->session->userdata('idlembaga');
        $role = $this->session->userdata('role');
        $roleString = $this->session->userdata('role_string');

        $var = [
            'title' => 'Dashboard',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga)
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/dashboard', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }
}