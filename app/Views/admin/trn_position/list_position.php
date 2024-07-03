<div class="container-fluid">

  <div class="mb-3">
    <h3>Mutasi Jabatan</h3>
  </div>

  <button class="btn btn-outline-primary mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-filter"></i> Filter
  </button>

  <div class="collapse" id="collapseExample">
  <div class="card card-body mb-3">
  <form action="" class="" method="get">
   <div class="row">
    <div class="col">
    <input class="form-control" name="keyword" placeholder="Search by name">
    </div>
    <div class="col">
      <select name="branch_id" id="" class="form-control">
        <option value="">Silahkan pilih SBU</option>
        <?php foreach($branch_id as $sbu) : ?>
          <option value="<?= $sbu['branch_id'] ?>"> <?= $sbu['branch_name'] ?> </option>
        <?php endforeach; ?>
      </select>
    </div>
   </div>
    <hr>
   <div class="row">
    <div class="col">
    <button type="submit" class="btn btn-outline-success" > <i class="fas fa-search" ></i> Search </button>
    </div>
   </div>
  </form>
  </div>
</div>

<?php if(session()->getFlashdata('pesan')) : ?>

<div class="alert alert-success" role="alert">
    <?= session()->getFlashdata('pesan') ?>
</div>

<?php endif; ?>

    <div class="card shadow mb-4">

    <!-- <?php if(session()->getFlashdata('pesan')) : ?>

      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>

      <?php endif; ?> -->

  <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

  <div class="card-body">
      <a href="/trn_position/add_position/" class="btn btn-outline-success mb-3"> <i class="fas fa-plus"></i> Add </a>

              <table class="table">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nomor Komputer</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">SBU Sekarang</th>
                            <th scope="col">SBU Lama</th>
                            <th scope="col">Posisi sekarang</th>
                            <th scope="col">Posisi Sebelumnya</th>
                            <th scope="col">STATUS</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($position as $pos) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $pos['trn_no'] ?></td>
                            <td><?= $pos['employee_name'] ?></td>
                            <td><?= $pos['branch_name'] ?></td>
                            <td><?= $pos['branch_name_old'] ?></td>
                            <td> <?= $pos['position_name'] ?></td>
                            <td><?= $pos['position_name_old'] ?></td>
                            <td><?= ($pos['posting'] == 1) ? '<span class="badge badge-success">Posting</span>' : '<span class="badge badge-danger">Belum di posting</span>' ?></td>
                            <td>
                               
                                
                                <?php if($pos['posting'] == 1){ ?>

                                  <div class="dropdown">
                                    <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu">
                                    <!-- <form action="/trn_position/unpost_position/<?= $pos['trn_id'] ?>">
                                    <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-ban"></i> Unpost </button>
                                    </form> -->
                                    <a href="/trn_position/detail_position/<?= $pos['trn_id'] ?>"class="dropdown-item"> <i class="fas fa-search" ></i> Detail </a>
                                    </div>
                                  </div>

                                  
                                  <?php }else{ ?>

                                    <div class="dropdown">
                                    <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu">
                                      <a href="/trn_position/detail_position/<?= $pos['trn_id'] ?>"class="dropdown-item"> <i class="fas fa-search" ></i> Detail </a>
                                    <a href="/trn_position/edit_position/<?= $pos['trn_id'] ?>" class="dropdown-item"> <i class="fas fa-edit"></i> Edit </a>
                                    <form action="/trn_position/<?= $pos['trn_id'] ?>" class="d-inline" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                      <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> Hapus </button>
                                    </form>

                                    <form action="/trn_position/post_position/<?= $pos['trn_id'] ?>" method="post">
                                    <input type="hidden" name="trn_id" value="<?= $pos['trn_id'] ?>">
                                    <input type="hidden" name="employee_id" value="<?= $pos['employee_id'] ?>">
                                    <input type="hidden" name="branch_id" value="<?= $pos['branch_id'] ?>">
                                    <input type="hidden" name="position_id" value="<?= $pos['position_id'] ?>">
                                    <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-check-circle"></i> Posting </button>
                                  </form>

                                    </div>
                                  </div>
                                
                                <?php } ?>
                            </td>
                          </tr>
                        </tbody>
                        <?php endforeach; ?>
          </table>
<div class="">
<?= $pager->links('default', 'custom_pagination') ?>
</div>

    </div>

    </div>
</div>