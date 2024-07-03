<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Edit Join karyawan</b></h5>
        </div>

    <div class="card-body">
  
    <a href="/mst_join/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>




<form action="/mst_join/update_join/<?= $join['id'] ?>" method="post">
<input type="hidden" value="<?= $join['id'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
         <input type="text" class="form-control" value="<?= $join['employee_name'] ?>" readonly>
         <input type="hidden" class="form-control" value="<?= $join['employee_id'] ?>" name="employee_id">
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tanggal Masuk</label>
        <input type="date" class="form-control d-inline" value="<?= $join['join_start'] ?>" name="join_start">
        </div>
        <div class="col">
        <label for="" class="d-inline">Tanggal Keluar</label>
        <input type="date" class="form-control d-inline" value="<?= $join['join_end'] ?>" name="join_end">
        </div>
    </div>
    <hr>

    <button type="submti" class="btn btn-info" > <i class="fas fa-edit"></i> Ubah data </button>
</form>
    </div>

     </div>

</div>