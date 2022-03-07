<?php
class Mtahunajar extends CI_Model{
    function getAll($idlembaga = FALSE){
        if($idlembaga){
            $this->db->where('id_lembaga', $idlembaga);
        }
        return $this->db->get('tahunajar');
    }

    function getActiveLembaga($idlembaga){
        return $this->db->get_where('tahunajar', [
            'id_lembaga' => $idlembaga,
            'status' => 1
        ])->row();
    }
}