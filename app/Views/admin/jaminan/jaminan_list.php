
<!-- Begin Page Content -->
<div class="container-fluid">
<!-- <style>
    @media print{
        .navbar-nav,
        .card-header,
        .cardshadow,
        .btn,
        
        footer{
            display:none;
        }
    }
</style> -->
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 align-center">Jaminan</h1>
<div>

  
</div>

<div class="mb-3">
<a class="btn btn-outline-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
<i class="fas fa-filter"></i> Filter 
</a>
</div>



  <div class="collapse" id="collapseExample">

      
      <div class="card mb-3">
      
      <div class="card-body justify-content-center">
      
          <form action="" method="get">

          <div class="row">
                <div class="col">
                     <label for="">Search by name</label>
                     <input class="form-control d-inline float-right" name="nama" placeholder="search by name">
                </div>

                <div class="col">
                    <label for="">SBU</label>
                    <select name="branch_id" id="" class="form-control">
                        <option value="">Pilih SBU</option>
                        <?php foreach($branch as $sbu) : ?>
                        <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                
            </div>
            <hr>
            <div class="row">
            <div class="col">
                    <label for=""> Pilih berdasarkan tanggal:</label>
                    <input type="date" class="form-control" name="tanggal" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                </div>

                <div class="col">
                    <label for=""> Pilih berdasarkan bulan: </label>
                    <input type="month" class="form-control" name="bulan" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                </div>
            </div>
            <hr>
                <div class="row mb-3">
                    <div class="col">
                        <label for=""> Pilih berdasarkan Tahun: </label>
                        <input type="text" id="datepicker" class="form-control" name="tahun" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                    </div>
                </div>

                <div class="">
                    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-search"></i> Search</button>
                </div>
        
          </form>
      </div>
      </div>
  </div>

  <?php if($jumlah_jaminan) : ?>
  <div class="alert alert-success mt-3">
    Total transaksi: <?= $jumlah_jaminan ?>
  </div>
  <?php endif ?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">

    <div class="d-flex justify-content-between mb-3">
        <a href="/jaminan/add_jaminan" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Add </a>
        <a href="/jaminan/print_list_jaminan" class="btn btn-outline-info" > <i class="fas fa-print"></i> Print</a>
       
    </div>




        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th>Nama Karyawan</th>
                        <th>SBU</th>
                        <th>Nama Jaminan</th>
                        <th class="text-center">Tanggal Serah</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                    <?php foreach ($jaminan as $j) : ?>
                    <tr>
                    <td><?= $nomor++ ?></td>
                        <td><?= $j ['trn_no'] ?></td>
                        <td><?= $j['employee_name'] ?></td>
                        <td><?= $j['branch_name'] ?></td>
                        <td><?= $j['jaminan_name'] ?></td>
                        <td class="text-center"><?= date( "d-m-Y", strtotime($j['tgl_serah'])) ?></td>
                        <td>
                            <?php if($j['status'] == 1) : ?>
                            <span class="text-success">Penyerahan</span>
                            <?php elseif($j['status'] == 2) : ?>
                            <span class="text-info">Peminjaman</span>
                            <?php elseif($j['status'] == 3) : ?>
                            <span class="text-primary">Pengembalian</span>
                            <?php endif ?>
                            
                        </td>
                        <td>
                        
                        <div class="dropdown">
                            <button class="btn btn-outline-success dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                Action
                            </button>
                            <div class="dropdown-menu">
                            <a href="/jaminan/detail/<?= $j['trn_id'] ?>" class="dropdown-item" > <i class="fas fa-info-circle"></i> Detail </a>
                            <a href="/jaminan/edit_jaminan/<?= $j['trn_id'] ?>" class="dropdown-item" > <i class="fas fa-edit"></i> Edit </a>
                            <form action="/jaminan/<?= $j['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> Delete </button>
                            </form>
                            <a href="/jaminan/print_jaminan/<?= $j['trn_id'] ?>"class="dropdown-item" > <i class="fas fa-print"></i> Print </a>
                            </div>
                        </div>

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