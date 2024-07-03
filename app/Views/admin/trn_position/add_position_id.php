<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Tambah Data Jabatan</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $karyawan['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail</a>
<form action="/trn_position/save_position_id" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="" name="trn_no">
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="" name="trn_date">
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
       <input type="text" class="form-control" value="<?= $karyawan['employee_name'] ?>" name="employee_id" readonly>
       <input type="hidden" class="form-control" value="<?= $karyawan['employee_id'] ?>" name="employee_id" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Posisi Sekarang</label>
        <select name="position_id" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($position_mst as $mst_position) : ?>
            <option value="<?= $mst_position['position_id'] ?>"><?= $mst_position['position_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Posisi Sebelumnya</label>
        <select name="position_id_old" id="" class="form-control">
            <option value="">Pilih</option>

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
            <option value="">Pilih</option>

            <?php foreach($branch as $branch) : ?>
            <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">SBU Sebelumnya</label>
        <select name="branch_id_old" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($branch_sebelum as $branch) : ?>
            <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Position Start</label>
        <input type="date" class="form-control d-inline" value="" name="position_start">
        </div>

        <div class="col">
        <label for="" class="d-inline">Position Start Old</label>
        <input type="date" class="form-control d-inline" value="" name="position_start_old">
        </div>
        
    </div>
    <hr>
   
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan_buat_setuju as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan_buat_setuju as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan Data </button>
</form>

    </div>

     </div>

</div>