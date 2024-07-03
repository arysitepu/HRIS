
<div class="container-fluid">
<div class="d-flex justify-content-between">
  <h3>Edit Karyawan</h3>
  <a href="/karyawan/index" class="btn btn-outline-success mb-3"> <i class="fas fa-arrow-left"></i> Back </a>
</div>

<div class="card shadow mb-4">
    <div class="card-body"> 
    <form action="/karyawan/update/<?= $karyawan['employee_id'] ?>" method="post" enctype="multipart/form-data">
    <?=  csrf_field() ?>

    <input type="hidden" name="employee_id" value="<?= $karyawan['employee_id'] ?>">
    <input type="hidden" name="gambar_lama" value="<?= $karyawan['gambar'] ?>">
      <div class="row">
        <div class="col">
            <label for="">Nama Lengkap</label>
          <input type="text" class="form-control <?= ($validation->hasError('employee_name')) ? 'is-invalid' : ''; ?>" name="employee_name" value="<?= old(('employee_name')) ? old('employee_name') : $karyawan['employee_name'] ?>">
          <div id="" class="invalid-feedback">
            <?= $validation->getError('employee_name') ?>
          </div>
        </div>
        <div class="col">
            <label for="">Nama Panggilan</label>
          <input type="text" class="form-control <?= ($validation->hasError('employee_nickname')) ? 'is-invalid' : ''; ?>" name="employee_nickname" value="<?=  old(('employee_nickname')) ? old('employee_nickname') : $karyawan['employee_nickname'] ?>">
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
                <option value="<?= $karyawan['branch_id'] ?>"><?= $karyawan['branch_name'] ?></option>

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
                <option value="<?= $karyawan['position_id'] ?>"><?= $karyawan['position_name'] ?></option>

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
         
            <select id="inputState" class="form-control <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : ''; ?>" name="jenis_kelamin" value="<?= old('jenis_kelamin') ?>">
                <option value="<?= $karyawan['jenis_kelamin'] ?>">
                <?php 
                if($karyawan['jenis_kelamin'] == 'L'){
                  echo "Laki - Laki";
                }elseif($karyawan['jenis_kelamin'] == 'P'){
                  echo "Perempuan";
                }else{
                  echo "";
                }
                ?>
                </option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki - Laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                
            </select>
            <div id="" class="invalid-feedback">
              <?= $validation->getError('jenis_kelamin') ?>
            </div>
        </div>

        <div class="col">
            <label for="">Tempat Lahir</label>
          <input type="text" class="form-control <?= ($validation->hasError('lahir_tempat')) ? 'is-invalid' :''; ?>" name="lahir_tempat" value="<?= old(('lahir_tempat')) ? old('lahir_tempat') :  $karyawan['lahir_tempat'] ?>">
          <div id="" class="invalid-feedback">
            <?= $validation->getError('lahir_tempat') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
            <label for="">Tanggal Lahir</label>
          <input type="date" class="form-control <?= ($validation->hasError('lahir_tanggal')) ? 'is-invalid' : ''; ?>" name="lahir_tanggal" value="<?= old(('lahir_tanggal')) ? old('lahir_tanggal') :  $karyawan['lahir_tanggal'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('lahir_tanggal') ?>
          </div>
        </div>
        <div class="col">
            <label for="">Nomor KTP</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_ktp')) ? 'is-invalid' : ''; ?>" name="no_ktp" value="<?= old(('employee_nickname')) ? old('lahir_tempat') :  $karyawan['no_ktp'] ?>">
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
                <option value="<?= $karyawan['gol_darah'] ?>"><?= $karyawan['gol_darah'] ?></option>
                <option value="A" <?= old('gol_darah') == 'A' ? 'selected' : '' ?>>A</option>
                <option value="B" <?= old('gol_darah') == 'B' ? 'selected' : '' ?>>B</option>
                <option value="O" <?= old('gol_darah') == 'O' ? 'selected' : '' ?>>O</option>
                <option value="AB" <?= old('gol_darah') == 'AB' ? 'selected' : '' ?>>AB</option>
            </select>
            <div class="invalid-feedback">
              <?= $validation->getError('gol_darah') ?>
            </div>
          </div>
          <div class="col">
              <label for="">No BPJS Kesehatan</label>
            <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_kes')) ? 'is-invalid' : ''; ?>" name="no_bpjs_kes" value="<?= old(('no_bpjs_kes')) ? old('no_bpjs_kes') : $karyawan['no_bpjs_kes'] ?>" >
            <div class="invalid-feedback">
              <?= $validation->getError('no_bpjs_kes') ?>
            </div>
          </div>
        </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Nomor Kartu Keluarga</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_kk')) ? 'is-invalid' : ''; ?>" name="no_kk" value="<?= old(('no_kk')) ? old('no_kk') : $karyawan['no_kk'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_kk') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Nomor BPJSTK</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_bpjs_tk')) ? 'is-invalid' : ''; ?>" name="no_bpjs_tk" value="<?= old(('no_bpjs_tk')) ? old('no_bpjs_tk') :  $karyawan['no_bpjs_tk'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_bpjs_tk') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Nomor NPWP</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_npwp')) ? 'is-invalid' : ''; ?>" name="no_npwp" value="<?= old(('no_npwp')) ? old('no_npwp') : $karyawan['no_npwp'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('no_npwp') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Alamat KTP</label>
          <input type="text" class="form-control <?= ($validation->hasError('alamat_ktp')) ? 'is-invalid' : ''; ?>" name="alamat_ktp" value="<?= old(('alamat_ktp')) ? old('alamat_ktp') : $karyawan['alamat_ktp'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('alamat_ktp') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Alamat Tinggal</label>
          <input type="text" class="form-control <?= ($validation->hasError('alamat_tinggal')) ? 'is-invalid' : ''; ?>" name="alamat_tinggal" value="<?= old(('alamat_tinggal')) ? old('alamat_tinggal') : $karyawan['alamat_tinggal'] ?>">
          <div class="invalid-feedback">
            <?= $validation->getError('alamat_tinggal') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Kecamatan</label>
        <select id="" class="theSelect form-control <?= ($validation->hasError('kecamatan_id')) ? 'is-invalid' : ''; ?>" name="kecamatan_id" value="<?= old('kecamatan_id') ?>" style="width:100%;">
                <option value="<?= $karyawan['kecamatan_id'] ?>"><?= $karyawan['kecamatan_distrik'] ?></option>

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
          <input type="text" class="form-control <?= ($validation->hasError('kode_pos')) ? 'is-invalid' : ''; ?>" name="kode_pos" value="<?= old(('kode_pos')) ? old('kode_pos') : $karyawan['kode_pos'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('kode_pos') ?>
            </div>
        </div>

        <div class="col">
        <label for="">Status Rumah</label>
        <select id="" class="theSelect form-control <?= ($validation->hasError('status_rumah')) ? 'is-invalid' : ''; ?>" name="status_rumah" value="<?= old('status_rumah') ?>">
                <option value="<?= $karyawan['status_rumah'] ?>">
                <?php 
                if($karyawan['status_rumah'] == 1){
                  echo "Milik Sendiri";
                }elseif($karyawan['status_rumah'] == 2){
                  echo "Tinggal Bersama Orang Tua";
                }elseif($karyawan['status_rumah'] == 3){
                  echo "Kost";
                }elseif($karyawan['status_rumah'] == 4){
                  echo "Kontrakan";
                }else{
                  echo "";
                }
                ?>
                </option>
                <option value="1" <?= old('status_rumah') == '1' ? 'selected' : '' ?> >Milik Sendiri</option>
                <option value="2" <?= old('status_rumah') == '2' ? 'selected' : '' ?> >Tinggal Bersama Orang tua</option>
                <option value="3" <?= old('status_rumah') == '3' ? 'selected' : '' ?> >Kost</option>
                <option value="4" <?= old('status_rumah') == '4' ? 'selected' : '' ?> >Kontrakan</option>
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
                <option value="<?= $karyawan['status_nikah'] ?>">
                <?php 
                if($karyawan['status_nikah'] == 1){
                  echo "Lajang";
                }elseif($karyawan['status_nikah'] == 2){
                  echo "Menikah";
                }elseif($karyawan['status_nikah'] == 3){
                  echo "Janda";
                }elseif($karyawan['status_nikah'] == 4){
                  echo "Duda";
                }
                ?>
                </option>
                <option value="1" <?= old('status_nikah') == '1' ? 'selected' : '' ?>>Lajang</option>
                <option value="2" <?= old('status_nikah') == '2' ? 'selected' : '' ?>>Menikah</option>
                <option value="3" <?= old('status_nikah') == '3' ? 'selected' : '' ?>>Janda</option>
                <option value="4" <?= old('status_nikah') == '4' ? 'selected' : '' ?>>Duda</option>
         </select>
         <div id="" class="invalid-feedback">
              <?= $validation->getError('status_nikah') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Etnis</label>
        <select id="" class="theSelect form-control <?= ($validation->hasError('etnis')) ? 'is-invalid' : ''; ?>" name="etnis" value="<?= old('etnis') ?>">
                <option value="<?= $karyawan['etnis'] ?>"><?= $karyawan['etnis'] ?></option>
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
        <select id="inputState" class="theSelect form-control <?= ($validation->hasError('agama')) ? 'is-invalid' : ''; ?>" name="agama" value="<?= old('agama') ?>">
                <option value="<?= $karyawan['agama'] ?>"><?= $karyawan['agama'] ?></option>
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
          <input type="text" class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' : ''; ?>" name="no_tlp" value="<?= old(('no_tlp')) ? old('no_tlp') : $karyawan['no_tlp'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('no_tlp') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Nomor Telephone 2</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_tlp2')) ? 'is-invalid' : ''; ?>" name="no_tlp2" value="<?= old(('no_tlp2')) ? old('no_tlp2') : $karyawan['no_tlp2'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('no_tlp2') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Email Pribadi</label>
          <input type="email" class="form-control <?= ($validation->hasError('email_pribadi')) ? 'is-invalid' : ''; ?>" name="email_pribadi" value="<?= old(('email_pribadi')) ? old('email_pribadi') : $karyawan['email_pribadi'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('email_pribadi') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Email Kantor</label>
          <input type="email" class="form-control <?= ($validation->hasError('email_kantor')) ? 'is-invalid' : ''; ?>" name="email_kantor" value="<?= old(('email_kantor')) ? old('email_kantor') : $karyawan['email_kantor'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('email_kantor') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Tinggi Badan (cm)</label>
          <input type="text" class="form-control <?= ($validation->hasError('badan_tinggi')) ? 'is-invalid' : ''; ?>" name="badan_tinggi" value="<?= old(('badan_tinggi')) ? old('badan_tinggi') :  $karyawan['badan_tinggi'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('badan_tinggi') ?>
          </div>
        </div>
      </div>

      <br>
        
      <div class="row">
        <div class="col">
        <label for="">Berat Badan (Kg)</label>
          <input type="text" class="form-control <?= ($validation->hasError('badan_berat')) ? 'is-invalid' : ''; ?>" name="badan_berat" value="<?= old(('badan_berat')) ? old('badan_berat') :  $karyawan['badan_berat'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('badan_berat') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Nomor Rekening</label>
          <input type="text" class="form-control <?= ($validation->hasError('no_rek')) ? 'is-invalid' : ''; ?>" name="no_rek" value="<?= old(('no_rek')) ? old('no_rek') : $karyawan['no_rek'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('no_rek') ?>
          </div>
        </div>
      </div>

      <hr>
      <div class="row">
        <div class="col">
        <label for="">Hak Cuti</label>
          <input type="text" class="form-control <?= ($validation->hasError('hak_cuti')) ? 'is-invalid' : ''; ?>" name="hak_cuti" value="<?= old(('hak_cuti')) ? old('hak_cuti') : $karyawan['hak_cuti'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('hak_cuti') ?>
          </div>
        </div>
        <div class="col">
        <label for="">Start Cuti</label>
          <input type="date" class="form-control <?= ($validation->hasError('start_cuti')) ? 'is-invalid' : ''; ?>" name="start_cuti" value="<?= old(('start_cuti')) ? old('start_cuti') : $karyawan['start_cuti'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('start_cuti') ?>
          </div>
        </div>
      </div>

      <br>


      <div class="col">
        <label for="">Update Gambar</label><br>
        <label for=""><?= $karyawan['gambar'] ?></label>
          <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar" value="<?= old(('gambar')) ? old('gambar') : $karyawan['gambar'] ?>"
          placeholder="<?= $karyawan['gambar'] ?>">
          <div id="" class="invalid-feedback">
              <?= $validation->getError('gambar') ?>
          </div>
          <br>
          

            <img src="/img/<?= $karyawan['gambar'] ?>" alt="" class="avatar">
          
        </div>

        
      <div class="justify-content mt-3">

          <button type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Ubah Data</button>
      </div>

      </div>
      <br>

      
  
      
    </form>
       
    </div>
</div>
    <script type="text/javascript">
          $(".theSelect").select2();
    </script>
</div>