<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=data pengangkatan.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>


<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="py-3">
    </div>

<!-- Page Heading -->

<div>
    <!-- <a href="<?= base_url('jaminan/printPDF') ?>" class="btn btn-success mb-3" >Print</a> -->
  
    
</div>

<div class="card-body form justify-content-center">
<!-- <h1 class="h3 mb-2 text-gray-800 text-center judul">Karyawan Join</h1><br> -->


<!-- DataTales Example -->
<br>
    <div class="card py-3">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Pengankatan karyawan</h6>
        </center>
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