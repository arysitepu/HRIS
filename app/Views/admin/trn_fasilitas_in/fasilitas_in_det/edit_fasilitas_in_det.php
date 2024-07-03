<div class="container-fluid">
   
     <div class="card shadow mb-4 col-md-10" style="margin: auto;">

     
    <?php if(session()->getFlashdata('pesan')) : ?>

<div class="alert alert-success">
  <?= session()->getFlashdata('pesan') ?>
</div>

<?php endif; ?>

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

        <div class="card-header">
            <h5 class="text-center"> <b> Tambah Data Fasilitas</b></h5>
        </div>

    <div class="card-body">
    
    <a href="/fasilitas_in/detail_fasilitas_in/<?= $fasilitas_in_det['trn_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke Detail</a>
<form action="/fasilitas_in_det/update_detail/<?= $fasilitas_in_det['id'] ?>" method="post">
<?= csrf_field() ?>
<input type="text" name="id" value="<?= $fasilitas_in_det['id'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_in_det['trn_no'] ?>" readonly name="trn_id">
        <input type="hidden" class="form-control d-inline" value="<?= $fasilitas_in_det['trn_id'] ?>" readonly name="trn_id">
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Qty </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_in_det['qty'] ?>" name="qty">
        <div class="invalid-feedback">
           
        </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Jenis Fasilitas </label>
         <select name="facility_id" id="" class="form-control">
   
            <option value="<?= $fasilitas_in_det['facility_id'] ?>"><?= $fasilitas_in_det['facility_name'] ?></option>

            <?php foreach($mst_fasilitas as $mst_fasilitas) : ?>
            <option value="<?= $mst_fasilitas['facility_id'] ?>"><?= $mst_fasilitas['facility_name'] ?> // <?= $mst_fasilitas['facility_code'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline"> Kegunaan </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_in_det['kegunaan_detail'] ?>" name="kegunaan">
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>

<hr>

    <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Simpan Data </button>
</form>

    </div>

     </div>

</div>