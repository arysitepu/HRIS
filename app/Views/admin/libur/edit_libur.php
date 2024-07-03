<div class="container-fluid">
<div class="d-flex justify-content-between">
    <h3>Edit Libur</h3>
    <a href="/libur/index" class="btn btn-outline-success mb-3"><i class="fas fa-arrow-left"></i> Back</a>

</div>

<div class="card shadow">

    <form action="/libur/update_libur/<?= $libur['id_libur'] ?>" method="post">
            <?= csrf_field() ?>
            <input type="hidden" value="<?= $libur['id_libur'] ?>" name="id_libur">
          <div class="modal-body">
                    <div class="row">
                        <div class="col">
                        <label for="" class="font-weight-bold">Jenis Libur</label>
                        <input type="text" class="form-control <?= ($validation->hasError('jenis_libur')) ? 'is-invalid' : '' ?>" name="jenis_libur" 
                        value="<?= $libur['jenis_libur'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('jenis_libur') ?>
                        </div>
                        </div>
                        <div class="col">
                            <label for="" class="font-weight-bold">Tanggal Libur</label>
                            <input type="date" class="form-control <?= ($validation->hasError('tgl_libur')) ? 'is-invalid' : '' ?>" name="tgl_libur"
                            value="<?= $libur['tgl_libur'] ?>">
                            <div class="invalid-feedback">
                                <?= $validation->getError('tgl_libur') ?>
                            </div>
                        </div>
                    </div>
            
          </div>
            <button type="submit" class="btn btn-outline-primary ml-3 mb-3"> <i class="fas fa-edit"></i> Update</button>
         
          </form>
</div>
</div>
