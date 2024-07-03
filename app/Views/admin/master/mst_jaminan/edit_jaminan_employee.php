<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

                    <div class="card-header">
                        <h5 class="text-center"> <b> Form Tambah Jaminan</b></h5>
                    </div>
    <form action="/mst_jaminan/update_jaminan/<?= $mst_jaminan['id'] ?>" method="post">
<?= csrf_field(); ?>
        <div class="card-body">
                <a href="/mst_jaminan/index" class="btn btn-success mb-3 ml-3" >Kembali ke Table</a>
                <input type="hidden" value="<?= $mst_jaminan['id'] ?>" name="id">

                <div class="row">
                    <div class="col">
                    <label for="" class="d-inline">Nama Karyawan</label>
                    <select id="inputState" class="form-control <?= ($validation->hasError('employee_id')) ? 'is-invalid' :'' ?>" name="employee_id">
                        <option value="<?= $mst_jaminan['employee_id'] ?>"><?= $mst_jaminan['employee_name'] ?></option>

                        <?php foreach ($karyawan as $kry) : ?>
                        <option value="<?= $kry['employee_id'] ?>" <?= old('employee_id') == $kry['employee_id'] ? 'selected' :'' ?>><?= $kry['employee_name']?></option>
                    <?php endforeach; ?>
                    </select>

                    <div class="invalid-feedback">
                       <?= $validation->getError('employee_id') ?>
                    </div>

                    </div>


                    <div class="col">
                    <label for="" class="d-inline">Tipe Jaminan</label>
                    <select id="inputState" class="form-control <?= ($validation->hasError('type_id')) ? 'is-invalid' : '' ?>" name="type_id">
                        <option value="<?= $mst_jaminan['type_id'] ?>"><?= $mst_jaminan['type_name'] ?></option>

                        <?php foreach ($type as $type) : ?>
                        <option value="<?= $type['type_id'] ?>"  <?= old('type_id') == $type['type_id'] ? 'selected' :'' ?> ><?= $type['type_name']?></option>
                    <?php endforeach; ?>
                    </select>
                    <div class="invalid-feedback">
                    <?= $validation->getError('type_id') ?>
                    </div>


                    </div>
                </div>
            <hr>
                <div class="row">
                <div class="col">
                <label for="" class="d-inline">Nama Jaminan</label>
                <input type="text" class="form-control <?= $validation->hasError('jaminan_name') ? 'is-invalid' :'' ?>" name="jaminan_name"
                value="<?= old(('jaminan_name')) ? old('jaminan_name') : $mst_jaminan['jaminan_name'] ?>">
                <div class="invalid-feedback">
                <?= $validation->getError('jaminan_name') ?>
                </div>
                </div>
          

                    <div class="col">
                    <label for="" class="d-inline">Deskripsi</label>
                    <input type="text" class="form-control d-inline <?= ($validation->getError('jaminan_desc')) ? 'is-invalid' : '' ?>" name="jaminan_desc"
                    value="<?= old(('jaminan_desc')) ? old('jaminan_desc') : $mst_jaminan['jaminan_desc'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('jaminan_desc') ?>
                    </div>
                    </div>
                </div>
            <hr>
                <div class="row">
                    <div class="col">
                    <label for="" class="d-inline">Nomor dokumen</label>
                    <input type="text" class="form-control d-inline text-center <?= ($validation->getError('doc_no')) ? 'is-invalid' : '' ?>" name="doc_no"
                    value="<?= old(('doc_no')) ? old('doc_no') : $mst_jaminan['doc_no'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('doc_no') ?>
                    </div>
                    </div>

                    <div class="col">
                    <label for="" class="d-inline">Tanggal Simpan</label>
                    <input type="date" class="form-control d-inline text-center <?= ($validation->getError('tanggal_simpan')) ? 'is-invalid' : '' ?>" name="tanggal_simpan"
                    value="<?= old(('tanggal_simpan')) ? old('tanggal_simpan') : $mst_jaminan['tanggal_simpan'] ?>">
                    <div class="invalid-feedback">
                    <?= $validation->getError('tanggal_simpan') ?>
                    </div>
                    </div>

                    <div class="col">
                    <label for="" class="d-inline">Tanggal Kembali</label>
                    <input type="date" class="form-control d-inline text-center" name="tanggal_kembali"
                    value="<?= old(('tanggal_kembali')) ? old('tanggal_kembali') : $mst_jaminan['tanggal_kembali'] ?>">
                    <div class="invalid-feedback">
                    
                    </div>
                    </div>

                
                

                </div>
            <br>
                <div class="row">
                    <div class="col">
                
                <button type="submit" class="btn btn-success" > <i class="fas fa-save" ></i> Simpan Data </button>
                    </div>
                

                </div>

    </div>
    </form>

</div>