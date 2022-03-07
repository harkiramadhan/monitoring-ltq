<?php
class Msiswa extends CI_Model{
    function getByLembaga($idlembaga){
        return $this->db->select('s.*')
                        ->from('siswa s')
                        ->where([
                            's.id_lembaga' => $idlembaga
                        ])->get();
    }

    function getById($idsiswa, $idlembaga=FALSE){
        if($idlembaga){
            $this->db->where('id_lembaga', $idlembaga);
        }
        return $this->db->select('s.*')
                        ->from('siswa s')
                        ->where([
                            's.id' => $idsiswa
                        ])->get();
    }
}