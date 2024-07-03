<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Detail User</h3>
        <a href="/auth/user" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>
    <div class="card-body shadow">
        <div class="table table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Username</td>
                    <td><?= $user['user_name'] ?></td>
                </tr>
                <tr>
                    <td>Administrator</td>
                    <td><?= $user['user_name_full'] ?></td>
                </tr>
                <tr>
                    <td>User level</td>
                    <td>
                        <?php if($user['user_level'] == 'user') :  ?>
                            admin SBU
                        <?php else : ?>
                            <?= $user['user_level'] ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>SBU</td>
                    <td><?= $user['branch_name'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?= $user['user_email'] ?></td>
                </tr>
                <tr>
                    <td>Last Login</td>
                    <td><?= $user['last_date_login'] ?></td>
                </tr>
                <tr>
                    <td>Last Logout</td>
                    <td><?= $user['last_date_logout'] ?></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <?php if($user['status_active'] == 1) : ?>
                            <span class="text-success">Online</span>
                            <?php else : ?>
                                <span class="text-danger">Offline</span>
                        <?php endif; ?>
                    </td>
                </tr>
                
            </table>
        </div>
    </div>
</div>