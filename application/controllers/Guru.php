<?php
class Guru extends CI_Controller{
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
            'title' => 'Guru',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
            'guru' => $this->Mguru->getByLembaga($idlembaga),
            'ajax' => [
                'ajax_guru'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/guru', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function create(){
        $idlembaga = $this->session->userdata('idlembaga');
        $datas = [
            'id_lembaga' => $idlembaga,
            'nama' => $this->input->post('nama', TRUE),
            'jenkel' => $this->input->post('jenkel', TRUE)
        ];
        $this->db->insert('guru', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Guru ".$this->input->post('nama', TRUE)." Berhasil Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Guru ".$this->input->post('nama', TRUE)." Gagal Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function detail(){
        $idguru = $this->input->get('id',TRUE);;
        $idlembaga = $this->session->userdata('idlembaga');
        $cekGuru = $this->Mguru->getById($idguru, $idlembaga);
        if($cekGuru->num_rows() > 0){
            $guru = $cekGuru->row();

            ?>
                <form action="<?= site_url('guru/update/' . $idguru) ?>" method="post" enctype="multipart/form-data">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama <small class="text-danger">*</small></label>
                                    <input class="form-control" name="nama" type="nama" value="<?= $guru->nama ?>" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Jenis Kelamin <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenkel" id="inlineRadio1" value="L" <?= ($guru->jenkel == "L") ? 'checked' : '' ?> required>
                                            <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenkel" id="inlineRadio2" value="P" <?= ($guru->jenkel == "P") ? 'checked' : '' ?> required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
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

    function update($idguru){
        $idlembaga = $this->session->userdata('idlembaga');
        $guru = $this->Mguru->getById($idguru, $idlembaga)->row();
        $dataUpdate = [
            'nama' => $this->input->post('nama', TRUE),
            'jenkel' => $this->input->post('jenkel', TRUE)
        ];
        $this->db->where('id', $idguru)->update('guru', $dataUpdate);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', $this->input->post('nama', TRUE)." Berhasil Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', $guru->nama." Gagal Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}