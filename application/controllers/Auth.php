<?php
class Auth extends CI_Controller{
    function index(){

    }

    function login(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);

        
        $this->output->set_content_type('application/json')->set_output(json_encode($this->input->post()));
        
    }

    function logout(){

    }
}