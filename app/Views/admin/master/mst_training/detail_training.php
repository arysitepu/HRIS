<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail jaminan</b></h5>
        </div>

    <div class="card-body">
    <a href="/mst_training/index" class="btn btn-success mb-3 ml-3" > <i class="fas fa-arrow-alt-circle-left"></i> Table</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_training['employee_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama pelatihan</label>
        <input type="text" class="form-control" value="<?= $mst_training['training_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Target Pelatihan</label>
        <textarea type="text" class="form-control d-inline" value="" readonly> <?= $mst_training['training_purpose'] ?> </textarea>
        </div>
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <textarea type="text" class="form-control d-inline" value="" readonly> <?= $mst_training['training_desc'] ?> </textarea>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Training Organizer</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_training['training_organizer'] ?>" readonly>
        </div>
        <hr>

       
        <div class="col">
        <label for="" class="d-inline">Training Start</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_training['training_start'] ?>" readonly>
        </div>
        <hr>
      
        
        
        <div class="col">
        <label for="" class="d-inline">Training End</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_training['training_end'] ?>" readonly>
        </div>
        <hr>
</div>
<hr>


<div class="row">
        <div class="col">
        <label for="" class="d-inline">Biaya Oleh</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_training['biaya_oleh'] ?>" readonly>
        </div>
    </div>

    </div>
     </div>

