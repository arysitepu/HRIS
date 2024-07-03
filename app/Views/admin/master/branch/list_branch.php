<div class="container-fluid">

<h3>SBU</h3>

<?php if(session()->getFlashdata('pesan')){ ?>
<div class="alert alert-success">
    <?= session()->getFlashdata('pesan') ?>
</div>
<?php }elseif(session()->getFlashdata('pesan_error')){ ?>
    <div class="alert alert-danger">
    <?= session()->getFlashdata('pesan_error') ?>
</div>
<?php } ?>

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

<div class="swal_error" data-swal_error="<?= session()->get('pesan_error') ?>"></div>
    <div class="card shadow">
        <div class="card-body">

            <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"> </i> Add 
            </button>
            <form action="" class="d-inline" method="get">
                <button type="submit" class="btn btn-success float-right"> <i class="fas fa-search"></i> </button>
                <input type="text" class="form-control col-md-2 d-inline float-right" name="keyword" placeholder="search . . .">
            </form>
        <table class="table table-bordered">

        <thead>
            <tr>
            <th scope="col">No</th>
            <th scope="col">Code SBU</th>
            <th scope="col">Nama SBU</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
            
            </tr>
        </thead>

        <tbody>

        <?php foreach($branch as $sbu):  ?>
            <tr>
            <th scope="row"><?= $nomor++ ?></th>
            <td><?= $sbu['branch_code'] ?></td>
            <td><?= $sbu['branch_name'] ?></td>
            <td>
                <?php if($sbu['status'] == 'Active'){ ?>
                    <span class="badge badge-success"><?= $sbu['status'] ?></span>
                <?php }elseif($sbu['status'] == 'Not Active'){ ?>
                    <span class="badge badge-danger"><?= $sbu['status'] ?></span>
                <?php } ?>
            </td>
            <td>
            <a href="/branch/detail/<?= $sbu['branch_id'] ?>" class="btn btn-success" data-title="Detail"> <i class="fas fa-info-circle"></i> </a>
            <a href="/branch/edit/<?= $sbu['branch_id'] ?>" class="btn btn-primary" data-title="Edit Data"> <i class="fas fa-edit"></i> </a>
            <form action="/branch/<?= $sbu['branch_id'] ?>" class="d-inline" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" data-title="Hapus Data" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </button>
            </form>
            </td>
            
            </tr>

            <?php endforeach ?>
        </tbody>

        </table>
        <div class="class">
            <?= $pager->links('default', 'custom_pagination') ?>
        </div>
        </div>
    </div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/branch/save" method="post">

      <div class="modal-body">
      <div class="row">
            <div class="col">
                <label for="">Branch Code</label>
            <input type="text" class="form-control <?= ($validation->hasError('branch_code')) ? 'is-invalid' : '' ?>" name="branch_code">
            <div class="invalid-feedback">
                <?= $validation->getError('branch_code') ?>
            </div>
            </div>
            <div class="col">
            <label for="">Branch Name</label>
            <input type="text" class="form-control <?= ($validation->hasError('branch_name')) ? 'is-invalid' : '' ?>" name="branch_name">
            <div class="invalid-feedback">
                <?= $validation->getError('branch_name') ?>
            </div>
            </div>
      </div>
<hr>
      <div class="row">
            <div class="col">
                <label for="">Phone</label>
            <input type="text" class="form-control" name="phone">
            </div>
            <div class="col">
            <label for="">Fax</label>
            <input type="text" class="form-control" name="fax">
            </div>
      </div>

      <hr>
      <div class="row">
            <div class="col">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email">
            </div>
            <div class="col">
            <label for="">Status</label>
            <select name="status" id="" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
                <option value="">Pilih</option>
                <option value="Active">Active</option>
                <option value="Not Active">Not Active</option>
            </select>
            <div class="invalid-feedback">
                <?= $validation->getError('status') ?>
            </div>
            </div>
      </div>

      <hr>
      <div class="row">
            <div class="col">
            <label for="">Address</label>
            <textarea type="text" class="form-control" name="address"> </textarea>
            </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success"> <i class="fas fa-save"></i> Save</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>

