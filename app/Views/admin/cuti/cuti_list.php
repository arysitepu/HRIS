<div class="container-fluid">

<div class="mb-3">
  <h3>Attendance</h3>
</div>

<a class="btn btn-outline-primary mb-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
<i class="fas fa-filter"></i> Filter 
  </a>

  <a class="btn btn-outline-info mb-2" href="/trn_cuti/index">
<i class="fas fa-history"></i> Reset 
  </a>

  <br>

  <div class="collapse" id="collapseExample">

  <div class="card">
<div class="card-body">

      <!-- test -->
      <form action="">
        <div class="row">
            <div class="col">
              <?php if(session()->get('user_level') == "admin") : ?>
              <select name="sbu" id="" class="form-control">
                <option value="">Pilih SBU</option>
                <?php foreach($branch as $sbu) : ?>
                <option value="<?= $sbu['branch_id'] ?>"> <?= $sbu['branch_name'] ?> </option>
                <?php endforeach ?>
              </select>
              <?php endif ?>

              <?php if(session()->get('user_level') == 'user') : ?>
                <select name="sbu" id="" class="form-control">
                <option value="<?= $branch['branch_id'] ?>"> <?= $branch['branch_name'] ?> </option>
              </select>
              <?php endif ?>
            </div>

            <div class="col">
              <?php if(session()->get('user_level') == 'admin') : ?>
              <input type="text" class="form-control" name="keyword" placeholder="Search Name">
              <?php endif ?>

              <?php if(session()->get('user_level') == 'user') : ?>
                <select name="keyword" id="" class="form-control">
                <option value="">Pilih karyawan</option>
                <?php foreach($employees as $employee) : ?>
                <option value="<?= $employee['employee_id'] ?>"> <?= $employee['employee_name'] ?> </option>
                <?php endforeach ?>
                </select>
              <?php endif ?>

            </div>

            <div class="col">
            <select name="cuti_id" id="" class="form-control">
                <option value="">Pilih Cuti</option>
                <?php foreach($mst_cuti as $master_cuti) : ?>
                <option value="<?= $master_cuti['cuti_id'] ?>"> <?= $master_cuti['cuti_name'] ?> </option>
                <?php endforeach ?>
              </select>
            </div>
        </div>
        <hr>
      <div class="row">
        <div class="col">
          <label for="">Dari bulan</label>
          <input type="month" class="form-control" name="awal_bulan">
        </div>
        <div class="col">
          <label for="">Sampai Dengan</label>
          <input type="month" class="form-control" name="akhir_bulan">
        </div>

      </div>
      <div class="row mt-2">
        <div class="col">
          <button type="submit" class="btn btn-outline-success"> <i class="fas fa-search"></i>Cari </button>
        </div>
      </div>
      
    </form>
      <!-- batas -->

  
</div>
  </div>

  </div>
<br>
  <div class="alert alert-warning">
      Mohon Untuk <strong class="text-danger">Generate</strong>  data karyawan setelah melakukan penambahan data
      dengan cara masuk ke detail cuti click tanggal lalu generate.
     
  </div>
<br>
<?php if(session()->getFlashdata('pesan')) : ?>

  <div class="alert alert-success">
    <?= session()->getFlashdata('pesan') ?>
  </div>

  <?php endif; ?>
    <div class="card shadow mb-4">
    

  <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card-body">
      <a href="/trn_cuti/add_cuti_start/" class="btn btn-outline-success mb-3"> <i class="fas fa-plus"></i> Add </a>
      <!-- <a href="/report/report_cuti/" class="btn btn-success mb-3"> <i class="fas fa-table"></i> Report Bulanan</a> -->
      <a href="/report/report_cuti_tahun/" class="btn btn-outline-success mb-3"> <i class="fas fa-file"></i> Report</a>

<?php if(session()->get('user_level') == 'admin') : ?>
<?php if($jumlah_cuti != 0) : ?>
<div class="alert alert-success">
 Jumlah transaksi: <?= $jumlah_cuti; ?>
</div>
<?php endif ?>
<?php endif ?>

<?php if(session()->get('user_level') == 'user') : ?>
<?php if($jumlah_cuti != 0) : ?>
<div class="alert alert-primary">
 Jumlah transaksi: <?= $jumlah_cuti; ?>
</div>
<?php endif ?>
<?php endif ?>



<div class="table-responsive">
              <table class="table table-bordered">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Posisi</th>
                            <th scope="col">SBU</th>
                            <th scope="col">Jenis Cuti</th>
                            <th scope="col">Start</th>
                            <th scope="col">Until</th>
                            <th scope="col">Cuti Diambil</th>
                            <th scope="col">Hak Cuti</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($cuti as $ct) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $ct['employee_name'] ?></td>
                            <td><?= $ct['position_name'] ?></td>
                            <td><?= $ct['branch_name'] ?></td>
                            <td><?= $ct['cuti_name'] ?></td>
                            <td><?= date("d-m-Y", strtotime($ct['tgl_dari'])) ?></td>
                            <td><?= date("d-m-Y",strtotime($ct['tgl_sampai'])) ?></td>
                            <td><?= $ct['cuti_jumlah'] ?></td>
                            <td><?= $ct['hak_cuti'] ?></td> 
                           
                            <td class="">
                                <div class="dropdown">
                                  <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                   Action
                                  </button>
                                  <div class="dropdown-menu">
                                  <a href="/trn_cuti/detail_cuti/<?= $ct['trn_id'] ?>" class="dropdown-item"> <i class="fas fa-info-circle"></i> Detail </a>
                                  <a href="/trn_cuti/edit_cuti/<?= $ct['trn_id'] ?>" class="dropdown-item"> <i class="fas fa-edit"></i> Edit </a>
                                  <form action="/trn_cuti/<?= $ct['trn_id'] ?>" class="d-inline" method="post">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> Delete </button>
                                  </form>
                                  </div>
                                </div>

                                <!-- <a href="/trn_cuti/print_cuti/<?= $ct['trn_id'] ?>" class="btn btn-danger btn-sm" title="Print"><i class="fas fa-print"></i></a> -->
                            </td>
                          </tr>
                        </tbody>
                        <?php endforeach; ?>
          </table>
</div>

<div class="">
  <?= $pager->links('default', 'custom_pagination') ?>
</div>





    </div>


    </div>
</div>
