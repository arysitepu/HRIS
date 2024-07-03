<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Edit User</h3>
        <a href="/auth/user" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>

    <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('pesan_error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('pesan_error') ?>
            </div>
    <?php endif; ?>

    <div class="card mt-3">
        <div class="card-body shadow">
        <form action="/auth/update_user/<?= $user['user_id'] ?>" method="POST">
            <?= csrf_field() ?>
        <div class="row">
            <div class="col">
                <label for="">Username</label>
                <input type="text" class="form-control <?= ($validation->hasError('user_name')) ? 'is-invalid' : '' ?>" name="user_name" value="<?= $user['user_name'] ?>">
                <div class="invalid-feedback">
                <?= $validation->getError('user_name') ?>
                </div>
            </div>
            <div class="col">
                <label for="">Name administrator</label>
                <input type="text" class="form-control <?= ($validation->hasError('user_name_full')) ? 'is-invalid' : '' ?>" name="user_name_full" value="<?= $user['user_name_full'] ?>">
                <div class="invalid-feedback">
                <?= $validation->getError('user_name_full') ?>
                </div>
            </div>
        </div>
    
        <hr>
        <div class="row">
            <div class="col">
                <label for="">Email</label>
                <input type="text" class="form-control <?= ($validation->hasError('user_email')) ? 'is-invalid' : '' ?>" name="user_email" value="<?= $user['user_email'] ?>">
                <div class="invalid-feedback">
                <?= $validation->getError('user_email') ?>
                </div>
            </div>

            <div class="col">
                <label for="">SBU</label>
                <select name="branch_id" id="" class="form-control <?= ($validation->hasError('branch_id')) ? 'is-invalid' : '' ?>">
                    <option value="<?= $user['branch_id'] ?>"><?= $user['branch_name'] ?></option>
                    <?php foreach($branches as $branch) : ?>
                        <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                <?= $validation->getError('branch_id') ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="">User Level</label>
                <select name="user_level" id="" class="form-control <?= ($validation->hasError('user_level')) ? 'is-invalid' : '' ?>">
                <option value="<?= $user['user_level'] ?>">
                    <?php if($user['user_level'] == 'user') : ?>
                        Admin SBU
                    <?php else : ?>
                        <?= $user['user_level'] ?>
                    <?php endif; ?>
                </option>
                <option value="admin">Admin</option>
                <option value="user">Admin SBU</option>
                <option value="mgr">Manager</option>
                <option value="staff">Staff</option>
                </select>
                <div class="invalid-feedback">
                <?= $validation->getError('user_level') ?>
                </div>
            </div>
        </div>
      <hr>
      <div class="row">
        <div class="col">
            <label for="">Status</label>
            <select name="status_active" id="" class="form-control">
                <option value="">Silahkan pilih</option>
                <option value="1" <?= ($user['status_active'] == 1) ? 'selected' : ''; ?>>Active</option>
                <option value="0" <?= ($user['status_active'] == 0) ? 'selected' : ''; ?>>Inactive</option>
            </select>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-outline-success"><i class="fas fa-user-edit"></i> Update </button>
            <a href="/auth/change_password/<?= $user['user_id'] ?>" class="btn btn-outline-primary"><i class="fas fa-exchange-alt"></i> Change password </a>
        </div>
      </div>
    </form>
       
    </div>
</div>
