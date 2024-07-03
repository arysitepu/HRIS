<style>
    @media print{
        .input-print,
        .input-print,
        #toolbarContainer,
        .judul,
        footer{
            display:none;
        } 
        
        .background-report{
            background-color: #B0DAFF;
        }
    }
    @page{
        size: auto;
    }
</style>



<div class="container-fluid">
    <br>
    
<form action="/report/search_report_cuti_tahun">
    <div class="row input-print">
        <div class="col">
            <input type="text" class="form-control col-md-3 d-inline" id="datepicker" name="years" value="">
            <?php if(session()->get('user_level') == 'admin') : ?>
            <select name="sbu" id="" class="form-control col-md-3 d-inline">
                <option value="">Select SBU</option>
            <?php foreach($branch as $sbu) : ?>
                <option value="<?= $sbu['branch_id'] ?>"> <?= $sbu['branch_name'] ?> </option>
            <?php endforeach ?>
            </select>
            <?php elseif(session()->get('user_level') == 'user') : ?>
                <select name="sbu" id="" class="form-control col-md-3 d-inline">
                    <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
                </select>
            <?php endif; ?>

        </div>
    </div>
    
    <div class="row input-print mt-3">
        <div class="col">
        <button type="submit" class="btn btn-info"> <i class="fas fa-search"></i> Search </button>
            <a href="" onclick="window.print()" class="btn btn-success mb-3 d-inline" > <i class="fas fa-print"></i> Print</a>
            <!-- <a href="/report/report_excel" class="btn btn-success" target="_blank"> <i class="fas fa-download"></i> excel </a> -->
            <button type="submit" formaction=<?= base_url("/report/report_excel") ?> class="btn btn-success" target="_blank"> <i class="fas fa-download"></i> excel </button>
            <!-- <button type="submit" formaction=<?= base_url("/exportexcel/trn_cuti_tahun") ?> class="btn btn-success"> <i class="fas fa-download"></i> excel </button> -->
    
        <a href="/trn_cuti/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
        <a href="/report/report_cuti_tahun/" class="btn btn-outline-warning"> <i class="fas fa-sync"></i> Reset</a>
    
        </div>
    </div>
</form>

<br>

<br><br>
<div align="center">

<table border="1" style="width:100%; color:black;" class="center mt-3">
    <tr>
        <td rowspan="6" class="text-center"><img src="/img/logoatl.png" alt="" width="180"></td>
        <td colspan="6" class="text-center">PT. ATAP TEDUH LESTARI</td>
        <td>Nomor Dokumen</td>
        <td>ATL-HO-SOP-HRD-04-02</td>
       
    </tr>
    <tr>
        <td colspan="6" rowspan="5" class="text-center">REKAPITULASI ATTEDANCE</td>
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

<br><br>

<span class="center" style="color: black;">REKAPITULASI KEHADIRAN KARYAWAN PADA PT ATAP TEDUH LESTARI TAHUN <?= $years ?> </span>
<br><br>
<div class="card">



