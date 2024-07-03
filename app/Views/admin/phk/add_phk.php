<div class="container-fluid">
<div class="d-flex justify-content-between mb-3">
            <h3 class=""> Add data karyawan keluar</h3>
            <a href="/phk/index/" class="btn btn-outline-success" ><i class="fas fa-arrow-left"></i> Back</a>
        </div>
     <div class="card shadow mb-4">

        

    <div class="card-body">
    
<form action="/phk/save_phk" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <!-- <input type="text" class="form-control d-inline" value="<?= $nomordokumen ?>" name="trn_no" readonly> -->
        <select name="trn_no" id="" class="form-control">
            <option value="<?= $nomordokumen ?>"><?= $nomordokumen ?></option>
            <option value="<?= $nomordokumenresign ?>"><?= $nomordokumenresign ?></option>
            <option value="<?= $nomordokumenpensiun ?>"><?= $nomordokumenpensiun ?></option>
            <option value="<?= $nomordokumen1 ?>"><?= $nomordokumen1 ?></option>
        </select>
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
        <select name="employee_id" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
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
        <label for="" class="d-inline"> Tanggal Keluar </label>
        <input type="date" class="form-control" name="phk_date">
        <div class="invalid-feedback">
           
        </div>
        </div>

    <div class="col">
    <label for="" class="d-inline"> Deskripsi </label>
        <textarea name="phk_desc" id="" class="form-control"></textarea>
        <div class="invalid-feedback">
           
        </div>
 </div>
    </div>
<hr>

<div class="row">
    <div class="col">
    <label for="" class="d-inline">Status</label>
        <select name="status" id="" class="form-control">
            <option value="">Pilih</option>
            <option value="3">Resign</option>
            <option value="4">PHK</option>
            <option value="5">Pensiun</option>
            
        </select>
    </div>
</div>

<hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Simpan Data </button>
</form>

    </div>

     </div>

</div>