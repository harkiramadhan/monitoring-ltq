<?php
class User extends CI_Controller{
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
            'title' => 'Pengguna',
            'user' => $this->Muser->getSelected($userid),
            'lembaga' => $this->Mlembaga->getSelected($idlembaga),
            'tahunajar' => $tahunajar,
            'kelas' => $this->Mkelas->getByLembaga($idlembaga, $tahunajar->id),
            'guru' => $this->Mguru->getByLembaga($idlembaga),
            'users' => $this->Muser->getByLembaga($idlembaga),
            'roles' => $this->db->get_where('user_role', ['id !=' => 1]),
            'ajax' => [
                'ajax_user'
            ]
        ];

        $this->load->view( $roleString . '/layout/header', $var);
        $this->load->view( $roleString . '/user', $var);  
        $this->load->view( $roleString . '/layout/footer', $var);  
    }

    function create(){
        $idlembaga = $this->session->userdata('idlembaga');
        $cek = $this->db->get_where('user', ['username' => $this->input->post('username', TRUE)]);
        if($cek->num_rows() > 0){
            $this->session->set_flashdata('error', "Username " . $this->input->post('username', TRUE) . " Sudah Tersedia");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $datas = [
                'id_lembaga' => $idlembaga,
                'id_guru' => $this->input->post('id_guru', TRUE),
                'username' => $this->input->post('username', TRUE),
                'password' => md5($this->input->post('password', TRUE)),
                'role' => $this->input->post('role'),
                'status' => 1
            ];
            $this->db->insert('user', $datas);
            if($this->db->affected_rows() > 0){
                $this->session->set_flashdata('sukses', "Pengguna @" . $this->input->post('username', TRUE) . " Berhasil Di Tambahkan");
                redirect($_SERVER['HTTP_REFERER']);
            }else{
                $this->session->set_flashdata('error', "Pengguna @" . $this->input->post('username', TRUE) . " Gagal Di Tambahkan");
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }

    function update($iduser){
        if($this->input->post('password', TRUE)){
            if($this->input->post('password', TRUE) == $this->input->post('passwordd', TRUE)){}else{
                $this->session->set_flashdata('error', "Password Tidak Cocok");
                redirect($_SERVER['HTTP_REFERER']);
            }
            $datas = [
                'password' => $this->input->post('password', TRUE),
                'id_guru' => $this->input->post('id_guru', TRUE),
                'role' => $this->input->post('role', TRUE),
                'password' => md5($this->input->post('password', TRUE))
            ];
        }else{
            $datas = [
                'password' => $this->input->post('password', TRUE),
                'id_guru' => $this->input->post('id_guru', TRUE),
                'role' => $this->input->post('role', TRUE)
            ];
        }
        $this->db->where('id', $iduser)->update('user', $datas);
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Pengguna @" . $this->input->post('username', TRUE) . " Berhasil Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Pengguna @" . $this->input->post('username', TRUE) . " Gagal Di Simpan");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function delete($iduser){
        $this->db->where('id', $iduser)->delete('user');
        if($this->db->affected_rows() > 0){
            $this->session->set_flashdata('sukses', "Pengguna Berhasil Di Hapus");
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            $this->session->set_flashdata('error', "Pengguna Gagal Di Hapus");
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    function detail(){
        $iduser = $this->input->get('id', TRUE);
        $idlembaga = $this->session->userdata('idlembaga');
        $cekUser = $this->db->get_where('user', [
            'id_lembaga' => $idlembaga,
            'id' => $iduser
        ]);

        if($cekUser->num_rows() > 0){
            $user = $cekUser->row();
            $guru = $this->Mguru->getByLembaga($idlembaga);
            $roles = $this->db->get_where('user_role', ['id !=' => 1]);
            ?>
                <form action="<?= site_url('user/update/' . $iduser) ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="username" value="<?= $user->username ?>">
                    <div class="card mt-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Username <small class="text-danger text-username">*) Gunakan Huruf Kecil</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="username" minlength="5" placeholder="Username" id="username" value="<?= $user->username ?>" disabled required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Guru <small class="text-danger">*</small></label>
                                        <select name="id_guru" class="form-control" id="exampleFormControlSelect1" required>
                                            <option value="" selected disabled>- Pilih Guru</option>
                                            <?php foreach($guru->result() as $rg){ ?>
                                                <option value="<?= $rg->id ?>" <?= ($rg->id == $user->id_guru) ? 'selected' : '' ?>><?= $rg->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Role <small class="text-danger">*</small></label>
                                        <select name="role" class="form-control" id="exampleFormControlSelect1" required>
                                            <option value="" selected disabled>- Pilih Role</option>
                                            <?php foreach($roles->result() as $ro){ ?>
                                                <option value="<?= $ro->id ?>" <?= ($ro->id == $user->role) ? 'selected' : '' ?>><?= $ro->role_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Password <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="input-password-2">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Ulangi Password <small class="text-danger text-confirm-2">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="passwordd" id="confirm-password-2">
                                    </div>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mb-0 text-white"><i class="fas fa-save me-2"></i>Simpan</button>
                        </div>
                    </div>
                </form>
                <script>
                    var inputPassword = $('#input-password-2')
                        $('#confirm-password-2').on('input', function(){
                            if(inputPassword.length > 0){
                                if(inputPassword.val() === $(this).val()){
                                    $(this).removeClass('is-invalid')
                                    $(this).addClass('is-valid')
                                    $('.text-confirm-2').text('*')
                                }else{
                                    $(this).addClass('is-invalid')
                                    $(this).removeClass('is-valid')
                                    $('.text-confirm-2').text('*) Password Tidak Cocok')
                                }
                            }
                        })
                </script>
            <?php
        }

    }

    function checkusername(){
        $username = $this->input->get('username', TRUE);
        $cek = $this->db->get_where('user', ['username' => $username]);
        if($cek->num_rows() > 0){
            $res = '1';
        }else{
            $res = '0';
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($res));
    }
}