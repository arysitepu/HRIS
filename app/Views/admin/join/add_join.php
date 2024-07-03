<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h3>Add Data Pengangkatan</h3>
        <a href="/join/index/" class="btn btn-outline-success mb-3 ml-3" ><i class="fas fa-arrow-left"></i> Back</a>
    </div>
     <div class="card shadow mb-4">

    <div class="card-body">
    
    
<form action="/join/save_join" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $nomordokumen; ?>" name="trn_no" readonly>
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
        <select name="employee_id" id="" class="theSelect form-control" style="width:100%;">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="theSelect form-control" style="width:100%;">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="theSelect form-control" style="width:100%;">
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
    <label for="" class="d-inline"> Jabatan </label>
       <select name="position_id" id="" class="form-control">
           <option value="">Pilih</option>

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
           <option value="">Pilih</option>

           <?php foreach($branch as $br) : ?>

           <option value="<?= $br['branch_id'] ?>"><?= $br['branch_name'] ?></option>

           <?php endforeach ?>
       </select>
        <div class="invalid-feedback">
           
        </div>
 </div>

 <div class="col">
        <label for="" class="d-inline"> Tanggal Pengangkatan </label>
        <input type="date" class="form-control" name="join_start">
        <div class="invalid-feedback">
           
        </div>
        </div>



    </div>
<hr>

<div class="row">
    <div class="col">
    <label for="" class="d-inline"> Status </label>
        <select name="status" class="form-control" id="">
            <option value="">Pilihan</option>
            <option value="1">Probation</option>
            <option value="2">Tetap</option>
        </select>
    </div>
</div>

<hr>

<div class="row">
<div class="col">
    <label for="">Note</label>
    <textarea name="note" id="" class="form-control"></textarea>
</div>
</div>
<hr>
    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Save </button>
</form>

    </div>

     </div>

     <script type="text/javascript">
       $(".theSelect").select2();
     </script>

</div>

