<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Edit jabatan karyawan</b></h5>
        </div>

    <div class="card-body">
  
    <a href="/mst_join/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>




    <form action="/mst_position/update_position/<?= $mst_position['id'] ?>" method="post">
      <?= csrf_field() ?>
      <input type="text" name="id" value="<?= $mst_position['id'] ?>">
        <div class="row">
          <div class="col">
            <label for="">Nama Karyawan</label>
         <input type="text" class="form-control" value="<?= $mst_position['employee_name'] ?>" readonly>
         <input type="hidden" name="employee_id" value="<?= $mst_position['employee_id'] ?>">
          </div>
          <div class="col">
            <label for="">Jabatan</label>
            <select id="inputState"  class="form-control" name="position_id">
              <option value="<?= $mst_position['position_id'] ?>"><?= $mst_position['position_name']  ?></option>

              <?php foreach($position as $pos) : ?>
              <option value="<?= $pos['position_id'] ?>"><?= $pos['position_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="col">
            <label for="">SBU</label>
            <select id="inputState"  class="form-control" name="branch_id">
              <option value="<?= $mst_position['branch_id'] ?>"><?= $mst_position['branch_name']  ?></option>

              <?php foreach($branch as $br) : ?>
              <option value="<?= $br['branch_id'] ?>"><?= $br['branch_name'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>

          <div class="col">
              <label for="">Position date</label>
              <input type="date" class="form-control" name="position_date" value="<?= $mst_position['position_date'] ?>">
          </div>
        </div>
      <br>
        <button type="submit" class="btn btn-success"> <i class="fas fa-edit"></i>Ubah Data </button>

</form> 
    </div>

     </div>

</div>