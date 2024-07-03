<style>
  .hidden-file {
    display: none;
  }
</style>

<div class="container-fluid">

        <?php if(session()->getFlashdata('pesan_error')) : ?>
        <div class="alert alert-danger">
        <?= session()->getFlashdata('pesan_error') ?>
        </div>

        <div class="swal_error" data-swal_error="<?= session()->get('pesan_error') ?>"></div>

<?php endif; ?>
<div class="d-flex justify-content-between mb-3">
    <h3 class="text-center"> Add Data Attendance</h3>
    <a href="/trn_cuti/index/" class="btn btn-outline-success" > <i class="fas fa-arrow-left"></i> Back </a>
</div>

     <div class="card shadow">
    <div class="card-body">
                        <form action="/trn_cuti/save_cuti" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="row">
                                <div class="col">
                                <label for="" class="d-inline"> Nomor Dokumen </label>
                                <!-- <input type="text" class="form-control" name="trn_no" value=""> -->
                            <input type="text" class="form-control" name="trn_no" value="<?= $nomorDokumen ?>" readonly>
                                <div class="invalid-feedback">
                                
                                </div>
                                </div>
                                <div class="col">
                                <label for="" class="d-inline"> Tanggal Dokumen </label>
                                <!-- <input type="date" class="form-control d-inline" value="" name="trn_date"> -->
                                <input type="date" class="form-control" value="<?= date('Y-m-d') ?>" name="trn_date" readonly>
                            <!-- <input type="date" class="form-control" name="trn_date" value="<?= date('Y-m-d') ?>" disabled> -->
                                <div class="invalid-feedback">
                                
                                </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col">
                                <label for="" class="d-inline"> Nama Karyawan </label>
                            <input type="text" class="form-control" value="<?= $employee_name->employee_name ?>" readonly>
                            <input type="hidden" class="form-control" name="employee_id" value="<?= $employee_name->employee_id ?>" readonly>
                                <div class="invalid-feedback">
                                
                                </div>
                                </div>
                                <div class="col">
                                <label for="" class="d-inline"> Posisi </label>
                                <input type="text" class="form-control" value="<?= $employee_name->position_name ?>" readonly>
                                <input type="hidden" class="form-control" name="position_id" value="<?= $employee_name->position_id ?>" readonly>
                                <div class="invalid-feedback">
                                
                                </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">

                            <div class="col">
                                <label for="" class="d-inline">SBU</label>
                                <input type="text" class="form-control" value="<?= $employee_name->branch_name ?>" readonly>
                                <input type="hidden" name="branch_id" class="form-control" value="<?= $employee_name->branch_id ?>" readonly>
                                </div>

                                <div class="col">
                                <label for="" class="d-inline">Jenis Cuti</label>
                                <input type="text" class="form-control" value="<?= $cuti_name->cuti_name ?>" readonly>
                                <input type="hidden" name="cuti_id" class="form-control" value="<?= $jenis_cuti ?>" readonly>
                                </div>
                            
                            </div>
                            <hr>

                            <?php if($cuti_name->cuti_id == 1){ ?>

                            <div class="row">        
                                <div class="col">
                                <label for="" class="">Cuti yang di ambil</label>
                                <input type="text" class="form-control" name="cuti_jumlah" value="0">
                            <span class="text-danger" style="font-size: 12px;"> (Diisi apabila hanya mengambil cuti tahunan) </span>
                                </div>

                                <div class="col">
                                    <label for="">Hak Cuti</label>
                                    <input type="text" class="form-control" name="hak_cuti" value="<?= $employee_name->hak_cuti ?>" readonly>
                                </div>
                                
                        
                            </div>
                        <hr>

                        <?php }else{ ?>
                            <div class="row">        
                                <div class="col">
                                <label for="" class="hidden-file">Cuti yang di ambil</label>
                                <input type="text" class="hidden-file" name="cuti_jumlah" value="0">
                            <span class="hidden-file" style="font-size: 12px;"> (Diisi apabila hanya mengambil cuti tahunan) </span>
                                </div>

                                <div class="col">
                                    <label for="" class="hidden-file">Hak Cuti</label>
                                    <input type="text" class="hidden-file" name="hak_cuti" value="<?= $employee_name->hak_cuti ?>" readonly>
                                </div>
                                
                        
                            </div>
                        <hr class="hidden-file">

                        <?php } ?>


                            <div class="row">

                            <div class="col">
                                <label for="">Tanggal Dari</label>
                                <input type="date" class="form-control <?= ($validation->hasError('tgl_dari')) ? 'is-invalid' : '' ?>" name="tgl_dari" value="<?= old('tgl_dari') ?>">
                                <div class="invalid-feedback">
                                <?= $validation->getError('tgl_dari') ?>
                                </div>
                                </div>

                            <div class="col">
                                <label for="">Tanggal Sampai</label>
                                <input type="date" class="form-control <?= ($validation->hasError('tgl_sampai')) ? 'is-invalid' : '' ?>" name="tgl_sampai" value="<?= old('tgl_sampai') ?>">
                                <div class="invalid-feedback">
                                <?= $validation->getError('tgl_sampai') ?>
                                </div>
                                </div>
                            
                            </div>
                        <hr>

                        <div class="row">
                        <div class="col">
                            <label for="" class="d-inline">Serah kerja kepada</label>
                        <input type="text" class="form-control" name="serah_kerja">
                        </div>

                        <div class="col">
                            <label for="" class="d-inline">Alamat Cuti</label>
                        <input type="text" class="form-control" name="alamat_cuti">
                        </div>

                        
                        </div>
                        <hr>

                        <div class="row">
                                <div class="col">
                                <label for="" class="d-inline"> Membuat </label>
                                <select name="employee_id_buat" id="" class="selField form-control <?= ($validation->hasError('gambar_sakit')) ? 'is-invalid' : '' ?>" style="width: 100% ;">
                                    <option value="">Pilih</option>

                                    <?php foreach($karyawan as $kry) : ?>
                                    <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                <?= $validation->getError('employee_id_buat') ?>
                                </div>
                                </div>
                                <div class="col">
                                <label for="" class="d-inline"> Menyetujui </label>
                                <select name="employee_id_setuju" id="" class="selField form-control <?= ($validation->hasError('gambar_sakit')) ? 'is-invalid' : '' ?>">
                                    <option value="">Pilih</option>

                                    <?php foreach($karyawan as $kry) : ?>
                                    <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                <?= $validation->getError('employee_id_setuju') ?>
                                </div>
                                </div>
                            </div>
                            <hr>

                        <div class="row">
                            
                        <div class="col">
                                <label for="" class="d-inline"> Deskripsi </label>
                                <textarea name="cuti_desc" id="" class="form-control"></textarea>
                                <div class="invalid-feedback">
                                
                                </div>
                                </div>

                            <?php if($cuti_name->cuti_id == 2){ ?>
                                <div class="col">
                                    <label for="">Upload bukti surat sakit</label>
                                    <input type="file" class="form-control <?= ($validation->hasError('gambar_sakit')) ? 'is-invalid' : '' ?>" name="gambar_sakit" value="">

                                    <div class="invalid-feedback">
                                    <?= $validation->getError('gambar_sakit') ?>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                    <input type="file" class="hidden-file" name="gambar_sakit" value="">
                                    <?php } ?>
                            
                        </div>

                        <hr>

                            <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan Data </button>
                        </form>

    </div>
    <script type="text/javascript">
       $(".selField").select2();
     </script>
     </div>

</div>