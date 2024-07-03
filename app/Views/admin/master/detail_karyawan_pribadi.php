<div class="container-fluid">

<a href="/karyawan/detail/<?= $karyawan['employee_id'] ?>" class="btn btn-outline-success mb-3"><i class="fas fa-arrow-left"></i> Back detail</a>

<div class="card-body">
<h3>Profile Pribadi <?= $karyawan['employee_name'] ?></h3>

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
  <button class="tablinks" onclick="detailKaryawan(event, 'Profile')">Detail</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Contact')">Contact</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Keluarga')">Keluarga</button>
  <button class="tablinks" onclick="detailKaryawan(event, 'Pendidikan')">Pendidikan</button>
</div>

<!-- Tab content -->
<div id="Profile" class="tabcontent">
<div class="card-header">
<h5 class="text-center">Detail Karyawan</h5>
</div>



            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Tinggi Badan (Cm)</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= ($karyawan['badan_tinggi'] == 0) ? '-' : $karyawan['badan_tinggi']  ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Berat Badan (Kg)</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= ($karyawan['badan_berat'] == 0) ? '-' : $karyawan['badan_berat']  ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Alamat KTP</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['alamat_ktp'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Alamat Tinggal</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['alamat_tinggal'] ?></label>
                        </div>
            </div>

            
            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Kecamatan</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['kecamatan_distrik'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Kota / Kabupaten</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['kota_kabupaten'] ?></label>
                        </div>
            </div>

            <div class="row mt-2">
                        <div class="col-md-6"><label class="labels"> <b>Provinsi</b> </label></div>
                        <div class="col-md-6"><label class="labels"><?= $karyawan['provinsi'] ?></label>
                        </div>
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

          
           
        </div>

       

</div>

<div id="Contact" class="tabcontent">
  
  <h4>Contact Karyawan</h4>

        <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Nama Contact</th>
                                  <th scope="col">No Hanphone</th>
                                  <th scope="col">Hubungan</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($contact as $contact) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $contact['contact_name'] ?></td>
                                  <td><?= $contact['no_tlp_contact'] ?></td>
                                  <td>
                                    <?php 
                                        if($contact['contact_type'] == 1){
                                          echo "Ayah";
                                        }elseif($contact['contact_type'] == 2){
                                          echo "Ibu";
                                        }elseif($contact['contact_type'] == 3){
                                          echo "Kakak";
                                        }elseif($contact['contact_type'] == 4){
                                          echo "Adik";
                                        }elseif($contact['contact_type'] == 5){
                                          echo "Saudara";
                                        }elseif($contact['contact_type'] == 6){
                                          echo "Suami";
                                        }elseif($contact['contact_type'] == 7){
                                          echo "Istri";
                                        }elseif($contact['contact_type'] == 8){
                                          echo "Anak";
                                        }else{
                                          echo "";
                                        }
                                    ?>
                                  </td>
                                  <td>
                                  <a href="/contact_employee/detail_contact/<?= $contact['id_contact'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle" title="DETAIL"></i> </a>
                                  <?php if(session()->get('user_level') == 'admin') : ?>
                                  <a href="/contact_employee/edit_contact/<?= $contact['id_contact'] ?>" class="btn btn-outline-info"> <i class="fas fa-edit"></i> </a>
                                  <a href="/contact_employee/delete_contact/<?= $contact['id_contact'] ?>" class="btn btn-outline-info" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </a>
                                  <?php endif; ?>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>

</div>

<div id="Keluarga" class="tabcontent">
  <h3>Keluarga</h3>
  <table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Nama Keluarga</th>
                                  <th scope="col">Hubungan Keluarga</th>
                                  <th scope="col">Pekerjaan</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($family as $fam) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $fam['family_name'] ?></td>
                                  <td>
                                  <?php 
                                  if($fam['family_type'] == 1){
                                    echo "Ayah";
                                }elseif($fam['family_type'] == 2){
                                    echo "Ibu";
                                }elseif($fam['family_type'] == 3){
                                    echo "Saudara";
                                }elseif($fam['family_type'] == 4){
                                    echo "Anak";
                                }elseif($fam['family_type'] == 5){
                                    echo "Suami";
                                }elseif($fam['family_type'] == 6){
                                    echo "Istri";
                                }else{
                                    echo "";
                                } 
                                  ?>
                                  </td>
                                  <td>
                                  <?php 
                                  if($fam['pekerjaan'] == 1){
                                    echo "Pegawai Negeri";
                                }elseif($fam['pekerjaan'] == 2){
                                    echo "Pegawai Swasta";
                                }elseif($fam['pekerjaan'] == 3){
                                    echo "Ibu Rumah Tangga";
                                }elseif($fam['pekerjaan'] == 4){
                                    echo "Wiraswasta";
                                }else{
                                    echo "Belum Bekerja";
                                } 
                                  ?>
                                  </td>
                                  <td>
                                  <a href="/karyawan/get_keluarga/<?= $fam['id_family'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle"></i> </a>
                                  <?php if(session()->get('user_level') == 'admin') : ?>
                                  <a href="/family/edit_family/<?= $fam['id_family'] ?>" class="btn btn-info"> <i class="fas fa-edit"></i> </a>
                                  <a href="/family/delete_family/<?= $fam['id_family'] ?>" class="btn btn-info" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </a>
                                  <?php endif; ?>
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>
</div>

<div id="Pendidikan" class="tabcontent">
<div class="card-header">

<h5 class="text-center">Pendidikan</h5>
</div>

<table class="table">
                              <thead class="thead-dark">
                                <tr>
                                  <th scope="col">No</th>
                                  <th scope="col">Asal sekolah</th>
                                  <th scope="col">Jurusan</th>
                                  <th scope="col">Tahun Masuk</th>
                                  <th scope="col">Tahun Lulus</th>
                                  <th scope="col">Aksi</th>
                                </tr>
                              </thead>
                              
                              <?php $no=1; ?>
                              <tbody>
                              <?php foreach($education as $edu) : ?>
                                <tr>
                                  <th scope="row"><?= $no++ ?></th>
                                  <td><?= $edu['education_name'] ?></td>
                                  <td><?= $edu['education_major'] ?></td>
                                  <td><?= $edu['tahun_masuk'] ?></td>
                                  <td><?= $edu['tahun_lulus'] ?></td>
                                  <td>
                                  <a href="/employee_education/detail_education/<?= $edu['id_education'] ?>" class="btn btn-outline-info"> <i class="fas fa-info-circle"></i> </a>
                                  <?php if(session()->get('user_level') == 'admin') : ?>
                                  <a href="/employee_education/edit_education/<?= $edu['id_education'] ?>" class="btn btn-outline-info"> <i class="fas fa-edit"></i> </a>
                                  <?php endif; ?>
                                  <!-- <a href="/education/delete_education/<?= $edu['id_education'] ?>" class="btn btn-info" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt" ></i> </a> -->
                                  </td>
                                </tr>
                              </tbody>
                          <?php endforeach; ?>
                </table>

</div>

<!-- batas tab content -->

</div>