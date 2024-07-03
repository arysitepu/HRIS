

<!-- Begin Page Content -->
<div class="container-fluid">
<style>
    @media print{
        .navbar-nav,
        .card-header,
        .card,
        .cardshadow,
        .btn,
        .form-group,
        .jaminan,
        .aksi,
        footer{
            display:none;
        }
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<div class="row">
    <div class="col mt-3">
        <h1 class=" jaminan h3 mb-2 text-gray-800 align-center">Jaminan</h1>
    </div>
</div>
<div>
    <a href="<?= base_url('jaminan/index') ?>" class="btn btn-outline-success mb-3"> <i class="fas fa-arrow-left"></i> Back </a>
</div>



<!-- DataTales Example -->

<div class="card py-3">    

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
          <button type="submit" formaction="<?= base_url("/jaminan/export_excel") ?>" class="btn btn-outline-success" target="_blank"> <i class="fas fa-download"></i> Export Excel</button>
          <a href=""  onclick="window.print()" class="btn btn-outline-danger" > <i class="fas fa-file-pdf"></i> Print</a>
      </div>

</form>
</div>
    </div>

    <div class="mt-3">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Jaminan Karyawan
            <?php if($branch_name && $branch_name['branch_name'] != null) : ?>
            <?= $branch_name['branch_name'];  ?>
            <?php else : ?>
                
            <?php endif ?>
        </h6>
        </center>
    </div>

    <div class="card-body">

    <table border="1" style="width:100%; color:black;" class="mt-3">
    <tr>
        <td rowspan="6" class="text-center"><img src="/img/logoatl.png" alt="" width="180"></td>
        <td colspan="6" class="text-center">PT. ATAP TEDUH LESTARI</td>
        <td>Nomor Dokumen</td>
        <td>ATL-HO-SOP-HRD-04-02</td>
       
    </tr>
    <tr>
        <td colspan="6" rowspan="5" class="text-center"> FORM <br> JAMINAN KARYAWAN</td>
        <td>Revisi</td>
        <td>00</td>
       
    </tr>
    <tr>
        <td>Tangggal</td>
        <td>01 Agustus 2019</td>
        
    </tr>
    <tr>
        <td>Departemen</td>
        <td>HRD</td>
        
    </tr>
    <tr>
        <td colspan="2" class="text-center">Halaman 1 dari 1</td>
        
        
    </tr>
</table>

<br>
        <div class="table-responsive">
            <table border="1" style="width:100%; color:black;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Karyawan</th>
                        <th>SBU</th>
                        <th>Nama Jaminan</th>
                        <th>Tanggal Serah Terima</th>
                        <th class="aksi">Aksi</th>
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                    <?php foreach ($jaminan as $j) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $j['trn_no'] ?></td>
                        <td><?= date("d-m-Y", strtotime($j['trn_date'])) ?></td>
                        <td><?= $j['employee_name'] ?></td>
                        <td><?= $j['branch_name'] ?></td>
                        <td><?= $j['jaminan_name'] ?></td>
                        <td><?= date("d-m-Y", strtotime($j['tgl_serah'])) ?></td>
                        <td class="aksi">
                        <a href="<?= base_url().'/jaminan/detail/'.$j['trn_id'] ?>" class="btn btn-link" title="" target="__blank">Detail</a>
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->