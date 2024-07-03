<div class="container-fluid">
   <div class="d-flex justify-content-between mb-3">
        <h3>Add Data Pelatihan Karyawan</h3>
       <a href="/training/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back  </a>
   </div>

   <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('pesan_error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('pesan_error') ?>
            </div>
    <?php endif; ?>

     <div class="card shadow mb-4">

    <div class="card-body">
    
<form action="/training/save_training" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control <?= ($validation->hasError('trn_no')) ? 'is-invalid' : '' ?> d-inline" value="<?= $nomordokumen; ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
        <?= $validation->getError('trn_no') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
     
        <input type="date" class="form-control <?= ($validation->hasError('trn_date')) ? 'is-invalid' : '' ?> d-inline" name="trn_date" value="<?= date('Y-m-d') ?>" readonly>
        <div class="invalid-feedback">
        <?= $validation->getError('trn_date') ?>
        </div>
        </div>
    </div>
    <hr>


    <div class="row">

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control <?= ($validation->hasError('employee_id_buat')) ? 'is-invalid' : '' ?>">
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
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control <?= ($validation->hasError('employee_id_setuju')) ? 'is-invalid' : '' ?>">
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
        <label for="" class="d-inline"> Tipe pelatihan </label>
       <select name="id_training" id="" class="form-control <?= ($validation->hasError('id_training')) ? 'is-invalid' : '' ?>">
        <option value="">Pilih Tipe training</option>
        <?php foreach($mst_trainings  as $mst_training) : ?>
            <option value="<?= $mst_training['id_training'] ?>"><?= $mst_training['name_training'] ?></option>
        <?php endforeach ?>
       </select>
        <div class="invalid-feedback">
        <?= $validation->getError('id_training') ?>
        </div>
    </div>
    <div class="col">
        <label for="" class="d-inline"> Nama Pelatihan </label>
        <input type="text" class="form-control <?= ($validation->hasError('training_name')) ? 'is-invalid' : '' ?> d-inline"  name="training_name">
        <div class="invalid-feedback">
        <?= $validation->getError('training_name') ?>
        </div>
    </div>
    
        <div class="col">
        <label for="" class="d-inline"> Training Organizer </label>
        <input type="text" class="form-control <?= ($validation->hasError('training_organizer')) ? 'is-invalid' : '' ?> d-inline" name="training_organizer">
        <div class="invalid-feedback">
        <?= $validation->getError('training_organizer') ?>
        </div>
        </div>
      
    </div>
<hr>


<div class="row">

<div class="col">
        <label for="" class="d-inline"> Training Purpose </label>
        <textarea type="text" class="form-control <?= ($validation->hasError('training_purpose')) ? 'is-invalid' : '' ?> d-inline" value="" name="training_purpose"> </textarea>
        <div class="invalid-feedback">
        <?= $validation->getError('training_purpose') ?>
        </div>
        </div>

    <div class="col">
        <label for="" class="d-inline"> Deskripsi </label>
        <textarea type="date" class="form-control <?= ($validation->hasError('training_desc')) ? 'is-invalid' : '' ?> d-inline" value="" name="training_desc"> </textarea>
        <div class="invalid-feedback">
        <?= $validation->getError('training_desc') ?>
        </div>
        </div>

    
    </div>
<hr>

<div class="row">

    <div class="col">
    <label for="" class="d-inline"> Tanggal Mulai </label>
    <input type="date" class="form-control <?= ($validation->hasError('training_start')) ? 'is-invalid' : '' ?> d-inline" value="" name="training_start">
    <div class="invalid-feedback">
    <?= $validation->getError('training_start') ?>
    </div>
    </div>

    <div class="col">
    <label for="" class="d-inline"> Tanggal Selesai </label>
    <input type="date" class="form-control <?= ($validation->hasError('training_end')) ? 'is-invalid' : '' ?> d-inline" value="" name="training_end">
    <div class="invalid-feedback">
    <?= $validation->getError('training_end') ?>
    </div>
    </div>
</div>

<hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Save </button>
</form>

    </div>

     </div>

</div>