<table border="1" style="width:100%; color:black;">
    <tr>
        <td rowspan="2" class="text-center text-black"> <strong>No</strong> </td>
        <td rowspan="2" class="text-center text-black"><strong>Uraian</strong></td>
        <td colspan="6" rowspan="2" class="text-center text-black"><strong>Jumlah</strong></td>
        <td colspan="103" class="text-center text-black"><strong>Bulan</strong></td>
    </tr>
    <tr>
       
        <td colspan="5" class="text-center text-black background-report"> <strong>Januari</strong> </td>
        <td colspan="5" class="text-center text-black"> <strong>Febuari</strong> </td>
        <td colspan="5" class="text-center text-black background-report"> <strong>Maret</strong> </td>
        <td colspan="5" class="text-center text-black"><strong>April</strong></td>
        <td colspan="5" class="text-center text-black background-report"><strong>Mei</strong></td>
        <td colspan="5" class="text-center text-black"><strong>Juni</strong></td>
        <td colspan="5" class="text-center text-black background-report"><strong>July</strong></td>
        <td colspan="5" class="text-center text-black"><strong>Agustus</strong></td>
        <td colspan="5" class="text-center text-black background-report"><strong>September</strong></td>
        <td colspan="5" class="text-center text-black"><strong>Oktober</strong></td>
        <td colspan="5" class="text-center text-black background-report"><strong>November</strong></td>
        <td colspan="6" class="text-center text-black"><strong>Desember</strong></td>
        

    </tr>

   
    <tr>
        <td rowspan="3" class="text-center"></td>
        <td rowspan="3"></td>
        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UnL</td>
        <td class="text-center text-black" >T</td>
        <td class="text-center text-black" >TOTAL</td>

        <!-- januari -->

        <td class="text-center text-black background-report" >S</td>
        <td class="text-center text-black background-report" >C</td>
        <td class="text-center text-black background-report" >CK</td>
        <td class="text-center text-black background-report" >UL</td>
        <td class="text-center text-black background-report" >T</td>

        <!-- febuari -->

        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UL</td>
         <td class="text-center text-black" >T</td>

        <!-- maret -->

        <td class="text-center text-black background-report" >S</td>
        <td class="text-center text-black background-report" >C</td>
        <td class="text-center text-black background-report" >CK</td>
        <td class="text-center text-black background-report" >UL</td>
         <td class="text-center text-black background-report" >T</td>

        <!-- april -->

        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UL</td>
         <td class="text-center text-black" >T</td>

        <!-- mei -->

        <td class="text-center text-black background-report" >S</td>
        <td class="text-center text-black background-report" >C</td>
        <td class="text-center text-black background-report" >CK</td>
        <td class="text-center text-black background-report" >UL</td>
         <td class="text-center text-black background-report" >T</td>

        <!-- juni -->

        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UL</td>
         <td class="text-center text-black" >T</td>

        <!-- Juli -->

        <td class="text-center text-black background-report" >S</td>
        <td class="text-center text-black background-report" >C</td>
        <td class="text-center text-black background-report" >CK</td>
        <td class="text-center text-black background-report" >UL</td>
        <td class="text-center text-black background-report" >T</td>

        <!-- agustus -->

        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UL</td>
         <td class="text-center text-black" >T</td>

        <!-- september -->
        
        <td class="text-center text-black background-report" >S</td>
        <td class="text-center text-black background-report" >C</td>
        <td class="text-center text-black background-report" >CK</td>
        <td class="text-center text-black background-report" >UL</td>
        <td class="text-center text-black background-report" >T</td>

        <!-- oktober -->

        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UL</td>
        <td class="text-center text-black" >T</td>

        <!-- november -->

        <td class="text-center text-black background-report" >S</td>
        <td class="text-center text-black background-report" >C</td>
        <td class="text-center text-black background-report" >CK</td>
        <td class="text-center text-black background-report" >UL</td>
         <td class="text-center text-black background-report" >T</td>

        <!-- desember -->

        <td class="text-center text-black" >S</td>
        <td class="text-center text-black" >C</td>
        <td class="text-center text-black" >CK</td>
        <td class="text-center text-black" >UL</td>
        <td class="text-center text-black" colspan="5">T</td>


    </tr>

    <tr>
        <!-- BARIS BARU -->
    </tr>
    
    


    <tr>
        <!-- <td></td> -->
    </tr>

    <?php
    $branch = "";
    ?>
    
 
    <?php if($years && $cabang == "kosong"){ ?>
        <tr>
        <td colspan="80" class="text-center alert alert-success">Silahkan cari tahun untuk melihat data </td>
        </tr>
    <?php }else{ ?>
    
    <tr>
        <?php $no=1; ?>

        <?php foreach($cuti as $ct) : ?>
        <td class="text-center"><?= $no++ ?></td>
        <td><?= $ct['employee_name'] ?> <br> tanggal masuk: <?= date("d-m-Y", strtotime($ct['join_start'])) ?> <br> masa kerja
        <?php
            
            $awal = new DateTime($ct['tanggal_masuk']);
            $akhir = new DateTime($ct['tanggal_keluar']);
            $akhir1 = date_create();
            
            if($ct['tanggal_keluar'] != null){

                $jarak = $akhir->diff($awal);
                echo $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan";
            }else{
                $jarak = $akhir1->diff($awal);
                echo $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan";
            }   
            ?>

           <br> <span>SBU :<?=  $ct['branch_name'] ?></span> 
        </td>

        <!-- jumlah -->
        <td class="text-center text-danger"><?= ($ct['s']) ? $ct['s'] : '-'  ?></td>
        <td class="text-center text-danger"><?= ($ct['c']) ? $ct['c'] : '-'  ?></td>
        <td class="text-center text-danger"><?= ($ct['ck']) ? $ct['ck'] : '-' ?></td>
        <td class="text-center text-danger"><?= ($ct['ul']) ? $ct['ul'] : '-'  ?></td>
        <td class="text-center text-danger">-</td>
        <td class="text-center text-danger">
            <?php
                $jumlah = $ct['c'] + $ct['ck'] + $ct['s'] + $ct['ul'];

                echo $jumlah;
            ?>
        </td>

        <!-- januari -->
        <td  class="text-center text-black background-report"><?= ($ct['sjan']) ? $ct['sjan'] : '-'  ?></td>
        <td class="text-center text-black background-report"><?= ($ct['cjan']) ? $ct['cjan'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?= ($ct['ckjan']) ? $ct['ckjan'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?= ($ct['uljan']) ? $ct['uljan'] : '-'  ?></td>
        <td  class="text-center text-black background-report">-</td>

        <!-- febuari -->
        <td  class="text-center text-black"><?= ($ct['sfeb']) ? $ct['sfeb'] : '-'  ?></td>
        <td  class="text-center text-black"><?= ($ct['cfeb']) ? $ct['cfeb'] :'-'  ?></td>
        <td  class="text-center text-black"><?= ($ct['ckfeb']) ? $ct['ckfeb'] : '-'  ?></td>
        <td  class="text-center text-black"><?= ($ct['ulfeb']) ? $ct['ulfeb'] : '-'  ?></td>
         <td  class="text-center text-black">-</td>

        <!-- maret  -->
        <td  class="text-center text-black background-report"><?= ($ct['smar']) ? $ct['smar'] :'-'  ?></td>
        <td  class="text-center text-black background-report"><?= ($ct['cmar']) ? $ct['cmar'] : '-' ?></td>
        <td  class="text-center text-black background-report"><?= ($ct['ckmar']) ? $ct['ckmar'] :'-'  ?></td>
        <td  class="text-center text-black background-report"><?= ($ct['ulmar']) ? $ct['ulmar'] :'-'  ?></td>
        <td  class="text-center text-black background-report">-</td>

        <!-- april  -->

        <td  class="text-center text-black"><?=($ct['sapr']) ? $ct['sapr'] :'-'  ?></td>
        <td  class="text-center text-black"><?=($ct['capr']) ? $ct['capr'] :'-' ?></td>
        <td  class="text-center text-black"><?=($ct['ckapr']) ? $ct['ckapr'] :'-'  ?></td>
        <td  class="text-center text-black"><?=($ct['ulapr']) ? $ct['ulapr'] :'-'  ?></td>
        <td  class="text-center text-black">-</td>
        
        <!-- mei  -->
        <td  class="text-center text-black background-report"><?=($ct['smei']) ? $ct['smei'] : ''  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['cmei']) ? $ct['cmei'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?= ($ct['ckmei']) ? $ct['ckmei'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['ulmei']) ? $ct['ulmei'] : '-'  ?></td>
        <td  class="text-center text-black background-report">-</td>

        <!-- juni  -->
        <td  class="text-center text-black"><?= ($ct['sjun']) ? $ct['sjun'] : '-'  ?></td>
        <td  class="text-center text-black"><?= ($ct['cjun']) ? $ct['cjun'] : '-'  ?></td>
        <td  class="text-center text-black"><?= ($ct['ckjun']) ? $ct['ckjun'] : '-'  ?></td>
        <td  class="text-center text-black"><?= ($ct['uljun']) ? $ct['uljun'] : '-'  ?></td>
        <td  class="text-center text-black">-</td>

        <!-- juli  -->
        <td  class="text-center text-black background-report"><?=($ct['sjul']) ? $ct['sjul'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['cjul']) ? $ct['cjul'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['ckjul']) ? $ct['ckjul'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['uljul']) ? $ct['uljul'] : '-'  ?></td>
        <td  class="text-center text-black background-report">-</td>

        <!-- agustus  -->
        <td  class="text-center text-black"><?=($ct['sagus']) ? $ct['sagus'] : '-'  ?></td>
        <td  class="text-center text-black"><?=($ct['cagus']) ? $ct['cagus'] : '-' ?></td>
        <td  class="text-center text-black"><?=($ct['ckagus']) ? $ct['ckagus'] : '-'  ?></td>
        <td  class="text-center text-black"><?=($ct['ulagus']) ? $ct['ulagus'] : '-'  ?></td>
        <td  class="text-center text-black">-</td>


        <!-- september  -->
        <td  class="text-center text-black background-report"><?=($ct['ssep']) ? $ct['ssep'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['csep']) ? $ct['csep'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['cksep']) ? $ct['cksep'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['ulsep']) ? $ct['ulsep'] : '-'  ?></td>
        <td  class="text-center text-black background-report">-</td>

        <!-- oktober  -->
        <td  class="text-center text-black"><?=($ct['sokt']) ? $ct['sokt'] : '-'  ?></td>
        <td  class="text-center text-black"><?=($ct['cokt']) ? $ct['cokt'] : '-'  ?></td>
        <td  class="text-center text-black"><?=($ct['ckokt']) ? $ct['ckokt'] : '-'  ?></td>
        <td  class="text-center text-black"><?=($ct['ulokt']) ? $ct['ulokt'] : '-'  ?></td>
        <td  class="text-center text-black">-</td>

        <!-- november  -->
        <td  class="text-center text-black background-report"><?=($ct['snov']) ? $ct['snov'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['cnov']) ? $ct['cnov'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['cknov']) ? $ct['cknov'] : '-'  ?></td>
        <td  class="text-center text-black background-report"><?=($ct['ulnov']) ? $ct['ulnov'] :'-'  ?></td>
        <td  class="text-center text-black background-report"> - </td>

        <!-- desember  -->
        <td  class="text-center text-black"><?=($ct['sdes']) ? $ct['sdes'] : '-'  ?></td>
        <td  class="text-center text-black"><?=($ct['cdes']) ? $ct['cdes'] : '-'  ?></td>
        <td  class="text-center text-black" ><?=($ct['ckdes']) ? $ct['ckdes'] : '-'  ?></td>
        <td  class="text-center text-black" ><?=($ct['uldes']) ? $ct['uldes'] : '-'  ?></td>
        <td  class="text-center text-black" colspan="6">-</td>
      


    </tr>

   

    <?php endforeach ?>
    <?php } ?>
   

    
</table>

</div>
<br>
<div class="row">
    <div class="col">
       <span class="text-dark">Membuat</span> 
    </div>

    <div class="col">
        <span class="text-dark">Memeriksa</span> 
    </div>

    
    <div class="col">
       <span class="text-dark">Menyetujui</span> 
    </div>

    <div class="col">
       <span class="text-dark">Mengetahui</span> 
    </div>
</div>
<br><br><br>
<div class="row">
    <div class="col">
        <span class="text-dark">Tresna wati</span> 
    </div>

    <div class="col">
       <span class="text-dark">Ari Rizkita</span> 
    </div>

    <div class="col">
       <span class="text-dark">Sammy gunawan</span> 
    </div>

    <div class="col">
       <span class="text-dark">Lenny Magdalena Keluanan</span> 
    </div>
</div>

<div class="row">
    <div class="col">
       <span class="text-dark">Admin</span> 
    </div>

    <div class="col">
       <span class="text-dark">Staff IT</span> 
    </div>

    <div class="col">
       <span class="text-dark">IT Manager</span> 
    </div>

    <div class="col">
      <span class="text-dark">Direktur</span> 
    </div>
</div>



</div>
</div>




</div>