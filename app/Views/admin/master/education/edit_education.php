<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Edit Pendidikan</h3>
        <a href="/employee_education/index" class="btn btn-outline-success"><i class="fas fa-arrow-left"></i> Back</a>
    </div>

    <?php if(session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('pesan_error')) : ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('pesan_error') ?>
      </div>
    <?php endif; ?>

    <div class="card shadow mt-3">
        <div class="card-body">
        <form action="/employee_education/education_update/<?= $education_employee['id'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" value="<?= $education_employee['id'] ?>">
            <div class="row">
                <div class="col">
                    <label for="inputEmail4">Karyawan</label>
                    <select id="inputState" class="form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>" name="employee_id">
                            <option value="<?= $education_employee['employee_id'] ?>"><?= $education_employee['employee_name'] ?></option>
                            <?php foreach ($karyawan as $kry) : ?>
                                <option value="<?= $kry['employee_id'] ?>" > <?= $kry['employee_name'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                        <?= $validation->getError('employee_id') ?>
                        </div>
                </div>
                <div class="col">
                    <label for="">Jenis Pendidikan</label>
                    <select id="inputState" class="form-control <?= ($validation->hasError('education_type')) ? 'is-invalid' : '' ?>" name="education_type">
                            <option value="<?= $education_employee['education_type'] ?>">
                            <?php 
                            if($education_employee['education_type'] == 1){
                                echo 'SD';
                            }elseif($education_employee['education_type'] == 2){
                                echo 'SMP';
                            }elseif($education_employee['education_type'] == 3){
                                echo 'SMA';
                            }elseif($education_employee['education_type'] == 4){
                                echo 'PERGURUAN TINGGI';
                            }else{
                                echo '';
                            }
                            ?>
                            </option>
                            <option value="1" >SD</option>
                            <option value="2" >SMP</option>
                            <option value="3" >SMA</option>
                            <option value="4" >PERGURUAN TINGGI</option>
                        
                        </select>
                        <div class="invalid-feedback">
                        <?= $validation->getError('education_type') ?>
                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="">Nama Pendidikan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('education_name')) ? 'is-invalid' : '' ?>" name="education_name" value="<?= $education_employee['education_name'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('education_name') ?>
                    </div>
                </div>
                <div class="col">
                    <label for="">Alamat Pendidikan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('education_address')) ? 'is-invalid' : '' ?>" name="education_address" value="<?= $education_employee['education_address'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('education_address') ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="">Jurusan</label>
                    <input type="text" class="form-control <?= ($validation->hasError('education_major')) ? 'is-invalid' : '' ?>" name="education_major" value="<?= $education_employee['education_major'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('education_major') ?>
                    </div>
                </div>
                <div class="col">
                    <label for="">Nilai</label>
                    <input type="text" class="form-control <?= ($validation->hasError('ipk')) ? 'is-invalid' : '' ?>" name="ipk" value="<?= $education_employee['ipk'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('ipk') ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="">Tahun Masuk</label>
                    <input type="text" id="datepicker" class="form-control <?= ($validation->hasError('tahun_masuk')) ? 'is-invalid' : '' ?>" name="tahun_masuk" value="<?= $education_employee['tahun_masuk'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tahun_masuk') ?>
                    </div>
                </div>
                <div class="col">
                    <label for="">Tahun lulus</label>
                    <input type="text" id="datepicker2" class="form-control <?= ($validation->hasError('tahun_lulus')) ? 'is-invalid' : '' ?>" name="tahun_lulus" value="<?= $education_employee['tahun_lulus'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tahun_lulus') ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="inputEmail4">Biaya oleh</label>
                    <select id="inputState" class="form-control <?= ($validation->hasError('biaya_oleh')) ? 'is-invalid' : '' ?>" name="biaya_oleh">
                            <option value="<?= $education_employee['biaya_oleh'] ?>">
                            <?php 
                            if($education_employee['biaya_oleh'] == 1){
                                echo 'Biaya Sendiri';
                            }elseif($education_employee['biaya_oleh'] == 2){
                                echo 'Orang tua';
                            }elseif($education_employee['biaya_oleh'] == 3){
                                echo 'PT ATAP TEDUH LESTARI';
                            }else{
                                echo '';
                            }
                            ?>
                            </option>
                            <option value="1" >Biaya Sendiri</option>
                            <option value="2" >Orang tua</option>
                            <option value="3" >PT ATAP TEDUH LESTARI</option>
                        
                        </select>
                        <div class="invalid-feedback">
                        <?= $validation->getError('biaya_oleh') ?>
                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                <button type="submit" class="btn btn-outline-success" > <i class="fas fa-edit"></i> Simpan </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>