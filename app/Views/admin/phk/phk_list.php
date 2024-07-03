
        <!-- Begin Page Content -->
        <div class="container-fluid">
        <style>
            @media print{
                .navbar-nav,
                .card-header,
                .cardshadow,
                .btn,
                .form-group,
                .judul,
                .detail,
                footer{
                    display:none;
                }
            }
        </style>
        <!-- Begin Page Content -->
        <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800 align-center judul">Karyawan keluar</h1>
        <a class="btn btn-outline-primary mb-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <i class="fas fa-filter"></i> Filter 
        </a>

        
        <div class="collapse" id="collapseExample">

            
        <div class="card mb-3">

        <div class="card-body">
        <form action="" method="get">
            <div class="row">
            <input class="form-control" name="nama" placeholder="search by name">
            </div>
            <hr>
        <div class="row">
            <div class="col">
                <label for=""> <b>Pilih berdasarkan tanggal:</b> </label>

                <div class="input-group mb-3">
                    <input type="date" class="form-control" name="keyword" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                
                </div>
            </div>

            <div class="col">
            <label for=""> <b>Pilih berdasarkan bulan:</b> </label>
                <div class="input-group mb-3">
                    <input type="month" class="form-control" name="bulan" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                
                </div>
            </div>
        </div>
        <hr>
        <div class="row">

            <div class="col">
                <label for=""> <b>Pilih berdasarkan Tahun:</b> </label>
                <div class="input-group mb-3">
                    <input type="text" id="datepicker" class="form-control" name="tahun" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                
                </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-outline-success"> <i class="fas fa-search"></i> Search</button>
        </form>
        </div>
        </div>
        </div>
            <?php if(session()->getFlashdata('pesan')) : ?>

                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashdata('pesan') ?>
                </div>

            <?php endif; ?>
            <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
        <div class="card shadow mb-4">
            <div class="card-body">

            <a href="/phk/add_phk/" class="btn btn-outline-success mb-3" > <i class="fas fa-plus"></i> Add </a>
            <a href="/phk/print/" class="btn btn-outline-danger mb-3" ><i class="fas fa-print"></i> Print</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Dokumen</th>
                                <th>Tangggal transaksi</th>
                                <th>Nama Karyawan</th>
                                <th>Tanggal Keluar</th>
                                <th>Posting</th>
                                <th class="">Aksi</th>
                            </tr>
                        </thead>
                        
                        <?php $no= 1; ?>

                        <tbody>
                            <?php foreach ($phk as $phk) : ?>
                            <tr>
                                <td><?= $nomor++ ?></td>
                                <td><?= $phk['trn_no'] ?></td>
                                <td><?= date("d-m-Y", strtotime($phk['trn_date'])) ?></td>
                                <td><?= $phk['employee_name'] ?></td>
                                <td><?= date("d-m-Y", strtotime($phk['phk_date'])) ?></td>
                                <td class="text-center"><?= ($phk['posting'] == 1) ? '<h6><span class="badge badge-success">Posting</span></h6>' : '' ?></td>
                                <td class="" >
                                    <?php if($phk['posting'] == 1) { ?>
                                        <a href="/phk/detail/<?= $phk['trn_id'] ?>" class="btn btn-sm btn-outline-success" > <i class="fas fa-info-circle"></i> </a>
                                    <!-- <a class="btn btn-sm btn-dark"> <i class="fas fa-edit"></i> </a>
                                    <a class="btn btn-sm btn-dark"> <i class="fas fa-trash-alt"></i></a> -->
                                <?php }else{ ?>
                                <a href="/phk/edit_phk/<?= $phk['trn_id'] ?>" class="btn btn-sm btn-primary" > <i class="fas fa-edit"></i> </a>
                                <form action="/phk/<?= $phk['trn_id'] ?>" method="post" class="d-inline">
                                    <?= csrf_field(); ?>
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </button>
                                </form>
                                <form action="/phk/post_phk/<?= $phk['trn_id'] ?>" class="d-inline" method="post">
                                        <input type="hidden" name="trn_id" value="<?= $phk['trn_id'] ?>">
                                        <input type="hidden" name="branch_id" value="<?= $phk['branch_id'] ?>">
                                        <input type="hidden" name="position_id" value="<?= $phk['position_id'] ?>">
                                        <input type="hidden" name="employee_id" value="<?= $phk['employee_id'] ?>">
                                        <input type="hidden" name="tanggal_keluar" value="<?= $phk['phk_date'] ?>">
                                        <input type="hidden" name="status" value="<?= $phk['employee_status'] ?>">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('pastikan inputan sudah benar')" > <i class="fas fa-check-circle"></i> </button>
                                    </form>
                                <?php } ?>

                                <?php if($phk['employee_status'] == 4) { ?>
                                <a href="/phk/detail_print/<?= $phk['trn_id'] ?>" class="btn btn-sm btn-info" > <i class="fas fa-print"></i> </a>
                            <?php }else{ ?>
                                <?php } ?>
                                
                                </td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="">
                    <?= $pager->links('default', 'custom_pagination') ?>
                </div>
            </div>
        </div>

    </div>
<!-- /.container-fluid -->

</div>
            <!-- End of Main Content -->