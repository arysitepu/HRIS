<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Fasilitas</b></h5>
        </div>

    <div class="card-body">
    <a href="/fasilitas_karyawan/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas['employee_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tipe Fasilitas</label>
        <input type="text" class="form-control" value="<?= $fasilitas['type_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Fasilitas</label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas['facility_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas['facility_desc'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nomor fasilitas asset</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $fasilitas['facility_asset_no'] ?>" readonly>
        </div>
    

    </div>

     </div>

</div>