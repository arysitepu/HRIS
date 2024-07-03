<div class="container-fluid">
<div class="d-flex justify-content-between">
    <h3>Edit SBU</h3>
    <a href="/branch/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back</a>

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

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
<div class="card shadow mt-3">
    <div class="card-body">
    <form action="/branch/update/<?= $branch['branch_id'] ?>" method="post">
        <input type="hidden" name="branch_id" value="<?= $branch['branch_id'] ?>">
    <div class="row">
            <div class="col">
                <label for="">Branch Code</label>
            <input type="text" class="form-control <?= ($validation->hasError('branch_code')) ? 'is-invalid' : '' ?>" name="branch_code" value="<?= $branch['branch_code'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('branch_code') ?>
            </div>
            </div>
            <div class="col">
            <label for="">Branch Name</label>
            <input type="text" class="form-control <?= ($validation->hasError('branch_name')) ? 'is-invalid' : '' ?>" name="branch_name" value="<?= $branch['branch_name'] ?>">
            <div class="invalid-feedback">
                <?= $validation->getError('branch_name') ?>
            </div>
            </div>
      </div>
<hr>
      <div class="row">
            <div class="col">
            <label for="">Phone</label>
            <input type="text" class="form-control" name="phone" value="<?= $branch['phone'] ?>">
            </div>
            <div class="col">
            <label for="">Fax</label>
            <input type="text" class="form-control" name="fax" value="<?= $branch['fax'] ?>">
            </div>
      </div>

      <hr>
      <div class="row">
            <div class="col">
            <label for="">Email</label>
            <input type="text" class="form-control" name="email" value="<?= $branch['email'] ?>">
            </div>
            <div class="col">
            <label for="">Status</label>
            <select name="status" id="" class="form-control <?= ($validation->hasError('status')) ? 'is-invalid' : '' ?>">
                <option value="<?= $branch['status'] ?>"><?= $branch['status'] ?></option>
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
            <textarea type="text" class="form-control" name="address"><?= $branch['address'] ?> </textarea>
            </div>
      </div>
<hr>
      <div class="row">
            <div class="col">
            <button type="submit" class="btn btn-primary"> <i class="fas fa-edit"></i>Update Data </button>
            </div>
      </div>
      </div>
    </form>
    </div>
</div>

</div>