<div class="container-fluid">
<div class="d-flex justify-content-between mb-3">
    <h3 class="">Tambah Keluarga Karyawan</h3>
    <a href="/family/index" class="btn btn-outline-success"><i class="fas fa-arrow-left"></i> Back </a>
</div>
<div class="card shadow">
<div class="card-body">
<form action="/family/save_family" method="post">
<?php csrf_field()  ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select id="inputState" class="theSelect form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>" name="employee_id">
                <option value="">Pilih</option>

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
        <input type="text" class="form-control <?= ($validation->hasError('family_name')) ? 'is-invalid' : '' ?>" name="family_name"
        value="<?= old('family_name') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('family_name') ?>
            </div>
        </div>
    </div>
<hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline">Hubungan Keluarga</label>
        <select id="" class="theSelect form-control d-inline <?= ($validation->hasError('family_type')) ? 'is-invalid' : '' ?>" name="family_type">

            <option value="">Pilih</option>
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
        <select id="" class="theSelect form-control d-inline  <?= ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>" name="jenis_kelamin">

        <option value="">Pilih</option>
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
        <input type="text" class="form-control d-inline <?= ($validation->hasError('lahir_tempat')) ? 'is-invalid' : '' ?>" name="lahir_tempat"
        value="<?= old('lahir_tempat') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('lahir_tempat') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Tanggal Lahir</label>
        <input type="date" class="form-control <?= ($validation->hasError('lahir_tanggal')) ? 'is-invalid' : '' ?>"  name="lahir_tanggal"
        value="<?= old('lahir_tanggal') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('lahir_tanggal') ?>
            </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Pekerjaan</label>
        <select id="" class="theSelect form-control d-inline <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' : '' ?>" name="pekerjaan">

            <option value="">Pilih</option>
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
        <select id="" class="theSelect form-control d-inline <?= ($validation->hasError('pendidikan')) ? 'is-invalid' : '' ?>" name="pendidikan">

            <option value="">Pilih</option>
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
        <input type="text" class="form-control d-inline <?= ($validation->hasError('jurusan')) ? 'is-invalid' : '' ?>" name="jurusan" 
        value="<?= old('jurusan') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('jurusan') ?>
            </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Asal Sekolah</label>
        <input type="text" class="form-control <?= ($validation->hasError('sekolah_nama')) ? 'is-invalid' : '' ?>" name="sekolah_nama"
        value="<?= old('sekolah_nama') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('sekolah_nama') ?>
        </div>
        </div>
    </div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline">Alamat Sekolah asal</label>
        <input type="text" class="form-control d-inline <?= ($validation->hasError('sekolah_alamat')) ? 'is-invalid' : '' ?>" name="sekolah_alamat"
        value="<?= old('sekolah_alamat') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('sekolah_alamat') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor Telephone</label>
        <input type="text" class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' : '' ?>"  name="no_tlp"
        value="<?= old('no_tlp') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('no_tlp') ?>
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Nomor Telephone2</label>
        <input type="text" class="form-control <?= ($validation->hasError('no_tlp2')) ? 'is-invalid' : '' ?>" name="no_tlp2"
        value="<?= old('no_tlp2') ?>">
        <div class="invalid-feedback">
                <?= $validation->getError('no_tlp2') ?>
        </div>
        </div>
    </div>
<hr>

<button type="submit" class="btn btn-outline-info" > <i class="fas fa-save" ></i> Simpan Data </button>
</form>
<script type="text/javascript">
       $(".theSelect").select2();
</script>
</div>
</div>

</div>