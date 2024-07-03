<div class="container-fluid">
  
  <div class="mb-3 d-flex justify-content-between">
       <h3>Detail Achievement</h3>
       <?php if(session()->get('user_level') == 'admin') : ?>
        <a href="/trn_achivement/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
        <?php elseif(session()->get('user_level') == 'user') : ?>
          <a href="/karyawan/detail_karyawan_kantor/<?= $achivement['employee_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
        <?php endif; ?>
    </div>

    <div class="card">
    <div class="row mt-3 mb-3 col-md-12">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
       
      <img class="avatar" width="150px" src="/img/<?= $achivement['gambar_karyawan'] ?>">
      </div>
    </div>
  </div>
  <div class="col-sm-9">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Detail karyawan</h5>
        <hr>
        <div class="row">
            <div class="col">
                <label for="">Nama karyawan: </label>
                <?= $achivement['employee_name'] ?>
            </div>

            <div class="col">
                <label for="">Jenis Penghargaan: </label>
                <?= $achivement['name'] ?>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col">
                <label for="">Jabatan: </label>
                <?= $achivement['position_name'] ?>
            </div>

            <div class="col">
                <label for="">SBU: </label>
                <?= $achivement['branch_name'] ?>
            </div>
        </div>

        <hr>
        <div class="row">
          <div class="col">
            <label for="">Certificate: </label>
            <?php if($achivement['gambar'] != null) : ?>
            <img src="/img/<?= $achivement['gambar'] ?>" alt="" class="img-thumbnail">
            <?php else : ?>
              <span class="text-danger">Gambar belum diupload</span>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        </div>

</div>