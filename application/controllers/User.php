<?php
class User extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar',
            'Mkelas',
            'Mguru'
        ]);

        if($this->session->userdata('masuk') != TRUE)
            redirect('', 'refresh');
    }
    
    function index(){
        $userid = $this->session->userdata('userid');
        $idlembaga = $this->session->userdata('idlembaga');
        $role = $this->session->userdata('role');
        $roleString = $this->session->userdata('role_string');
        $tahunajar = $this->Mtahunajar->getActiveLembaga($idlembaga);

        $var = [
            'title' => 'Pengguna',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
            'kelas' => $this->Mkelas->getByLembaga($idlembaga, $tahunajar->id),
            'guru' => $this->Mguru->getByLembaga($idlembaga),
            'ajax' => [
                'ajax_user'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/user', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }
}