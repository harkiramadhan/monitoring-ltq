<?php
class Mlembaga extends CI_Model{
    function getSelected($idlembaga){
        return $this->db->get_where('lembaga', ['id' => $idlembaga])->row();
    }
}