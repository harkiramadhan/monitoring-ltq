<div class="row">
    <div class="col-md-6 mt-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <div class="row">
                    <div class="col-lg-6">
                        <h6 class="mb-0"><strong>Daftar Siswa</strong></h6>
                    </div>
                    <div class="col-lg-6 text-end">
                        <a class="btn btn-sm btn-round bg-gradient-default mb-0 me-2" href="<?= site_url('siswa/import') ?>"><i class="fas fa-upload me-3" aria-hidden="true"></i>Siswa</a>
                        <button class="btn btn-sm btn-round bg-gradient-dark mb-0" type="button" data-bs-toggle="modal" data-bs-target="#addSiswa"><i class="fas fa-plus me-3" aria-hidden="true"></i>Siswa</button>
                    </div>
                </div>
            </div>
            <div class="card-body pt-4 p-3">
                <ul class="list-group">
                    <?php 
                        foreach($siswa->result() as $row){ 
                            $cekKelas = $this->db->select('k.kelas')
                                                ->from('mutasi m')
                                                ->join('kelas k', 'm.id_kelas = k.id')
                                                ->where([
                                                    'm.id_tahunajar' => $tahunajar->id,
                                                    'm.id_siswa' => $row->id
                                                ])->get();
                    ?>
                        <li class="list-group-item border-0 d-flex p-2 mb-2 bg-gray-100 border-radius-lg">
                            <div class="d-flex flex-column justify-content-center">
                                <h6 class="mb-0 ms-2 text-sm"><strong><?= $row->nama ?></strong> &nbsp;&nbsp;<span class="badge bg-gradient-primary"><?= $row->jenkel ?></span></h6>
                                <small class="mb-0 ms-2 text-sm"><?= @$cekKelas->row()->kelas ?></small>
                            </div>
                            <div class="ms-auto text-end">
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
<div class="modal fade" id="addSiswa" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card card-plain">
                    <div class="card-header pb-0 text-left">
                        <h5 class="font-weight-bolder">Tambah Siswa</h5>
                    </div>
                    <div class="card-body pb-0">
                        <form action="<?= site_url('siswa/create') ?>" role="form text-left" method="post">
                            <input type="hidden" name="id_tahunajar" value="<?= $tahunajar->id ?>">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label>Nama Siswa <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Nama Siswa" aria-label="Nama Siswa" name="nama" required>
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <label>NIS</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="NIS" aria-label="NIS" name="nis">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <label>Jenis Kelamin <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenkel" id="inlineRadio1" value="L" required>
                                            <label class="form-check-label" for="inlineRadio1">Laki - Laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="jenkel" id="inlineRadio2" value="P" required>
                                            <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Tanggal Masuk <small class="text-danger">*</small></label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Tanggal Masuk" aria-label="Tanggal Masuk" name="tanggal_masuk" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label>Tanggal Keluar</label>
                                    <div class="input-group mb-3">
                                        <input type="date" class="form-control" placeholder="Tanggal Keluar" aria-label="Tanggal Keluar" name="tanggal_keluar">
                                    </div>
                                </div>

                                <hr class="horizontal dark">

                                <div class="col-lg-12 mb-3">
                                    <label for="example-text-input" class="form-control-label">Upload Foto</label>
                                    <img id="image-preview2" src="#" alt="Image placeholder" class="card-img-top d-none">
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group ms-auto input-group-sm">
                                        <input type="file" id="image-source2" name="img" class="form-control" aria-label="Upload" onchange="previewImage2();" multiple accept="image/*">
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