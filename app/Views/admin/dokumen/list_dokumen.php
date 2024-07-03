<div class="container-fluid">

<?php if(session()->get('user_level') == 'admin') : ?>
<button type="button" class="btn btn-outline-primary mb-3" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-upload"></i> Upload
</button>
<?php endif; ?>
<?php 
    if(session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif; ?>


    <?php if (session()->getFlashdata('pesan_error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?= session()->getFlashdata('pesan_error'); ?>
    </div>
    <?php endif; ?>

<div class="card mt-3">
    <div class="card-header">
      <h3>List Dokumen</h3>
    </div>

    <div class=" card-body mt-3">

      <form action="" class="d-inline">
        <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
        <input class="form-control col-md-2 d-inline float-right mtb-3" name="keyword" placeholder="search by name">
      </form>
    </div>
<div class="card-body">

<div class="alert alert-success">
  <b>Jumlah Dokumen = <?= $jumlah_dokumen ?></b> 
</div>
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Name</th>
      <th scope="col">Dokumen</th>
    </tr>
  </thead>
<?php
$no =1;
?>

<?php foreach($dokumen as $doc) : ?>
  <tbody id="myTable">
    <tr>
      <th scope="row"><?= $nomor++ ?></th>
      <td><?= $doc['nama_dokumen'] ?></td>
      <td class="text-center"> 
        <a href="/dokumen/download/<?= $doc['id_dokumen'] ?>" class="btn btn-success"><i class="fas fa-download"></i> Download</a>
        <?php if(session()->get('user_level') == 'admin') : ?>
        <a href="/dokumen/edit/<?= $doc['id_dokumen'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>
        <form action="/dokumen/<?= $doc['id_dokumen'] ?>" method="post" class="d-inline">
        <input type="hidden" name="_method" value="delete">
          <button type="submit" class="btn btn-danger" title="hapus" onclick="return confirm('apakah anda yakin?');"> <i class="fas fa-trash"></i> </button>
        </form>  
        <?php endif; ?>
      </td>
      
    </tr>
  </tbody>

  <?php endforeach ?>
</table>

<div class="">
  <?= $pager->links('default', 'custom_pagination') ?>
</div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload dokumen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="/dokumen/save_dokumen" method="POST" enctype="multipart/form-data">
    <div class="row">
        <div class="col">
            <label for="nama_dokumen">Nama Dokumen</label>
            <input type="text" class="form-control <?= ($validation->hasError('nama_dokumen')) ? 'is-invalid' : ''; ?>" name="nama_dokumen">
            <div class="invalid-feedback">
                <?= $validation->getError('nama_dokumen') ?>
            </div>
        </div>
        <div class="col">
            <label for="dokumen">Upload</label>
            <input type="file" class="form-control <?= ($validation->hasError('dokumen')) ? 'is-invalid' : ''; ?>" name="dokumen">
            <div class="invalid-feedback">
                <?= $validation->getError('dokumen') ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="deskripsi">Deskripsi</label>
            <textarea class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" name="deskripsi"></textarea>
            <div class="invalid-feedback">
                <?= $validation->getError('deskripsi') ?>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
    </div>
  </div>
</div>

</div>

