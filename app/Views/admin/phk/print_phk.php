<html>
<head>
<title>Surat PHK</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Serif&display=swap" rel="stylesheet">

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



</head>

<body class="body">
<div class="container-fluid">
    <br>
    <div class="row mb-3 ml-3">
        <h3>Surat PHK</h3>
    </div>
<div class="mb-3">
    <a href="/phk/detail/<?= $phk['trn_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    <a href="/phk/detail_print/<?= $phk['trn_id'] ?>"  onclick="window.print()" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i> Print</a>
</div>


<table align="center" border="0" cellpadding="1" style="width: 1000px;">

    <tbody>
        <tr>     
            <td colspan="3">
                <div align="center">

                <!-- coba header table -->
                    
                <!-- batas -->
                <table border="1" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <tr>
                      <td rowspan="11" class="text-center" > <br><img src="/img/atl.jpg" alt="" width="150"></td>
                      <td colspan="2" class="text-center">PT. ATAP TEDUH LESTARI</td>
                      <td>Nomor Dokumen</td>
                      <td>ATL-HO-SOP-HRD-04-02</td>
                  </tr>

                  <tr >
                        
                      <td class="text-center" rowspan="10" colspan="2"> <br><br> FORM <br> SURAT PEMUTUSAN HUBUNGAN KERJA</td>
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
                      <td rowspan="">20 February 2022</td>
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

                                <!-- <span style="font-family: Verdana; font-size: 20px;"><b>SURAT PEMUTUHSAN HUBUNGAN KERJA</b></span> -->

                                        <hr/>
                        <tr>     
                                <td colspan="3">
                                    <div align="center" class="mb-4">

                                    <span style="font-family: Verdana; font-size: 20px;"><b>SURAT PEMUTUHSAN HUBUNGAN KERJA</b></span><br>

                                        <span style="font-family: Verdana; font-size: 20px"><b> No: <?= $phk['trn_no'] ?> </b></span>
                                    </div>
                                </td>
                        </tr>

                </div>

            </td>  
            
        </tr>

        <tr>     
            <td colspan="2">
                <table border="0" cellpadding="1" style="width: 700px;">
                    
                    <tbody>
                        
                        <tr>         
                            <td><span style="font-size: 20px;">Perihal</span></td>         
                            <td><span style="font-size: 20px;">:</span></td>         
                            <td><span style="font-size: 20px;">Surat Pemutusan Hubungan Kerja</span></td>       
                        </tr>

                    </tbody>

                </table>

            </td>     
            <!-- <td valign="top">
                <div align="right">
            <span style="font-size: ;">Sumedang, 03 mei 2011</span>
            </div>
            </td>    -->

        </tr>

        <tr>     
            <td width="202"></td>     
            <td width="343"></td>     
            <td width="339"></td>   
        </tr>

        <tr>     
            <td>
        <br>
                    <table border="0" style="width: 539px;">
                            <tbody>
                                    <tr>         
                                        <td width="74"><span style="font-size: 20px;">Kepada Yth: <br><?= $phk['employee_name'] ?></span></td>         
                                        <td width="11"></td>         
                                        <td width="140"></td>      
                                    </tr>
                                        
                                    <tr>         
                                        <td><br><br><span style="font-size: 20px;">Di Tempat</span></td>         
                                        <td></td>         
                                        <td></td>       
                                    </tr>
                        </tbody>
                    </table>

            </td> 

            

        

        </tr>
        <tr>     
            <td></td>     
            <td></td>     
            <td></td>   
        </tr>

        <tr>      
            <td></td>     
            <td></td>     
            <td></td>   
        </tr>

        <tr>     
            <td colspan="3" height="270" valign="top"><br>
                <div align="justify"><span style="font-size: 20px;" class="mt-3">Dengan hormat, <br>
        Sehubungan dengan hasil evaluasi kinerja saudara selama <?= date("d-m-Y",strtotime($phk['phk_date'])) ?> bulan terakhir dan berdasarkan Surat Peringatan I, II, III yang telah dibeikan, kami
        menilai tidak ada peningkatan dan perbaikan kinerja dari sisi kedisiplinan dan tanggung jawab pekerjaan. Oleh karena itu, maka kami memutuskan untuk tidak 
        melanjutkan hubungan kerja (Pemutusan Hubungan Kerja) dengan saudara/saudari <?= $phk['employee_name'] ?></span>


        <div align="justify">
        <span style="font-size: 20px;"><br>

        Demikian surat ini kami sampaikan, kami harap ibu/bapa dapat menghadiri rapat ini. sekian dan terima kasih.</span> </div>
        </div>


        <div align="left" class="mt-3">
        <span style="font-size: 20px;">Jakarta, <?= date( "d-m-Y" ,strtotime($phk['trn_date'])) ?></span>
        </div>



        </td>   
        </tr>

        <tr>     
                <td>
                    <div align="left">
                        <span style="font-size: 20px;">PT. ATAP TEDUH LESTARI</span>
                    </div><br><br><br><br>

                        <div align="center">

                        </div>

                        <div align="left">
                        <span style="font-size: 20px;"><?= $phk['buat_name'] ?></span>
                        </div>

                        <div align="left">
                        <span style="font-size: 20px;">Administration Manager </span>
                        </div>
                </td> 

                <td>
            
                </td>

                <td valign="top"  >
                    <div align="center"><br><br>
                            <span style="font-size: 20px;">Disetujui </span>
                    </div></div><br><br><br><br>

                        <div align="center">

                        </div>

                        <div align="center" >
                        <span style="font-size: 20px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 300px;"><?= $phk['setuju_name'] ?></span>
                        </div>

                        <div align="center">
                        <span style="font-size: 20px;">Direktur SBU</span>
                        </div>
                </td>   

        </tr>
    </tbody>
</table>
</div>
</body>
</html>