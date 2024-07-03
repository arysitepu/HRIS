<?php
$session = session();
$login = $session->getFlashdata('login');
$username = $session->getFlashdata('username');
$password = $session->getFlashdata('password');
$otorisasi = $session->getFlashdata('otorisasi');

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/logo.png" type="image/gif">

    <title>PT. ATAP TEDUH LESTARI</title>

    <!-- Custom fonts for this template-->
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-success">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-6 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block "></div>
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <img src="/logo.png" alt="" style="width: 50% ;">
                                        <h1 class="h4 text-gray-900 mb-4">Human Resource Development</h1>
                                    </div>
                                    <div class="text-center">
                                        <h5 class="h6 text-gray-900 mb-4">Silahkan Masukan Username dan Password</h5>
                                    </div>

                                    <div class="swal_error" data-swal_error="<?= session()->get('password') ?>"></div>
                                    <div class="swal_error2" data-swal_error2="<?= session()->get('username') ?>"></div>
                                    
                                    <?php if($username) : ?>
                                        <div class="alert alert-danger" role="alert">
                                            <?= $username; ?>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if($password) : ?>
                                    <div class="alert alert-danger" role="alert">
                                   <?= $password; ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($login) : ?>
                                    <div class="alert alert-danger" role="alert">
                                   <?= $login; ?>
                                    </div>
                                    <?php endif; ?>

                                    <?php if($otorisasi) : ?>

                                        <div class="alert alert-danger" role="alert">
                                            <?= $otorisasi ?>
                                        </div>

                                        <?php endif; ?>

                                    <form class="user" action="/auth/login_proces">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                id="" aria-describedby=""
                                                placeholder="username" name="username">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Password" name="password">
                                        </div>
                                       
                                        <button type="submit" class="btn btn-success btn-user btn-block" name="login">
                                            Login
                                        </button>
                                        
                                       
                                    </form>
                                    <hr>
                                    <div class="copyright text-center my-auto">
                                        <span>Copyright &copy; PT. ATAP TEDUH LESTARI</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    
    
    <!-- Custom scripts for all pages-->
    <script src="/assets/js/sb-admin-2.min.js"></script>

     <!-- sweeetalret -->
    <script src="/assets/vendor/sweetalert/js/sweetalert2.all.min.js"></script>
    <!-- sweeetalret -->

    <script src="/assets/js/script.js"></script>

    

</body>

</html>