<div class="container-fluid">

        <div class="d-flex justify-content-between">
        <h3>Add Jaminan</h3>
        <a href="/jaminan/index/" class="btn btn-outline-success mb-3 ml-3" > <i class="fas fa-arrow-left"></i> Back </a>
        </div>

    <?php if(session()->getFlashdata('pesan_error')) : ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('pesan_error') ?>
    </div>
    <?php endif ?>

    <div class="swal_error" data-swal_error="<?= session()->get('pesan_error') ?>"></div>

     <div class="card shadow">

    <div class="card-body">
    
    
<form action="/jaminan/save_jaminan" method="post" enctype="multipart/form-data">
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
        <input type="date" class="form-control d-inline" value="<?= date('Y-m-d') ?>" name="trn_date" disabled>
       
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="d-inline"> Jenis jaminan </label>
        <select name="type_id" id="" class="form-control <?= ($validation->hasError('type_id')) ? 'is-invalid' : ''; ?>">
            <option value="">Pilih</option>

            <?php foreach($type as $type) : ?>
            <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
        <?= $validation->getError('type_id') ?>
        </div>

        
        </div> 

        <div class="col">
        <label for="" class="d-inline"> Nama Jaminan </label>
        <input type="text" class="form-control <?= ($validation->hasError('jaminan_name')) ? 'is-invalid' : '' ?> d-inline" value="" name="jaminan_name">
        <div class="invalid-feedback">
        <?= $validation->getError('jaminan_name') ?>
        </div>
        </div>
    </div>
<hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
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

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
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
        <label for="" class="d-inline">Disetujui</label>
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
        <label for="" class="d-inline"> Tanggal serah </label>
        <input type="date" class="form-control d-inline" value="" name="tgl_serah">
        <div class="invalid-feedback">
           
        </div>
        </div>

        <div class="col">
            <label for="" class="d-inline">Upload Gambar</label>
            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar">
            <div class="invalid-feedback">
                <?= $validation->getError('gambar') ?>
            </div>
        </div>
      
    </div>
<hr>

<div class="row">
<div class="col">
        <label for="" class="d-inline"> Status </label>
            <select name="status" id="" class="form-control" >

            <option value="">Pilih</option>

            <option value="1">Penyerahan</option>
            <option value="2">Peminjaman</option>
            <option value="3">Pengembalian</option>

            </select>
            <div class="invalid-feedback">
            
            </div>
        </div>
</div>
<hr>
<div class="row">
    <div class="col">
        <label for="" class="d-inline"> Deskripsi jaminan </label>
        <textarea type="date" class="form-control d-inline" value="" name="jaminan_desc"> </textarea>
        <div class="invalid-feedback">
           
        </div>
        </div>

    
    </div>
<hr>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Save </button>
</form>

    </div>

     </div>

     <script type="text/javascript">
      $(".selField").select2()
     </script>

</div>