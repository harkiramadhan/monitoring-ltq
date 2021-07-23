<?php
class Auth extends CI_Controller{
    function index(){

    }

    function login(){
        $username = $this->input->post('username', TRUE);
        $password = $this->input->post('password', TRUE);
    }

    function logout(){

    }
}