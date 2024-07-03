

<!-- Begin Page Content -->
<div class="container-fluid">
<style>
    @media print{
        .navbar-nav,
        .card-header,
        .cardshadow,
        .btn,
        footer{
            display:none;
        }
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->

<div class="">
    <div class="row mt-3 ml-3">
        <a href="/jaminan/detail/<?= $jaminan['trn_id'] ?>"  class="btn btn-outline-success mb-3 mr-2" > <i class="fas fa-arrow-left"></i> Back </a>
    <a href="" onclick="window.print()" class="btn btn-outline-danger mb-3 mr-2" > <i class="fas fa-print"></i> Print </a>
    <!-- <a href="/jaminan/index/"  class="btn btn-success mb-3" >Kembali ke Table</a> -->
    </div>
   
</div>



<!-- DataTales Example -->

 
    <div class="card-body dashed-border">
        <div class="table-responsive">
        <div id=halaman>
       <center> 
       <table border="1" class="table table-bordered text-dark" width="100%" cellspacing="0">
                  <tr>
                      <td rowspan="11" colspan="" class="border border-dark"> <center><br><br><img src="/img/atl.jpg" alt="" width="150"></center></td>
                      <td colspan="2" class="text-center border border-dark"> <b> PT. ATAP TEDUH LESTARI </b></td>
                      <td rowspan="2" class="border border-dark">Nomor Dokumen</td>
                      <td rowspan="2" class="border border-dark">ATL-HO-SOP-HRD-04-02</td>
                  </tr>

                  <tr >
                      <td class="text-center border border-dark" rowspan="10" colspan="2"> <br><br><br><b>  FORM <br> SURAT JAMINAN </b></td>
                  </tr>

                  <tr>
                      <td rowspan="2" class="border border-dark">Revisi</td>
                  </tr>

                  <tr>
                      <td rowspan="" class="border border-dark">00</td>
                  </tr>

                  <tr>

                      <td rowspan="2" class="border border-dark">Tanggal</td>
                  </tr>

                  <tr>
                      <td rowspan="2" class="border border-dark">25 February 2022</td>
                  </tr>

                  <!-- batas -->

                  <tr >
                      <td rowspan="2" class="border border-dark">Departemen</td>
                  </tr>

                  <tr>
                      <td rowspan="" class="border border-dark">HRD</td>
                  </tr>

                

                  <tr>
                      <td colspan="2" class="text-center border border-dark">Halaman 1 dari 1</td>
                  </tr>

                </table>  <br><hr class="border border-dark">  
       <h3 id=judul class="text-dark">SURAT JAMINAN</h3>
       <h3 id=judul class="text-dark">No Surat: <?= $jaminan['trn_no'] ?></h3> 
    </center>

        <p class="text-print"><span>Telah diterima oleh PT.Atap Teduh Lestari dari :</p>

        <table class="text-print">
            <tr>
                <td style="width: 30%;"><span>Nama</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><span ><?= $jaminan['employee_name'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%;"><span >Berupa</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;"><span ><?= $jaminan['jaminan_name'] ?></td>
            </tr>
            <tr>
                <td style="width: 30%; vertical-align: top;"><span >Jaminan Deskripsi</td>
                <td style="width: 5%; vertical-align: top;">:</td>
                <td style="width: 65%;"><span ><?= $jaminan['jaminan_desc'] ?></td>
            </tr>
            <!-- <tr>
                <td style="width: 30%;">Pekerjaan</td>
                <td style="width: 5%;">:</td>
                <td style="width: 65%;">Guru</td>
            </tr> -->
        </table><br>

        <p class="text-print"><span>Telah menerima berkas karyawan</p>

        <div class="form-tanda-tangan"><span class="text-print">Jakarta, <?= date( "d-m-Y", strtotime($jaminan['trn_date'])) ?></div><br>
        <div class="form-tanda-tangan jarak-tanga-tangan"><span class="text-print">Yang Menerima,</div>
        <div class="form-tanda-tangan"><span class="text-print"><?= $jaminan['employee_name'] ?></div>

    </div>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->