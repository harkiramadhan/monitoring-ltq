<?php
class Tahunajar extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar'
        ]);

        if($this->session->userdata('masuk') != TRUE)
            redirect('', 'refresh');
    }

    function index(){
        $userid = $this->session->userdata('userid');
        $idlembaga = $this->session->userdata('idlembaga');
        $role = $this->session->userdata('role');
        $roleString = $this->session->userdata('role_string');

        $var = [
            'title' => 'Semester',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $this->Mtahunajar->getActiveLembaga($idlembaga),
            'tahunajar_res' => $this->Mtahunajar->getAll($idlembaga),
            'ajax' => [
                'ajax_tahunajar'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/tahunajar', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function detail(){
        $idtahunajar = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekTahunajar = $this->db->get_where('tahunajar', [
            'id' => $idtahunajar,
            'id_lembaga' => $idlembaga
        ]);

        if($cekTahunajar->num_rows() > 0){
            $tahunajar = $cekTahunajar->row();
            ?>
                <div class="card">
                    <div class="card-header">
                        <h6 class="text-dark font-weight-bolder"><?= $tahunajar->tahun_awal."/".$tahunajar->tahun_akhir." - Semester ". $tahunajar->semester ?></h6>
                    </div>
                    <div class="card-body">
                        
                    </div>
                </div>
            <?php 
        }
    }

    function create(){
        $idlembaga = $this->session->userdata('idlembaga');
        $cekUnique = $this->db->get_where('tahunajar', [
            'id_lembaga' => $idlembaga,
            'tahun_awal' => $this->input->post('tahun_awal', TRUE),
            'tahun_akhir' => $this->input->post('tahun_akhir', TRUE),
            'semester' => $this->input->post('semester', TRUE),
        ]);
        $cekActive = $this->db->get_where('tahunajar', [
            'id_lembaga' => $idlembaga,
            'status' => 1
        ]);
        $status = ($cekActive->num_rows() > 0) ? 2 : 1;

        if($cekUnique->num_rows() > 0){
            $this->session->set_flashdata('error', "Tahunajar & Semester Sudah Tersedia");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $datas = [
                'id_lembaga' => $idlembaga,
                'tahun_awal' => $this->input->post('tahun_awal', TRUE),
                'tahun_akhir' => $this->input->post('tahun_akhir', TRUE),
                'semester' => $this->input->post('semester', TRUE),
                'status' => $status
            ];
            $this->db->insert('tahunajar', $datas);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('sukses', "Tahunajar Berhasil Di Tambahkan");
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->session->set_flashdata('sukses', "Tahunajar Gagal Di Tambahkan");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }

    }

    function active(){
        $id = $this->input->post('id');
        $idlembaga = $this->session->userdata('idlembaga');
        $cekActive = $this->db->get_where('tahunajar', [
            'id_lembaga' => $idlembaga,
            'status' => 1
        ]);
        $tahunajar = $this->db->get_where('tahunajar', [
            'id' => $id
        ])->row();

        if($cekActive->num_rows() > 0){
            $this->db->where('id', $cekActive->row()->id)->update('tahunajar', ['status' => 2]);
        }
        
        $this->db->where('id', $id)->update('tahunajar', ['status' => 1]);

        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', $tahunajar->tahun_awal."/".$tahunajar->tahun_akhir." - Semester ".$tahunajar->semester ." Berhasil Di Aktifkan");
        }else{
            $this->session->set_flashdata('error', $tahunajar->tahun_awal."/".$tahunajar->tahun_akhir." - Semester ".$tahunajar->semester ." Gagal Di Aktifkan");
        }
    }
}