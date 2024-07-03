<div class="container-fluid">
<div class="">
        <h3>Jabatan</h3>
    </div>
    <hr>
<form action="/position/save" method="post">
    <?=  csrf_field() ?>
      <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control col-md-6  <?= ($validation->hasError('position_name')) ? 'is-invalid' : ''; ?>" name="position_name"
                placeholder="Tambah jabatan">
                <button type="submit"  class="btn btn-outline-success" > <i class="fas fa-plus"></i> Add data</button>
            </div>
            <div id="" class="invalid-feedback">
            <?= $validation->getError('position_name') ?>
          </div>
        </div>
    </form>
    <?php 
    if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

<div class="card shadow mb-4">
<div class="swal" data-swal="<?= session()->get('pesan'); ?>"></div>
    
  
    <div class="card-body">
    <input type="text" class="form-control col-md-3 mb-3 float-sm-right" id="myInput" placeholder="Search">
        <div class="table-responsive">
            <table class="table" id="dataTable" width="100%" cellspacing="0" >

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Jabatan</th>
                        
                        <th class="aksi" >Aksi</th>
                        
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody id="myTable" >
                    <?php foreach ($position as $pos) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $pos['position_name'] ?></td>
                        
                        <td class="aksi">
                        
                        <!-- <a href="/position/edit/<?= $pos['position_id'] ?>" class="btn btn-primary" ><i class="fas fa-user-edit"></i></a> -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-title="Edit Data" data-target="#edit<?= $pos['position_id'] ?>"  ><i class="fas fa-user-edit"></i></button>

                        <form action="/position/<?= $pos['position_id'] ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-danger" data-title="Hapus Data" onclick="return confirm('apakah anda yakin?.');" ><i class="fas fa-trash-alt"></i></button>

                        </form>
                        
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="">
           
            </div>
        </div>
    </div>
</div>

</div>


<!-- Modal Edit-->
<?php foreach ($position as $pos) : ?>
<div class="modal fade" id="edit<?= $pos['position_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Jabatan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/position/update/<?= $pos['position_id'] ?>">
      <input type="hidden" name="position_id" value="<?= $pos['position_id'] ?>">
      <div class="modal-body">
          <div class="form-group mb-0">
              <label for=""></label>
              <input type="text" name="position_name" id="position_name" class="form-control" value="<?= $pos['position_name'] ?>">
          </div>
       <label for=""></label>

      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?php endforeach; ?>

<!-- batas edit modal -->

