<div class="container-fluid">

<h3>List Karyawan</h3>

<div class="mt-3">
<button class="btn btn-outline-primary mb-3" type="button" data-toggle="collapse" data-target="#filterKaryawan" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-filter"> </i> Filter
</button>

<?php if(session()->get('user_level') == 'user') : ?>
  <a href="/report/report_karyawan_user" class="btn btn-outline-danger mb-3">
    <i class="fas fa-print"> </i> Report Employee
  </a>
  <?php endif ?>

  <?php if(session()->get('user_level') == 'admin') : ?>
  <a href="/report/report_karyawan" class="btn btn-outline-danger mb-3">
    <i class="fas fa-print"> </i> Report Employee
  </a>
  <?php endif ?>
</div>



  <div class="collapse" id="filterKaryawan">
  <div class="card card-body mb-3">
<?php if(session()->get('user_level') == 'admin'){ ?>
  <form action="" method="get" class="d-inline">

  <div class="row">
    <div class="col">
      <input type="text" class="form-control" placeholder="Nama Karyawan" name="keyword">
    </div>
    <div class="col">

    <select name="sbu" id="" class="theSelect" style="width: 100%;">
            <option value="">Pilih Sbu</option>

            <?php foreach($branch as $sbu): ?>
                <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
            <?php endforeach ?>
    </select>
      <!-- <input type="text" class="form-control" placeholder="SBU" name="sbu"> -->
    </div>
  </div>
<br>
  <div class="row">
    <div class="col">
    <select name="status" id="" class="form-control">
            <option value="2">Status</option>
            <option value="1">Probation</option>
            <option value="2">Tetap</option>
            <option value="3">Resign</option>
            <option value="4">PHK</option>
    </select>
    </div>
  </div>

  <div class="row">
<div class="col">

    <button type="submit"  class="btn btn-outline-success mt-3"> <i class="fas fa-search"></i> Cari </button>
</div>
  </div>

  
</form>

<?php }elseif(session()->get('user_level') == 'user'){ ?>
  <form action="" method="get" class="d-inline">

<div class="row">
  <div class="col">
    <input type="text" class="form-control" placeholder="Nama Karyawan" name="keyword">
  </div>
  <div class="col">
  <select name="status" id="" class="form-control">
          <option value="">Status</option>
          <option value="1">Probation</option>
          <option value="2">Tetap</option>
          <option value="3">Resign</option>
          <option value="4">PHK</option>
  </select>
  </div>
</div>

<div class="row">
<div class="col">

  <button type="submit"  class="btn btn-outline-success mt-3"> <i class="fas fa-search"></i> Cari </button>
</div>
</div>


</form>
  <?php } ?>

   </div>
</div>

<div class="card shadow mb-4">

   

    <?php 
    if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>

    

  <!-- sweet alert -->
<div class="swal" data-swal="<?= session()->get('pesan'); ?>"></div>

  <!-- batas sweet alert -->
  
    <div class="card-body">
    <a href="/karyawan/add" class="btn btn-outline-success d-inline" > <i  class="fas fa-plus"></i> Add</a>
    <!-- <input type="text" id="myInput" class="form-control col-md-2 d-inline float-right" placeholder="Search"> -->
        <div class="table-responsive mt-3">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0" >

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama lengkap</th>
                        <th>Jabatan</th>
                        <th>SBU</th>
                        <th>Tanggal Masuk</th>
                        <th>Tanggal Keluar</th>
                        <th>Status</th>
                        <th>Masa kerja</th>
                       
                        <th class="aksi text-center" style="width: 20% ;" >Aksi</th>
                        
                    </tr>
                </thead>
                <div class="alert alert-success">
                   Total Karyawan: <span class="text-bold"><?= $jumlah_karyawan ?> </span>
                </div>
                </div>
                <tbody id="myTable">
                    <?php foreach ($karyawan as $kry) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $kry['employee_name'] ?></td>
                        <td><?= (isset($kry['position_name'])) ? $kry['position_name'] : 'None'  ?></td>
                       
                        <td><?= $kry['branch_name'] ?></td>
                        <td><?= ($kry['tanggal_masuk'] == null) ? '' : date( "d-m-Y", strtotime($kry['tanggal_masuk'])) ?></td>
                        <td><?= $kry['tanggal_keluar']?></td>
                        <td>
                            <?= ($kry['employee_status'] == 0) ? 'None' :'' ?>
                            <?= ($kry['employee_status'] == 1) ? '<h6><span class="badge badge-primary">Probation</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 2) ? '<h6><span class="badge badge-success">Tetap</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 3) ? '<h6><span class="badge badge-warning">Resign</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 4) ? '<h6><span class="badge badge-danger">Phk</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 5) ? '<h6><span class="badge badge-dark">Pensiun</span></h6>' :'' ?>
                        </td>
                        <td><?php 
                
                        
                            $awal = new DateTime($kry['tanggal_masuk']);
                            $akhir = new DateTime(($kry['tanggal_keluar']) ?? '');
                            $akhir1 = date_create();
                            
                            if($kry['tanggal_keluar'] != null){

                                $jarak = $akhir->diff($awal);
                                echo $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan";
                            }else{
                                $jarak = $akhir1->diff($awal);
                                echo $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan";
                            }

                           
                
                            // $diff = date_diff(date_create($kry['tanggal_masuk']), date_create());
                            // echo $diff->format('%Y Thn %m Bln');
                            
                            ?>

                            
                        </td>
                       
                       
                     
                        
                        <td class="aksi text-center">
                        <a href="/karyawan/detail/<?= $kry['employee_id'] ?>" class="btn btn-outline-success" data-title="Detail" > <i class="fas fa-id-card"></i> </a>
                        <a href="/karyawan/edit/<?= $kry['employee_id'] ?>" class="btn btn-outline-primary" data-title="Edit" ><i class="fas fa-user-edit"></i></a>

                        <form action="/karyawan/<?= $kry['employee_id'] ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" class="btn btn-outline-danger" data-title="Hapus" onclick="return confirm('apakah anda yakin?.');" ><i class="fas fa-trash-alt"></i></button>

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
<script type="text/javascript">
       $(".theSelect").select2();
     </script>
</div>