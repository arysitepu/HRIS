<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h3>Detail Karyawan</h3>
        <a href="/karyawan/index" class="btn btn-outline-success mb-3"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>

<div class="card">
    <div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
            <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal">
                <img class="avatar" width="150px" src="/img/<?= $karyawan['gambar'] ?>">
            </button>
            </div>
        </div>
        <div class="col-md-6 border-right">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-right">Profile</h4>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Nama Lengkap</b> </label></div>
                    <div class="col-md-6"><label class="labels"><?= $karyawan['employee_name'] ?></label></div>
                </div>
    
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Nama Panggilan</b> </label></div>
                    <div class="col-md-6"><label class="labels"><?= $karyawan['employee_nickname'] ?></label></div>
                </div>
              
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>NIK</b> </label></div>
                    <div class="col-md-6"><label class="labels"><?= $karyawan['nik'] ?></label></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Jabatan</b> </label></div>
                    <div class="col-md-6"><label class="labels">  <?= ($karyawan['position_name_trn'] == null) ? $karyawan['position_name'] : $karyawan['position_name_trn'] ?></label></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>SBU</b> </label></div>
                    <div class="col-md-6"><label class="labels">  <?= $karyawan['branch_name'] ?></label></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Jenis Kelamin</b> </label></div>
                    <div class="col-md-6"><label class="labels">  <?= ($karyawan['jenis_kelamin'] == 'L') ? 'Laki - Laki' :'' ?>
                      <?= ($karyawan['jenis_kelamin'] == 'P') ? 'Perempuan' :'' ?></label></div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Status</b> </label></div>
                    <div class="col-md-6"><label class="labels">  
                        <?= ($karyawan['employee_status'] == 0) ? 'None' : '' ?>
                        <?= ($karyawan['employee_status'] == 1) ? 'Percobaan' : '' ?>
                        <?= ($karyawan['employee_status'] == 2) ? 'Karyawan Tetap' : '' ?>
                        <?= ($karyawan['employee_status'] == 3) ? 'Resign' : '' ?>
                        <?= ($karyawan['employee_status'] == 4) ? 'PHK' : '' ?>
                        <?= ($karyawan['employee_status'] == 5) ? 'Pensiun' : '' ?>
                    </label>
                </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Hak Cuti</b> </label></div>
                    <div class="col-md-6"><label class="labels">  
                        <?= $karyawan['hak_cuti'] ?>
                    </label>
                </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Sisa cuti</b> </label></div>
                    <div class="col-md-6"><label class="labels">  
                        <?php
                         $sisa_cuti =$karyawan['hak_cuti'] -  $cuti_jumlah['cuti_jumlah'];
                         
                         echo $sisa_cuti;
                         ?>
                    </label>
                </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Tanggal Lahir</b> </label></div>
                    <div class="col-md-6"><label class="labels">  
                       <?= $karyawan['lahir_tanggal'] ?>
                    </label>
                </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Tanggal masuk</b> </label></div>
                    <div class="col-md-6"><label class="labels">  
                       <?= $karyawan['tanggal_masuk'] ?>
                    </label>
                </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-6"><label class="labels"> <b>Tanggal Keluar</b> </label></div>
                    <div class="col-md-6"><label class="labels">  
                       <?= $karyawan['tanggal_keluar'] ?>
                    </label>
                </div>
                </div>

                
            </div>

            <div class="card-body">
            <a href="/karyawan/detail_karyawan_pribadi/<?= $karyawan['employee_id'] ?>" class="btn btn-info"> <i class="fas fa-search"></i> Pribadi </a>
        
        <a href="/karyawan/detail_karyawan_kantor/<?= $karyawan['employee_id'] ?>" class="btn btn-info"> <i class="fas fa-search"></i> Kantor </a>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>
</div>

<!-- modal foto karyawan -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Your Photo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <img class="" src="/img/<?= $karyawan['gambar'] ?>" style="width: 28.9em;">
      </div>
    </div>
  </div>
</div>
<!-- batas -->
</div>