<div class="container-fluid">


<button class="btn btn-primary mb-3" type="button" data-toggle="collapse" data-target="#filterKaryawan" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-filter"> Filter</i>
  </button>

  <a href="/karyawan/cetak_karyawan" class="btn btn-success mb-3">
    <i class="fas fa-print"> print</i>
  </a>

  <a href="/karyawan/index" class="btn btn-success mb-3">
    <i class="fas fa-table"> back table</i>
  </a>


  <div class="collapse" id="filterKaryawan">
  <div class="card card-body">

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

    <button type="submit"  class="btn btn-success mt-3"> <i class="fas fa-search"></i> Cari </button>
</div>
  </div>
</form>

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

 
    


    <div class="card-header py-3">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Karyawan</h6>
        </center>
    </div>
  
    <div class="card-body">
    <a href="/karyawan/add" class="btn btn-success d-inline" > <i  class="fas fa-plus"></i> Tambah Karyawan</a>
    <!-- <input type="text" id="myInput" class="form-control col-md-2 d-inline float-right" placeholder="Search"> -->
        <div class="table-responsive mt-3">
            <table class="table table-bordered " id="dataTable" width="100%" cellspacing="0" style="width: 150%">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama lengkap</th>
                        <th>Nama Panggilan</th>
                        <th>Jabatan</th>
                        <th>SBU</th>
                        <th>Tanggal Masuk</th>
                        <th>Jenis kelamin</th>
                        <th>Foto diri</th>
                        <th>Tanggal Lahir</th>
                        <th>Alamat</th>
                        <th>Handphone</th>
                        <th>No KTP</th>
                        <th>Tanggal Keluar</th>
                        <th>Status</th>
                        <th>Masa kerja</th>

                    
                        
                    </tr>
                </thead>
                <div class="alert alert-success">
                   Total Karyawan: <span class="text-bold"><?= $jumlah_karyawan ?> (aktif)</span>
                </div>
                </div>
                <tbody id="myTable">
                    <?php $nomor =1; ?>
                    <?php foreach ($karyawan as $kry) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $kry['employee_name'] ?></td>
                        <td><?= $kry['employee_nickname'] ?></td>
                        <td><?= (isset($kry['position_name'])) ? $kry['position_name'] : 'None'  ?></td>
                       
                        <td><?= $kry['branch_name'] ?></td>
                        <td><?= ($kry['tanggal_masuk'] == null) ? '' : date( "d-m-Y", strtotime($kry['tanggal_masuk'])) ?></td>
                        <td><?= $kry['jenis_kelamin'] ?></td>
                        <td class="text-center"> <img style="width: 50px;" src="/img/<?= $kry['gambar'] ?>" alt=""> </td>
                        <td><?= $kry['lahir_tanggal'] ?></td>
                        <td><?= $kry['alamat_ktp'] ?></td>
                        <td><?= $kry['no_tlp'] ?></td>
                        <td> <?= $kry['no_ktp'] ?></td>
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
                       
                       
                     
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

         
        </div>
    </div>
</div>

</div>