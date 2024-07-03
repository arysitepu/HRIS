<div class="containter-fluid">
<div class="card shadow-mb4">

<div class="card-body">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
              <!-- <li class="breadcrumb-item"><a href="">Profile</a></li> -->
              <!-- <li class="breadcrumb-item"><a class="" href="">Edit</a></li> -->
              <li class="breadcrumb-item"><a class="" href="/karyawan/detail/<?= $karyawan['employee_id'] ?>">Kembali ke Detail</a></li>
            </ol>
          </nav>
          <!-- /Breadcrumb -->
</div>

<div class="card-body">
<form action="/contact_employee/save_contact_id" method="post">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nama Karyawan</label>
     <input type="text" class="form-control" value="<?= $karyawan['employee_name'] ?>" name="" readonly>
     <input type="hidden" class="form-control" value="<?= $karyawan['employee_id'] ?>" name="employee_id" readonly>
            <div class="invalid-feedback">
              
            </div>

    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Jenis Contact</label>
      <select id="inputState" class="form-control" name="contact_type" value="" name="contact_type">
                <option value="">Pilih</option>
                <option value="1" <?= old('contact_type') == '1' ? 'selected' : '' ?> >Ayah</option>
                <option value="2" <?= old('contact_type') == '2' ? 'selected' : '' ?>>Ibu</option>
                <option value="3" <?= old('contact_type') == '3' ? 'selected' : '' ?>>Kakak</option>
                <option value="4" <?= old('contact_type') == '4' ? 'selected' : '' ?>>Adik</option>
                <option value="5" <?= old('contact_type') == '5' ? 'selected' : '' ?>>Saudara</option>
            </select>

            <div class="invalid-feedback">
              
            </div>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Nama Contact</label>
     <input type="text" class="form-control" name="contact_name"
     value="<?= old('contact_name') ?>">

     <div class="invalid-feedback">
        
     </div>
    </div>

    
    <div class="form-group col-md-6">
      <label for="inputPassword4">Jenis Kelamin</label>
      <select id="inputState" class="form-control" name="jenis_kelamin" value="">
                <option value="">Pilih</option>
                <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?> >Laki - Laki</option>
                <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?> >Perempuan</option>
            </select>
            <div class="invalid-feedback">
               
            </div>
    </div>


    <div class="form-group col-md-6">
      <label for="inputPassword4">Tempat Lahir</label>
     <input type="text" class="form-control" name="lahir_tempat"
     value="<?= old('lahir_tempat') ?>">
     <div class="invalid-feedback">
      
     </div>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Tanggal Lahir</label>
     <input type="date" class="form-control" name="lahir_tanggal"
     value="<?= old('lahir_tanggal') ?>">
     <div class="invalid-feedback">
        
     </div>
    </div>



    <div class="form-group col-md-6">
      <label for="inputPassword4">Pekerjaan</label>
      <select id="inputState" class="form-control" name="pekerjaan" value="">
                <option value="">Pilih</option>
                <option value="1" <?= old('pekerjaan') == '1' ? 'selected' : '' ?> >Ibu rumah tangga</option>
                <option value="2" <?= old('pekerjaan') == '2' ? 'selected' : '' ?> >Pegawai Swasta</option>
                <option value="3" <?= old('pekerjaan') == '3' ? 'selected' : '' ?> >Pegawai Negeri</option>
                <option value="4" <?= old('pekerjaan') == '4' ? 'selected' : '' ?> >Wiraswasta</option>
            </select>
            <div class="invalid-feedback">
               
            </div>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Nomor Handphone</label>
     <input type="text" class="form-control" name="no_tlp"
     value="<?= old('no_tlp') ?>">
     <div class="invalid-feedback">
      
    </div>
    </div>

    
    <div class="form-group col-md-6">
      <label for="inputPassword4">Nomor Hanphone 2</label>
     <input type="text" class="form-control" name="no_tlp2"
     value="<?= old('no_tlp2') ?>">
     <div class="invalid-feedback">
      
    </div>
    </div>

    <div class="form-group col-md-6">
      <label for="inputPassword4">Alamat Tinggal</label>
     <input type="text" class="form-control" name="alamat_tinggal"
     value="<?= old('alamat_tinggal') ?>">
     <div class="invalid-feedback">
       
    </div>
    </div>

    <div class="form-group col-md-6">
      <label for="inputEmail4">Kecamatan</label>
      <select id="inputState" class="form-control " name="kecamatan_id">
                <option value="">Pilih</option>

                <?php foreach ($kecamatan as $kec) : ?>
                <option value="<?= $kec['kecamatan_id'] ?>" <?= old('kecamatan_id') == $kec['kecamatan_id'] ? 'selected' : '' ?>><?= $kec['kecamatan_distrik']?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
      
    </div>
    </div>
 
  

  </div>
  <button type="submit" class="btn btn-success" >Simpan</button>
</form>
</div>
</div>
</div>