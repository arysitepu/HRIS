<div class="container-fluid">

<div class="card shadow mb-4">
    <div class="card-body py-3">

    <?php 
    if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    

  <!-- sweet alert -->
<div class="swal" data-swal="<?= session()->get('pesan'); ?>"></div>

  <!-- batas sweet alert -->

  
  <a class="btn btn-info" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
   <i class="fas fa-plus"></i> Tambah Data
  </a>

  <div class="collapse col-md-12 mt-3" id="collapseExample">
  <div class="card card-body">


    <form action="/mst_join/save_join" method="post">
          <div class="row">
            <div class="col">
              <label for="">Nama Karyawan</label>
              <select id="inputState"  class="form-control" name="employee_id">
                <option value="">Pilih</option>
  
                <?php foreach($karyawan as $kry) : ?>
                <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col">
              <label for="">Join Start</label>
              <input type="date" class="form-control" name="join_start">
            </div>
            <div class="col">
              <label for="">End Join</label>
              <input type="date" class="form-control" name="join_end">
            </div>
          </div>
        <br>
          <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i>Simpan Data </button>
  
  </form> 

  </div>
  </div>

    <!-- <a href="" class="btn btn-success mb-3" >Tambah Jabatan</a> -->

    </div>

    <div class="card-header py-3">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Join karyawan</h6>
        </center>
    </div>
  
    <div class="card-body">
   
    <form action="" class="d-inline">
      <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
      <input class="form-control col-md-2 d-inline float-right" name="keyword">
    </form>
    
    
        <div class="table-responsive">

       
            <table class="table mt-3" id="dataTable" width="100%" cellspacing="0" >

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Karyawan</th>
                        <th>Start Join</th>
                        <th>End Join</th>
                        <th class="aksi" >Aksi</th>
                        
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                    <?php foreach ($join as $join) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $join['employee_name'] ?></td>
                        <td><?= $join['join_start'] ?></td>
                        <td><?= $join['join_end'] ?></td>
                        
                        <td class="aksi">
                        
                   
                        <a href="/mst_join/edit_join/<?= $join['id'] ?>" class="btn btn-success" ><i class="fas fa-edit"></i></a>

                        <form action="/mst_join/<?= $join['id'] ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.');" ><i class="fas fa-trash-alt"></i></button>

                        </form>
                        
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="">
           <?= $pager->links('default', 'custom_pagination') ?>
            </div>
        </div>
    </div>
</div>

</div>
