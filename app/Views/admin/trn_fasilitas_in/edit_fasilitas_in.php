<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Tambah Data Fasilitas Kembali</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/fasilitas_in/index/" class="btn btn-success mb-3 ml-3" > <i class="fas fa-arrow-circle-alt-left"></i> Kembali ke table</a>
<form action="/fasilitas_in/update_fasilitas_in/<?= $fasilitas_in['trn_id'] ?>" method="post">
<?= csrf_field() ?>
<input type="hidden" name="trn_id" value="<?= $fasilitas_in['trn_id'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_in['trn_no'] ?>" name="trn_no">
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= $fasilitas_in['trn_date'] ?>" name="trn_date">
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="d-inline"> Tanggal Pinjam </label>
        <input type="date" class="form-control d-inline" value="<?= $fasilitas_in['tgl_pinjam'] ?>" name="tgl_pinjam">
        <div class="invalid-feedback">
           
        </div>
        </div>

        <div class="col">
        <label for="" class="d-inline"> Tanggal Kembali </label>
        <input type="date" class="form-control d-inline" value="<?= $fasilitas_in['tgl_kembali'] ?>" name="tgl_kembali">
        <div class="invalid-feedback">
           
        </div>
        </div>
        
    </div>
<hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">
            <option value="<?= $fasilitas_in['employee_id'] ?>"><?= $fasilitas_in['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $fasilitas_in['employee_id_buat'] ?>"><?= $fasilitas_in['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $fasilitas_in['employee_id_setuju'] ?>"><?= $fasilitas_in['setuju_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <hr>



    <button type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Ubah Data </button>
</form>

    </div>

     </div>

</div>