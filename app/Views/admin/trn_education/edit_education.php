<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Edit Pendidikan</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/education/index/" class="btn btn-success mb-3 ml-3" >Kembali ke table</a>

    <form action="/education/update_education/<?= $education['trn_id'] ?>">
<input type="hidden" name="trn_id" value="<?= $education['trn_id'] ?>">
        <div class="row">
            <div class="col">
            <label for="" class="d-inline">Nomor Dokumen </label>
            <input type="text" class="form-control d-inline text-center" value="<?= $education['trn_no'] ?>" name="trn_no">
            </div>
    
            <div class="col">
            <label for="" class="d-inline">Tanggal Dokumen </label>
            <input type="text" class="form-control d-inline text-center" value="<?= $education['trn_date'] ?>" name="trn_date">
            </div>
        </div>
        <hr>
    
        <div class="row">
            <div class="col">
            <label for="" class="d-inline">Nama Karyawan</label>
            <input type="text" class="form-control d-inline" value="<?= $education['employee_name'] ?>" name="employee_id" readonly>
            <input type="hidden" class="form-control d-inline" value="<?= $education['employee_id'] ?>" name="employee_id" readonly>
          
            </div>
            <div class="col">
            <label for="" class="d-inline">Nama Sekolah</label>
            <input type="text" class="form-control <?= ($validation->hasError('education_name')) ? 'is-invalid' : '' ?>" value="<?= old(('education_name')) ? old('education_name') : $education['education_name'] ?>" name="education_name">
            <div class="invalid-feedback">
                <?= $validation->getError('education_name') ?>
            </div>
            </div>
        </div>
    <hr>
        <div class="row">
            <div class="col">
    
            <label for="" class="d-inline">Jenis Pendidikan</label>
            <select name="education_type" id="" class="form-control">
                <option value="<?= $education['education_type'] ?>">
                    <?= ($education['education_type'] == '1') ? 'SD' :'' ?>
                    <?= ($education['education_type'] == '2') ? 'SMP' :'' ?>
                    <?= ($education['education_type'] == '3') ? 'SMA' :'' ?>
                    <?= ($education['education_type'] == '4') ? 'Strata 1' :'' ?>
                </option>
               
                <option value="1">SD</option>
                <option value="2">SMP</option>
                <option value="3">SMA</option>
                <option value="4">STRATA 1</option>
               
            </select>
            </div>
            <div class="col">
            <label for="" class="d-inline">Alamat Sekolah</label>
            <input type="text" class="form-control d-inline" value="<?= $education['education_address'] ?>" name="education_address">
            </div>
        </div>
    <hr>
        <div class="row">
            <div class="col">
            <label for="" class="d-inline">Jurusan</label>
            <input type="text" class="form-control d-inline" value="<?= $education['education_major'] ?>" name="education_major">
            </div>
            <div class="col">
            <label for="" class="d-inline">Nilai/IPK</label>
            <input type="text" class="form-control d-inline" value="<?= $education['ipk'] ?>" name="ipk">
            </div>
            
        </div>
        <hr>
        <div class="row">
        <div class="col">
            <label for="" class="d-inline">Tahun Masuk</label>
            <input type="text" class="form-control d-inline" id="datepicker" value="<?= $education['tahun_masuk'] ?>" name="tahun_masuk">
            </div>
            <div class="col">
            <label for="" class="d-inline">Tahun Lulus</label>
            <input type="text" class="form-control d-inline" id="datepicker2" value="<?= $education['tahun_lulus'] ?>" name="tahun_lulus">
            </div>
            <div class="col">
            <label for="" class="d-inline">Biaya</label>
            <input type="text" class="form-control d-inline" value="<?= $education['biaya'] ?>" name="biaya">
            </div>
        </div>
        <hr>
    
        <div class="row">
            <div class="col">
            <label for="" class="d-inline">Dibuat</label>
            <select name="employee_id_buat" id="" class="form-control">
                <option value="<?= $education['employee_id'] ?>"><?= $education['buat_name'] ?></option>

                <?php foreach($karyawan as $kry) : ?>
                <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
                <?php endforeach; ?>
            </select>
            </div>
            <div class="col">
            <label for="" class="d-inline">Disetujui</label>
            <select name="employee_id_setuju" id="" class="form-control">
                <option value="<?= $education['employee_id'] ?>"><?= $education['setuju_name'] ?></option>

                <?php foreach($karyawan as $kry) : ?>
                <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
                <?php endforeach; ?>
            </select>
            </div>
        </div>
        <hr>

        <button type="submit" class="btn btn-success" > <i class="fas fa-edit"></i> Edit </button>
    </form>


    </div>

     </div>

</div>