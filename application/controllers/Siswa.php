<?php
class Siswa extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar',
            'Msiswa',
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

        $var = [
            'title' => 'Siswa',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'siswa' => $this->Msiswa->getByLembaga($idlembaga),
            'guru' => $this->Mguru->getByLembaga($idlembaga),
            'tahunajar' => $this->Mtahunajar->getActiveLembaga($idlembaga),
            'ajax' => [
                'ajax_siswa'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/siswa', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function detail(){
        $idsiswa = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekSiswa = $this->Msiswa->getById($idsiswa, $idlembaga);

        if($cekSiswa->num_rows() > 0){
            $siswa = $cekSiswa->row();
            ?>
                <form action="<?= site_url('siswa/update/' . $idsiswa) ?>" method="post" enctype="multipart/form-data">
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama <small class="text-danger">*</small></label>
                                    <input class="form-control" name="nama" type="nama" value="<?= $siswa->nama ?>" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">NIS</label>
                                    <input class="form-control <?= ($siswa->nis == NULL) ? 'is-invalid' : '' ?>" type="number" value="<?= $siswa->nis ?>" name="nis" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Jenis Kelamin <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenkel" id="inlineRadio1" value="L" <?= ($siswa->jenkel == "L") ? 'checked' : '' ?> required>
                                            <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenkel" id="inlineRadio2" value="P" <?= ($siswa->jenkel == "P") ? 'checked' : '' ?> required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tanggal Masuk <small class="text-danger">*</small></label>
                                    <input class="form-control" name="tanggal_masuk" type="date" value="<?= $siswa->tanggal_masuk ?>" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tanggal Keluar</label>
                                    <input class="form-control" name="tanggal_keluar" type="date" value="<?= $siswa->tanggal_keluar ?>" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <?php if($siswa->img): ?>
                                    <img id="image-preview" src="<?= base_url('./uploads/img/siswa/' . $siswa->img) ?>" alt="Image placeholder" class="card-img-top">
                                <?php else: ?>
                                    <img id="image-preview" src="#" alt="Image placeholder" class="card-img-top d-none">
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group ms-auto input-group-sm">
                                    <label for="example-text-input" class="form-control-label">Upload Foto</label>
                                    <input type="file" id="image-source" name="img" class="form-control" aria-label="Upload" onchange="previewImage();" multiple accept="image/*">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mb-0 text-white btn-submit"><i class="fas fa-save me-2"></i>Simpan</button>
                    </div>
                </div>
                </form>

                <script>
                    function previewImage() {
                        var element = document.getElementById("image-preview")
                            element.classList.remove("d-none")
                    
                        document.getElementById("image-preview").style.display = "block"
                        var oFReader = new FileReader()
                        oFReader.readAsDataURL(document.getElementById("image-source").files[0])
                    
                        oFReader.onload = function(oFREvent) {
                        document.getElementById("image-preview").src = oFREvent.target.result
                        }
                    }
                </script>
            <?php
        }
    }

    function create(){
        $idlembaga = $this->session->userdata('idlembaga');
        $config['upload_path'] = './uploads/img/siswa';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('img')){
            $img = $this->upload->data();
            $filename = $img['file_name'];
        }else{
            $filename = NULL;
        }

        $datas = [
            'id_lembaga' => $idlembaga,
            'nis' => $this->input->post('nis', TRUE),
            'nama' => $this->input->post('nama', TRUE),
            'jenkel' => $this->input->post('jenkel', TRUE),
            'tanggal_masuk' => $this->input->post('tanggal_masuk', TRUE),
            'tanggal_keluar' => $this->input->post('tanggal_keluar', TRUE),
            'img' => $filename,
            'status' => 1
        ];
        $this->db->insert('siswa', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', $this->input->post('nama', TRUE)." Berhasil Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', $this->input->post('nama', TRUE)." Gagal Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function update($idsiswa){
        $idlembaga = $this->session->userdata('idlembaga');
        $siswa = $this->Msiswa->getById($idsiswa, $idlembaga)->row();

        $config['upload_path'] = './uploads/img/siswa';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if($this->upload->do_upload('img')){
            if($siswa->img == TRUE){
                $path = './uploads/img/siswa/';
                $fileName = $siswa->img;
                unlink($path.$fileName);
            }

            $img = $this->upload->data();
            $filename = $img['file_name'];
        }else{
            if($siswa->img == TRUE){
                $filename = $siswa->img;
            }else{
                $filename = NULL;
            }
        }

        $dataUpdate = [
            'nis' => $this->input->post('nis', TRUE),
            'nama' => $this->input->post('nama', TRUE),
            'jenkel' => $this->input->post('jenkel', TRUE),
            'tanggal_masuk' => $this->input->post('tanggal_masuk', TRUE),
            'tanggal_keluar' => $this->input->post('tanggal_keluar', TRUE),
            'img' => $filename
        ];
        $this->db->where('id', $idsiswa)->update('siswa', $dataUpdate);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', $this->input->post('nama', TRUE)." Berhasil Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', $siswa->nama." Gagal Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function import(){
        
    }
}