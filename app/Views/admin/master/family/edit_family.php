<div class="container-fluid">
<div class="d-flex justify-content-between mb-3">
    <h3 class="text-center">Edit Keluarga Karyawan</h3>
    <a href="/family/index" class="btn btn-outline-success"><i class="fas fa-arrow-left"></i> Back</a>
</div>
<div class="card shadow">
<div class="card-body">
<form action="/family/update_family/<?= $family['id'] ?>" method="post">
<?php csrf_field()  ?>
<input type="hidden" value="<?= $family['id'] ?>" name="id">
    <div class="row">
        
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select id="" class="theSelect form-control <?= $validation->hasError('employee_id') ? 'is-invalid' :'' ?>" name="employee_id">
                <option value="<?= $family['employee_id'] ?>"><?= $family['employee_name'] ?></option>

                <?php foreach ($karyawan as $kry) : ?>
                <option value="<?= $kry['employee_id'] ?>" <?= old('employee_id') == $kry['employee_id'] ? 'selected' : '' ?>><?= $kry['employee_name']?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
               <?= $validation->getError('employee_id') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nama Keluarga</label>
        <input type="text" class="form-control <?= $validation->hasError('family_name') ? 'is-invalid' :'' ?>" name="family_name"
        value="<?= old(('family_name')) ? old('family_name') : $family['family_name'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('family_name') ?>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Hubungan Keluarga</label>
        <select id="" class="theSelect form-control d-inline <?= $validation->hasError('family_type') ? 'is-invalid' :'' ?>s" name="family_type">

            <option value="<?= $family['family_type'] ?>">
            <?php 
            if($family['family_type'] == 1){
                echo "Ayah";
            }elseif($family['family_type'] == 2){
                echo "Ibu";
            }elseif($family['family_type'] == 3){
                echo "Saudara";
            }elseif($family['family_type'] == 4){
                echo "anak";
            }elseif($family['family_type'] == 5){
                echo "Suami";
            }elseif($family['family_type'] == 6){
                echo "Istri";
            }else{
                echo "";
            }
            ?>
            </option>
            <option value="1" <?= old('family_type') == '1' ? 'selected' :'' ?>>Ayah</option>
            <option value="2" <?= old('family_type') == '2' ? 'selected' :'' ?>>Ibu</option>
            <option value="3" <?= old('family_type') == '3' ? 'selected' :'' ?>>Saudara</option>
            <option value="4" <?= old('family_type') == '4' ? 'selected' :'' ?>>Anak</option>
            <option value="5" <?= old('family_type') == '5' ? 'selected' :'' ?>>Suami</option>
            <option value="6" <?= old('family_type') == '6' ? 'selected' :'' ?>>Istri</option>
            </select>
            <div class="invalid-feedback">
            <?= $validation->getError('family_type') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Jenis Kelamin</label>
        <select id="" class="theSelect form-control d-inline <?= $validation->hasError('jenis_kelamin') ? 'is-invalid' :'' ?>" name="jenis_kelamin">

        <option value="<?= $family['jenis_kelamin'] ?>">
        <?php 
        if($family['jenis_kelamin'] == 'L'){
            echo "Laki - Laki";
        }elseif($family['jenis_kelamin'] == 'P'){
            echo "Perempuan";
        }else{
            echo "";
        }
        ?>
        </option>
        <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' :'' ?>>Laki - Laki</option>
        <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' :'' ?>>Perempuan</option>

        </select>
        <div class="invalid-feedback">
        <?= $validation->getError('jenis_kelamin') ?>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Tempat Lahir</label>
        <input type="text" class="form-control d-inline  <?= $validation->hasError('lahir_tempat') ? 'is-invalid' :'' ?>" name="lahir_tempat"
        value="<?= old(('lahir_tempat')) ? old('lahir_tempat') :  $family['lahir_tempat'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('lahir_tempat') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tanggal Lahir</label>
        <input type="date" class="form-control <?= $validation->hasError('lahir_tanggal') ? 'is-invalid' :'' ?>" name="lahir_tanggal"
        value="<?=  old(('lahir_tanggal')) ? old('lahir_tanggal') :  $family['lahir_tanggal'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('lahir_tanggal') ?>
            </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Pekerjaan</label>
        <select id="" class="theSelect form-control d-inline <?= $validation->hasError('pekerjaan') ? 'is-invalid' :'' ?>" name="pekerjaan">

            <option value="<?= $family['pekerjaan'] ?>"><?php 
            if($family['pekerjaan'] == 1){
                echo "Pegawai Negeri";
            }elseif($family['pekerjaan'] == 2){
                echo "Pegawai Swasta";
            }elseif($family['pekerjaan'] == 3){
                echo "Ibu Rumah Tangga";
            }elseif($family['pekerjaan'] == 4){
                echo "Wiraswasta";
            }else{
                echo "Belum Bekerja";
            } 
            ?></option>
            <option value="1" <?= old('pekerjaan') == '1' ? 'selected' : '' ?>>Pegawai Negeri</option>
            <option value="2" <?= old('pekerjaan') == '2' ? 'selected' : '' ?>>Pegawai Swasta</option>
            <option value="3" <?= old('pekerjaan') == '3' ? 'selected' : '' ?>>Ibu Rumah Tangga</option>
            <option value="4" <?= old('pekerjaan') == '4' ? 'selected' : '' ?>>Wiraswasta</option>
            </select>
            <div class="invalid-feedback">
            <?= $validation->getError('pekerjaan') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Pendidikan</label>
        <select id="" class="theSelect form-control d-inline <?= $validation->hasError('pendidikan') ? 'is-invalid' :'' ?>" name="pendidikan">

            <option value="<?= $family['pendidikan'] ?>"><?php 
            if($family['pendidikan'] == 1){
                echo "SD";
            }elseif($family['pendidikan'] == 2){
                echo "SMP";
            }elseif($family['pendidikan'] == 3){
                echo "SMA";
            }elseif($family['pendidikan'] == 4){
                echo "STRATA 1";
            }elseif($family['pendidikan'] == 5){
                echo "STRATA 2";
            }elseif($family['pendidikan'] == 6){
                echo "DOKTORAL";
            }else{
                echo "TK/Belum Bersekolah";
            } 
            ?></option>
            <option value="1"  <?= old('pendidikan') == '1' ? 'selected' : '' ?>>SD</option>
            <option value="2"  <?= old('pendidikan') == '2' ? 'selected' : '' ?>>SMP</option>
            <option value="3"  <?= old('pendidikan') == '3' ? 'selected' : '' ?>>SMA</option>
            <option value="4"  <?= old('pendidikan') == '4' ? 'selected' : '' ?>>Strata 1</option>
            <option value="5"  <?= old('pendidikan') == '5' ? 'selected' : '' ?>>Strata 2</option>
            <option value="6"  <?= old('pendidikan') == '6' ? 'selected' : '' ?>>Doktoral</option>
            </select>
            <div class="invalid-feedback">
            <?= $validation->getError('pendidikan') ?>
            </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Jurusan</label>
        <input type="text" class="form-control d-inline <?= $validation->hasError('jurusan') ? 'is-invalid' :'' ?>" name="jurusan" 
        value="<?=  old(('jurusan')) ? old('jurusan') :  $family['jurusan'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('jurusan') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Asal Sekolah</label>
        <input type="text" class="form-control <?= $validation->hasError('sekolah_nama') ? 'is-invalid' :'' ?>" name="sekolah_nama"
        value="<?=  old(('sekolah_nama')) ? old('sekolah_nama') :  $family['sekolah_nama'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('sekolah_nama') ?>
        </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Alamat Sekolah asal</label>
        <input type="text" class="form-control d-inline <?= $validation->hasError('sekolah_alamat') ? 'is-invalid' :'' ?>" name="sekolah_alamat"
        value="<?= old(('sekolah_alamat')) ? old('sekolah_alamat') : $family['sekolah_alamat'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('sekolah_alamat') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor Telephone</label>
        <input type="text" class="form-control <?= $validation->hasError('no_tlp') ? 'is-invalid' :'' ?>"  name="no_tlp"
        value="<?= old(('no_tlp')) ? old('no_tlp') : $family['no_tlp'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('no_tlp') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor Telephone2</label>
        <input type="text" class="form-control <?= $validation->hasError('no_tlp2') ? 'is-invalid' :'' ?>" name="no_tlp2"
        value="<?= old(('no_tlp2')) ? old('no_tlp2') : $family['no_tlp2'] ?>">
        <div class="invalid-feedback">
        <?= $validation->getError('no_tlp2') ?>
        </div>
        </div>
    </div>
<hr>

<button type="submit" class="btn btn-outline-info" > <i class="fas fa-edit" ></i> Ubah Data </button>
</form>
</div>
</div>
<script type="text/javascript">
       $(".theSelect").select2();
</script>
</div>