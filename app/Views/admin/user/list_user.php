<div class="container-fluid">
        <h3>User</h3>

        <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-plus"></i> Add
        </button>

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
            <div class="card shadow">
                <div class="card-body">
                    <div class="table table-responsive">
                    <table id="user" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <td>No</td>
                                <td>Username</td>
                                <td>Administrator</td>
                                <td>SBU</td>
                                <td>Last login</td>
                                <td>Last logout</td>
                                <td>Status</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <?php $no= 1; ?>
                        <tbody>
                            <?php foreach($users as $user) : ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $user['user_name'] ?></td>
                                <td><?= $user['user_name_full'] ?></td>
                                <td><?= $user['branch_name'] ?></td>
                                <td>
                                    <?php if($user['last_date_login'] == null) : ?>
                                        <span> - </span>
                                    <?php else : ?>
                                            <?= date("d-M-Y H:i:s", strtotime($user['last_date_login'])) ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                <?php if($user['last_date_login'] == null) : ?>
                                        <span>-</span>
                                    <?php else : ?>
                                            <?= date("d-M-Y H:i:s", strtotime($user['last_date_logout'])) ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($user['status_active'] == 1) : ?>
                                        <span class="text-success">Active</span>
                                    <?php else : ?>
                                        <span class="text-danger">Inactive</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                   Action
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="/auth/detail_user/<?= $user['user_id'] ?>"><i class="fas fa-info-circle"></i> Detail</a>
                                    <a class="dropdown-item" href="/auth/edit_user/<?= $user['user_id'] ?>"><i class="fas fa-user-edit"></i> Edit</a>
                                    <form action="/auth/<?= $user['user_id'] ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="_method" value="delete">
                                            <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> Hapus </button>
                                    </form>
                                </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- add data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add data user</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/auth/save" method="POST">
            <?= csrf_field() ?>
        <div class="row">
            <div class="col">
                <label for="">Username</label>
                <input type="text" class="form-control <?= ($validation->hasError('user_name')) ? 'is-invalid' : '' ?>" name="user_name">
                <div class="invalid-feedback">
                <?= $validation->getError('user_name') ?>
                </div>
            </div>
            <div class="col">
                <label for="">Name administrator</label>
                <input type="text" class="form-control <?= ($validation->hasError('user_name_full')) ? 'is-invalid' : '' ?>" name="user_name_full">
                <div class="invalid-feedback">
                <?= $validation->getError('user_name_full') ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
            <label for="">Password</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control <?= ($validation->hasError('user_password')) ? 'is-invalid' : '' ?>" name="user_password">
                <div class="input-group-append">
                <a href="" class="input-group-text"><i class="fa fa-eye-slash"></i></a>
                </div>
                <div class="invalid-feedback">
                <?= $validation->getError('user_password') ?>
                </div>
            </div>
            </div>

            <div class="col">
            <label for="">Confirm Password</label>
            <div class="input-group" id="show_hide_password">
                <input type="password" class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid' : '' ?>" name="pass_confirm">
                <div class="input-group-append">
                <a href="" class="input-group-text"><i class="fa fa-eye-slash"></i></a>
                </div>
                <div class="invalid-feedback">
                <?= $validation->getError('pass_confirm') ?>
                </div>
            </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <label for="">Email</label>
                <input type="text" class="form-control <?= ($validation->hasError('user_email')) ? 'is-invalid' : '' ?>" name="user_email">
                <div class="invalid-feedback">
                <?= $validation->getError('user_email') ?>
                </div>
            </div>

            <div class="col">
                <label for="">SBU</label>
                <select name="branch_id" id="" class="form-control <?= ($validation->hasError('branch_id')) ? 'is-invalid' : '' ?>">
                    <option value="">Silahkan pilih</option>
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
                <option value="">Silahkan pilih</option>
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Save changes</button>
    </form>

      </div>
    </div>
  </div>
</div>
<!-- batas -->

<script>
    $(document).ready(function () {
    $('#user').DataTable();
});

$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});
</script>