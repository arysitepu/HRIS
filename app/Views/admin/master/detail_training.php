<div class="container-fluid">
   
     <div class="card shadow mb-4">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Training</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $mst_training['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Training</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_training['training_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Training Organizer</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_training['training_organizer'] ?>" readonly>

        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Training Pupose</label>
        <textarea type="text" class="form-control" value="" readonly><?= $mst_training['training_purpose'] ?> </textarea>
        </div>
        <div class="col">
        <label for="" class="d-inline">Training Desc</label>
        <textarea type="text" class="form-control d-inline" value="" readonly> <?= $mst_training['training_desc'] ?> </textarea>
       
        </div>
    </div>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Training Start</label>
        <input type="date" class="form-control d-inline" value="<?= $mst_training['training_start'] ?>" readonly> 
        </div>
        <div class="col">
        <label for="" class="d-inline">Training End</label>
        <input type="date" class="form-control d-inline" value="<?= $mst_training['training_end'] ?>" readonly>
        </div>
    </div>


    </div>

     </div>

</div>