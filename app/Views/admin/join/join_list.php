
<!-- Begin Page Content -->
<div class="container-fluid">
<style>
    @media print{
        .navbar-nav,
        .card-header,
        .cardshadow,
        .btn,
        .form-group,
        .aksi,
       
        footer{
            display:none;
        }
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 align-center">Pengangkatan</h1>
<hr>
<div>

        
<a class="btn btn-outline-primary mb-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
<i class="fas fa-filter"></i> Filter 
  </a>
  <a href="/join/index" class="btn btn-outline-info mb-3">
<i class="fas fa-fw fa-sync"></i> reset 
  </a>
  <!-- <a href="/" class="btn btn-success mb-3">Kembali ke dashboard</a> -->

  <div class="alert alert-success"> Mohon untuk posting data setelah input untuk posting silahkan click tombol action pilih posting (begitu juga dengan unposting) </div>

    <?php if($jumlah_join != null) : ?>
        <div class="alert alert-info">Transaction Total: <?= $jumlah_join ?></div>
    <?php endif ?>

  <div class="collapse" id="collapseExample">

  <div class="card mb-3">
      <div class="card-body">
    
          <form action="" method="get">
           <div class="row">
            <div class="col">
            <input class="form-control" name="nama" placeholder="search by name...">
            </div>
            <div class="col">
            <select name="branch_id" id="" class="form-control">
                <option value="">Pilih SBU</option>
                <?php foreach($branch_id as $sbu) : ?>
                    <option value="<?= $sbu['branch_id'] ?>"> <?= $sbu['branch_name'] ?> </option>
                <?php endforeach ?>
            </select>
            </div>
           </div>
           <hr>
           <div class="row">
            <div class="col">
            <label for="">Pilih berdasarkan tanggal</label>
            <input type="date" class="form-control " name="tanggal">
            </div>
            <div class="col">
            <label for="">Pilih berdasarkan bulan</label>
            <input type="month" class="form-control" name="bulan">
            </div>
            
           </div>
            <hr>
            <div class="row">
                <div class="col">
                    <label for="">Tanggal dari</label>
                    <input type="date" class="form-control" name="tanggal_dari">
                </div>
                <div class="col">
                    <label for="">Tanggal sampai</label>
                    <input type="date" class="form-control" name="tanggal_sampai">
                </div>
            </div>
            <hr>
           <div class="row">
           <div class="col">
            <label for="">Pilih berdasarkan tahun</label>
            <input type="text" class="form-control " name="tahun" id="datepicker">
            </div>
           </div>
            <hr>
           <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-outline-success"> <i class="fas fa-search"></i> Search </button>
            </div>
           </div>

           <hr>

        
          </form>
      </div>
  </div>


  </div>
    
</div>


<!-- DataTales Example -->
<?php if(session()->getFlashdata('pesan'))  : ?>

    <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
    </div>

    <?php endif ?>
<div class="card shadow mb-4">
    

    <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
       
   
    <div class="card-body"> 
        <a href="/join/add_join" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Add </a>
        <a href="/join/print_list" class="btn btn-outline-danger" > <i class="fas fa-print"></i> Print</a>
    

<div class="table-responsive mt-3">
            <table class="table table-bordered mt-3" cellspacing="5">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Nomor Dokumen</th>
                        <th>Tanggal Dokumen</th>
                        <th>Tanggal Pangkatan</th>
                        <th>Nama Karyawan</th>
                        <th>Position</th>
                        <th>SBU (CABANG) </th>
                        <th>Posting</th>
                        <th>Aksi</th>
                        
                    </tr>
                </thead>
                
                <?php $no= 1; ?>

                <tbody>
                <?php foreach($join as $j) : ?>
                    <tr>
                    <td><?= $nomor++ ?></td>
                    <td><?= mb_substr($j['trn_no'], 0, 8, 'UTF-8')."..." ?></td>
                        <td><?= date("d-m-Y", strtotime($j['trn_date'])) ?></td>
                        <td><?= date("d-m-Y", strtotime($j['join_start'])) ?></td>
                        <td><?= mb_substr($j['employee_name'], 0, 5, "UTF-8")."..." ?></td>
                        <td><?= mb_substr($j['position'], 0, 10, "UTF-8")."..." ?></td>
                        <td><?= $j['branch'] ?></td>
                        <td><?php
                         if($j['posting'] == 1){ 
                            echo '<h6><span class="badge badge-success">Posting</span></h6>'; 
                        }elseif($j['posting'] == 0){
                            echo '<h6><span class="badge badge-danger">Belum diposting</span></h6>';
                            
                        }  ?>
                        </td>
                        <td>
                        <div class="dropdown">
                        <button class="btn btn-outline-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            action
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="/join/detail/<?= $j['trn_id'] ?>" class="dropdown-item" > <i class="fas fa-info-circle"></i> Detail </a>                            
                        <?php if($j['posting'] == 1) { ?>
                            <?php }else{ ?>

                                <a href="/join/edit_join/<?= $j['trn_id'] ?>" class="dropdown-item" > <i class="fas fa-edit"></i>Edit </a>
                                <form action="/join/<?= $j['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="dropdown-item" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> Hapus </button>
                                </form>

                                <form action="/join/post_join/<?= $j['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="trn_id" value="<?= $j['trn_id'] ?>">
                                <input type="hidden" name="employee_id" value="<?= $j['employee_id'] ?>">
                                <input type="hidden" name="branch_id" value="<?= $j['branch_id'] ?>">
                                <input type="hidden" name="position_id" value="<?= $j['position_id'] ?>">
                                <input type="hidden" name="tanggal_masuk" value="<?= $j['join_start'] ?>">
                                <input type="hidden" name="status" value="<?= $j['employee_status'] ?>">
                                  <button type="submit" class="dropdown-item" title="post" onclick="return confirm('pastikan inputan sudah benar')" > <i class="fas fa-check-circle"></i> Posting </button>
                                </form>
                                <?php } ?>
                        <!-- <a href="/join/detail_print/<?= $j['trn_id'] ?>" class="btn btn-info" > <i class="fas fa-print"></i> </a> -->
                 

                                <form action="/join/un_post_join/<?= $j['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="trn_id" value="<?= $j['trn_id'] ?>">
                                <input type="hidden" name="employee_id" value="<?= $j['employee_id'] ?>">
                                <input type="hidden" name="branch_id" value="<?= $j['branch_id'] ?>">
                                <input type="hidden" name="position_id" value="<?= $j['position_id'] ?>">
                                <input type="hidden" name="tanggal_masuk" value="<?= $j['join_start'] ?>">
                                <input type="hidden" name="status" value="<?= $j['employee_status'] ?>">
                                  <!-- <button type="submit" class="dropdown-item" title="unpost" onclick="return confirm('Apakah anda yakin?.')" > <i class="fas fa-ban"></i> Unpost </button> -->
                                </form>
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