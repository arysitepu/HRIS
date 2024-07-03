
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard | Human Resource</h1>
                        
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    <div class="swal1" data-swal1="<?= session()->get('berhasil') ?>"></div>

                    <?php $session = session() ?> 
                        <div class="alert alert-success col-md-12" ><b>Selamat Datang <?= $session->get('username') ?> <?= $session->get('user_level') ?> PT. ATAP TEDUH LESTARI</b></div>
                        
                    </div>

                    <!-- Content Row -->

                   <div class="row">
                    <div class="col">
                        <div class="row mt-5">
                            <img src="/assets/img/development.png" alt="" class="img-fluid">
                        </div>
                    </div>

                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                    <div class="row no-gutters align-items-center">
                                                        <div class="col mr-2">
                                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Karyawan Aktif</div>
                                                            <div class="h5 mb-0 font-weight-bold text-gray-800""><?= $total_karyawan ?> Orang</div><hr>
                                                            <a href="/karyawan/index" class="btn btn-outline-primary btn-sm">Lihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-md-6 mb-4">
                                            <div class="card border-left-primary shadow h-100 py-2">
                                                <div class="card-body">
                                                <div class="row no-gutters align-items-center">
                                                    <div class="col mr-2">
                                                    <a href="/trn_cuti/index" class="btn btn-outline-dark btn-lg btn-block">Attendance</a>
                                                    <a href="/dokumen/index" class="btn btn-outline-dark btn-lg btn-block">Document</a>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                    </div>


                                </div>

                                <div class="row">
                                
                                <div class="col-md-12 mb-4">
                                    <div class="card border-left-primary shadow h-100 py-2">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                <h1 class="text-center" style="color:black ;"></h1>
                                                <center><h1 style="font-size: 40px;" id="jam" class="text-center badge badge-primary"></h1></center>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        </div>

                                </div>

                            </div>

                            

                        </div>
                    </div>
                   </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Content Column -->
                        

                        
                    </div>

                </div>
                <!-- /.container-fluid -->

                <script type="text/javascript">
                    window.onload = function() { jam(); }
                
                    function jam() {
                    var e = document.getElementById('jam'),
                    d = new Date(), h, m, s;
                    h = d.getHours();
                    m = set(d.getMinutes());
                    s = set(d.getSeconds());
                
                    e.innerHTML = h +':'+ m +':'+ s;
                
                    setTimeout('jam()', 1000);
                    }
                
                    function set(e) {
                    e = e < 10 ? '0'+ e : e;
                    return e;
                    }
                </script>

            </div>
            <!-- End of Main Content -->