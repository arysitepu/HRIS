<div class="container-fluid">

<a href="/dokumen/index" class="btn btn-success mb-3">Kembali ke table</a>

<div class="card">
    <div class="card-header">
        <h3>Edit Data</h3>
    </div>

    <div class="card-body">
    <form action="/dokumen/update_dokumen/<?= $dokumen['id_dokumen'] ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id_dokumen" value="<?= $dokumen['id_dokumen'] ?>">
    <input type="hidden" name="dokumen_lama" value="<?= $dokumen['dokumen'] ?>">
                <div class="row">
                    <div class="col">
                    <label for="">Nama Dokumen</label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_dokumen')) ? 'is-invalid' : ''; ?>" name="nama_dokumen" value="<?= $dokumen['nama_dokumen'] ?>">
                    <div id="" class="invalid-feedback">
                      <?= $validation->getError('nama_dokumen') ?>
                    </div>
                    </div>
                    <div class="col">
                    <label for="">Upload</label>
                    <input type="file" class="form-control" name="dokumen" value="<?= $dokumen['dokumen'] ?>">
                    <br>
                    <div class="card">
                        <?= $dokumen['dokumen'] ?>
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                    <label for="">Deskripsi</label>
                    <textarea type="text" class="form-control" name="deskripsi"> <?= $dokumen['deskripsi'] ?></textarea>
                    </div>
                    
                </div>
        
      </div>
      <div class="modal-footer">
       
        <button type="submit" class="btn btn-primary"> <i class="fas fa-edit"></i> Update</button>
      </div>
      </form>
    </div>
</div>

</div>