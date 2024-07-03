<div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h3 class="text-center"> Add Fasilitas Karyawan</h3>
            <a href="/fasilitas/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
        </div>

        <?php if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
        </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('pesan_error')) : ?>
        <div class="alert alert-danger">
        <?= session()->getFlashdata('pesan_error') ?>
        </div>
        <?php endif; ?>

     <div class="card shadow">
    <div class="card-body">
<form action="/fasilitas/save_fasilitas" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class=""> Nomor Dokumen </label>
        <input type="text" class="form-control <?= ($validation->hasError('trn_no')) ? 'is-invalid' : '' ?>" value="<?= $nomordokumen; ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
        <?= $validation->getError('trn_no') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class=""> Tanggal Dokumen </label>
        <input type="date" class="form-control <?= ($validation->hasError('trn_date')) ? 'is-invalid' : '' ?>" value="<?= date('Y-m-d') ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
        <?= $validation->getError('trn_date') ?>
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class=""> Tanggal Pinjam </label>
        <input type="date" class="form-control" value="" name="tgl_pinjam">
        <div class="invalid-feedback">
       
        </div>
        </div>

        <div class="col">
        <label for="" class=""> Tanggal Kembali </label>
        <input type="date" class="form-control" value="" name="tgl_kembali">
        <div class="invalid-feedback">
        
        </div>
        </div>
        
    </div>
<hr>

    <div class="row">

    <div class="col">
        <label for="" class="">Nama Karyawan</label>
        <select name="employee_id" id="" class="selField form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>">
            <option value="">Pilih</option>
            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= $validation->getError('employee_id') ?>
        </div>
        </div>
        
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="">Dibuat</label>
        <select name="employee_id_buat" id="" class="selField form-control <?= ($validation->hasError('employee_id_buat')) ? 'is-invalid' : '' ?>">
            <option value="">Pilih</option>
            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= $validation->getError('employee_id_buat') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="">Disetujui</label>
        <select name="employee_id_setuju" id="" class="selField form-control <?= ($validation->hasError('employee_id_setuju')) ? 'is-invalid' : '' ?>">
            <option value="">Pilih</option>
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
        <label for="" class=""> Kegunaan </label>
        <input type="text" class="form-control <?= ($validation->hasError('kegunaan')) ? 'is-invalid' : '' ?>" value="" name="kegunaan">
        <div class="invalid-feedback">
        <?= $validation->getError('kegunaan') ?>
        </div>
        </div>

        <div class="col">
        <label for="" class=""> Status </label>
       <select name="status" id="" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
       <option value="">Pilih</option>
       <option value="1">Penyerahan</option>
       <option value="2">Pengembalian</option>

       </select>
        <div class="invalid-feedback">
        <?= $validation->getError('status') ?>
        </div>
        </div>
        
    </div>
<hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Save Data </button>
</form>

    </div>

    <script type="text/javascript">
       $(".selField").select2();
     </script>

     </div>

</div>