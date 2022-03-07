<?php
class Mkelas extends CI_Model{
    function getByLembaga($idlembaga){
        return $this->db->select('g.nama, k.*')
                        ->from('kelas k')
                        ->join('guru g', 'k.id_guru = g.id')
                        ->where([
                            'k.id_lembaga' => $idlembaga,
                            'k.status' => 1
                        ])->get();
    }

    function getById($idkelas, $idlembaga=FALSE){
        if($idlembaga){
            $this->db->where('k.id_lembaga', $idlembaga);
        }
        return $this->db->select('g.nama, k.*')
                        ->from('kelas k')
                        ->join('guru g', 'k.id_guru = g.id')
                        ->where([
                            'k.id' => $idkelas,
                            'k.status' => 1
                        ])->get();
    }
}