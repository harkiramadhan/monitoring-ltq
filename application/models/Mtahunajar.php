<?php
class Mtahunajar extends CI_Model{
    function getAll($idlembaga = FALSE){
        if($idlembaga){
            $this->db->where('id_lembaga', $idlembaga);
        }
        return $this->db->get('tahunajar');
    }
}