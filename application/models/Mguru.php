<?php
class Mguru extends CI_Model{
    function getByLembaga($idlembaga){
        return $this->db->get_where('guru', ['id_lembaga' => $idlembaga]);
    }

    function getById($idguru, $idlembaga = FALSE){
        if($idlembaga){
            $this->db->where('id_lembaga', $idlembaga);
        }

        return $this->db->get_where('guru', [
            'id' => $idguru
        ]);
    }
}