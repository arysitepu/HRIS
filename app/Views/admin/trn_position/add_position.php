

<div class="container-fluid">
   <div class="mb-3 d-flex justify-content-between">
       <h3 class="">Add data Mutasi Jabatan</h3>
       <a href="/trn_position/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
   </div>
     <div class="card shadow">
        

    <div class="card-body">
<form action="/trn_position/save_position" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $nomordokumen?>" name="trn_no" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= date('Y-m-d') ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="selField form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Posisi Sekarang</label>
        <select name="position_id" id="" class="selField form-control">
            <option value="">Pilih</option>

            <?php foreach($position_mst as $mst_position) : ?>
            <option value="<?= $mst_position['position_id'] ?>"><?= $mst_position['position_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Posisi Sebelumnya</label>
        <select name="position_id_old" id="" class="selField form-control">
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
        <select name="branch_id" id="" class="selField form-control">
            <option value="">Pilih</option>

            <?php foreach($branch_mst as $branch) : ?>
            <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">SBU Sebelumnya</label>
        <select name="branch_id_old" id="" class="selField form-control" style="width: 100%;">
            <option value="">Pilih</option>

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
        <select name="employee_id_buat" id="" class="selField form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="selField form-control" style="width: 100%;">
            <option value="">Pilih</option>

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
            <textarea name="note" id="" class="form-control"></textarea>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Save </button>
</form>

    </div>

     </div>
     <script type="text/javascript">
       $(".selField").select2();
     </script>
</div>