<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Edit Contact Karyawan</h3>
        <a href="/contact_employee/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i>  Back </a>
    </div>
    <div class="card shadow">
        <div class="card-body">
        <form action="/contact_employee/update_contact/<?= $contact['id'] ?>" method="post">
        <input type="hidden" name="id" value="<?= $contact['id'] ?>">
        <div class="row">
            <div class="col">
            <label for="inputEmail4">Karyawan</label>
            <select id="" class="selField form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' : '' ?>" name="employee_id" value="">
                <option value="<?= $contact['employee_id'] ?>"><?= $contact['employee'] ?></option>

                <?php foreach ($karyawan as $kry) : ?>
                <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name']?></option>
              <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('employee_id') ?>
            </div>
            </div>
            <div class="col">
            <label for="inputPassword4">Jenis Contact</label>
             <select id="" class="selField form-control <?= ($validation->hasError('contact_type')) ? 'is-invalid' :'' ?>" name="contact_type" value="" name="contact_type">
                <option value="<?= $contact['contact_type'] ?>">
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
              </option>
                <option value="1">Ayah</option>
                <option value="2">Ibu</option>
                <option value="3">Kakak</option>
                <option value="4">Adik</option>
                <option value="5">Saudara</option>
                <option value="6">Suami</option>
                <option value="7">Istri</option>
                <option value="8">Anak</option>
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
            <input type="text" class="form-control <?= ($validation->hasError('contact_name')) ? 'is-invalid' : ''; ?>" name="contact_name" value="<?= $contact['contact_name'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('contact_name') ?>
            </div>
            </div>
            <div class="col">
            <label for="inputPassword4">Jenis Kelamin</label>
            <select id="" class="form-control <?=   ($validation->hasError('jenis_kelamin')) ? 'is-invalid' : '' ?>" name="jenis_kelamin" value="">
                <option value="<?= $contact['jenis_kelamin'] ?>">
                <?php 
                            if($contact['jenis_kelamin'] == 'L'){
                                echo 'Laki - Laki';
                            }elseif($contact['jenis_kelamin'] == 'P'){
                                echo 'Perempuan';
                            }else{
                                echo "";
                            }
                            ?>
                </option>
                <option value="L">Laki - Laki</option>
                <option value="P">Perempuan</option>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('jenis_kelamin') ?>
            </div>
            </div>
            <div class="col">
                <label for="inputPassword4">Tempat Lahir</label>
                <input type="text" class="form-control <?= ($validation->hasError('lahir_tempat')) ? 'is-invalid' :'' ?>" name="lahir_tempat" value="<?= $contact['lahir_tempat'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('lahir_tempat') ?>
                </div>
            </div>
        </div>
    <hr>
        <div class="row">
            <div class="col">
                <label for="inputPassword4">Tanggal Lahir</label>
                <input type="date" class="form-control <?= ($validation->hasError('lahir_tanggal')) ? 'is-invalid' :'' ?>" name="lahir_tanggal" value="<?= $contact['lahir_tanggal'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('lahir_tanggal') ?>
                </div>
            </div>
            <div class="col">
                    <label for="inputPassword4">Pekerjaan</label>
                    <select id="" class="selField form-control <?= ($validation->hasError('pekerjaan')) ? 'is-invalid' :'' ?>" name="pekerjaan" value="">
                        <option value="<?= $contact['pekerjaan'] ?>">
                        <?php 
                                    if($contact['pekerjaan'] == 1){
                                        echo "Ibu Rumah Tangga";
                                    }elseif($contact['pekerjaan'] == 2){
                                        echo "Pegawai Swasta";
                                    }elseif($contact['pekerjaan'] == 3){
                                        echo "Pegawai Negeri";
                                    }elseif($contact['pekerjaan'] == 4){
                                        echo "Wiraswasta";
                                    }elseif($contact['pekerjaan'] == 5){
                                        echo "Pelajar";
                                    }else{
                                        echo "";
                                    }
                                    ?>
                    </option>
                        <option value="1">Ibu rumah tangga</option>
                        <option value="2">Pegawai Swasta</option>
                        <option value="3">Pegawai Negeri</option>
                        <option value="4">Wiraswasta</option>
                        <option value="5">Pelajar</option>
                    </select>
                    <div class="invalid-feedback">
                        <?= $validation->getError('pekerjaan') ?>
                    </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="">Nomor Handphone</label>
                <input type="text" class="form-control <?= ($validation->hasError('no_tlp')) ? 'is-invalid' :'' ?>" name="no_tlp" value="<?= $contact['no_tlp'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('no_tlp') ?>
                </div>
            </div>
            <div class="col">
            <label for="inputPassword4">Nomor Hanphone 2</label>
            <input type="text" class="form-control <?= ($validation->hasError('no_tlp2')) ? 'is-invalid' :'' ?>" name="no_tlp2" value="<?= $contact['no_tlp2'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('no_tlp2') ?>
            </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="inputPassword4">Alamat Tinggal</label>
                <input type="text" class="form-control <?= ($validation->hasError('alamat_tinggal')) ? 'is-invalid' :'' ?>" name="alamat_tinggal" value="<?= $contact['alamat_tinggal'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('alamat_tinggal') ?>
                </div>
            </div>
            <div class="col">
                <label for="inputEmail4">Kecamatan</label>
                <select id="" class="selField form-control <?= ($validation->hasError('kecamatan_id')) ? 'is-invalid' :'' ?> " name="kecamatan_id" value="">
                    <option value="<?= $contact['kecamatan_id'] ?>"><?= $contact['kecamatan'] ?></option>

                    <?php foreach ($kecamatan as $kec) : ?>
                    <option value="<?= $kec['kecamatan_id'] ?>"><?= $kec['kecamatan_distrik']?></option>
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
        <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-edit"></i> Ubah data</button>
        </div>
        </div>
        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
            $(".selField").select2();
</script>