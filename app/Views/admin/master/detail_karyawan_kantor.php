<div class="container-fluid">

<a href="/karyawan/detail/<?= $karyawan['employee_id'] ?>" class="btn btn-outline-success mb-3"><i class="fas fa-arrow-left"></i> Back detail</a>
<h3 class="">Data ATL <?= $karyawan['employee_name'] ?></h3>
<div class="container rounded mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 border-right">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5"><img class="avatar" width="150px" src="/img/<?= $karyawan['gambar'] ?>"></div>
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

              
         
        </div>
    </div>
    </div>

</div>

<div class="tab bg-success">
<button class="tablinks" onclick="detailKaryawan(event, 'Detail')">Detail Kantor</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Angkat')">Pengangkatan</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Fasilitas')">Fasilitas</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Jaminan')">Jaminan</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Position')">Mutasi Jabatan</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Achievement')">Achievement</button>
</div>

<div id="Detail" class="tabcontent">

            <div class="card-header">

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>No KTP</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['no_ktp'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>No Kartu Keluarga</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['no_kk'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>No BPJS Ketenagakerjaan</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['no_bpjs_tk'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>No NPWP</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['no_npwp'] ?></label>
                        </div>
            </div>
            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Status Rumah</b> </label></div>
                        <div class="col-md-6"><label class="labels"> 
                  <?= ($karyawan['status_rumah'] == '1') ? 'Milik Sendiri' :'' ?>
                  <?= ($karyawan['status_rumah'] == '2') ? 'Sewa' :'' ?>
                  <?= ($karyawan['status_rumah'] == '3') ? 'Keluarga' :'' ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Status Pernikahan</b> </label></div>
                        <div class="col-md-6"><label class="labels"> <?= ($karyawan['status_nikah'] == '1') ? 'Lajang' : '' ?>
                  <?= ($karyawan['status_nikah'] == '2') ? 'Menikah' : '' ?>
                  <?= ($karyawan['status_nikah'] == '3') ? 'Bertunangan' : '' ?>
                  <?= ($karyawan['status_nikah'] == '4') ? 'Suami/Istri Meninggal' : '' ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Etnis</b> </label></div>
                        <div class="col-md-6"><label class="labels">  <?= $karyawan['etnis'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Agama</b> </label></div>
                        <div class="col-md-6"><label class="labels">  <?= $karyawan['agama'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Golongan Darah</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['gol_darah'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Nomor Telephone</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['no_tlp'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Nomor Telephone 2</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['no_tlp2'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Email Pribadi</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['email_pribadi'] ?></label>
                        </div>
            </div>

</div>
</div>

<div id="Fasilitas" class="tabcontent">

<div class="card-header">
    <h3>List fasilitas <?= $karyawan['employee_name'] ?></h3>
</div>

<table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Jenis Fasilitas</th>
                                  <th scope="col">Nama Fasilitas</th>
                                  <th scope="col">Deskripsi</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($fasilitas as $fas) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $fas['type_name'] ?></td>
                                  <td><?= $fas['facility_name'] ?></td>
                                  <td><?= $fas['kegunaan'] ?></td>
                                  <td>
                                  <a href="/fasilitas/detail_fasilitas/<?= $fas['id_facility'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle"></i> </a>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>

</div>

<div id="Jaminan" class="tabcontent">

<h3>List jaminan <?= $karyawan['employee_name'] ?></h3>
 
<table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Jenis Jaminan</th>
                                  <th scope="col">Nama Jaminan</th>
                                  <th scope="col">Tanggal Serah</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($jaminan as $j) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $j['type_name'] ?></td>
                                  <td><?= $j['jaminan_name'] ?></td>
                                  <td><?= $j['tgl_serah'] ?></td>
                                  <td>
                                    <?php if($j['status_jaminan'] == 1) : ?>
                                      <span class="text-info">Penyerahan</span>
                                    <?php elseif($j['status_jaminan'] == 2) : ?>
                                      <span class="text-primary">Peminjaman</span>
                                    <?php elseif($j['status_jaminan'] == 3) : ?>
                                      <span class="text-success">Pengembalian</span>
                                    <?php endif; ?>
                                  </td>
                                  <td>
                                  <a href="/jaminan/detail/<?= $j['id_jaminan'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle"></i> </a>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>
</div>

<div id="Position" class="tabcontent">

        <div class="card-body">
        <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Jabatan</th>
                                  <th scope="col">Jabatan Lama</th>
                                  <th scope="col">Tanggal Pindah</th>
                                  <th scope="col">Tanggal Masuk</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($position as $position) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $position['position_name'] ?></td>
                                  <td><?= $position['position_name_old'] ?></td>
                                  <td><?= $position['position_start'] ?></td>
                                  <td><?= $position['position_start_old'] ?></td>
                                  <td>
                                  <a href="/trn_position/detail_position/<?= $position['id_position'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle"></i> </a>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>
</div>

</div>

<div id="Angkat" class="tabcontent">

<div class="card-body">

<table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Jabatan</th>
                                  <th scope="col">SBU</th>
                                  <th scope="col">Status</th>
                                  <th scope="col">Tanggal Pengangkatan</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($join as $j) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $j['position_name'] ?></td>
                                  <td><?= $j['branch_name'] ?></td>
                                  <td>
                                    <?php 
                                    if($j['employee_status'] == 1){
                                      echo "Probation";
                                    }elseif($j['employee_status'] == 2){
                                      echo "Tetap";
                                    }elseif($j['employee_status'] == 3){
                                      echo "Resign";
                                    }elseif($j['employee_status'] == 4){
                                      echo "PHK";
                                    }else{
                                      echo "belum ada status";
                                    }
                                    ?>
                                </td>
                                  <td><?= date("d-m-Y",strtotime($j['join_start'])) ?></td>
                                  <td>
                                  <a href="/join/detail/<?= $j['id_join'] ?>" class="btn btn-outline-info"> <i class="fa fa-info-circle" title="Detail"></i> </a>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>

</div>
</div>

<div id="Achievement" class="tabcontent">

        <div class="card-body">
        <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Achievement</th>
                                  <th scope="col">Tahun</th>
                                  <th scope="col">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php $no = 1; ?>
                                <?php foreach($achievements as $achievement) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $achievement['name_achievement'] ?></td>
                                  <td><?= $achievement['tahun_terima'] ?></td>
                                  <td>
                                    <a href="/trn_achivement/detail/<?= $achievement['trn_id'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle"></i> </a>
                                  </td>
                                </tr>
                                <?php endforeach; ?>
                              </tbody>
                         
                </table>
</div>

</div>



</div>