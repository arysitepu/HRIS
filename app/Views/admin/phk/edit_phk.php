<div class="container-fluid">
<div class="d-flex justify-content-between mb-3">
            <h3 class=""> Edit data Karyawan Keluar</h3>
            <a href="/phk/index/" class="btn btn-outline-success" ><i class="fas fa-arrow-left"></i> Back</a>
        </div>
     <div class="card shadow mb-4" >

        

    <div class="card-body">
    
<form action="/phk/update_phk/<?= $phk['trn_id'] ?>" method="post">
<?= csrf_field() ?>
    <div class="row">
        <input type="hidden" value="<?= $phk['trn_id'] ?>" name="trn_id">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $phk['trn_no'] ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= $phk['trn_date'] ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">
            <option value="<?= $phk['employee_id'] ?>"><?= $phk['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $phk['employee_id_buat'] ?>"><?= $phk['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $phk['employee_id_setuju'] ?>"><?= $phk['setuju_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline"> Tanggal PHK </label>
        <input type="date" class="form-control" name="phk_date" value="<?= $phk['phk_date'] ?>">
        <div class="invalid-feedback">
           
        </div>
        </div>

    <div class="col">
    <label for="" class="d-inline"> Deskripsi </label>
        <textarea name="phk_desc" id="" class="form-control"> <?= $phk['phk_desc'] ?> </textarea>
        <div class="invalid-feedback">
           
        </div>
 </div>
    </div>
<hr>

<div class="row">
    <div class="col">
    <label for="" class="d-inline">Status</label>
        <select name="status" id="" class="form-control">
            <option value="<?= $phk['employee_status'] ?>">
                <?php if($phk['employee_status'] == 3) :  ?>
                    <span>Resign</span>
                <?php elseif($phk['employee_status'] == 4) : ?>
                    <span>PHK</span>
                <?php elseif($phk['employee_status'] == 5) : ?>
                    <span>Pensiun</span>
                <?php endif ?>
            </option>

            
            <option value="3">Resign</option>
            <option value="4">PHK</option>
            <option value="5">Pensiun</option>
            
        </select>
    </div>
</div>

<hr>


    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-edit"></i> Ubah Data </button>
</form>

    </div>

     </div>

</div>