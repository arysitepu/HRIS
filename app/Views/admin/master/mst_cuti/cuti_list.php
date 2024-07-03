<div class="container-fluid">
<div class="">
        <h3>Attendance</h3>
  </div>
  <?php if(session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('pesan') ?>
    </div>
    <?php endif; ?>
    <div class="card shadow mb-3 mt-3">
    

  <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

   

    <div class="card-body">
    <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <i class="fas fa-plus"></i> Add
    </button>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-outline-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="cuti_name" placeholder="search by name">
</form>


<div class="table-responsive">

              <table class="table table-bordered">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Cuti</th>
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">Potong Cuti</th>
                            <th scope="col">Maximal Cuti</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($mst_cuti as $cuti) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $cuti['cuti_name'] ?></td>
                            <td><?= $cuti['cuti_type'] ?></td>
                            <td><?= $cuti['potong_cuti'] ?></td>
                            <td><?= $cuti['qty_max'] ?> Hari</td>
                            <td>
                               
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-title="Edit" data-target="#edit<?= $cuti['cuti_id'] ?>"> <i class="fas fa-edit" ></i> </button>

                                <form action="/mst_cuti/<?= $cuti['cuti_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger" data-title="Hapus" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> </button>
                                </form>
                            </td>
                          </tr>
                        </tbody>
                        <?php endforeach; ?>

                        
          </table>
</div>

          <div class="">
                           <?= $pager->links('default', 'custom_pagination') ?>
                        </div>
<div class="">

<!-- add modal -->

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah jenis cuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/mst_cuti/save_cuti">
      <div class="modal-body">

            <div class="row">
                    <div class="col">
                        <label for="" class="d-inline">Nama Cuti</label>
                    <input type="text" class="form-control" name="cuti_name">
                    </div>

                    <div class="col">
                        <label for="" class="d-inline">Jenis Cuti</label>
                        <select name="cuti_type" class="form-control" id="">

                        <option value="">Pilih</option>
                            <option value="Cuti Tahunan">Cuti</option>
                            <option value="Absen Normal">Sakit</option>
                            <option value="Cuti Khusus">Cuti Khusus</option>
                            <option value="Mangkir">Absen Mangkir</option>
                            
                        </select>
                    <!-- <input type="text" class="form-control" name="cuti_type"> -->
                    </div>
                    <hr>
                    
            </div>

            <hr>

            <div class="row">
                    <div class="col">
                        <label for="" class="d-inline">Potong Cuti</label>
                    <input type="text" class="form-control" name="potong_cuti">
                    </div>

                    <div class="col">
                        <label for="" class="d-inline">Maxmimal Cuti</label>
                    <input type="text" class="form-control" name="qty_max">
                    </div>
                    <hr>
                    
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- batas -->

<!-- edit data -->

<?php foreach($mst_cuti as $cuti) : ?>
<div class="modal fade" id="edit<?= $cuti['cuti_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit data cuti</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/mst_cuti/update_cuti/<?= $cuti['cuti_id'] ?>">
      <div class="modal-body">

            <div class="row">
<input type="hidden" name="cuti_id" value="<?= $cuti['cuti_id'] ?>">
                    <div class="col">
                        <label for="" class="d-inline">Nama Cuti</label>
                    <input type="text" class="form-control" name="cuti_name" value="<?= $cuti['cuti_name'] ?>">
                    </div>

                    <div class="col">
                        <label for="" class="d-inline">Jenis Cuti</label>
                        <select name="cuti_type" class="form-control" id="">

                            <option value="">Pilih</option>
                                <option value="Cuti Tahunan">Cuti</option>
                                <option value="Absen Normal">Sakit</option>
                                <option value="Cuti Khusus">Cuti Khusus</option>
                                <option value="Mangkir">Absen Mangkir</option>
                                
                            </select>
                    </div>
                    <hr>
                    
            </div>

            <hr>

            <div class="row">
                    <div class="col">
                        <label for="" class="d-inline">Potong Cuti</label>
                    <input type="text" class="form-control" name="potong_cuti" value="<?= $cuti['potong_cuti'] ?>">
                    </div>

                    <div class="col">
                        <label for="" class="d-inline">Maxmimal Cuti</label>
                    <input type="text" class="form-control" name="qty_max" value="<?= $cuti['qty_max'] ?>">
                    </div>
                    <hr>
                    
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach ?>
<!-- batas -->
</div>

    </div>


    </div>
</div>

