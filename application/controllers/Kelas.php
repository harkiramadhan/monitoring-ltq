<?php
class Kelas extends CI_Controller{
    function __construct(){
        parent::__construct();

        $this->load->model([
            'Muser',
            'Mlembaga',
            'Mauth',
            'Mtahunajar',
            'Mkelas',
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
            'title' => 'Kelas',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
            'kelas' => $this->Mkelas->getByLembaga($idlembaga, $tahunajar->id),
            'guru' => $this->Mguru->getByLembaga($idlembaga),
            'ajax' => [
                'ajax_kelas'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/kelas', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function create(){
        $idlembaga = $this->session->userdata('idlembaga');
        $datas = [
            'id_lembaga' => $idlembaga,
            'id_guru' => $this->input->post('id_guru', TRUE),
            'id_tahunajar' => $this->input->post('id_tahunajar', TRUE),
            'kelas' => $this->input->post('kelas', TRUE),
            'status' => 1
        ];
        $this->db->insert('kelas', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Kelas ".$this->input->post('kelas', TRUE)." Berhasil Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Kelas Gagal Di Tambahkan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function update(){
        $idkelas = $this->input->post('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekKelas = $this->Mkelas->getById($idkelas, $idlembaga);

        if($cekKelas->num_rows() > 0){
            $dataUpdate = [
                'id_guru' => $this->input->post('id_guru', TRUE),
                'kelas' => $this->input->post('kelas', TRUE)
            ];
            $this->db->where('id', $idkelas)->update('kelas', $dataUpdate);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('sukses', "Kelas ".$this->input->post('kelas', TRUE)." Berhasil Di Simpan");
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->session->set_flashdata('error', "Kelas Gagal Di Simpan");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }else{
            $this->session->set_flashdata('error', "Kelas Gagal Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function detail(){
        $idkelas = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekKelas = $this->Mkelas->getById($idkelas, $idlembaga);
        $siswa = $this->Mkelas->getSiswaKelas($idkelas, $idlembaga);
        if($cekKelas->num_rows() > 0){
            $kelas = $cekKelas->row();
            ?>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="d-flex flex-column justify-content-center">
                                    <small class="mb-0 ms-2 text-sm"><?= $kelas->nama ?></small>
                                    <h6 class="mb-0 ms-2 text-sm"><strong><?= $kelas->kelas ?></strong></h6>
                                </div>
                            </div>
                            <div class="col-lg-4 text-end">
                                <button class="btn btn-sm btn-round bg-gradient-dark mb-0 btn-addSiswa" type="button" data-id="<?= $idkelas ?>"><i class="fas fa-plus me-3" aria-hidden="true"></i>Siswa</button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-4" width="5px">No</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">L/P</th>
                                    <th class="text-secondary opacity-7" width="5px"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $no = 1;
                                    foreach($siswa->result() as $row){
                                ?>
                                <tr>
                                    <td class="text-center" width="5px">
                                        <h6 class="mb-0 text-sm"><?= $no++ ?></h6>
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm text-bolder"><?= $row->nama ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center">
                                        <span class="text-secondary text-xs font-weight-bold"><?= $row->jenkel ?></span>
                                    </td>
                                    <td class="align-middle text-center" width="5px">
                                        <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="<?= site_url('kelas/deleteSiswaFromKelas/' . $idkelas . '/' . $row->id_siswa) ?>"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <script>
                    $('.btn-addSiswa').click(function(){
                        var idkelas = $(this).attr('data-id')
                        $.ajax({
                            url: '<?= site_url('kelas/modalAddSiswa') ?>',
                            type: 'post',
                            data : {idkelas : idkelas},
                            success: function(res){
                                $('.modal-content-edit').html(res)
                                $('#editKelas').modal('show')
                            }
                        })
                    })
                </script>
            <?php 
        }
    }

    function delete($idkelas){
        $this->db->where('id', $idkelas)->update('kelas', ['status' => 2]);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Kelas Berhasil Di Hapus");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Kelas Gagal Di Hapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function edit(){
        $idkelas = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekKelas = $this->Mkelas->getById($idkelas, $idlembaga);
        if($cekKelas->num_rows() > 0){
            $kelas = $cekKelas->row();
            $guru = $this->Mguru->getByLembaga($idlembaga);
            ?>
                <div class="modal-body p-0">
                    <div class="card card-plain">
                        <div class="card-header pb-0 text-left">
                            <h5 class="font-weight-bolder">Edit Kelas</h5>
                        </div>
                        <div class="card-body pb-0">
                            <form action="<?= site_url('kelas/update') ?>" role="form text-left" method="post">
                                <input type="hidden" name="id" value="<?= $idkelas ?>">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Guru <small class="text-danger">*</small></label>
                                            <select name="id_guru" class="form-control" id="exampleFormControlSelect1" required>
                                                <option value="" disabled>- Pilih Guru</option>
                                                <?php foreach($guru->result() as $rg){ ?>
                                                    <option <?= ($rg->id == $kelas->id_guru) ? 'selected' : '' ?> value="<?= $rg->id ?>"><?= $rg->nama ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <label>Nama Kelas <small class="text-danger">*</small></label>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Nama Kelas" aria-label="Nama Kelas" name="kelas" value="<?= $kelas->kelas ?>" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mt-4 mb-0 text-white"><i class="fas fa-save me-2"></i>Simpan</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer text-center pt-0 px-lg-2 px-1">
                            <button type="button" class="btn btn-sm btn-link btn-block  ml-auto" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </div>
                </div>
            <?php
        }
    }

    function modalAddSiswa(){
        $idkelas = $this->input->post('idkelas', TRUE);
        $idlembaga = $this->session->userdata('idlembaga', TRUE);
        $tahunajar = $this->Mtahunajar->getActiveLembaga($idlembaga);
        $idtahunajar = $tahunajar->id;
        $siswaNotIn = $this->Mkelas->getSiswaNotIn($idtahunajar, $idlembaga);
        $kelas = $this->Mkelas->getById($idkelas, $idlembaga)->row();

        ?>
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="">Tambah Siswa Kelas <br><strong><?= $kelas->kelas ?></strong></h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('kelas/addSiswa') ?>" role="form text-left" method="post">
                            <input type="hidden" name="idtahunajar" value="<?= $tahunajar->id ?>">
                            <input type="hidden" name="idkelas" value="<?= $idkelas ?>">
                            
                            <div class="form-group mb-0">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                                    <input class="form-control" placeholder="Cari Siswa ..." id="myInputSearch" type="text">
                                </div>
                            </div>

                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-4" width="5px">No</th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-4" width="5px"></th>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">L/P</th>
                                        </tr>
                                    </thead>
                                    <tbody id="myTableSearch">
                                        <?php
                                            $no = 1; 
                                            foreach($siswaNotIn->result() as $row){ 
                                        ?>
                                        <tr>
                                            <td class="text-center" width="5px">
                                                <h6 class="mb-0 text-sm"><?= $no++ ?></h6>
                                            </td>
                                            <td width="5px" class="text-center">
                                                <div class="form-check text-center">
                                                    <input class="form-check-input" id="fcustomCheck<?= $row->id ?>" type="checkbox" name="idsiswa[]" value="<?= $row->id ?>">
                                                    <label class="custom-control-label" for="customCheck<?= $row->id ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm text-bolder"><?= $row->nama ?></h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold"><?= $row->jenkel ?></span>
                                            </td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mt-4 mb-0 text-white">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <button type="button" class="btn btn-sm btn-link btn-block  ml-auto" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>

            <script>
                $("#myInputSearch").on("keyup", function() {
                    var value = $(this).val().toLowerCase()
                    $("#myTableSearch tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    })
                })
            </script>
        <?php
    }

    function addSiswa(){
        $idlembaga = $this->session->userdata('idlembaga', TRUE);
        $idkelas = $this->input->post('idkelas', TRUE);
        $idtahunajar = $this->input->post('idtahunajar', TRUE);
        $idsiswa = $this->input->post('idsiswa[]', TRUE);

        if(count($idsiswa) > 0){
            foreach($idsiswa as $row){
                $datas = [
                    'id_lembaga' => $idlembaga,
                    'id_siswa' => $row,
                    'id_tahunajar' => $idtahunajar,
                    'id_kelas' => $idkelas 
                ];

                $cek = $this->db->get_where('mutasi', [
                    'id_lembaga' => $idlembaga,
                    'id_siswa' => $row,
                    'id_tahunajar' => $idtahunajar,
                    'id_kelas' => $idkelas 
                ]);
                if($cek->num_rows() > 0){}else{
                    $this->db->insert('mutasi', $datas);
                }
            }

            $this->session->set_flashdata('sukses', "Siswa Berhasil Di Masukkan Kedalam Kelas");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Tidak Ada Siswa Yang Di Pilih");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function deleteSiswaFromKelas($idkelas, $idsiswa){
        $this->db->where([
            'id_kelas' => $idkelas,
            'id_siswa' => $idsiswa
        ])->delete('mutasi');
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', 'Siswa Berhasil Di Hapus');
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', 'Siswa Gagal Di Hapus');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
}