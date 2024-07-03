<div class="container-fluid">

        <div class="d-flex justify-content-between">
            <h3>Edit Fasilitas Karyawan</h3>
            <a href="/fasilitas/index/" class="btn btn-outline-success mb-3 ml-3" > <i class="fas fa-arrow-left"></i> Back</a>
        </div>

     <div class="card shadow mb-4">


    <div class="card-body">
    
   
<form action="/fasilitas/update_fasilitas/<?= $fasilitas['trn_id'] ?>" method="post">
<?= csrf_field() ?>
<input type="hidden" name="trn_id" value="<?= $fasilitas['trn_id'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control <?= ($validation->hasError('trn_no')) ? 'is-invalid' : '' ?>" value="<?= $fasilitas['trn_no'] ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
        <?= $validation->getError('trn_no') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control <?= ($validation->hasError('trn_date')) ? 'is-invalid' : '' ?>" value="<?= $fasilitas['trn_date'] ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
        <?= $validation->getError('trn_date') ?>
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="d-inline"> Tanggal Pinjam </label>
        <input type="date" class="form-control" value="<?= $fasilitas['tgl_pinjam'] ?>" name="tgl_pinjam">
        <div class="invalid-feedback">
           
        </div>
        </div>

        <div class="col">
        <label for="" class="d-inline"> Tanggal Kembali </label>
        <input type="date" class="form-control" value="<?= $fasilitas['tgl_kembali'] ?>" name="tgl_kembali">
        <div class="invalid-feedback">
           
        </div>
        </div>
        
    </div>
<hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>">
            <option value="<?= $fasilitas['employee_id'] ?>"><?= $fasilitas['employee_name'] ?></option>
            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= $validation->getError('employee_id') ?>
        </div>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control <?= ($validation->hasError('employee_id_buat')) ? 'is-invalid' : '' ?>">
            <option value="<?= $fasilitas['employee_id_buat'] ?>"><?= $fasilitas['buat_name'] ?></option>
            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= $validation->getError('employee_id_buat') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control <?= ($validation->hasError('employee_id_setuju')) ? 'is-invalid' : '' ?>">
            <option value="<?= $fasilitas['employee_id_setuju'] ?>"><?= $fasilitas['setuju_name'] ?></option>
            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
            <?= $validation->getError('employee_id_setuju') ?>
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="d-inline"> Kegunaan </label>
        <input type="text" class="form-control <?= ($validation->hasError('kegunaan')) ? 'is-invalid' : '' ?>" value="<?= $fasilitas['kegunaan'] ?>" name="kegunaan">
        <div class="invalid-feedback">
        <?= $validation->getError('kegunaan') ?>
        </div>
        </div>

        <div class="col">
        <label for="" class="d-inline"> Status </label>
       <select name="status" id="" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
           <option value="<?= $fasilitas['status'] ?>">
                <?= ($fasilitas['status'] == 1) ? 'Penyerahan' : '' ?>
                <?= ($fasilitas['status'] == 2) ? 'Pengembalian' : '' ?>
        </option>
        <option value="1">Penyerahan</option>
        <option value="2">Pengembalian</option>
       </select>
        <div class="invalid-feedback">
        <?= $validation->getError('status') ?>
        </div>
        </div>

        
    </div>
<hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-edit"></i> Update </button>
</form>

    </div>

     </div>

</div>