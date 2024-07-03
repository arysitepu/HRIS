<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Pendidikan</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/education/index/" class="btn btn-success mb-3 ml-3" >Kembali ke table</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nomor Dokumen </label>
        <input type="text" class="form-control d-inline text-center" value="<?= $education['trn_no'] ?>" readonly>
        </div>

        <div class="col">
        <label for="" class="d-inline">Tanggal Dokumen </label>
        <input type="text" class="form-control d-inline text-center" value="<?= $education['trn_date'] ?>" readonly>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <input type="text" class="form-control d-inline" value="<?= $education['employee_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama Sekolah</label>
        <input type="text" class="form-control" value="<?= $education['education_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Jenis Pendidikan</label>
        <input type="text" class="form-control d-inline" value="<?= ($education['education_type'] == '1') ? 'SD' : '' ?><?= ($education['education_type'] == '2') ? 'SMP' : '' ?><?= ($education['education_type'] == '3') ? 'SMA' : '' ?><?= ($education['education_type'] == '4') ? 'Strata1    ' : '' ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Alamat Sekolah</label>
        <input type="text" class="form-control d-inline" value="<?= $education['education_address'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Jurusan</label>
        <input type="text" class="form-control d-inline" value="<?= $education['education_major'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nilai/IPK</label>
        <input type="text" class="form-control d-inline" value="<?= $education['ipk'] ?>" readonly>
        </div>
        
    </div>
    <hr>
    <div class="row">
    <div class="col">
        <label for="" class="d-inline">Tahun Masuk</label>
        <input type="text" class="form-control d-inline" value="<?= $education['tahun_masuk'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tahun Lulus</label>
        <input type="text" class="form-control d-inline" value="<?= $education['tahun_lulus'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Biaya</label>
        <input type="text" class="form-control d-inline" value="<?= rupiah($education['biaya']) ?>" readonly>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <input type="text" class="form-control d-inline" value="<?= $education['buat_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <input type="text" class="form-control d-inline" value="<?= $education['setuju_name'] ?>" readonly>
        </div>
    </div>
    <hr>

    </div>

     </div>

</div>