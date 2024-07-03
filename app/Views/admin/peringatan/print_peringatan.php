<html>
<head>
<title>Surat peringatan</title>
</head>

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
    .dashed-line {
            border: 0;
            border-top: 2px dashed #000; /* Ubah warna dan ketebalan sesuai kebutuhan */
            margin: 20px 0;
        }
</style>


<body class="">
<div class="container-fluid ">
<div class="row mt-3 mb-3 ml-5">
    <div class="col">
        <a href="/peringatan/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
        <a href="/peringatan/detail/<?= $peringatan['trn_id'] ?>" class="btn btn-outline-success" > Detail</a>
        <a href="" onclick="window.print()" class="btn btn-outline-danger" > <i class="fas fa-file-pdf"></i> Print</a>
    </div>
    
</div>
<table align="center" border="0" cellpadding="1" style="width: 1000px;"><tbody>
        <tr>     
         <td colspan="3">
            <div align="center">
                <!-- <span style="font-family: Verdana; font-size 20PX;"><b>FORM SURAT PEMBINAAN / PERINGATAN </b></span> -->
                <table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0"">
                  <tr>
                      <td rowspan="11" colspan=""> <br><br><center><img src="/img/atl.jpg" alt="" width="150"></center></td>
                      <td colspan="2" class="text-center"> <b> PT. ATAP TEDUH LESTARI </b></td>
                      <td rowspan="2" >Nomor Dokumen</td>
                      <td rowspan="2">ATL-HO-SOP-HRD-04-02</td>
                  </tr>

                  <tr >
                      <td class="text-center" rowspan="10" colspan="2"> <br><br><br><b> FORM <br> SURAT PERINGATAN </b></td>
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
                      <td rowspan="2" 20 February 2022</td>
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
        
        </td>   
        </tr>

<tr> 
    
    <tr>     
         <td colspan="3">
                <div align="center">
                <span style="font-family: Verdana; font-size: 20PX;"><b> SURAT PEMBINAAN / PERINGATAN </b></span>
        </div>
        </td>
    </tr>

    <tr>     
         <td colspan="3">
                <div align="center">
                <span style="font-family: Verdana; font-size 20PX;"><b> No: <?= $peringatan['trn_no'] ?> </b></span>
        </div>
        </td>
    </tr>

    <tr>     
         <td colspan="3">
                <div align="left">
                <span style="font-family: Verdana; font-size: 20PX;">Surat Pembinaan / Peringatan ini ditujukan kepada:</span>
        </div>
        </td>
    </tr>

<tr> 


    <td colspan="2"><table border="0" cellpadding="1" style="width: 400px;"><tbody>
<tr >   
    

    <td width="93"><span style="font-size:20PX;">Nama</span></td>         
    <td width="8"><span style="font-size:20PX;">:</span></td>         
    <td width="200"><span style="font-size:20PX;"><?= $peringatan['employee_name'] ?></span></td>       
</tr>

<tr>         
    <td><span style="font-size: 20PX;">NIK</span></td>         
    <td><span style="font-size: 20PX;">:</span></td>         
    <td><span style="font-size: 20PX;"><?= $peringatan['ktp'] ?></span></td>       
</tr>

<tr>         
    <td><span style="font-size: 20PX;">Jabatan</span></td>         
    <td><span style="font-size: 20PX;">:</span></td>         
    <td><span style="font-size: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;"><?= $peringatan['position'] ?></span></td>
</tr>

</tbody>

</table>

</td>     
    <!-- <td valign="top">
        <div align="right">
    <span style="font-size 20PX;">Sumedang, 03 mei 2011</span>
    </div>
    </td>    -->

</tr>

<tr>     
    <td width="302"></td>     <td width="343"></td>     
    <td width="339"></td>   
</tr>

<tr>     
    <td>
        <table border="0" style="width: 239px;">
        <tbody>
            <br>
        <tr>         
            <td width="200"><span style="font-size: 20PX;">Kepada yth </span></td>         
            <td width="11"></td>         
            <td width="140"></td>      
        </tr>
 <tr>
    <td style="font-size: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;"><span><?=$peringatan['employee_name'] ?></span></td>
 </tr>
    <!-- <tr>         
        <td><span style="font-size 20PX;">orangtua/wali siswa</span></td>         
        <td></td>         
        <td></td>       
    </tr> -->
<tr>         
    <td><span style="font-size: 20PX;">Di Tempat</span></td>         
    <td></td>         
    <td></td>       
</tr>
<!-- <tr>         
    <td><span style="font-size 20PX;">tempat</span></td> 

    <td></td>    

     <td></td>       
    </tr> -->

</tbody>

</table>

</td>     
<td></td>     <td></td>  

</tr>
<tr>     
    <td></td>     
    <td></td>     
    <td></td>   
</tr>
<tr>     
    <td colspan="3" height="270" valign="top">
    <div align="justify"><span style="font-size: 20PX;">Dengan hormat,
Sehubungan dengan hasil evaluasi kinerja saudara <?= $peringatan['employee_name'] ?> yang harusnya sebagai karyawan selalu mematuhi & melaksanakan tata tertib serta peraturan
yang berlaku di lingkungan perusahaan, dengan ini kami memberikan peringatan kepada saudara <?= $peringatan['employee_name'] ?> atas tindakan pelanggaran tata tertib yang tidak 
dipatuhi sebagaimana mestinya, Yaitu:
 <b> <?= $peringatan['sp_desc'] ?> </b>
Dengan dikeluarkannya surat peringatan dan sanksi yang diberikan, diharapkan yang bersangkutan tidak melakukan 
kesalahan lagi & melakukan intropeksi agar selalu 
mematuhi peraturan & tata tertib yang berlaku.</span>
    </div>


<div align="justify">
<span style="font-size: 20PX;">

Demikian Surat Pembinaan / Peringatan ini diberikan untuk dapat diperhatikan</span> </div>
</div>


<div align="left" class="mt-3">
<span style="font-size: 20PX;">Jakarta, <?= date("d-m-Y", strtotime($peringatan['trn_date'])) ?></span>
</div>
</td>
</tr>

<tr>     
    <td><div align="left">
<span style="font-size: 20PX;">PT. ATAP TEDUH LESTARI</span></div><br><br><br><br><br><br>
<div align="center">

</div>
<div align="left">
<span style="font-size: 20PX;"><?= $peringatan['buat_name'] ?></span></div>
<span style="font-size: 20PX;">Administration Manager </span></div>
</td>    
 <td>

 </td>     
 <td valign="top">
    
<br><br><br><br>

<div align="center">

</div>

</td>   
</tr>
</tbody>

</table>
</div>
</body>
</html>