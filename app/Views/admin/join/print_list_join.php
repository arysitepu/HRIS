
<!-- Begin Page Content -->
<div class="container-fluid">
<style>
    @media print{
        .navbar-nav,
        .card-header,
        .cardshadow,
        .card,
        .form,
        .btn,
        .form-group,
        .aksi,
       .judul,
        footer{
            display:none;
        }
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="py-3">
        
            <a href="/join/index" class="btn btn-outline-success mb-3"> <i class="fas fa-arrow-left"></i> Back</a>
            <a href="/join/print_list" class="btn btn-outline-info mb-3"> <i class="fas fa-sync"></i> reset</a>
    </div>

<!-- Page Heading -->

<div>
    <!-- <a href="<?= base_url('jaminan/printPDF') ?>" class="btn btn-success mb-3" >Print</a> -->
  
    
</div>

<div class="card-body form justify-content-center">
<!-- <h1 class="h3 mb-2 text-gray-800 text-center judul">Karyawan Join</h1><br> -->

                <form action="/join/print_list/" method="get">
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
                <button formaction="/join/excel_print_list/" class="btn btn-outline-success"> <i class="fas fa-download"></i> Excel </button>
                <a href="" onclick="window.print()" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i>Print </a>
            </div>
            <div class="col">
            </div>
           </div>

           <hr>
        </form>

<!-- DataTales Example -->
<br>
    <div class="text-center">
       
        <h3 class="m-0 font-weight-bold text-dark">Daftar Pengangkatan karyawan PT. ATAP TEDUH LESTARI</h3>
        
    </div>
    

</div>
<!-- /.container-fluid -->

<div class="card-body">

    
        <div class="table-responsive">
        <div align="center">
                <!-- <span style="font-family: Verdana; font-size:25PX;"><b>FORM SURAT PEMBINAAN / PERINGATAN </b></span> -->
                <table border="1" style="width:100%; color:black;" class="mt-3">
    <tr>
        <td rowspan="6" class="text-center"><img src="/img/logoatl.png" alt="" width="180"></td>
        <td colspan="6" class="text-center">PT. ATAP TEDUH LESTARI</td>
        <td>Nomor Dokumen</td>
        <td>ATL-HO-SOP-HRD-04-02</td>
       
    </tr>
    <tr>
        <td colspan="6" rowspan="5" class="text-center"> FORM <br> PENGANGKATAN KARYAWAN</td>
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
                <hr />
        </div>
       
            <table border="1" style="width:100%; color:black;">

                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Tanggal Pengangkatan</th>
                        <th>Nama Karyawan</th>
                        <th>Position</th>
                        <th>SBU</th>
                        <th>Status</th>
                         
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                   <?php foreach($join as $j) : ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $j->trn_no ?></td>
                        <td><?= date("d-m-Y", strtotime($j->trn_date)) ?></td>
                        <td><?= date("d-m-Y", strtotime($j->join_start)) ?></td>
                        <td><?= $j->employee_name ?></td>
                        <td><?= $j->position ?></td>
                        <td><?= $j->branch ?></td>
                        <td>
                        <?= ($j->employee_status == 0) ? 'None' :'' ?>
                            <?= ($j->employee_status == 1) ? 'Probation' :'' ?>
                            <?= ($j->employee_status == 2) ? 'Tetap' :'' ?>
                            <?= ($j->employee_status == 3) ? 'Resign' :'' ?>
                            <?= ($j->employee_status == 4) ? 'Phk' :'' ?>
                            <?= ($j->employee_status == 5) ? 'Pensiun' :'' ?>
                        </td>
                        
                    </tr>
                  <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

            </div>
            <!-- End of Main Content -->