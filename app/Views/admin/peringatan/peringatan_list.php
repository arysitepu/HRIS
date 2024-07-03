
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
<h1 class="h3 mb-2 text-gray-800 align-center">Surat Peringatan</h1>
<div>
  

    
<a class="btn btn-outline-primary mb-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
<i class="fas fa-filter"></i> Filter 
  </a>
    
</div>


<div class="collapse" id="collapseExample">

      
<div class="card mb-3">

<div class="card-body">

<form action="" method="get">

<div class="row">
    <div class="col">
        <input class="form-control" name="nama" placeholder="search by name">
    </div>
</div>
<hr>
            <div class="row">
            <div class="col">
                <label for=""> <b>Pilih berdasarkan tanggal:</b> </label>
                <div class="input-group mb-3">
                <input type="date" class="form-control" name="tanggal" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
            </div>
            </div>
                    

            <div class="col">
            <label   label for=""> <b>Pilih berdasarkan bulan:</b> </label>
            <div class="input-group mb-3">
            <input type="month" class="form-control" name="bulan" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
        </div>
      </div>

        
                </div>

                <div class="row">
                    <div class="col">
                        <label for=""> <b>Pilih berdasarkan Tahun:</b> </label>
                        <div class="input-group mb-3">
                        <input type="text" id="datepicker" class="form-control" name="tahun" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                    
                    </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <button class="btn btn-outline-success"> <i class="fas fa-search"></i> Search </button>
                    </div>
                </div>
    </form>


</div>
</div>

</div>


<?php if(session()->getFlashdata('pesan')) : ?>

    <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
    </div>
<?php endif;  ?>
<!-- DataTales Example -->
<div class="card shadow mb-4">
 

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card-body">

    <div class="">
    <a href="/peringatan/add_peringatan" class="btn btn-outline-success mb-3" > <i class="fas fa-plus"></i> Add </a>
    <a href="/peringatan/print_list" class="btn btn-outline-danger mb-3" > <i class="fas fa-print"></i> Print</a>

    
          
        
    </div>


    
        <div class="table-responsive">

       
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th>Tanggal Surat</th>
                        <th>Nama Karyawan</th>
                        <!-- <th>Pembuat surat</th> -->
                        <!-- <th>Menyetujui</th> -->
                        <th class="aksi">Aksi</th>
                        
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                    <?php foreach ($peringatan as $p) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $p['trn_no'] ?></td>
                        <td><?= date( "d-m-Y", strtotime($p['trn_date'])) ?></td>
                        <td><?= $p['employee_name'] ?></td>
                        <!-- <td><?= $p['buat_name'] ?></td> -->
                        <!-- <td><?= $p['setuju_name'] ?></td> -->
                        
                        <td class="aksi">
                        <a href="/peringatan/detail/<?= $p['trn_id'] ?>" class="btn btn-sm btn-outline-success" > <i class="fas fa-info-circle"></i> </a>
                        <a href="/peringatan/edit_peringatan/<?= $p['trn_id'] ?>" class="btn btn-sm btn-outline-primary" > <i class="fas fa-edit"></i> </a>

                        <form action="/peringatan/<?= $p['trn_id'] ?>" method="post" class="d-inline">
                            <?= csrf_field(); ?>
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </button>
                        </form>
                        <!-- <a href="/peringatan/detail_print/<?= $p['trn_id'] ?>" class="btn btn-sm btn-outline-info" > <i class="fas fa-print"></i> </a> -->

               
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