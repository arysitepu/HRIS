<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Edit achivement</h3>
        <a href="/trn_achivement/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>

    <?php if(session()->getFlashdata('pesan')){ ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('pesan') ?>
    </div>
    <?php }elseif(session()->getFlashdata('pesan_error')){ ?>
    <div class="alert alert-danger">
      <?= session()->getFlashdata('pesan_error') ?>
    </div>
    <?php } ?>

    <div class="card">
        <div class="card-body">
        
       <form action="/trn_achivement/update/<?= $achivement['trn_id'] ?>" enctype="multipart/form-data" method="post">
        <?= csrf_field() ?> 

       <input type="hidden" name="trn_id" value="<?= $achivement['trn_id'] ?>">
      <div class="row">

                <div class="col">
                    <input type="text" class="form-control" value="<?= $achivement['employee_name'] ?>" readonly>
                    <input type="hidden" class="form-control" name="employee_id" value="<?= $achivement['employee_id'] ?>">
                <!-- <select name="employee_id" id="" class="form-control <?= ($validation->hasError('employee_id'))  ? 'is-invalid' : '' ?>">
                    <option value="<?= $achivement['employee_id'] ?>"><?= $achivement['employee_name'] ?></option>

                    <?php foreach($karyawan as $kry) : ?>
                    <option value="<?= $kry['employee_id'] ?>"> <?= $kry['employee_name'] ?></option>
                    <?php endforeach; ?>
                </select> -->
                <div class="invalid-feedback">
                    <?= $validation->getError('employee_id') ?>
                </div>
                </div>

                <div class="col">
                <select name="id_achive" id="" class="form-control">
                    <option value="<?= $achivement['id_achive'] ?>"><?= $achivement['name'] ?></option>

                    <?php foreach($mst_achivement as $acvhive) : ?>
                    <option value="<?= $acvhive['id_achive'] ?>"> <?= $acvhive['name'] ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
        </div>

        <hr>

        <div class="row">
        <div class="col">
                <label for="">Tahun Terima</label>
                <input type="text" id="datepicker" class="form-control" name="tahun_terima" value="<?= $achivement['tahun_terima'] ?>">
    
                <div class="invalid-feedback">
              
                </div>
            </div>
        </div>

        <hr>
        <div class="col">
            <label for="" class="d-inline">Upload gambar</label>
            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar">
            <div class="invalid-feedback">
            <?= $validation->getError('gambar') ?>
            </div>
            <input type="hidden" name="gambar_lama" value="<?= $achivement['gambar'] ?>">
        </div>
        <hr>

        <div class="row">
            <div class="col">
            <?php if($achivement['gambar'] != null) : ?>
            <img src="/img/<?= $achivement['gambar'] ?>" alt="" class="img-thumbnail img-detail">
            <?php else : ?>
              <span class="text-danger">Gambar belum diupload</span>
            <?php endif; ?>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-edit"></i> Update data </button>
            </div>
        </div>

        </form>



        </div>
    </div>
</div>