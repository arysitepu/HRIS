<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Add contact karyawan</h3>
        <a href="/contact_employee/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>

    <div class="card shadow">
        <div class="card-body">
        <form action="/contact_employee/save_contact" method="post">
            <div class="row">
                <div class="col">
                <label for="">Karyawan</label>
                        <select
                            class="selField form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>"
                            name="employee_id">
                            <option value="">Pilih</option>
                            <?php foreach ($karyawan as $kry) : ?>
                            <option value="<?= $kry['employee_id'] ?>"
                                <?= old('employee_id') == $kry['employee_id'] ? 'selected' : ''; ?>>
                                <?= $kry['employee_name']?></option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('employee_id') ?>
                        </div>
                </div>
                <div class="col">
                        <label for="inputPassword4">Jenis Contact</label>
                        <select
                            class="selField form-control <?= ($validation->hasError('contact_type')) ? 'is-invalid' :'' ?>"
                            name="contact_type" value="">
                            <option value="">Pilih</option>
                            <option value="1" <?= old('contact_type') == '1' ? 'selected' : '' ?>>Ayah</option>
                            <option value="2" <?= old('contact_type') == '2' ? 'selected' : '' ?>>Ibu</option>
                            <option value="3" <?= old('contact_type') == '3' ? 'selected' : '' ?>>Kakak</option>
                            <option value="4" <?= old('contact_type') == '4' ? 'selected' : '' ?>>Adik</option>
                            <option value="5" <?= old('contact_type') == '5' ? 'selected' : '' ?>>Saudara</option>
                            <option value="6" <?= old('contact_type') == '6' ? 'selected' : '' ?>>Suami</option>
                            <option value="7" <?= old('contact_type') == '7' ? 'selected' : '' ?>>Istri</option>
                            <option value="8" <?= old('contact_type') == '8' ? 'selected' : '' ?>>Anak</option>
                        </select>
 
                        <div class="invalid-feedback">
                            <?= $validation->getError('contact_type') ?>
                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                        <label for="inputPassword4">Nama Contact</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('contact_name')) ? 'is-invalid' : ''; ?>"
                            name="contact_name" value="<?= old('contact_name') ?>">
 
                        <div class="invalid-feedback">
                            <?= $validation->getError('contact_name') ?>
                        </div>
                </div>
                <div class="col">
                        <label for="inputPassword4">Jenis Kelamin</label>
                        <select
                            class="selField form-control <?=($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>"
                            name="jenis_kelamin" value="">
                            <option value="">Pilih</option>
                            <option value="L" <?= old('jenis_kelamin') == 'L' ? 'selected' : '' ?>>Laki - Laki</option>
                            <option value="P" <?= old('jenis_kelamin') == 'P' ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis_kelamin') ?>
                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                        <label for="inputPassword4">Tempat Lahir</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('lahir_tempat')) ? 'is-invalid' :'' ?>"
                            name="lahir_tempat" value="<?= old('lahir_tempat') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('lahir_tempat') ?>
                        </div>
                </div>
                <div class="col">
                        <label for="inputPassword4">Tanggal Lahir</label>
                        <input type="date"
                            class="form-control <?= ($validation->hasError('lahir_tanggal')) ? 'is-invalid' :'' ?>"
                            name="lahir_tanggal" value="<?= old('lahir_tanggal') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('lahir_tanggal') ?>
                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                        <label for="inputPassword4">Pekerjaan</label>
                        <select
                            class="form-control <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' :'' ?>"
                            name="pekerjaan" value="">
                            <option value="">Pilih</option>
                            <option value="1" <?= old('pekerjaan') == '1' ? 'selected' : '' ?>>Ibu rumah tangga</option>
                            <option value="2" <?= old('pekerjaan') == '2' ? 'selected' : '' ?>>Pegawai Swasta</option>
                            <option value="3" <?= old('pekerjaan') == '3' ? 'selected' : '' ?>>Pegawai Negeri</option>
                            <option value="4" <?= old('pekerjaan') == '4' ? 'selected' : '' ?>>Wiraswasta</option>
                            <option value="5" <?= old('pekerjaan') == '5' ? 'selected' : '' ?>>Pelajar</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('pekerjaan') ?>
                        </div>
                </div>
                <div class="col">
                        <label for="inputPassword4">Nomor Handphone</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' :'' ?>"
                            name="no_tlp" value="<?= old('no_tlp') ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_tlp') ?>
                        </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="inputPassword4">Nomor Hanphone 2</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('no_tlp2')) ? 'is-invalid' :'' ?>"
                        name="no_tlp2" value="<?= old('no_tlp2') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('no_tlp2') ?>
                    </div>
                </div>
                <div class="col">
                    <label for="inputPassword4">Alamat Tinggal</label>
                    <input type="text"
                        class="form-control <?= ($validation->hasError('alamat_tinggal')) ? 'is-invalid' :'' ?>"
                        name="alamat_tinggal" value="<?= old('alamat_tinggal') ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('alamat_tinggal') ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="inputEmail4">Kecamatan</label>
                    <select
                        class="selField form-control <?= ($validation->hasError('kecamatan_id')) ? 'is-invalid' :'' ?> "
                        name="kecamatan_id">
                        <option value="">Pilih</option>

                        <?php foreach ($kecamatan as $kec) : ?>
                        <option value="<?= $kec['kecamatan_id'] ?>"
                            <?= old('kecamatan_id') == $kec['kecamatan_id'] ? 'selected' : '' ?>>
                            <?= $kec['kecamatan_distrik']?></option>
                        <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('kecamatan_id') ?>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col">
                <button type="submit" class="btn btn-outline-success">Simpan</button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".selField").select2();
</script>