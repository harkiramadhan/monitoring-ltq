<?php
class Mkelas extends CI_Model{
    function getByLembaga($idlembaga, $idtahunajar=FALSE){
        if($idtahunajar){
            $this->db->where('k.id_tahunajar', $idtahunajar);
        }else{
            $this->db->where('t.status', 1);
        }
        return $this->db->select('g.nama, k.*')
                        ->from('kelas k')
                        ->join('guru g', 'k.id_guru = g.id')
                        ->join('tahunajar t', 'k.id_tahunajar = t.id')
                        ->where([
                            'k.id_lembaga' => $idlembaga,
                            'k.status' => 1,
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

    function getSiswaKelas($idkelas, $idlembaga = FALSE){
        return $this->db->select('s.nama, s.jenkel, k.kelas, m.*')
                        ->from('mutasi m')
                        ->join('siswa s', 'm.id_siswa = s.id')
                        ->join('kelas k', 'm.id_kelas = k.id')
                        ->where([
                            'm.id_kelas' => $idkelas,
                            's.id_lembaga' => $idlembaga
                        ])->get();
    }

    function getSiswaNotIn($idtahunajar, $idlembaga){
        return $this->db->select('s.*')
                        ->from('siswa s')
                        ->where("
                            s.id NOT IN (
                                SELECT mutasi.id_siswa
                                FROM mutasi 
                                LEFT JOIN kelas ON mutasi.id_kelas = kelas.id
                                WHERE 
                                    mutasi.id_tahunajar = '".$idtahunajar."' AND 
                                    kelas.id_lembaga = '".$idlembaga."' AND 
                                    kelas.status != 2
                            )AND s.status = 1 AND s.id_lembaga = '".$idlembaga."' ")->get();
    }
}