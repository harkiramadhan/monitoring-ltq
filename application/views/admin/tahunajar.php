<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-8">
                        <h6 class="mb-0"><strong>Daftar Semester</strong></h6>
                    </div>
                    <div class="col-lg-4 text-end">
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addSemester"><i class="fas fa-plus me-3" aria-hidden="true"></i>Semester</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <?php foreach($tahunajar->result() as $row){ ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 <?= ($row->status == 1) ? 'bg-success' : 'bg-gray-100' ?> border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 ms-3 text-sm <?= ($row->status == 1) ? 'text-white' : '' ?>"><strong><?= $row->tahun_awal."/".$row->tahun_akhir." - Semester ".$row->semester ?></strong></h6>
                            </div>
                            <div class="ms-auto text-end">
                                <?php if($row->status != 1): ?>
                                    <button type="button" class="btn btn-sm btn-round btn-success text-white px-3 mb-0 btn-active" data-id="<?= $row->id ?>"><i class="fas fa-check me-2" aria-hidden="true"></i>Aktif</button>
                                <?php endif; ?>
                                <button type="button" class="btn btn-sm btn-round btn-dark text-white px-3 mb-0 btn-detail" data-id="<?= $row->id ?>"><i class="fas fa-eye me-2" aria-hidden="true"></i>Detail</button>
                                <a class="btn btn-sm btn-round btn-link text-danger px-3 mb-0" href="javascript:;"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
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
<div class="modal fade" id="addSemester" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Semester</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('tahunajar/create') ?>" role="form text-left" method="post">
                            <label class="mb-0">Tahunajar <small class="text-danger">*) ex: 2020/2021</small></label>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Tahun Awal <small class="text-danger">*) ex: 2020</small></label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Tahun Awal" aria-label="Tahun Akhir" name="tahun_awal" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Tahun Akhir <small class="text-danger">*) ex: 2021</small></label>
                                    <div class="input-group mb-3">
                                        <input type="number" class="form-control" placeholder="Tahun Akhir" aria-label="Tahun Akhir" name="tahun_akhir" required>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Semester</label>
                                    <div class="input-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio1" value="1" required>
                                            <label class="form-check-label" for="inlineRadio1">1</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="semester" id="inlineRadio2" value="2" required>
                                            <label class="form-check-label" for="inlineRadio2">2</label>
                                        </div>
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