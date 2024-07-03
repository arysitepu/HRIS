<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Detail Fasilitas</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/karyawan/detail/<?= $mst_jaminan['employee_id'] ?>" class="btn btn-success mb-3 ml-3" > <i class="fas fa-arrow-left"></i> Back </a>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Jenis Jaminan</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_jaminan['type_name'] ?>" readonly>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama Jaminan</label>
        <input type="text" class="form-control" value="<?= $mst_jaminan['jaminan_name'] ?>" readonly>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Deskripsi</label>
        <textarea type="text" class="form-control d-inline" value="" readonly> <?= $mst_jaminan['jaminan_desc'] ?> </textarea>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor doc</label>
        <input type="text" class="form-control d-inline" value="<?= $mst_jaminan['doc_no'] ?>" readonly>
        </div>
    </div>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tanggal Simpan</label>
        <input type="date" class="form-control d-inline" value="<?= $mst_jaminan['tanggal_simpan'] ?>" readonly> 
        </div>
        <div class="col">
        <label for="" class="d-inline">Tanggal Kembali</label>
        <input type="date" class="form-control d-inline" value="<?= $mst_jaminan['tanggal_kembali'] ?>" readonly>
        </div>
    </div>


    </div>

     </div>

</div>