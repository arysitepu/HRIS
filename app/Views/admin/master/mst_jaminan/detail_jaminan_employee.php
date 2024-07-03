<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail jaminan</b></h5>
        </div>

    <div class="card-body">
    <a href="/mst_jaminan/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_jaminan['employee_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tipe jaminan</label>
        <input type="text" class="form-control" value="<?= $mst_jaminan['type_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama jaminan</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_jaminan['jaminan_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_jaminan['jaminan_desc'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nomor jaminan asset</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_jaminan['doc_no'] ?>" readonly>
        </div>
        <hr>

        <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tanggal simpan</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_jaminan['tanggal_simpan'] ?>" readonly>
        </div>
        <hr>

        
        <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tanggal Kembali</label>
        <input type="text" class="form-control d-inline text-center" value="<?= $mst_jaminan['tanggal_kembali'] ?>" readonly>
        </div>
        <hr>
    

    </div>

     </div>

</div>