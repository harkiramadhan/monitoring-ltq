<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h6 class="mb-0"><strong>Daftar Kelas</strong></h6>
                    </div>
                    <div class="col-lg-4 text-end">
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addKelas"><i class="fas fa-plus me-3" aria-hidden="true"></i>Kelas</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <?php foreach($kelas->result() as $row){ ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <small class="mb-0 ms-2 text-sm"><?= $row->nama ?></small>
                                <h6 class="mb-0 ms-2 text-sm"><strong><?= $row->kelas ?></strong></h6>
                            </div>
                            <div class="ms-auto text-end">
                                <button type="button" class="btn btn-sm btn-round btn-info text-white px-3 mb-0 btn-edit" data-id="<?= $row->id ?>"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</button>
                                <button type="button" class="btn btn-sm btn-round btn-dark text-white px-3 mb-0 btn-detail" data-id="<?= $row->id ?>"><i class="fas fa-eye me-2" aria-hidden="true"></i>Detail</button>
                                <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="<?= site_url('kelas/delete/' . $row->id) ?>"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
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
<div class="modal fade" id="addKelas" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Kelas</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('kelas/create') ?>" role="form text-left" method="post">
                            <input type="hidden" name="id_tahunajar" value="<?= $tahunajar->id ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Guru <small class="text-danger">*</small></label>
                                        <select name="id_guru" class="form-control form-control-lg" id="exampleFormControlSelect1" required>
                                            <option value="" selected disabled>- Pilih Guru</option>
                                            <?php foreach($guru->result() as $rg){ ?>
                                                <option value="<?= $rg->id ?>"><?= $rg->nama ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <label>Nama Kelas <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Kelas" aria-label="Nama Kelas" name="kelas" required>
                                    </div>
                                </div>
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
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editKelas" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content modal-content-edit">

        </div>
    </div>
</div>