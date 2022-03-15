<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h6 class="mb-0"><strong>Daftar Materi Utama</strong></h6>
                    </div>
                    <div class="col-lg-4 text-end">
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addMateriUtama"><i class="fas fa-plus me-3" aria-hidden="true"></i>Materi Utama</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                        <input class="form-control" placeholder="Cari Materi Utama ..." id="myInput" type="text">
                    </div>
                </div>
                <ul class="list-group">
                    <?php foreach($materiUtama->result() as $row){ ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 ms-2 text-sm"><strong><?= $row->materi ?></strong></h6>
                            </div>
                            <div class="ms-auto text-end d-flex flex-column justify-content-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-round btn-info text-white px-3 mb-0 btn-edit me-1" data-id="<?= $row->id ?>"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</button>
                                    <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="<?= site_url('materi/delete/' . $row->id) ?>"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h6 class="mb-0"><strong>Daftar Materi Penunjang</strong></h6>
                    </div>
                    <div class="col-lg-4 text-end">
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addMateriPenunjang"><i class="fas fa-plus me-3" aria-hidden="true"></i>Materi Penunjang</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                        <input class="form-control" placeholder="Cari Materi Penunjang ..." id="myInput" type="text">
                    </div>
                </div>
                <ul class="list-group">
                    <?php foreach($materiPenunjang->result() as $rowp){ ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 ms-2 text-sm"><strong><?= $rowp->materi ?></strong></h6>
                            </div>
                            <div class="ms-auto text-end d-flex flex-column justify-content-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-round btn-info text-white px-3 mb-0 btn-edit me-1" data-id="<?= $rowp->id ?>"><i class="fas fa-pencil-alt me-2" aria-hidden="true"></i>Edit</button>
                                    <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="<?= site_url('materi/delete/' . $rowp->id) ?>"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="addMateriUtama" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Materi Utama</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('materi/create') ?>" role="form text-left" method="post">
                            <input type="hidden" name="type" value="1">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Materi Utama<small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Materi Utama" aria-label="Materi Utama" name="materi" required>
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

<div class="modal fade" id="addMateriPenunjang" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Materi Penunjang</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('materi/create') ?>" role="form text-left" method="post">
                            <input type="hidden" name="type" value="2">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Materi Penunjang<small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Materi Penunjang" aria-label="Materi Penunjang" name="materi" required>
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
<div class="modal fade" id="editMateri" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content modal-content-edit">

        </div>
    </div>
</div>