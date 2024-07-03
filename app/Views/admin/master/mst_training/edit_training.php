<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Form Edit Data Training</b></h5>
        </div>

    <div class="card-body">
    <a href="/mst_training/index" class="btn btn-success mb-3 ml-3" > <i class="fas fa-arrow-alt-circle-left"></i> Table</a>

<form action="/mst_training/update_training/<?= $mst_training['id'] ?>" method="post">
<?= csrf_field() ?>
<input type="text" value="<?= $mst_training['id'] ?>" name="id">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">

            <option value="<?= $mst_training['employee_id'] ?>"><?= $mst_training['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) :  ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama pelatihan</label>
        <input type="text" class="form-control <?= ($validation->hasError('training_name')) ? 'is-invalid' : '' ?>" value="<?= old(('training_name')) ? old('training_name') : $mst_training['training_name'] ?>" 
        name="training_name">
        <div class="invalid-feedback">
            <?= $validation->getError('training_name') ?>
        </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Target Pelatihan</label>
        <textarea type="text" class="form-control d-inline" value="" name="training_purpose"><?= $mst_training['training_purpose'] ?> </textarea>
        </div>
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <textarea type="text" class="form-control d-inline"  name="training_desc"> <?= $mst_training['training_purpose'] ?> </textarea>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Training Organizer</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_training['training_organizer'] ?>" name="training_organizer">
        </div>
        <hr>

       
        <div class="col">
        <label for="" class="d-inline">Training Start</label>
        <input type="date" class="form-control d-inline text-center" value="<?= $mst_training['training_start'] ?>" name="training_start">
        </div>
        <hr>
      
        
        
        <div class="col">
        <label for="" class="d-inline">Training End</label>
        <input type="date" class="form-control d-inline text-center" value="<?= $mst_training['training_end'] ?>" name="training_end">
        </div>
        <hr>
</div>
<hr>


<div class="row">
        <div class="col">
        <label for="" class="d-inline">Biaya Oleh</label>
      <select name="biaya_oleh" id="" class="form-control">

      <option value="<?= $mst_training['biaya_oleh'] ?>"><?= $mst_training['biaya_oleh'] ?></option>

      <option value="1">Biaya Sendiri</option>
      <option value="2">PT. ATAP TEDUH LESTARI</option>

      </select>
        </div>
    </div>

    <br>
    <div class="row">
        <div class="col">
        <button type="submit" class="btn btn-info" > <i class="fas fa-save"></i> Simpan data </button>
        </div>
    </div>

</form>
    </div>
 </div>

</div>

