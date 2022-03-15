<?php 
class Materi extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar',
            'Mguru',
            'Mmateri'
        ]);

        if($this->session->userdata('masuk') != TRUE)
            redirect('', 'refresh');
    }

    function index(){
        $userid = $this->session->userdata('userid');
        $idlembaga = $this->session->userdata('idlembaga');
        $role = $this->session->userdata('role');
        $roleString = $this->session->userdata('role_string');
        $tahunajar = $this->Mtahunajar->getActiveLembaga($idlembaga);

        $var = [
            'title' => 'Materi',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
            'materiUtama' => $this->Mmateri->getMateriUtama($idlembaga),
            'materiPenunjang' => $this->Mmateri->getMateriPenunjang($idlembaga),
            'ajax' => [
                'ajax_materi'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/materi', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function create(){
        $idlembaga = $this->session->userdata('idlembaga');
        $datas = [
            'id_lembaga' => $idlembaga,
            'type' => $this->input->post('type', TRUE),
            'materi' => $this->input->post('materi', TRUE),
            'status' => 1
        ];
        $this->db->insert('materi', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Materi " . $this->input->post('materi', TRUE) . " Berhasil Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Materi " . $this->input->post('materi', TRUE) . " Gagal Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function update($idmateri){
        $datas = [
            'materi' => $this->input->post('materi', TRUE),
        ];
        $this->db->where('id', $idmateri)->update('materi', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Materi " . $this->input->post('materi', TRUE) . " Berhasil Di Perbarui");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Materi " . $this->input->post('materi', TRUE) . " Gagal Di Perbarui");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function delete($idmateri){
        $datas = [
            'status' => 2,
        ];
        $this->db->where('id', $idmateri)->update('materi', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Materi " . $this->input->post('materi', TRUE) . " Berhasil Di Hapus Sementara");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Materi " . $this->input->post('materi', TRUE) . " Gagal Di Hapus Sementara");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function edit(){
        $idmateri = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekMateri = $this->Mmateri->getById($idmateri, $idlembaga);
        if($cekMateri->num_rows() > 0){
            $materi = $cekMateri->row();
            $type = ($materi->type == 1) ? 'Utama' : 'Penunjang';
            ?>
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h5 class="font-weight-bolder">Tambah Materi Penunjang</h5>
                        </div>
                        <form action="<?= site_url('materi/update/' . $idmateri) ?>" role="form text-left" method="post">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Materi <?= $type ?><small class="text-danger">*</small></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Materi <?= $type ?>" aria-label="Materi <?= $type ?>" name="materi" value="<?= $materi->materi ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mt-4 mb-0 text-white"><i class="fas fa-save me-2"></i>Simpan</button>
                                <button type="button" class="btn btn-sm btn-link btn-block  ml-auto" data-bs-dismiss="modal">Batal</button>
                            </div>
                        </form>
                    </div>
                </div>
            <?php
        }
    }
}