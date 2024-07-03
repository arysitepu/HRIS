<div class="container-fluid">

<div class="mb-3 d-flex justify-content-between">
<h3 class=""> Edit Data Mutasi Jabatan</h3>
<a href="/trn_position/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
</div>

     <div class="card shadow">
    <div class="card-body">
<form action="/trn_position/update_position/<?= $position['trn_id'] ?>" method="post">
<?= csrf_field() ?>
<input type="hidden" name="trn_id" value="<?= $position['trn_id'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $position['trn_no'] ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= $position['trn_date'] ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">
            <option value="<?= $position['employee_id'] ?>"><?= $position['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Posisi Sekarang</label>
        <select name="position_id" id="" class="form-control">
            <option value="<?= $position['position_id'] ?>"><?= $position['position_name'] ?></option>

            <?php foreach($position_mst as $mst_position) : ?>
            <option value="<?= $mst_position['position_id'] ?>"><?= $mst_position['position_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Posisi Sebelumnya</label>
        <select name="position_id_old" id="" class="form-control">
            <option value="<?= $position['position_id_old'] ?>"><?= $position['position_name_old'] ?></option>

            <?php foreach($position_mst as $mst_position) : ?>
            <option value="<?= $mst_position['position_id'] ?>"><?= $mst_position['position_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
<hr>
    <div class="row">
    <div class="col">
        <label for="" class="d-inline">SBU Sekarang</label>
        <select name="branch_id" id="" class="form-control">
            <option value="<?= $position['branch_id'] ?>"><?= $position['branch_name'] ?></option>

            <?php foreach($branch_mst as $branch) : ?>
            <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">SBU Sebelumnya</label>
        <select name="branch_id_old" id="" class="form-control">
            <option value="<?= $position['branch_id_old'] ?>"><?= $position['branch_name_old'] ?></option>

            <?php foreach($branch_mst as $branch) : ?>
            <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Position Start</label>
        <input type="date" class="form-control d-inline" value="<?= $position['position_start'] ?>" name="position_start">
        </div>

        <div class="col">
        <label for="" class="d-inline">Position Start Old</label>
        <input type="date" class="form-control d-inline" value="<?= $position['position_start_old'] ?>" name="position_start_old">
        </div>
        
    </div>
    <hr>
   
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $position['employee_id_buat'] ?>"><?= $position['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $position['employee_id_setuju'] ?>"><?= $position['setuju_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col">
            <label for="">Note / Keterangan</label>
            <textarea name="note" id="" class="form-control"><?= $position['note'] ?></textarea>
        </div>
    </div>
    <hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Update Data </button>
</form>

    </div>

     </div>

</div>