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
                <form action="<?= site_url('siswa/update') ?>" method="post" enctype="multipart/form-data">
                <div class="card">
                    <div class="card-body">
                        <div class="row gx-4">
                            <?php if($siswa->img != NULL): ?>
                                <div class="col-auto">
                                    <div class="avatar avatar-xl position-relative">
                                        <img id="image-preview" alt="image preview" src="<?= base_url('uploads/img/siswa/' . $siswa->img) ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm mb-0" style="max-height: 100px!important">
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="col-auto">
                                    <div class="avatar avatar-xl position-relative">
                                        <img id="image-preview" alt="image preview" src="https://nkriku.com/wp-content/uploads/2022/02/infografis_20200913_NJ1572.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm mb-0" style="max-height: 100px!important">
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="col-auto my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1">
                                        <?= $siswa->nama."&nbsp;&nbsp; / &nbsp;&nbsp;".$siswa->jenkel ?>
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        Kelas 1
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-2">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Informasi Siswa</p>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group ms-auto input-group-sm">
                                    <label for="example-text-input" class="form-control-label">Upload Foto</label>
                                    <input type="file" id="image-source" name="img" class="form-control" aria-label="Upload" onchange="previewImage();" multiple accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Nama</label>
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
                                    <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
                                    <select name="jenkel" class="form-control" required>
                                        <option value="" selected disabled>- Pilih Jenis Kelamin</option>
                                        <option <?= ($siswa->jenkel == "L") ? 'selected' : '' ?> value="L"> Laki - Laki</option>
                                        <option <?= ($siswa->jenkel == "P") ? 'selected' : '' ?> value="P"> Perempuan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tanggal Masuk</label>
                                    <input class="form-control" name="tanggal_masuk" type="date" value="<?= $siswa->tanggal_masuk ?>" onfocus="focused(this)" onfocusout="defocused(this)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="example-text-input" class="form-control-label">Tanggal Keluar</label>
                                    <input class="form-control" name="tanggal_keluar" type="date" value="<?= $siswa->tanggal_keluar ?>" onfocus="focused(this)" onfocusout="defocused(this)">
                                </div>
                            </div>
                        </div>
                        <hr class="horizontal dark">
                        <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mb-0 text-white">Simpan</button>
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

    function update(){
        
        
    }
}