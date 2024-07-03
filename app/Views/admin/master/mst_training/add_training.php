<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Form Tambah Data Training</b></h5>
        </div>

    <div class="card-body">
    <a href="/mst_training/index" class="btn btn-success mb-3 ml-3" > <i class="fas fa-arrow-alt-circle-left"></i> Table</a>

<form action="/mst_training/save_training" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>">

            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) :  ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('employee_id') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama pelatihan</label>
        <input type="text" class="form-control" value="" name="training_name">
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Target Pelatihan</label>
        <textarea type="text" class="form-control d-inline" value="" name="training_purpose"> </textarea>
        </div>
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <textarea type="text" class="form-control d-inline" value="" name="training_desc">  </textarea>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Training Organizer</label>
        <input type="text" class="form-control d-inline text-center" value="" name="training_organizer">
        </div>
        <hr>

       
        <div class="col">
        <label for="" class="d-inline">Training Start</label>
        <input type="date" class="form-control d-inline text-center" value="" name="training_start">
        </div>
        <hr>
      
        
        
        <div class="col">
        <label for="" class="d-inline">Training End</label>
        <input type="date" class="form-control d-inline text-center" value="" name="training_end">
        </div>
        <hr>
</div>
<hr>


<div class="row">
        <div class="col">
        <label for="" class="d-inline">Biaya Oleh</label>
      <select name="biaya_oleh" id="" class="form-control">

      <option value="">Pilih</option>

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

