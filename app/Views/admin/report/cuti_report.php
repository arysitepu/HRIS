<style>
    @media print{
        .input-print,
        #toolbarContainer,
        .judul,
        footer{
            display:none;
        }
    }
</style>

<div class="container-fluid">

<?php



?>

<form action="">
    <div class="row input-print">
        <div class="col">
            <input type="month" class="form-control col-md-3 d-inline" name="bulan" value="<?= old('bulan') ?>">
            <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search </button>
            <a href="" onclick="window.print()" class="btn btn-success mb-3 d-inline" > <i class="fas fa-print"></i> Print</a>
            <a href="/trn_cuti/index" class="btn btn-success"> Kembali ke Table </a>
        </div>
    </div>
</form>

<br>
<form action="/exportexcel/trn_cuti">
    <div class="row input-print">
        <div class="col">
            <input type="month" class="form-control col-md-3 d-inline" name="bulan" value="<?= old('bulan') ?>">
            <button type="submit" class="btn btn-success"> <i class="fas fa-download"></i> Export Excel </button>
           
        </div>
    </div>
</form>
<div align="center">
                <!-- <span style="font-family: Verdana; font-size:25PX;"><b>FORM SURAT PEMBINAAN / PERINGATAN </b></span> -->
                <table border="" class="table table-bordered" id="dataTable" width="100%" cellspacing="0"">
                  <tr>
                      <td rowspan="11" colspan=""> <br><br><center><img src="/img/atl.jpg" alt="" width="150"></center></td>
                      <td colspan="2" class="text-center"> <b> PT. ATAP TEDUH LESTARI </b></td>
                      <td rowspan="2" >Nomor Dokumen</td>
                      <td rowspan="2">ATL-HO-SOP-HRD-04-02</td>
                  </tr>

                  <tr >
                      <td class="text-center" rowspan="10" colspan="2"> <br><br><br><b> LIST <br> ATTEDANCE KARYAWAN </b></td>
                  </tr>

                  <tr>
                      <td rowspan="2">Revisi</td>
                  </tr>

                  <tr>
                      <td rowspan="">00</td>
                  </tr>

                  <tr>

                      <td rowspan="2">Tanggal</td>
                  </tr>

                  <tr>
                      <td rowspan="2">25 February 2022</td>
                  </tr>

                  <!-- batas -->

                  <tr >
                      <td rowspan="2">Departemen</td>
                  </tr>

                  <tr>
                      <td rowspan="">HRD</td>
                  </tr>

                

                  <tr>
                      <td colspan="2" class="text-center">Halaman 1 dari 1</td>
                  </tr>

                </table>
                <hr />
        </div>




        <div class="container-fluid judul mb-3">
            <h3> <strong>Silahkan Cari Data Terlebih Dahulu</strong></h3>
        </div>

<div class="card">


<table class="" border="1">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Posisi</th>
                            <th scope="col" class="text-center">Bulan</th>
                            <th scope="col" class="text-center">Cuti</th>
                            <th scope="col" class="text-center">Sakit</th>
                            <th scope="col" class="text-center">Ck</th>
                            <th scope="col" class="text-center">Ul</th>
                            <th scope="col" class="text-center">Total</th>
                           
                          </tr>
                        </thead>

                        
                   
                        <?php $no=1; ?>
                        <tbody>
                            <?php 
                                $total = 0;
                                foreach($cuti as $ct) : 
                                
                            ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $ct['employee_name'] ?></td>
                            <td><?= $ct['position_name'] ?></td>
                            <td class="text-center"><?= date('M-Y' ,strtotime($ct['tgl_dari'])) ?></td>
                            <td class="text-center"><?= ($ct['c']) ? $ct['c'] : '-' ?></td>
                            <td class="text-center"><?= ($ct['s']) ? $ct['s'] : '-'  ?> </td>
                            
                            <td class="text-center"><?= ($ct['ck']) ? $ct['ck'] : '-'  ?></td>
                            
                            <td class="text-center text-danger"><?= ($ct['ul']) ? $ct['ul'] : '-' ?></td>
                            <td class="text-center"> 
                                <?php 
                                $cuti = $ct['c'];
                                $sakit = $ct['s'];
                                $cuti_khusus = $ct['ck'];
                                $ul = $ct['ul'];

                                $jumlah = $cuti + $sakit + $cuti_khusus + $ul;

                                echo $jumlah;
                                ?>
                            </td>
                           
                          </tr>
                        </tbody>

                    
                        <?php endforeach; ?>

                       
          </table>
</div>
</div>


</div>