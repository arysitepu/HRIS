<div class="container-fluid">
   <div class="d-flex justify-content-between mb-3">
       <h3 class=""> Edit Data Surat Peringatan</h3>
       <a href="/peringatan/index/" class="btn btn-outline-success" > <i class="fas fa-arrow-left"></i> Back </a>
       
   </div>
     <div class="card shadow mb-4">
    <div class="card-body">
    
<form action="/peringatan/update_peringatan/<?= $peringatan['trn_id'] ?>" method="post">
<?= csrf_field() ?>
    <div class="row">
        <input type="hidden" name="trn_id" value="<?= $peringatan['trn_id'] ?>">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $peringatan['trn_no'] ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= $peringatan['trn_date'] ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>
    

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">
            <option value="<?= $peringatan['employee_id'] ?>"><?= $peringatan['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $peringatan['employee_id_buat'] ?>"><?= $peringatan['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $peringatan['employee_id_setuju'] ?>"><?= $peringatan['setuju_name'] ?></option>

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
            <option value="<?= $peringatan['position_id'] ?>"><?= $peringatan['position'] ?></option>

            <?php foreach($position as $pos): ?>
            <option value="<?= $pos['position_id'] ?>"><?= $pos['position_name'] ?></option>
            <?php endforeach ?>
        
        </select>
        <div class="invalid-feedback">
           
        </div>
        </div>

    <div class="col">
        <label for="" class="d-inline"> Jenis Peringatan </label>
        <select name="sp_type" id="" class="form-control">
            <option value="<?= $peringatan['sp_type'] ?>"><?= $peringatan['sp_type'] ?></option>

            <option value="SP1">SP1</option>
            <option value="SP2">SP2</option>
        </select>
        <div class="invalid-feedback">
           
        </div>
 </div>
    </div>
<hr>

<div class="row">
    
<div class="col">
        <label for="" class="d-inline"> Deskripsi </label>
        <textarea name="sp_desc" id="" class="form-control" > <?= $peringatan['sp_desc'] ?> </textarea>
        <div class="invalid-feedback">
           
        </div>
        </div>
</div>

<hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Update Data </button>
</form>

    </div>

     </div>

</div>