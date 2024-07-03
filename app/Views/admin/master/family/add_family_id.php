<div class="container-fluid">

<div class="card">

<div class="card-header">

    <h5 class="text-center">Tambah Data Keluarga</h5>
</div>

<div class="card-body">
   
    <a href="/family/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>
<form action="/family/save_family_id" method="post">
<?php csrf_field()  ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
       <input type="text" class="form-control" value="<?= $karyawan['employee_name'] ?>" readonly>
       <input type="hidden" class="form-control" value="<?= $karyawan['employee_id'] ?>" name="employee_id" readonly>
            <div class="invalid-feedback">
               
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama Keluarga</label>
        <input type="text" class="form-control " name="family_name"
        value="<?= old('family_name') ?>">
        <div class="invalid-feedback">
               
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Hubungan Keluarga</label>
        <select id="input-state" class="form-control d-inline" name="family_type">

            <option value="">Pilih</option>
            <option value="1" <?= old('family_type') == '1' ? 'selected' :'' ?>>Ayah</option>
            <option value="2" <?= old('family_type') == '2' ? 'selected' :'' ?>>Ibu</option>
            <option value="3" <?= old('family_type') == '3' ? 'selected' :'' ?>>Saudara</option>
            
            </select>
            <div class="invalid-feedback">
                
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Jenis Kelamin</label>
        <select id="input-state" class="form-control d-inline" name="jenis_kelamin">

        <option value="">Pilih</option>
        <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' :'' ?>>Laki - Laki</option>
        <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' :'' ?>>Perempuan</option>

        </select>
        <div class="invalid-feedback">
               
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tempat Lahir</label>
        <input type="text" class="form-control d-inline" name="lahir_tempat"
        value="<?= old('lahir_tempat') ?>">
        <div class="invalid-feedback">
             
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tanggal Lahir</label>
        <input type="date" class="form-control"  name="lahir_tanggal"
        value="<?= old('lahir_tanggal') ?>">
        <div class="invalid-feedback">
               
            </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Pekerjaan</label>
        <select id="input-state" class="form-control d-inline" name="pekerjaan">

            <option value="">Pilih</option>
            <option value="1" <?= old('pekerjaan') == '1' ? 'selected' : '' ?>>Pegawai Negeri</option>
            <option value="2" <?= old('pekerjaan') == '2' ? 'selected' : '' ?>>Pegawai Swasta</option>
            <option value="3" <?= old('pekerjaan') == '3' ? 'selected' : '' ?>>Ibu Rumah Tangga</option>
            <option value="4" <?= old('pekerjaan') == '4' ? 'selected' : '' ?>>Wiraswasta</option>
            </select>
            <div class="invalid-feedback">
               
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Pendidikan</label>
        <select id="input-state" class="form-control d-inline" name="pendidikan">

            <option value="">Pilih</option>
            <option value="1"  <?= old('pendidikan') == '1' ? 'selected' : '' ?>>SD</option>
            <option value="2"  <?= old('pendidikan') == '2' ? 'selected' : '' ?>>SMP</option>
            <option value="3"  <?= old('pendidikan') == '3' ? 'selected' : '' ?>>SMA</option>
            <option value="4"  <?= old('pendidikan') == '4' ? 'selected' : '' ?>>Strata 1</option>
            <option value="5"  <?= old('pendidikan') == '5' ? 'selected' : '' ?>>Strata 2</option>
            <option value="6"  <?= old('pendidikan') == '6' ? 'selected' : '' ?>>Doktoral</option>
            </select>
            <div class="invalid-feedback">
               
            </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Jurusan</label>
        <input type="text" class="form-control d-inline" name="jurusan" 
        value="<?= old('jurusan') ?>">
        <div class="invalid-feedback">
               
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Asal Sekolah</label>
        <input type="text" class="form-control " name="sekolah_nama"
        value="<?= old('sekolah_nama') ?>">
        <div class="invalid-feedback">
                
        </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Alamat Sekolah asal</label>
        <input type="text" class="form-control d-inline" name="sekolah_alamat"
        value="<?= old('sekolah_alamat') ?>">
        <div class="invalid-feedback">
               
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor Telephone</label>
        <input type="text" class="form-control"  name="no_tlp"
        value="<?= old('no_tlp') ?>">
        <div class="invalid-feedback">
               
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor Telephone2</label>
        <input type="text" class="form-control" name="no_tlp2"
        value="<?= old('no_tlp2') ?>">
        <div class="invalid-feedback">
            
        </div>
        </div>
    </div>
<hr>

<button type="submit" class="btn btn-info" > <i class="fas fa-save" ></i> Simpan Data </button>
</form>





</div>
</div>

</div>