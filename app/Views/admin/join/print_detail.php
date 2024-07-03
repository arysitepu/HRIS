
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

<div class="container-fluid">
    <div class="mb-3">
        <a href="<?= base_url().'/join/detail/'.$join['trn_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    <a href="" onclick="window.print()" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i>Print </a>
    </div>



<table align="center" border="0" cellpadding="1" style="width: 1000px;"><tbody>
        <tr>     
         <td colspan="3">
                    <div align="center">
                        <!-- <span style="font-family: Verdana; font-size:20PX;"><b>FORM SURAT PEMBINAAN / PERINGATAN </b></span> -->
                        <table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0"">
                        <tr>
                            <td rowspan="11" colspan=""> <br><br><center><img src="/img/atl.jpg" alt="" width="150"></center></td>
                            <td colspan="2" class="text-center"> <b> PT. ATAP TEDUH LESTARI </b></td>
                            <td rowspan="2" >Nomor Dokumen</td>
                            <td rowspan="2">ATL-HO-SOP-HRD-04-02</td>
                        </tr>

                        <tr >
                            <td class="text-center" rowspan="10" colspan="2"> <br><br><br><b> FORM <br> SURAT PERJANJIAN KERJA KARYAWAN </b></td>
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
                            <td rowspan="2">20 February 2022</td>
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
                <span style="font-family: Verdana; font-size:20PX;"><b> SURAT PERJANJIAN KERJA KARYAWAN </b></span>
        </div>
        </td>
    </tr>

    <tr>     
         <td colspan="3">
                <div align="center">
                     <span style="font-family: Verdana; font-size:20PX;"><b> No: <?= $join['trn_no'] ?> </b></span>
                </div>
        </td>
    </tr>

    

    <!-- <tr>
         <td colspan="3">
                <div align="left">
                <span style="font-family: Verdana; font-size:20PX;">Telah di sepakati</span>
        </div>
        </td>
    </tr> -->

<tr> 


        <td colspan="2"><table border="0" cellpadding="1" style="width: 400px;"><tbody>
    <tr > 
        <td width="93"><span style="font-size:18PX;">Nama</span></td>         
        <td width="8"><span style="font-size:18PX;">:</span></td>         
        <td width="199"><span style="font-size:18PX;"><?= $join['employee_name'] ?> </span></td>       
    </tr>

    <tr > 
        <td width="4000"><span style="font-size:18PX;">Tempat/Tanggal Lahir</span></td>         
        <td width="1000"><span style="font-size:18PX;">:</span></td>         
        <td width="6000"><span style="font-size:18PX;"><?= $join['tempat_lahir'] ?>, <?= $join['tanggal_lahir'] ?> </span></td>       
    </tr>

    <tr > 
        <td width="4000"><span style="font-size:18PX;">Alamat</span></td>         
        <td width="1000"><span style="font-size:18PX;">:</span></td>         
        <td width="6000"><span style="font-size:18PX;"><?= $join['alamat'] ?> </span></td>       
    </tr>

    <tr>         
        <td colspan="3"><span style="font-size:18PX;">Telah di sepakati</span></td>  
    </tr>

    <tr>         
        <td ><span style="font-size:18PX;">Sebagai</span></td>         
        <td><span style="font-size:18PX;">:</span></td>         
        <td colspan="3"><span style="font-size:18PX;"> <?= $join['position'] ?> </span></td>       
    </tr>

    <tr>         
        <td><span style="font-size:18PX;">SBU</span></td>         
        <td><span style="font-size:18PX;">:</span></td>         
        <td><span style="font-size:18PX;"><?= $join['branch'] ?></span></td>       
    </tr>

    <tr>         
        <td><span style="font-size:18PX;">Sejak tanggal</span></td>         
        <td><span style="font-size:18PX;">:</span></td>         
        <td><span style="font-size:18PX;"><?= $join['join_start'] ?></span></td>       
    </tr>

    <tr>         
        <td colspan="3"><span style="font-size:18PX;">Dengan ketentuan sebagai berikut :</span></td>  
    </tr>

    </tbody>

    </table>

    </td>     
        <!-- <td valign="top">
            <div align="right">
        <span style="font-size:18PX;">Sumedang, 03 mei 1811</span>
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
<!-- <tr>         
    <td width="180"><span style="font-size:18PX;">kepada yth </span></td>         
    <td width="11"></td>         
    <td width="140"></td>      
 </tr> -->
    <!-- <tr>         
        <td><span style="font-size:18PX;">orangtua/wali siswa</span></td>         
        <td></td>         
        <td></td>       
    </tr> -->
