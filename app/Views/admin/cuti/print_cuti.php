
<style>

    .table-report{
        border-style:dashed;
        color: black;
    }

    @media print{
        .navbar-nav,
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

<div class="container-fluid">
<a href=""  onclick="window.print()" class="btn btn-success mb-3 mt-3" >Print</a>
<a href="/trn_cuti/index" class="btn btn-success mb-3 mt-3" >Kembali ke table</a>
<table border="1" style="width:100%;" class="mt-3">
    <tr>
        <td rowspan="6" class="text-center"><img src="/img/atl.jpg" alt="" width="100"></td>
        <td colspan="6" class="text-center">PT. ATAP TEDUH LESTARI</td>
        <td>Nomor Dokumen</td>
        <td>ATL-HO-SOP-HRD-04-02</td>
       
    </tr>
    <tr>
        <td colspan="6" rowspan="5" class="text-center">FORM PENGAJUAN CUTI</td>
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

<div class="table-report">
<h3 class="text-center mt-3">PERMOHONAN CUTI</h3>

<br>

<table border="0" style="width:85% ;">
    <tr>
        <td>I</td>
        <td class="">Nama</td>
        <td>   :</td>
        <td class=""><?= $cuti['employee_name'] ?></td>
    </tr>
    <tr>
    <td></td>
        <td class="">Departemen</td>
        <td>:</td>
        <td class=""><?= $cuti['position_name'] ?></td>
    </tr>

</table>

<hr class="col-md-11"><br><br>
<table border="0" style="width:100% ;">
    <tr>
        <td>II</td>
        <td>PILIHAN</td>
        <td></td>
        <td class="text-center">DARI TANGGAL</td>
        <td class="text-center">SAMPAI DENGAN TANGGAL</td>
    </tr>
    <tr>
        <td class="text-center"></td>
        <td>I</td>
        <td></td>
        <td class="text-center"><?= date("d-m-Y", strtotime($cuti['tgl_dari'])) ?></td>
        <td class="text-center"><?= date("d-m-Y", strtotime($cuti['tgl_sampai'])) ?></td>
    </tr>
</table>

<hr class="col-md-11"><br><br>

<table style="width: 50%;">
<tr>
        <td>III</td>
        <td>ALASAN MENGAMBIL CUTI</td>
        
        <td class=""><?= $cuti['cuti_desc'] ?></td>
    </tr>
</table>

<hr class="col-md-11"><br><br>

<table style="width:37% ;">
    <tr>
        <td>IV</td>
        <td>PEKERJAAN DISERAHKAN KE</td>
        <td><?= $cuti['serah_kerja'] ?></td>
    </tr>
</table>

<hr class="col-md-11"><br><br>

<table border="0" style="width:38% ;">
    <tr>
        <td>V</td>
        <td>ALAMAT SELAMA CUTI</td>
        <td><?= $cuti['alamat_cuti'] ?></td>
    </tr>
</table>

<hr class="col-md-11"><br><br>

<table style="width:42% ;">
    <tr>
        <td>VI</td>
        <td>DIISI OLEH HR DEPT</td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td>HAK CUTI (Tahun:<?= $cuti['hak_cuti'] ?>)</td>
        <td>:</td>
        <td> <?= $cuti['hak_cuti'] ?> Hari</td>
    </tr>

     <tr>
        <td></td>
        <td>CUTI YANG TELAH DI PAKAI</td>
        <td>:</td>
        <td> <?= $cuti_jumlah['cuti_jumlah'] ?> Hari</td>
    </tr>

    <tr>
        <td></td>
        <td>CUTI YANG AKAN DI PAKAI</td>
        <td>:</td>
        <td> <?= $cuti['cuti_jumlah'] ?> Hari</td>
    </tr>

    <tr>
        <td></td>
        <td>SISA CUTI</td>
        <td>:</td>
        <td> 

        <?php 
            $cuti_sisa = $cuti['hak_cuti'] -  $cuti_jumlah['cuti_jumlah'];
            echo $cuti_sisa;
        ?>
        <!-- <?php 
        $cuti_sisa = $cuti['hak_cuti'] - $cuti['cuti_jumlah']; 
         echo $cuti_sisa;
         ?> Hari -->
    </td>
    </tr>
</table>

<hr class="col-md-11"><br><br>
<table style="width: 20% ;">
    <tr>
        <td style="width: 10%; ;"></td>
        <td>Jakarta,</td>   
        <td><?= date("d-m-Y", strtotime($cuti['trn_date'])) ?></td>
    </tr>
</table>
<br><br><br>

<table style="width:100% ;">
    <tr>
        <td style="width:10% ;"></td>
        <td>Pemohon</td>
        <td></td>
        <td style="width:18% ;"></td>
        <td>Setuju / Tidak Setuju</td>
    </tr>

    </table>
<br><br><br><br> <br><br>

    <table style="width:100% ;">
    <tr>
        <td style="width:10% ;"></td>
        <td><?= $cuti['employee_name'] ?></td>
        <td><?= $cuti['serah_kerja'] ?></td>
        <td><?= $cuti['buat_name'] ?></td>
        <td><?= $cuti['setuju_name'] ?></td>
    </tr>

    <tr>
        <td style="width:10% ;"></td>
        <td>KaryawanYbs</td>
        <td>Pegawai pengganti</td>
        <td>Atasan KaryawanYbs</td>
        <td>Direktur</td>
    </tr>

    
 
    </table>

</div>


</div>