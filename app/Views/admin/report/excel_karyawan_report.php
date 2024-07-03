<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Datakaryawan.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>

<div class="container-fluid">

<table border="1" style="width:100%; color:black;">
    <tr>
        <td>Total karyawan
        <?php 
            if($sbu_name['branch_id'] == ""){
                echo "semua SBU";
            }elseif($sbu_name['branch_id'] == "cabang"){
                echo "";
            }else{
                echo $sbu_name['branch_name'];
            }
        ?>
        </td>
        <td>Karyawan tetap / aktif</td>
        <td>Karyawan probation</td>
        <td>karyawan Resign</td>
    </tr>
    <td><?= $count_sbu ?> Orang</td>
        <td><?= $count_tetap ?> orang</td>
        <td><?= $count_probation ?> orang</td>
        <td><?= $count_resign ?> Orang</td>
    <tr>

    </tr>
</table>

<br>

<table border="1" style="width:100%; color:black;">
                        <tr>
                            <td>No</td>
                            <td>Nama Karyawan</td>
                            <td>SBU</td>
                            <td>Position</td>
                            <td>Tanggal Masuk</td>
                            <td>Masa kerja</td>
                            <td>Status</td>
                        </tr>
                       
                        <?php $nomor = 1; ?>
                        <?php foreach($karyawan as $kry) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $kry['employee_name'] ?></td>
                            <td><?= $kry['branch_name'] ?></td>
                            <td><?= $kry['position_name'] ?></td>
                            <td><?= date("d-m-Y", strtotime($kry['tanggal_masuk'])) ?></td>
                            <td>
                            <?php 
                
                        
                $awal = new DateTime($kry['tanggal_masuk']);
                $akhir = new DateTime(($kry['tanggal_keluar']) ?? '');
                $akhir1 = date_create();
                
                if($kry['tanggal_keluar'] != null){

                    $jarak = $akhir->diff($awal);
                    echo $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan";
                }else{
                    $jarak = $akhir1->diff($awal);
                    echo $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan";
                }

               
                
                ?>
                            </td>
                            <td>
                                <?= ($kry['employee_status'] == 0) ? 'None' :'' ?>
                            <?= ($kry['employee_status'] == 1) ? '<h6><span class="badge badge-primary">Probation</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 2) ? '<h6><span class="badge badge-success">Tetap</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 3) ? '<h6><span class="badge badge-warning">Resign</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 4) ? '<h6><span class="badge badge-danger">Phk</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 5) ? '<h6><span class="badge badge-dark">Pensiun</span></h6>' :'' ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                     
                      
                    </table>
</div>
