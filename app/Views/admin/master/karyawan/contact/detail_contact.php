<div class="container-fluid">
    <div class="main-body">
    

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
           <div class="text-center">
               <h3>Detail Contact Karyawan</h3>
           </div>
          </nav>
          <!-- /Breadcrumb -->

          <!-- Breadcrumb -->
          <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="">Profile</a></li>
            
              <li class="breadcrumb-item"><a class="" href="/karyawan/detail/<?= $contact['employee_id'] ?>">Kembali ke Detail</a></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
  

            <!-- Profile -->
            <center>
                <div class=" col-md-8 ">
                  <div class="card mb-3">
                    <div class="card-body">
                         <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Contact type</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= ($contact['contact_type'] == '1') ? 'Ayah' : '' ?>
                            <?= ($contact['contact_type'] == '2') ? 'Ibu' : '' ?>
                            <?= ($contact['contact_type'] == '3') ? 'Kakak' : '' ?>
                            <?= ($contact['contact_type'] == '4') ? 'Adik' : '' ?>
                            <?= ($contact['contact_type'] == '5') ? 'Saudara' : '' ?>
                            </div>
                        </div>
                        <hr>
    
                           
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Nama Contact</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['contact_name'] ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Jenis Kelamin</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= ($contact['jenis_kelamin'] == 'L') ? 'Laki - Laki' : '' ?><?= ($contact['jenis_kelamin'] == 'P') ? 'Perempuan' : '' ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Tempat Lahir</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['lahir_tempat'] ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Tanggal Lahir</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['lahir_tanggal'] ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Pekerjaan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= ($contact['pekerjaan'] == '1') ? 'Ibu Rumah Tangga' :'' ?>
                            <?= ($contact['pekerjaan'] == '2') ? 'Pegawai Swasta' :'' ?>
                            <?= ($contact['pekerjaan'] == '3') ? 'Pegawai Negeri' :'' ?>
                            <?= ($contact['pekerjaan'] == '4') ? 'Wiraswasta' :'' ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Nomor Hanphone 1</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['no_tlp'] ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Nomor Hanphone 2</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['no_tlp2'] ?>
                            </div>
                        </div>
                        <hr>
    
                        
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Alamat Tinggal</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['alamat_tinggal'] ?>
                            </div>
                        </div>
                        <hr>
    
                        <div class="row">
                            <div class="col-sm-3">
                            <h6 class="mb-0">Kecamatan</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                            <?= $contact['kecamatan_distrik'] ?>
                            </div>
                        </div>
                        <hr>
    
                     
                 
                   
                        
    
                      </div>
                    </div>
                  </div>
                 </div>
    
                 </div>
            </center>
            


          </div>

        </div>
    </div>

    </div>