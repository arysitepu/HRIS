<div class="container-fluid">
    
    <div class="d-flex justify-content-between mb-3">
        <h3 class="text-center"> <b> Edit Data Pengangkatan</b></h3>
        <a href="/join/index/" class="btn btn-outline-success" ><i class="fas fa-arrow-left"></i> Back</a>
    </div>

     <div class="card shadow mb-4">
    <div class="card-body">
    
<form action="/join/update_join/<?= $join['trn_id'] ?>" method="post">
<?= csrf_field() ?>
<input type="hidden" name="trn_id" value="<?= $join['trn_id'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $join['trn_no'] ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= $join['trn_date'] ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">
            <option value="<?= $join['employee_id'] ?>"><?= $join['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $join['employee_id_buat'] ?>"><?= $join['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $join['employee_id_setuju'] ?>"><?= $join['setuju_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <hr>

    <div class="row">

    <div class="col">
    <label for="" class="d-inline"> Jabatan </label>
       <select name="position_id" id="" class="form-control">
           <option value="<?= $join['position_id'] ?>"><?= $join['position'] ?></option>

           <?php foreach($position as $pos) : ?>

           <option value="<?= $pos['position_id'] ?>"><?= $pos['position_name'] ?></option>

           <?php endforeach ?>
       </select>
        <div class="invalid-feedback">
           
        </div>
 </div>


    <div class="col">
    <label for="" class="d-inline"> SBU </label>
       <select name="branch_id" id="" class="form-control">
           <option value="<?= $join['branch_id'] ?>"><?= $join['branch'] ?></option>

           <?php foreach($branch as $br) : ?>

           <option value="<?= $br['branch_id'] ?>"><?= $br['branch_name'] ?></option>

           <?php endforeach ?>
       </select>
        <div class="invalid-feedback">
           
        </div>
 </div>

 <div class="col">
        <label for="" class="d-inline"> Tanggal Pengangkatan </label>
        <input type="date" class="form-control" name="join_start" value="<?= $join['join_start'] ?>">
        <div class="invalid-feedback">
           
        </div>
        </div>



    </div>
<hr>

<div class="row">
    <div class="col">
    <label for="" class="d-inline"> Status </label>
        <select name="status" class="form-control" id="">
            <option value="<?= $join['employee_status'] ?>">
            <?php
            if($join['employee_status'] == 1){
                echo 'Probation';
            }elseif($join['employee_status'] == 2){
                echo 'Tetap';
            }else{
                echo '';
            }
            ?>
            </option>
            <option value="1">Probation</option>
            <option value="2">Tetap</option>
        </select>
    </div>
</div>

<hr>
<div class="row">
<div class="col">
    <label for="">Note</label>
    <textarea name="note" id="" class="form-control"><?= $join['note'] ?></textarea>
</div>
</div>
<hr>
    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-edit"></i> Ubah Data </button>
</form>

    </div>

     </div>

</div>