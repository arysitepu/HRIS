<div class="container-fluid">
<div class="d-flex justify-content-between">
  <h3 class="">Add Karyawan</h3>
  <a href="/karyawan/index" class="btn btn-outline-success mb-3"> <i class="fas fa-arrow-left"></i> Back</a>
</div>


<div class="card shadow mb-4">
   

    <div class="card-header py-3">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Form Tambah Data Karyawan</h6>
        </center>
    </div>
  
    <div class="card-body">

   
   
    
    <form action="/karyawan/save" method="post" enctype="multipart/form-data">
    <?=  csrf_field() ?>
      <div class="row">
        <div class="col">
            <label for="">Nama Lengkap</label>
          <input type="text" class="form-control <?= ($validation->hasError('employee_name')) ? 'is-invalid' : ''; ?>" name="employee_name" value="<?= old('employee_name') ?>">
          <div id="" class="invalid-feedback">
            <?= $validation->getError('employee_name') ?>
          </div>
        </div>
        <div class="col">
            <label for="">Nama Panggilan</label>
          <input type="text" class="form-control <?= ($validation->hasError('employee_nickname')) ? 'is-invalid' : ''; ?>" name="employee_nickname" value="<?= old('employee_nickname') ?>">
          <div id="" class="invalid-feedback">
            <?= $validation->getError('employee_nickname') ?>
          </div>
        </div>
      </div>

        <br>

      <div class="row">
        <div class="col">
            <label for="">SBU</label>
            <select id="" class="theSelect form-control <?= ($validation->hasError('branch_id')) ? 'is-invalid' : ''; ?>" name="branch_id">
                <option value="">Pilih</option>

                <?php foreach ($branch as $br) : ?>
                <option value="<?= $br['branch_id'] ?>" <?= old('branch_id') == $br['branch_id'] ? 'selected' : ''; ?>><?= $br['branch_name'] ?></option>
            
              <?php endforeach; ?>
            </select>
            
            <div id="" class="invalid-feedback">
              <?= $validation->getError('branch_id') ?>
            </div>

            
          </div>
   

        <div class="col">
            <label for="">Jabatan</label>
            <select id="" class="theSelect form-control <?= ($validation->hasError('position_id')) ? 'is-invalid' : ''; ?>" name="position_id" value="<?= old('position_id') ?>">
                <option value="">Pilih</option>

                <?php foreach ($position as $p) : ?>
                <option value="<?= $p['position_id'] ?>" <?= old('position_id') == $p['position_id'] ? 'selected' : '';?>><?= $p['position_name'] ?></option>
              <?php endforeach; ?>
            </select>
            <div id="" class="invalid-feedback">
              <?= $validation->getError('position_id') ?>
            </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
            <label for="">Jenis Kelamin</label>
         
            <select id="" class="theSelect form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" value="<?= old('jenis_kelamin') ?>">
                <option value="">Pilih</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki - Laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                
            </select>
            <div id="" class="invalid-feedback">
              <?= $validation->getError('jenis_kelamin') ?>
            </div>
        </div>

        <div class="col">
            <label for="">Tempat Lahir</label>
          <input type="text" class="form-control <?= ($validation->hasError('lahir_tempat')) ? 'is-invalid' :''; ?>" name="lahir_tempat" value="<?= old('lahir_tempat') ?>">
          <div id="" class="invalid-feedback">
            <?= $validation->getError('lahir_tempat') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
            <label for="">Tanggal Lahir</label>
          <input type="date" class="form-control <?= ($validation->hasError('lahir_tanggal')) ? 'is-invalid' : ''; ?>" name="lahir_tanggal" value="<?= old('lahir_tanggal') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('lahir_tanggal') ?>
          </div>
        </div>
        <div class="col">
            <label for="">Nomor KTP</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_ktp')) ? 'is-invalid' : ''; ?>" name="no_ktp" value="<?= old('no_ktp') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_ktp') ?>
          </div>
        </div>
      </div>

      <br>

      <div class="row">
          <div class="col">
              <label for="">Golongan Darah</label>
              <select id="inputState" class="form-control <?= ($validation->hasError('gol_darah')) ? 'is-invalid' : ''; ?>" name="gol_darah" value="<?= old('gol_darah') ?>">
                <option value="">Pilih</option>
                <option value="A+" <?= old('gol_darah') == 'A+' ? 'selected' : '' ?>>A+</option>
                <option value="A-" <?= old('gol_darah') == 'A-' ? 'selected' : '' ?>>A-</option>
                <option value="B+" <?= old('gol_darah') == 'B+' ? 'selected' : '' ?>>B+</option>
                <option value="B-" <?= old('gol_darah') == 'B-' ? 'selected' : '' ?>>B-</option>
                <option value="O+" <?= old('gol_darah') == 'O+' ? 'selected' : '' ?>>O+</option>
                <option value="O-" <?= old('gol_darah') == 'O-' ? 'selected' : '' ?>>O-</option>
                <option value="AB+" <?= old('gol_darah') == 'AB+' ? 'selected' : '' ?>>AB+</option>
                <option value="AB-" <?= old('gol_darah') == 'AB-' ? 'selected' : '' ?>>AB-</option>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('gol_darah') ?>
            </div>
          </div>
          <div class="col">
              <label for="">No BPJS Kesehatan</label>
            <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_kes')) ? 'is-invalid' : ''; ?>" name="no_bpjs_kes" value="<?= old('no_bpjs_kes') ?>" >
            <div class="invalid-feedback">
              <?= $validation->getError('no_bpjs_kes') ?>
            </div>
          </div>
        </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Nomor Kartu Keluarga</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" name="no_kk" value="<?= old('no_kk') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_kk') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Nomor BPJSTK</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_tk')) ? 'is-invalid' : ''; ?>" name="no_bpjs_tk" value="<?= old('no_bpjs_tk') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_bpjs_tk') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Nomor NPWP</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_npwp')) ? 'is-invalid' : ''; ?>" name="no_npwp" value="<?= old('no_npwp') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_npwp') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Alamat KTP</label>
          <input type="text" class="form-control <?= ($validation->hasError('alamat_ktp')) ? 'is-invalid' : ''; ?>" name="alamat_ktp" value="<?= old('alamat_ktp') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('alamat_ktp') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Alamat Tinggal</label>
          <input type="text" class="form-control <?= ($validation->hasError('alamat_tinggal')) ? 'is-invalid' : ''; ?>" name="alamat_tinggal" value="<?= old('alamat_tinggal') ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('alamat_tinggal') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Kecamatan</label>
        <select id="inputState" class="theSelect form-control <?= ($validation->hasError('kecamatan_id')) ? 'is-invalid' : ''; ?>" name="kecamatan_id" value="<?= old('kecamatan_ids') ?>" style="width:100%;">
                <option value="">Pilih</option>

                <?php foreach ($kecamatan as $kec) : ?>
                <option value="<?= $kec['kecamatan_id'] ?>" <?= old('kecamatan_id') == $kec['kecamatan_id'] ? 'selected' : '';?> ><?= $kec['kecamatan_distrik'] ?></option>
              <?php endforeach; ?>
            </select>

            <div id="" class="invalid-feedback">
              <?= $validation->getError('kecamatan_id') ?>
            </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Kode pos</label>
          <input type="text" class="form-control <?= ($validation->hasError('kode_pos')) ? 'is-invalid' : ''; ?>" name="kode_pos" value="<?= old('kode_pos') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('kode_pos') ?>
            </div>
        </div>

        <div class="col">
        <label for="">Status Rumah</label>
        <select id="" class="theSelect form-control <?= ($validation->hasError('status_rumah')) ? 'is-invalid' : ''; ?>" name="status_rumah" value="<?= old('status_rumah') ?>">
                <option value="">Pilih</option>
                <option value="1" <?= old('status_rumah') == '1' ? 'selected' : '' ?>>Milik Sendiri</option>
                <option value="2" <?= old('status_rumah') == '2' ? 'selected' : '' ?>>Sewa</option>
                <option value="3" <?= old('status_rumah') == '3' ? 'selected' : '' ?>>Keluarga</option>
                
         </select>

            <div id="" class="invalid-feedback">
              <?= $validation->getError('status_rumah') ?>
            </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Status Pernikahan</label>

        <select id="" class="theSelect form-control <?= ($validation->hasError('status_nikah')) ? 'is-invalid' : ''; ?>" name="status_nikah" value="<?= old('status_nikah') ?>">
                <option value="">Pilih</option>
                <option value="1" <?= old('status_nikah') == '1' ? 'selected' : '' ?>>Lajang</option>
                <option value="2" <?= old('status_nikah') == '2' ? 'selected' : '' ?>>Menikah</option>
                <option value="3" <?= old('status_nikah') == '3' ? 'selected' : '' ?>>Bertunangan</option>
                <option value="4" <?= old('status_nikah') == '4' ? 'selected' : '' ?>>Cerai</option>
                <option value="5" <?= old('status_nikah') == '5' ? 'selected' : '' ?>>Suami/Istri meninggal</option>
         </select>
         <div id="" class="invalid-feedback">
              <?= $validation->getError('status_nikah') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Etnis</label>
        <select id="" class="theSelect form-control <?= ($validation->hasError('etnis')) ? 'is-invalid' : ''; ?>" name="etnis" value="<?= old('etnis') ?>">
                <option value="">Pilih</option>
                <option value="Aceh" <?= old('etnis') == 'Aceh' ? 'selected' : '' ?>>Aceh</option>
                <option value="Ambon" <?= old('etnis') == 'Ambon' ? 'selected' : '' ?>>Ambon</option>
                <option value="Batak" <?= old('etnis') == 'Batak' ? 'selected' : '' ?>>Batak</option>
                <option value="Jawa" <?= old('etnis') == 'Jawa' ? 'selected' : '' ?>>Jawa</option>
                <option value="Sunda" <?= old('etnis') == 'Sunda' ? 'selected' : '' ?>>Sunda</option>
               
         </select>
          <div id="" class="invalid-feedback">
              <?= $validation->getError('etnis') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Agama</label>
        <select id="inputState" class="form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" value="<?= old('agama') ?>">
                <option value="">Pilih</option>
                <option value="Kristen Protestan" <?= old('agama') == 'Kristen Protestan' ? 'selected' : '' ?>>Kristen Protestan</option>
                <option value="Islam" <?= old('agama') == 'Islam' ? 'selected' : '' ?>>Islam</option>
                <option value="Khatolik" <?= old('agama') == 'Khatolik' ? 'selected' : '' ?>>Khatolik</option>
                <option value="Hindu" <?= old('agama') == 'Hindu' ? 'selected' : '' ?>>Hindu</option>
                <option value="Buddha" <?= old('agama') == 'Buddha' ? 'selected' : '' ?>>Buddha</option>
                <option value="Konguchu" <?= old('agama') == 'Konguchu' ? 'selected' : '' ?>>Konguchu</option>
         </select>

         <div id="" class="invalid-feedback">
              <?= $validation->getError('agama') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Nomor Telephone 1</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' : ''; ?>" name="no_tlp" value="<?= old('no_tlp') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('no_tlp') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Nomor Telephone 2</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_tlp2')) ? 'is-invalid' : ''; ?>" name="no_tlp2" value="<?= old('no_tlp2') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('no_tlp2') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Email Pribadi</label>
          <input type="email" class="form-control <?= ($validation->hasError('email_pribadi')) ? 'is-invalid' : ''; ?>" name="email_pribadi" value="<?= old('email_pribadi') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('email_pribadi') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Email Kantor</label>
          <input type="email" class="form-control <?= ($validation->hasError('email_kantor')) ? 'is-invalid' : ''; ?>" name="email_kantor" value="<?= old('email_kantor') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('email_kantor') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Tinggi Badan (cm)</label>
          <input type="text" class="form-control <?= ($validation->hasError('badan_tinggi')) ? 'is-invalid' : ''; ?>" name="badan_tinggi" value="<?= old('badan_tinggi') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('badan_tinggi') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Berat Badan (Kg)</label>
          <input type="text" class="form-control <?= ($validation->hasError('badan_berat')) ? 'is-invalid' : ''; ?>" name="badan_berat" value="<?= old('badan_berat') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('badan_berat') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Nomor Rekening</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_rek')) ? 'is-invalid' : ''; ?>" name="no_rek" value="<?= old('no_rek') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('no_rek') ?>
          </div>
        </div>
      </div>
 <hr>
      <div class="row">
        <div class="col">
        <label for="">Hak Cuti</label>
          <input type="text" class="form-control <?= ($validation->hasError('hak_cuti')) ? 'is-invalid' : ''; ?>" name="hak_cuti" value="<?= old('hak_cuti') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('hak_cuti') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Start Cuti</label>
          <input type="date" class="form-control <?= ($validation->hasError('start_cuti')) ? 'is-invalid' : ''; ?>" name="start_cuti" value="<?= old('start_cuti') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('start_cuti') ?>
          </div>
        </div>
      </div>

      <br>
        <div class="row">
          <!-- <div class="col">
              <label for="">Tanggal masuk</label>
            <input type="date" class="form-control <?= ($validation->hasError('tanggal_masuk')) ? 'is-invalid' : ''; ?>" name="tanggal_masuk" value="<?= old('tanggal_masuk') ?>">
            <div id="" class="invalid-feedback">
              <?= $validation->getError('tanggal_masuk') ?>
          </div>
          </div> -->
          <!-- <div class="col">
              <label for="">Tanggal Keluar</label>
            <input type="date" class="form-control" name="tanggal_keluar" value="<?= old('tanggal_keluar') ?>">
          </div> -->
        </div>

      <br>

      <div class="row">

          <!-- <div class="col">
              <label for="">Status</label>
              <select id="inputState" class="form-control" name="employee_status" value="<?= old('employee_status') ?>">
                  <option value="">Pilih</option>
                  <option value="1" <?= old('employee_status') == '1' ? 'selected' : '' ?>>Active</option>
                  <option value="2" <?= old('employee_status') == '2' ? 'selected' : '' ?>>Deactive</option>
              </select>
            <div id="" class="invalid-feedback">
             
          </div>
          </div> -->

          
      <div class="col">
        <label for="">Upload foto</label>
          <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar" value="<?= old('gambar') ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('gambar') ?>
          </div>
        </div>
      </div>
      <br>
      
  
      <div class="justify-content">

          <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan Data</button>
      </div>
      
    </form>
       
    </div>
</div>
  <script type="text/javascript">
       $(".theSelect").select2();
     </script>
</div>