<!-- <tr>         
    <td><span style="font-size:18PX;">Di Tempat</span></td>         
    <td></td>         
    <td></td>       
</tr> -->
<!-- <tr>         
    <td><span style="font-size:18PX;">tempat</span></td> 

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
    <div align="justify"><span style="font-size:18PX;">1. Gaji All in : Rp. 4.500.000/bulan
 <b>  </b>
</span>
    </div>
   
    <div align="justify"><span style="font-size:18PX;">2. Hubungan kerja berakhir apabila: <br> </span>
    <span style="font-size:18PX;"> <ul> <li> <p class="text-justify">Dalam masa penilaian oleh atasan, trinee menunjukkan hasil kurang maksimal, sebelum
            masa percobaan selama 3 (tiga) bulan secara sepihak perusahaan berhak untuk memutuskan ikatan kerja training
            </p>
        </li>
        <li> <p class="text-justify">Kualitas pekerjaan tidak memenuhi kriteria perusahaan, banyak melakukan kesalahan yang dapat merugikan perusahaan,
            tidak dapat bekerjasama dengan rekan kerja, atasan, ataupun bawahan. 
            </p>
        </li> 
        <li> <p class="text-justify"> Tidak menunaikan tugas dan kewajiban sesuai dengan peraturan perusahaan dan petunjuk yang telah diberikan perusahaan
            melalui  atasan.
            </p>
        </li> 
        </ul> 
    </span>
    </div>

<div align="justify"><span style="font-size:18PX;">3. Hubungan kerja akan dilanjutkan menjadi karyawan kontrak / tetap apabila: <br></span>

<span style="font-size:18PX;"> <ul> <li> <p class="text-justify">Selama masa evaluasi karyawan menunjukan kinerja, attitude, tanggung jawab dan kerjasama
    yang baik. 
            </p>
        </li>
        <li> <p class="text-justify">Nilai yang dicapai sesuai dengan standar (baik), setelah masa training berakhir (3bulan). 
            </p>
        </li> 
        
        </ul> 
    </span>
    </div>

    <div align="justify"><span style="font-size:18PX;">4. Sehubungan dengan hasil evaluasi kinerja saudara  yang harusnya sebagai karyawan <br></span>
    <span style="font-size:18PX;"> <ol type="a"> 
        <li> <p class="text-justify">Saudara wajib memegang teguh rahasia perusahaan dan tidak memberitahukan kepada siapapun semua keterangan yang diperoleh
            dari perusahaan baik pada saat bekerja sekarang ini pada saat yang akan datang ataupun setelah tidak bekerja pada perusahaan ini.  
            </p>
        </li>
        <li> <p class="text-justify">Hal - hal lain yang diatur dalam peraturan perusahaan PT ATAP TEDUH LESTARI secara otomatis berlaku pada saudara 
            </p>
        </li> 
        
        </ol> 
    </span>
    </div>


<div align="justify">
<span style="font-size:18PX;">

Ditetapkan di Jakarta, Pada tanggal <?= $join['trn_date'] ?></span> </div>
</div>


<div align="left" class="mt-3">
<span style="font-size:18PX;">Mennyetujui syarat - syarat diatas </span>
</div>
</td>
</tr>

<tr>     
    <td><div align="left">
<span style="font-size:18PX;"> <b>PIHAK PERUSAHAAN</b> </span>
</div><br><br><br><br>
<div align="center">

</div>
<div align="left">
    <span style="font-size:18PX;"> <b><?= $join['buat_name'] ?></b>  </span></div>
    <span style="font-size:18PX;"> <b>Administration Manager</b>  </span></div>
</td>  

<td><div align="center">
    <span style="font-size:18PX;"> <b>Mengetahui</b> </span>
    </div><br><br><br><br>
    <div align="center">

    </div>
    <div align="center">
        <span style="font-size:18PX;"> <b><?= $join['setuju_name'] ?></b>   </span><br>
        <span style="font-size:18PX;"> <b>Direktur</b>  </span>
    </div>
</td> 

<td><div align="center">
    <span style="font-size:18PX;"> <b>Karyawan Ybs</b> </span>
    </div><br><br><br><br>
    <div align="center">

    </div>
    <div align="center">
    <span style="font-size:18PX;"> <b>(..............................................)</b>   </span><br>
    <span style="font-size:18PX;"> <b><?= $join['employee_name'] ?></b>  </span>
    </div>
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

