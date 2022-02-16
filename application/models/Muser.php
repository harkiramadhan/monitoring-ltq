<?php 
class Muser extends CI_Model{
    function getSelected($userid){
        return $this->db->select('g.nama, u.*, r.string')
                        ->from('user u')
                        ->join('user_role r', 'u.role = r.id')
                        ->join('guru g', 'u.id_guru = g.id')
                        ->where([
                            'u.id' => $userid,
                        ])->get()->row();
    }
}