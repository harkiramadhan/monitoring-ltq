<?php 
class Mmateri extends CI_Model{
    function getMateriUtama($idlembaga){
        return $this->db->select('m.*')
                        ->from('materi m')
                        ->order_by('m.materi', "ASC")
                        ->where([
                            'm.id_lembaga' => $idlembaga,
                            'm.type' => 1,
                            'm.status' => 1
                        ])->get();
    }

    function getMateriPenunjang($idlembaga){
        return $this->db->select('m.*')
                        ->from('materi m')
                        ->order_by('m.materi', "ASC")
                        ->where([
                            'm.id_lembaga' => $idlembaga,
                            'm.type' => 2,
                            'm.status' => 1
                        ])->get();
    }

    function getById($idmateri, $idlembaga){
        return $this->db->select('m.*')
                        ->from('materi m')
                        ->order_by('m.materi', "ASC")
                        ->where([
                            'm.id_lembaga' => $idlembaga,
                            'm.id' => $idmateri
                        ])->get();
    }
}