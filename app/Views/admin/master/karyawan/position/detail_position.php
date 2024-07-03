<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Position</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $position['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nomor Dokumen </label>
        <input type="text" class="form-control d-inline text-center" value="<?= $position['trn_no'] ?>" readonly>
        </div>

        <div class="col">
        <label for="" class="d-inline">Tanggal Dokumen </label>
        <input type="text" class="form-control d-inline text-center" value="<?= $position['trn_date'] ?>" readonly>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <input type="text" class="form-control d-inline" value="<?= $position['employee_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Posisi sekarang</label>
        <input type="text" class="form-control" value="<?= $position['position_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Posisi Sebelumnya</label>
        <input type="text" class="form-control d-inline" value="<?= $position['position_name_old'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">SBU Sekarang</label>
        <input type="text" class="form-control d-inline" value="<?= $position['branch_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">SBU Sebelumnya</label>
        <input type="text" class="form-control d-inline" value="<?= $position['branch_name_old'] ?>" readonly>
        </div>

    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Start Position</label>
        <input type="text" class="form-control d-inline" value="<?= $position['position_start'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Start Position Old</label>
        <input type="text" class="form-control d-inline" value="<?= $position['position_start_old'] ?>" readonly>
        </div>
        
    </div>
<hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <input type="text" class="form-control d-inline" value="<?= $position['buat_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <input type="text" class="form-control d-inline" value="<?= $position['setuju_name'] ?>" readonly>
        </div>
    </div>
    <hr>

    </div>

     </div>

</div>