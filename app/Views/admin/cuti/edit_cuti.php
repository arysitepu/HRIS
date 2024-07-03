<style>
  .hidden-file {
    display: none;
  }
</style>

<div class="container-fluid">
   
    
    <?php if(session()->getFlashdata('pesan')) { ?>
    
      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>
    
      <?php }elseif(session()->getFlashdata('pesan_error')){?>
        <div class="alert alert-danger">
        <?= session()->getFlashdata('pesan_error') ?>
      </div>
      <?php } ?>
      <div class="d-flex justify-content-between">
        <h3>Edit Attendance</h3>
        <a href="/trn_cuti/index/" class="btn btn-outline-success mb-3" > <i class="fas fa-arrow-left"></i> Back </a>
      </div>
     <div class="card shadow">

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>


    <div class="card-body">
    
<form action="/trn_cuti/update_cuti/<?= $cuti['trn_id'] ?>" method="post" enctype="multipart/form-data">
<?= csrf_field() ?>
<input type="hidden" name="trn_id" value="<?= $cuti['trn_id'] ?>">
<input type="hidden" name="gambar_lama_sakit" value="<?= $cuti['gambar_sakit'] ?>">
<div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
      <input type="text" class="form-control" name="trn_no" value="<?= $cuti['trn_no'] ?>" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
      <input type="date" class="form-control" name="trn_date" value="<?= $cuti['trn_date'] ?>" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nama Karyawan </label>
       <input type="text" class="form-control" value="<?= $cuti['employee_name'] ?>" readonly>
       <input type="hidden" class="form-control" name="employee_id" value="<?= $cuti['employee_id'] ?>" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Posisi </label>
        <input type="text" class="form-control" value="<?= $cuti['position_name'] ?>" disabled>
        <input type="hidden" class="form-control" name="position_id" value="<?= $cuti['position_id'] ?>" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">SBU</label>
        <input type="text" class="form-control" value="<?= $cuti['branch_name'] ?>" disabled>
        <input type="hidden" class="form-control" name="branch_id" value="<?= $cuti['branch_id'] ?>">
        </div>

        <div class="col">
        <label for="" class="d-inline">Jenis Cuti</label>
        <input type="text" class="form-control" value="<?= $cuti['cuti_name'] ?>" disabled>
        <input type="hidden" class="form-control" name="cuti_id" value="<?= $cuti['cuti_id']?>">
        </div>
       
    </div>
    <hr>

    <div class="row">

<div class="col">
    <label for="" class="">Jumlah Cuti</label>
   <input type="text" class="form-control" name="cuti_jumlah" value="<?= $cuti['cuti_jumlah'] ?>">
   <span class="text-danger" style="font-size: 12px;"> (Diisi apabila hanya mengambil cuti tahunan) </span>
</div>

<div class="col">
    <label for="">Hak Cuti</label>
     <input type="text" class="form-control" name="hak_cuti" value="<?= $cuti['hak_cuti'] ?>">
    <div class="invalid-feedback">
       
    </div>
    </div>
   
</div>
<hr>

    <div class="row">

    <div class="col">
        <label for="">Tanggal Sampai</label>
         <input type="date" class="form-control" name="tgl_dari" value="<?= $cuti['tgl_dari'] ?>">
        <div class="invalid-feedback">
           
        </div>
        </div>

    <div class="col">
        <label for="">Tanggal Sampai</label>
         <input type="date" class="form-control" name="tgl_sampai" value="<?= $cuti['tgl_sampai'] ?>">
        <div class="invalid-feedback">
           
        </div>
        </div>
       
    </div>
<hr>

<div class="row">

<div class="col">
    <label for="" class="d-inline">Serah kerja kepada</label>
   <input type="text" class="form-control" name="serah_kerja" value="<?= $cuti['serah_kerja'] ?>">
</div>

<div class="col">
    <label for="" class="d-inline">Alamat Cuti</label>
   <input type="text" class="form-control" name="alamat_cuti" value="<?= $cuti['alamat_cuti'] ?>">
</div>

   
</div>
<hr>

<div class="row">
        <div class="col">
        <label for="" class="d-inline"> Membuat </label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $cuti['employee_id_buat'] ?>"><?= $cuti['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Menyetujui </label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $cuti['employee_id_setuju'] ?>"><?= $cuti['setuju_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

<div class="row">
    
<div class="col">
        <label for="" class="d-inline"> Deskripsi </label>
        <textarea name="cuti_desc" id="" class="form-control"> <?= $cuti['cuti_desc'] ?> </textarea>
        <div class="invalid-feedback">
           
        </div>
        </div>

        <?php if($cuti['cuti_id'] == 2){ ?>
        <div class="col">
            <label for="">Upload bukti surat sakit</label>
            
            <input type="file" class="form-control <?= ($validation->hasError('gambar_sakit')) ? 'is-invalid' : '' ?>" name="gambar_sakit" value="<?= $cuti['gambar_sakit'] ?>"
            placeholder="<?= $cuti['gambar_sakit'] ?>">

            <div class="invalid-feedback">
            <?= $validation->getError('gambar_sakit') ?>
            </div>
        </div>
        <?php }else{ ?>
            <input type="file" class="hidden-file" name="gambar_sakit" value="">
            <?php } ?>
</div>

<hr>

<div class="row mb-3">
    <div class="col">
    <?php if($cuti['gambar_sakit'] != null){ ?>
    <button type="button" data-toggle="modal" data-target="#modalGambar">
        <img class="avatar2" src="/img/<?= $cuti['gambar_sakit'] ?>" alt="">
    </button> <span> Bukti surat sakit</span>
    <?php }else{ ?>
        Belum di upload gambar
        <?php } ?>
    </div>
</div>

    <button type="submit" class="btn btn-success"> <i class="fas fa-edit"></i> Update Data </button>
</form>

<br>

    </div>

     </div>

     <!-- modal gambar -->
<div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Surat Sakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <img class="" src="/img/<?= $cuti['gambar_sakit'] ?>" alt="">
      </div>
    </div>
  </div>
</div>
<!-- batas -->


</div>