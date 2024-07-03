

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
    <br>
    <div class="row">
    <h3 class="text-dark text-center">Daftar Surat Peringatan</h3>
    </div>
<br>
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="row">
    <div class="col">
        <a href="/peringatan/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
        <a href=""  onclick="window.print()" class="btn btn-outline-danger" > <i class="fas fa-file-pdf"></i> Print</a>
    </div>

</div>

            <form action="" method="get">
                    <div class="row mt-3">
                        <div class="col">
                            <label for="">Month</label>
                            <input type="month" class="form-control" placeholder="search by month" name="bulan">
                        </div>
                        <div class="col">
                            <label for="">Date</label>
                            <input type="date" class="form-control" placeholder="search tanggal" name="tanggal">
                        </div>
                        <div class="col">
                            <label for="">Years</label>
                            <input type="text" class="form-control" placeholder="search tahun" name="tahun" id="datepicker">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col">
                            <button type="submit"  class="btn btn-outline-success" > <i class="fas fa-search"></i> Search </button>
                        </div>
                    </div>
            </form>
    <div class="card-body">

    
        <div class="table-responsive">
        
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <tr>
                            <td rowspan="11" class="text-center"> <img src="/img/atl.jpg" alt="" width="200"></td>
                            <td colspan="2" class="text-center">PT. ATAP TEDUH LESTARI</td>
                            <td>Nomor Dokumen</td>
                            <td>ATL-HO-SOP-HRD-04-02</td>
                        </tr>

                        <tr >
                            <td class="text-center" rowspan="10" colspan="2"> <br><br> FORM <br> SURAT PEMBINAAN / PERINGATAN</td>
                        </tr>

                        <tr>
                            <td rowspan="2">Revisi</td>
                        </tr>

                        <tr>
                            <td rowspan="2">00</td>
                        </tr>

                        <tr>

                            <td rowspan="2">Tanggal</td>
                        </tr>

                        <tr>
                            <td rowspan="">25 February 2022</td>
                        </tr>

                        <!-- batas -->

                        <tr >
                            <td rowspan="2">Departemen</td>
                        </tr>

                        <tr>
                            <td>HRD</td>
                        </tr>

                        

                        <tr>
                            <td colspan="2" class="text-center">Halaman 1 dari 1</td>
                        </tr>
        </table>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>Nomor Dokumen</th>
                        <th>Tanggal Surat</th>
                        <th>Nama Karyawan</th>
                        <th>Pembuat surat</th>
                        <th>Menyetujui</th>
                        <th class="aksi">Aksi</th>
                        
                    </tr>
                </thead>
                
                <tbody>
                    <?php foreach ($peringatan as $p) : ?>
                    <tr>
                        <td><?= $p->trn_no ?></td>
                        <td><?= $p->trn_date ?></td>
                        <td><?= $p->employee_name ?></td>
                        <td><?= $p->buat_name ?></td>
                        <td><?= $p->setuju_name ?></td>
                        
                        <td class="aksi">
                        <a href="<?= base_url().'/peringatan/detail/'.$p->trn_id ?>" class="btn btn-success" >Detail</a>
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