<?php
class Mauth extends CI_Model{
    function auth($username, $password){
        return $this->db->select('g.nama, u.*, r.string')
                        ->from('user u')
                        ->join('guru g', 'u.id_guru = g.id')
                        ->join('user_role r', 'u.role = r.id')
                        ->where([
                            'u.username' => $username,
                            'u.password' => md5($password)
                        ])->get();
    }
}