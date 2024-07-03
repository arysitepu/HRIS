<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Tambah Data Pendidikan</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $karyawan['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail karyawan</a>
<form action="/education/save_education_id" method="post">
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
        <label for="" class="d-inline">Nama Sekolah</label>
        <input type="text" class="form-control" value="" name="education_name">
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Jenis Pendidikan</label>
        <select name="education_type" id="" class="form-control">
            <option value="">Pilih</option>
           
            <option value="1">SD</option>
            <option value="2">SMP</option>
            <option value="3">SMA</option>
            <option value="4">STRATA 1</option>
           
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Alamat Sekolah</label>
        <input type="text" class="form-control d-inline" value="" name="education_address">
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Jurusan</label>
        <input type="text" class="form-control d-inline" value="" name="education_major">
        </div>

        <div class="col">
        <label for="" class="d-inline">Nilail / IPK</label>
        <input type="text" class="form-control d-inline" value="" name="ipk">
        </div>
        
    </div>
    <hr>
    <div class="row">
    <div class="col">
        <label for="" class="d-inline">Tahun Masuk</label>
        <input type="text" class="form-control d-inline" id="datepicker" value="" name="tahun_masuk">
        </div>
        <div class="col">
        <label for="" class="d-inline">Tahun Lulus</label>
        <input type="text" class="form-control d-inline" id="datepicker2" value="" name="tahun_lulus">
        </div>
        <div class="col">
        <label for="" class="d-inline">Biaya</label>
        <input type="text" class="form-control d-inline" value="" name="biaya">
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan1 as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="">Pilih</option>

            <?php foreach($karyawan1 as $kry) : ?>
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