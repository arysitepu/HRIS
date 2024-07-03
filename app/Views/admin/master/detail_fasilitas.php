<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Fasilitas</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $facility['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Jenis Fasilitas</label>
        <input type="text" class="form-control d-inline" value="<?= $facility['type_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama Fasilitas</label>
        <input type="text" class="form-control" value="<?= $facility['facility_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <input type="text" class="form-control d-inline" value="<?= $facility['facility_desc'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor asset</label>
        <input type="text" class="form-control d-inline" value="<?= $facility['facility_asset_no'] ?>" readonly>
        </div>
    </div>


    </div>

     </div>

</div>