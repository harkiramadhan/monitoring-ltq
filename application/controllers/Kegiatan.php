<?php
class Kegiatan extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar',
            'Mguru'
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
            'title' => 'Kegiatan',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
            'kegiatan' => $this->db->get_where('kegiatan', ['id_tahunajar' => $tahunajar->id]),
            'ajax' => [
                'ajax_kegiatan'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/kegiatan', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function create(){
        $datas = [
            'id_tahunajar' => $this->input->post('id_tahunajar', TRUE),
            'kegiatan' => $this->input->post('kegiatan', TRUE),
            'tempat' => $this->input->post('tempat', TRUE),
            'waktu' =>$this->input->post('waktu', TRUE)
        ];
        $this->db->insert('kegiatan', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Kegiatan " . $this->input->post('kegiatan', TRUE) . " Berhasil Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Kegiatan " . $this->input->post('kegiatan', TRUE) . " Gagal Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function update($idkegiatan){
        $datas = [
            'kegiatan' => $this->input->post('kegiatan', TRUE),
            'tempat' => $this->input->post('tempat', TRUE),
            'waktu' =>$this->input->post('waktu', TRUE)
        ];
        $this->db->where('id', $idkegiatan)->update('kegiatan', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Kegiatan " . $this->input->post('kegiatan', TRUE) . " Berhasil Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Kegiatan " . $this->input->post('kegiatan', TRUE) . " Gagal Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function delete($idkegiatan){
        $this->db->where('id', $idkegiatan)->delete('kegiatan');
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Kegiatan Berhasil Di Hapus");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Kegiatan Gagal Di Hapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function detail(){
        $idkegiatan = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $tahunajar = $this->Mtahunajar->getActiveLembaga($idlembaga);
        $cekKegiatan = $this->db->get_where('kegiatan', ['id' => $idkegiatan, 'id_tahunajar' => $tahunajar->id]);

        if($cekKegiatan->num_rows() > 0){
            $kegiatan = $cekKegiatan->row();
            ?>
                <form action="<?= site_url('kegiatan/update/' . $idkegiatan) ?>" method="post" enctype="multipart/form-data">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Nama Kegiatan <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Kegiatan" aria-label="Nama Kegiatan" name="kegiatan" value="<?= $kegiatan->kegiatan ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <label>Tempat Kegiatan <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tempat Kegiatan" aria-label="Tempat Kegiatan" name="tempat" value="<?= $kegiatan->tempat ?>" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Waktu Kegiatan <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Waktu Kegiatan" aria-label="Waktu Kegiatan" name="waktu" value="<?= $kegiatan->waktu ?>" required>
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mb-0 text-white btn-submit"><i class="fas fa-save me-2"></i>Simpan</button>
                        </div>
                    </div>
                </form>
            <?php
        }
    }
}