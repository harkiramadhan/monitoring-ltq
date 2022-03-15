<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="mb-0"><strong>Daftar Pengguna</strong></h6>
                    </div>
                    <div class="col-lg-6 text-end">
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addPengguna"><i class="fas fa-plus me-3" aria-hidden="true"></i>Pengguna</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <?php 
                        foreach($users->result() as $row){ 
                    ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 ms-2 text-sm"><strong>@<?= $row->username ?></strong>  &nbsp;&nbsp;<span class="badge <?= ($row->role == 2) ? 'bg-gradient-primary' : 'bg-gradient-secondary' ?>"><?= $row->role_name ?></span></h6>
                                <small class="mb-0 ms-2 text-sm"><?= $row->nama ?></small>
                            </div>
                            <div class="ms-auto text-end d-flex flex-column justify-content-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-round btn-dark text-white px-3 mb-0 btn-detail" data-id="<?= $row->id ?>"><i class="fas fa-eye me-2" aria-hidden="true"></i>Detail</button>
                                    <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="<?= site_url('user/delete/' . $row->id) ?>"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4 div-detail">
        
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="addPengguna" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Pengguna</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('user/create') ?>" role="form text-left" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Username <small class="text-danger text-username">*) Gunakan Huruf Kecil</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" name="username" minlength="5" placeholder="Username" id="username" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Guru <small class="text-danger">*</small></label>
                                        <select name="id_guru" class="form-control" id="exampleFormControlSelect1" required>
                                            <option value="" selected disabled>- Pilih Guru</option>
                                            <?php foreach($guru->result() as $rg){ ?>
                                                <option value="<?= $rg->id ?>"><?= $rg->nama ?></option>
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
                                                <option value="<?= $ro->id ?>"><?= $ro->role_name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Password <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="input-password" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Ulangi Password <small class="text-danger text-confirm">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password" id="confirm-password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-sm btn-round bg-success btn-lg w-100 mt-4 mb-0 text-white btn-submit">Tambahkan</button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center pt-0 px-lg-2 px-1">
                        <button type="button" class="btn btn-sm btn-link btn-block ml-auto" data-bs-dismiss="modal">Batal</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>