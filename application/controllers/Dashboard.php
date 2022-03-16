<?php
class Dashboard extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mtahunajar'
        ]);

        if($this->session->userdata('masuk') != TRUE)
            redirect('');
    }

    function index(){
        $userid = $this->session->userdata('userid');
        $idlembaga = $this->session->userdata('idlembaga');
        $role = $this->session->userdata('role');
        $roleString = $this->session->userdata('role_string');
        $tahunajar = $this->Mtahunajar->getActiveLembaga($idlembaga);

        $var = [
            'title' => 'Dashboard',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/dashboard', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }
}