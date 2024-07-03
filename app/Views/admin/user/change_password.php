<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Change Password</h3>
        <a href="/auth/edit_user/<?= $user['user_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
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

<div class="card shadow mt-3">
    <div class="card-body">
    <form action="/auth/update_password/<?= $user['user_id'] ?>" method="post">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col">
                <label for="">Password</label>
                <div class="input-group" id="show_hide_password">
                    <input type="password" class="form-control <?= ($validation->hasError('user_password')) ? 'is-invalid' : '' ?>" name="user_password" value="">
                    <div class="input-group-append">
                    <a href="" class="input-group-text"><i class="fa fa-eye-slash"></i></a>
                    </div>
                    <div class="invalid-feedback">
                    <?= $validation->getError('user_password') ?>
                    </div>
                </div>
            </div>
            </div>
            <hr>
            <div class="row">
                    <div class="col">
                    <label for="">Confirm Password</label>
                    <div class="input-group" id="show_hide_password">
                        <input type="password" class="form-control <?= ($validation->hasError('pass_confirm')) ? 'is-invalid' : '' ?>" name="pass_confirm" value="">
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
                    <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-exchange-alt"></i> Change password </button>
                </div>
            </div>
        </form>
        </div>
    </div>
</div>
<script>
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