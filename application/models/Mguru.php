<?php
class Mguru extends CI_Model{
    function getByLembaga($idlembaga){
        return $this->db->get_where('guru', ['id_lembaga' => $idlembaga]);
    }
}