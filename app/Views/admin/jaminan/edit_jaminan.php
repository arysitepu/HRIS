<div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h3 class="text-center"> Edit Data Jaminan </h3>
        <a href="/jaminan/index/" class="btn btn-outline-success" > <i class="fas fa-arrow-left"></i> Back </a>
        </div>

        <?php if(session()->getFlashdata('pesan')) : ?>

        <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
        </div>

        <?php endif; ?>

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>


     <div class="card shadow mb-4">
    <div class="card-body">
<form action="/jaminan/update_jaminan/<?= $jaminan['trn_id'] ?>" method="post" enctype="multipart/form-data">
<?= csrf_field() ?>
<input type="hidden" value="<?= $jaminan['trn_id'] ?>" name="trn_id">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $jaminan['trn_no'] ?>" name="trn_no" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Tanggal Dokumen </label>
        <input type="date" class="form-control d-inline" value="<?= $jaminan['trn_date'] ?>" name="trn_date" readonly>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="d-inline"> Jenis jaminan </label>
        <select name="type_id" id="" class="form-control">
            <option value="<?= $jaminan['type_id'] ?>"><?= $jaminan['type_name'] ?></option>

            <?php foreach($type as $type) : ?>
            <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
           
        </div>

        
        </div> 

        <div class="col">
        <label for="" class="d-inline"> Nama Jaminan </label>
        <input type="text" class="form-control d-inline" value="<?= $jaminan['jaminan_name'] ?>" name="jaminan_name">
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
<hr>

    <div class="row">

    <div class="col">
        <label for="" class="d-inline">Nama Karyawan</label>
        <select name="employee_id" id="" class="form-control">
            <option value="<?= $jaminan['employee_id'] ?>"><?= $jaminan['employee_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Dibuat</label>
        <select name="employee_id_buat" id="" class="form-control">
            <option value="<?= $jaminan['employee_id_buat'] ?>"><?= $jaminan['buat_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
        <div class="col">
        <label for="" class="d-inline">Disetujui</label>
        <select name="employee_id_setuju" id="" class="form-control">
            <option value="<?= $jaminan['employee_id_setuju'] ?>"><?= $jaminan['setuju_name'] ?></option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>
    </div>
    <hr>

    <div class="row">
    <div class="col">
        <label for="" class="d-inline"> Tanggal serah </label>
        <input type="date" class="form-control d-inline" value="<?= $jaminan['tgl_serah'] ?>" name="tgl_serah">
        <div class="invalid-feedback">
           
        </div>
        </div>

        <div class="col">
            <label for="" class="d-inline">Upload Gambar</label>
            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar">
            <input type="hidden" name="gambar_lama" value="<?= $jaminan['gambar'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('gambar') ?>
            </div>
        </div>
    </div>
<hr>
<div class="row">
<div class="col">
        <label for="" class="d-inline"> Status </label>
       <select name="status" id="" class="form-control">
            <option value="<?= $jaminan['status'] ?>">
            <?= ($jaminan['status'] == 1) ? 'Penyerahan' : '' ?>
            <?= ($jaminan['status'] == 2) ? 'Peminjaman' : '' ?>
            <?= ($jaminan['status'] == 3) ? 'Pengembalian' : '' ?>
        </option>

        <option value="1">Penyerahan</option>
        <option value="2">Peminjaman</option>
        <option value="3">Pengembalian</option>

       </select>
        <div class="invalid-feedback">
           
        </div>
        </div>

   

</div>
<hr>

<div class="row">
    <div class="col">
        <label for="" class="d-inline"> Deskripsi jaminan </label>
        <textarea type="date" class="form-control d-inline" name="jaminan_desc"> <?= $jaminan['jaminan_desc'] ?> </textarea>
        <div class="invalid-feedback">
           
        </div>
        </div>
    </div>
<hr>

<div class="row mb-3">
<div class="col">
        <img src="/img/<?= $jaminan['gambar'] ?>" alt="" class="img-thumbnail img-detail">
    </div>
</div>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-edit"></i> Update </button>
</form>

    </div>

     </div>

</div>