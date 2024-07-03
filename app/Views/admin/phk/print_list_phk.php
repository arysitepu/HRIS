

<!-- Begin Page Content -->
<div class="container-fluid">
<style>
    @media print{
        .navbar-nav,
        .cari,
        .judul,
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
<br>
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 align-center judul">Karyawan keluar</h1>
<div>
    <!-- <a href="<?= base_url('jaminan/printPDF') ?>" class="btn btn-success mb-3" >Print</a> -->
   
</div>

<div class="card-body1 py-3" >
    <div class="cari">

        <form action="" method="get">
          <div class="row">
              <div class="col">
                  <label for=""> <b>Pilih berdasarkan tanggal:</b> </label>
        
                  <div class="input-group mb-3">
                    <input type="date" class="form-control" name="keyword" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                  
                </div>
        
                  <!-- <input type="date" class="form-control " name="keyword"> -->
                  <!-- <button type="submit"  class="btn btn-success " >Lihat</button> -->
              </div>
        
              <div class="col">
              <label for=""> <b>Pilih berdasarkan bulan:</b> </label>
                <div class="input-group mb-3">
                    <input type="month" class="form-control" name="bulan" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                  
                </div>
              </div>
          </div>
        <br>
          <div class="row">
        
              <div class="col">
                  <label for=""> <b>Pilih berdasarkan Tahun:</b> </label>
                  <div class="input-group mb-3">
                    <input type="text" id="datepicker" class="form-control" name="tahun" placeholder="" aria-label="Recipient's username" aria-describedby="button-addon2">
                  
                </div>
                  <!-- <input type="text" class="form-control " name="tahun" id="datepicker"> -->
                </div>
            </div>
            <br>
            <a href="/phk/index" class="btn btn-outline-success"><i class="fas fa-arrow-left"></i> Back</a>     
            <button type="submit"  class="btn btn-outline-success"> <i class="fas fa-search"></i> Search</button>
            <a href=""  onclick="window.print()" class="btn btn-outline-danger" ><i class="fas fa-file-pdf"></i> Print</a>
        
        </form>
    </div>

<!-- DataTales Example -->


<div class="card-body py-3">
</div>

    <div class="judul py-3">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Daftar PHK Karyawan</h6>
        </center>
    </div>
    <div class="card-body">

    <table border="1" style="width:100%; color:black;">
    <tr>
        <td rowspan="6" class="text-center"><img src="/img/logoatl.png" alt="" width="180"></td>
        <td colspan="6" class="text-center">PT. ATAP TEDUH LESTARI</td>
        <td>Nomor Dokumen</td>
        <td>ATL-HO-SOP-HRD-04-02</td>
       
    </tr>
    <tr>
        <td colspan="6" rowspan="5" class="text-center"> REKAPITULASI <br> KARYAWAN KELUAR</td>
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
                        <th>Tanggal Surat</th>
                        <th>Nama Karyawan</th>
                        <th>Pembuat surat</th>
                        <th>Menyetujui</th>
                        <th>PHK Descripsi</th>
                        <th>Tanggal PHK</th>
                        <th class="detail">Aksi</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php $no=1; ?> 
                    <?php foreach ($phk as $phk) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $phk['trn_no'] ?></td>
                        <td><?= $phk['trn_date'] ?></td>
                        <td><?= $phk['employee_name'] ?></td>
                        <td><?= $phk['buat_name'] ?></td>
                        <td><?= $phk['setuju_name'] ?></td>
                        <td><?= $phk['phk_desc'] ?></td>
                        <td><?= $phk['phk_date'] ?></td>

                        <td class="detail">
                        <a href="/phk/detail/<?= $phk['trn_id'] ?>" class="btn btn-link" >Detail</a>
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