<div class="row">
    <div class="col-md-7 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h6 class="mb-0"><strong>Daftar Kegiatan</strong></h6>
                    </div>
                    <div class="col-lg-4 text-end">
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addKegiatan"><i class="fas fa-plus me-3" aria-hidden="true"></i>Kegiatan</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                        <input class="form-control" placeholder="Cari Kegiatan ..." id="myInput" type="text">
                    </div>
                </div>
                <ul class="list-group">
                    <?php foreach($kegiatan->result() as $row){ ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 ms-2 text-sm"><i class="fas fa-calendar me-2"></i><strong><?= $row->kegiatan ?></strong></h6>
                                <h6 class="mb-0 ms-2 text-sm"><i class="fas fa-clock me-2"></i><strong><?= longdate_indo($row->waktu) ?></strong></h6>
                                <h6 class="mb-0 ms-2 text-sm"><i class="fas fa-map-marker me-2"></i><strong><?= $row->tempat ?></strong></h6>
                            </div>
                            <div class="ms-auto text-end d-flex flex-column justify-content-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-sm btn-round btn-dark text-white px-3 mb-0 btn-detail mx-1" data-id="<?= $row->id ?>"><i class="fas fa-eye me-2" aria-hidden="true"></i>Detail</button>
                                    <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="<?= site_url('kegiatan/delete/' . $row->id) ?>"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                </div>
                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-5 mt-4 div-detail">
        
    </div>
</div>

<!-- Modals -->
<div class="modal fade" id="addKegiatan" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Kegiatan</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('kegiatan/create') ?>" role="form text-left" method="post">
                            <input type="hidden" name="id_tahunajar" value="<?= $tahunajar->id ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Nama Kegiatan <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Kegiatan" aria-label="Nama Kegiatan" name="kegiatan" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <label>Tempat Kegiatan <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Tempat Kegiatan" aria-label="Tempat Kegiatan" name="tempat" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Waktu Kegiatan <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Waktu Kegiatan" aria-label="Waktu Kegiatan" name="waktu" required>
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
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content modal-content-edit">

        </div>
    </div>
</div>