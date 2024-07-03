<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Pendidikan</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $education['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tingkat pendidikan</label>
        <input type="text" class="form-control d-inline" value="<?= ($education['education_type'] == '1') ? 'SD' :'' ?><?= ($education['education_type'] == '2') ? 'SMP' :'' ?><?= ($education['education_type'] == '3') ? 'SMA' :'' ?><?= ($education['education_type'] == '4') ? 'STRATA 1' :'' ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama Sekolah</label>
        <input type="text" class="form-control" value="<?= $education['education_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Alamat Sekolah</label>
        <input type="text" class="form-control d-inline" value="<?= $education['education_address'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Jurusan</label>
        <input type="text" class="form-control d-inline" value="<?= $education['education_major'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nilai</label>
        <input type="text" class="form-control d-inline" value="<?= $education['ipk'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tahun Masuk</label>
        <input type="text" class="form-control" value="<?= $education['tahun_masuk'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tahun Lulus</label>
        <input type="text" class="form-control d-inline" value="<?= $education['tahun_lulus'] ?>" readonly>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Biaya Oleh</label>
        <input type="text" class="form-control d-inline text-center" value="<?= rupiah($education['biaya']) ?>" readonly>
        </div>
      
    </div>
<hr>


    </div>

     </div>

</div>