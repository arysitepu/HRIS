<div class="container-fluid">



    <div class="card shadow mb-4">

    <?php if(session()->getFlashdata('pesan')) : ?>

      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>

      <?php endif; ?>

  <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card-header text-center">
        <h5>List Cuti Karyawan</h5>
    </div>

    <div class="card-body">
      <!-- <a href="/trn_cuti/add_cuti/" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a> -->

      <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#tambah"> <i class="fas fa-plus" ></i>Tambah data </button>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword" placeholder="search by name">
</form>



              <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Hak Cuti</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($cuti_period as $cp) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $cp['employee_name'] ?></td>
                            <td><?= $cp['cuti_qty'] ?></td>
                            <td>
                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#detail<?= $cp['trn_id'] ?>"> <i class="fas fa-search" ></i> </button>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#edit<?= $cp['trn_id'] ?>"> <i class="fas fa-edit" ></i> </button>

                                  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $cp['trn_id'] ?>" > <i class="fas fa-trash-alt" ></i> </button>
                            </td>
                          </tr>
                        </tbody>
                        <?php endforeach; ?>
          </table>
<div class="">

</div>

    </div>

<!-- detail data -->

<?php foreach($cuti_period as $cp) : ?>

<div class="modal fade" id="detail<?= $cp['trn_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Detail Periode</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
  
    <div class="modal-body col-md-12">

    
    <div class="row">
          <div class="col">
            <label for="">Nama Karyawan</label>
            <input type="text" class="form-control" value="<?= $cp['employee_name'] ?>" readonly>
          </div>
          <div class="col">
            <label for="">Hak Cuti</label>
            <input type="text" class="form-control" value="<?= $cp['cuti_qty'] ?>" readonly>
          </div>
        </div>

    </div>
    
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
     
    </div>
  </div>
</div>
</div>

<?php endforeach ?>

<!-- batas detail data -->

<!-- tambah data -->

<div class="modal fade" id="tambah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Tambah data</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <form action="/trncuti_period/save_period">

        <div class="modal-body col-md-12">
    
        
        <div class="row">
              <div class="col">
                <label for="">Nama Karyawan</label>
                <select name="employee_id" id="" class="form-control<?= ($validation->hasError('empployee_id')) ? 'is-invalid' : '' ?>">
                    <option value="">Pilih</option>
    
                    <?php foreach($karyawan as $kry) : ?>
                    <option value="<?= $kry['employee_id'] ?>" ><?= $kry['employee_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('employee_id') ?>
                </div>
              </div>

              <div class="col">
                <label for="">Periode</label>
                <input type="text" id="datepicker" class="form-control" value="" name="periode">
              </div>
              
              <div class="col">
                <label for="">Hak Cuti</label>
                <input type="text" class="form-control" value="" name="cuti_qty">
              </div>

            </div>

            
    
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan data</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
    </form>
  

<!-- batas tambah data -->

<!-- edit data -->
<?php foreach($cuti_period as $cp) : ?>
<div class="modal fade" id="edit<?= $cp['trn_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Edit data</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <form action="/trncuti_period/update_period/<?= $cp['trn_id'] ?>">

        <div class="modal-body col-md-12">
    
        
        <div class="row">
              <div class="col">
                <label for="">Nama Karyawan</label>
                <input type="hidden" name="trn_id" value="<?= $cp['trn_id'] ?>">
                <select name="employee_id" id="" class="form-control<?= ($validation->hasError('empployee_id')) ? 'is-invalid' : '' ?>">
                    <option value="<?= $cp['employee_id'] ?>"><?= $cp['employee_name'] ?></option>
    
                    <?php foreach($karyawan as $kry) : ?>
                    <option value="<?= $kry['employee_id'] ?>" ><?= $kry['employee_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('employee_id') ?>
                </div>
              </div>
              
              <div class="col">
                <label for="">Hak Cuti</label>
                <input type="text" class="form-control" name="cuti_qty" value="<?= $cp['cuti_qty'] ?>">
              </div>

            </div>

            <hr>
            <div class="row">
            <div class="col">
                <label for="">Periode</label>
                <input type="text" id="" class="form-control" name="periode" value="<?=$cp['periode'] ?>">
              </div>
            </div>

            
    
        </div>
        
        <div class="modal-footer">
            <button type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Ubah data</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
    </form>

    <?php endforeach ?>

<!-- batas edit data -->

<!-- modal hapus data -->
<?php foreach($cuti_period as $cp) : ?>
<div class="modal fade" id="delete<?= $cp['trn_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Hapus data</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    
    <form action="/trncuti_period/update_period/<?= $cp['trn_id'] ?>">

        <div class="modal-body col-md-12">

        <h5>Yakin mau di hapus</h5>

        </div>
        
        <div class="modal-footer">
   <a href="/trncuti_period/delete_period/<?= $cp['trn_id'] ?>" class="btn btn-danger"> <i class="fas fa-trash-alt" ></i> Hapus </a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
    </div>
    </form>

    <?php endforeach ?>

<!-- batas modal hapus -->

    </div>
</div>

