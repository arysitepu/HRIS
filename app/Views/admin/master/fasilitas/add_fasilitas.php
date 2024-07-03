<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

                    <div class="card-header">
                        <h5 class="text-center"> <b> Form Tambah Fasilitas</b></h5>
                    </div>
    <form action="/fasilitas_karyawan/save" method="post">
<?= csrf_field(); ?>
        <div class="card-body">
                <a href="/fasilitas_karyawan/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>

                <div class="row">
                    <div class="col">
                    <label for="" class="d-inline">Nama Karyawan</label>
                    <select id="inputState" class="form-control <?= $validation->hasError('employee_id') ? 'is-invalid' : '' ?>" name="employee_id">
                        <option value="">Pilih</option>

                        <?php foreach ($karyawan as $kry) : ?>
                        <option value="<?= $kry['employee_id'] ?>" <?= old('employee_id') == $kry['employee_id'] ? 'selected' : '' ?>><?= $kry['employee_name']?></option>
                    <?php endforeach; ?>
                    </select>

                    <div class="invalid-feedback">
                        <?= $validation->getError('employee_id') ?>
                    </div>

                    </div>


                    <div class="col">
                    <label for="" class="d-inline">Tipe Fasilitas</label>
                    <select id="inputState" class="form-control <?= $validation->hasError('type_id') ? 'is-invalid' : '' ?>" name="type_id">
                        <option value="">Pilih</option>

                        <?php foreach ($type as $type) : ?>
                        <option value="<?= $type['type_id'] ?>" <?= old('type_id') == $type['type_id'] ? 'selected' : '' ?>  ><?= $type['type_name']?></option>
                    <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                    <?= $validation->getError('type_id') ?>
                    </div>


                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col">
                    <label for="" class="d-inline">Nama Fasilitas</label>
                    <input type="text" class="form-control d-inline <?= $validation->hasError('facility_name') ? 'is-invalid' : '' ?>" name="facility_name"
                    value="<?= old('facility_name') ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('facility_name') ?>
                    </div>
                    </div>
                    <div class="col">
                    <label for="" class="d-inline">Deskripsi</label>
                    <input type="text" class="form-control d-inline <?= $validation->hasError('facility_desc') ? 'is-invalid' : '' ?>" name="facility_desc"
                    value="<?= old('facility_desc') ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('facility_desc') ?>
                    </div>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col">
                    <label for="" class="d-inline">Nomor fasilitas asset</label>
                    <input type="text" class="form-control d-inline text-center <?= $validation->hasError('facility_asset_no') ? 'is-invalid' : '' ?>" name="facility_asset_no"
                    value="<?= old('facility_asset_no') ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('facility_asset_no') ?>
                    </div>
                    </div>
                

                </div>
            <br>
                <div class="row">
                    <div class="col">
                
                <button type="submit" class="btn btn-success" > <i class="fas fa-save" ></i> Simpan Data </button>
                    </div>
                

                </div>

    </div>
    </form>

</div>