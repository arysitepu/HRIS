<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Add data pendidikan</h3>
        <a href="/employee_education/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>
    <div class="card shadow">
        <div class="card-body">
        <form action="/employee_education/save_education" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col">
                <label for="">Karyawan</label>
                <select id="inputState" class="theSelect form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>" name="employee_id" style="width:100%;">
                    <option value="">Pilih</option>
                    <?php foreach ($karyawan as $kry) : ?>
                        <option value="<?= $kry['employee_id'] ?>" <?= old('employee_id') == $kry['employee_id'] ? 'selected' : '' ?> > <?= $kry['employee_name'] ?> </option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                <?= $validation->getError('employee_id') ?>
                </div>
            </div>
            <div class="col">
                <label for="inputEmail4">Jenis Pendidikan</label>
                <select id="inputState" class="form-control <?= ($validation->hasError('education_type')) ? 'is-invalid' : '' ?>" name="education_type">
                    <option value="">Pilih</option>
                    <option value="1" <?= old('education_type') == '1' ? 'selected' : '' ?> >SD</option>
                    <option value="2" <?= old('education_type') == '2' ? 'selected' : '' ?> >SMP</option>
                    <option value="3" <?= old('education_type') == '3' ? 'selected' : '' ?> >SMA</option>
                    <option value="4" <?= old('education_type') == '4' ? 'selected' : '' ?> >PERGURUAN TINGGI</option>
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
                <input type="text" class="form-control <?= ($validation->hasError('education_name')) ? 'is-invalid' : '' ?>" name="education_name"
                value="<?= old('education_name') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('education_name') ?>
                </div>
            </div>
            <div class="col">
                <label for="">Alamat Pendidikan</label>
                <input type="text" class="form-control <?= ($validation->hasError('education_address')) ? 'is-invalid' : '' ?>" name="education_address" 
                value="<?= old('education_address') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('education_address') ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="">Jurusan</label>
                <input type="text" class="form-control <?= ($validation->hasError('education_major')) ? 'is-invalid' : '' ?>" name="education_major"
                value="<?= old('education_major') ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('education_major') ?>
                </div>
            </div>
            <div class="col">
                <label for="">Nilai</label>
                <input type="text" class="form-control  <?= ($validation->hasError('ipk')) ? 'is-invalid' : '' ?>" name="ipk" value="<?= old('ipk') ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('ipk') ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="">Tahun Masuk</label>
                <input type="text" id="datepicker" class="form-control <?= ($validation->hasError('tahun_masuk')) ? 'is-invalid' : '' ?>" name="tahun_masuk" value="<?= old('tahun_masuk') ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('tahun_masuk') ?>
                </div>
            </div>
            <div class="col">
                <label for="">Tahun lulus</label>
                <input type="text" id="datepicker2" class="form-control <?= ($validation->hasError('tahun_lulus')) ? 'is-invalid' : '' ?>" name="tahun_lulus" value="<?= old('tahun_lulus') ?>" >
                <div class="invalid-feedback">
                    <?= $validation->getError('tahun_lulus') ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="inputEmail4">Biaya oleh</label>
                <select id="inputState" class="form-control <?= ($validation->hasError('biaya_oleh')) ? 'is-invalid' : '' ?>" name="biaya_oleh">
                    <option value="">Pilih</option>
                    <option value="1" <?= old('biaya_oleh') == '1' ? 'selected' : '' ?> >Biaya Sendiri</option>
                    <option value="2" <?= old('biaya_oleh') == '2' ? 'selected' : '' ?> >Orang tua</option>
                    <option value="3" <?= old('biaya_oleh') == '3' ? 'selected' : '' ?> >PT ATAP TEDUH LESTARI</option>
                </select>
                <div class="invalid-feedback">
                <?= $validation->getError('biaya_oleh') ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
            <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Simpan</button>
            </div>
        </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
       $(".theSelect").select2();
</script>