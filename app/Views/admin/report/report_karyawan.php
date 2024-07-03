<div class="container-fluid">
    <?php if(session()->get('user_level') == 'admin') : ?>
    <a href="/report/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Menu Report </a>
    <?php endif; ?>
    <a href="/karyawan/index/" class="btn btn-outline-success"> <i class="fas fa-users"></i> Halaman karyawan </a>
    <a href="/report/report_karyawan/" class="btn btn-outline-info"> <i class="fas fa-sync"></i> reset </a>
    <div class="card mt-3">

        <div class="card-body">

        <?php if(session()->get('user_level') == 'user') : ?>
            <form action="/report/search_report_karyawan_user" method="get">
                    <div class="row">
                    <div class="col">
                    <select name="status" id="" class="selField form-control">
                            <option value="">Silahkan pilih Status</option>
                            <option value="2">Tetap</option>
                            <option value="1">Probation</option>
                            <option value="3">Resign</option>
                            <option value="4">PHK</option>
                        </select>
                    </div>
                </div>
                <br>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success"> <i class="fas fa-search"></i> Search </button>
                    <button type="submit" formaction="/report/cetak_excel/" class="btn btn-success"> <i class="fas fa-download"></i> export excel</button>
                    <button type="submit" formaction="/report/cetak_pdf/"  class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i> PDF</button>
                    <button type="submit" class="btn btn-success"> <i class="fas fa-users"></i> Lihat Semua karyawan </button>
                </div>
            </div>
        </form>
        <?php endif ?>

            <?php if(session()->get('user_level') == 'admin') : ?>
            <form action="/report/search_report_karyawan" method="get">
                    <div class="row">
                    <div class="col">
                    <select name="status" id="" class="selField form-control">
                            <option value="">Silahkan pilih Status</option>
                            <option value="2">Tetap</option>
                            <option value="1">Probation</option>
                            <option value="3">Resign</option>
                            <option value="4">PHK</option>
                        </select>
                    </div>
                </div>
                <br>
            <div class="row">
                <div class="col">
                <select name="sbu" id="" class="selField form-control">
                    <option value="">Silahkan pilih SBU</option>
                    <?php foreach($branch as $sbu) : ?>
                    <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
                    <?php endforeach; ?>
                </select>
                </div>
            </div>
        <br>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-success"> <i class="fas fa-search"></i> Search </button>
                    <button type="submit" formaction="/report/cetak_excel/" class="btn btn-success"> <i class="fas fa-download"></i> export excel</button>
                    <button type="submit" formaction="/report/cetak_pdf/"  class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i> PDF</button>
                    <button type="submit" class="btn btn-success"> <i class="fas fa-users"></i> Lihat Semua karyawan </button>
                </div>
            </div>
        </form>
        <?php endif ?>
        </div>
    </div>

    
    <div class="alert alert-success mt-3">
      
        Total karyawan  <?php 
            if($sbu_name['branch_id'] == ""){
                echo "semua SBU";
            }elseif($sbu_name['branch_id'] == "cabang"){
                echo "";
            }else{
                echo $sbu_name['branch_name'];
            }
        ?>:  <?= $count_sbu ?> Orang | | karyawan status tetap / aktif: <?= $count_tetap ?> orang 
        | |   karyawan status probation: <?= $count_probation ?> orang | | <br> Karyawan Resign: <?= $count_resign ?> Orang
    </div>
            <div class="card mt-3">
                <div class="card-body">
                    <table border="1" style="width:100%; color:black;">
                        <tr>
                            <td>No</td>
                            <td>Nama Karyawan</td>
                            <td>SBU</td>
                            <td>Position</td>
                            <td>Pendidikan</td>
                            <td>Tanggal Masuk</td>
                            <td>Masa kerja</td>
                            <td>Status</td>
                        </tr>

                     
                        <?php if($sbu_name['branch_id'] == "cabang"){ ?>
                        <tr>
                            <td colspan="7" class="text-center">Silahkan pilih SBU atau tekan tombol lihat semua karyawan untuk melihat data </td>
                        </tr>
                        <?php }else{ ?>
                        <?php $nomor = 1; ?>
                        <?php foreach($karyawan as $kry) : ?>
                        <tr>
                            <td><?= $nomor++ ?></td>
                            <td><?= $kry['employee_name'] ?></td>
                            <td><?= $kry['branch_name'] ?></td>
                            <td><?= $kry['position_name'] ?></td>
                            <td><?php 
                            if($kry['education_type'] == 1){
                                echo "SD";
                            }elseif($kry['education_type'] == 2){
                                echo "SMP";
                            }elseif($kry['education_type'] == 3){
                                echo "SMA";
                            }elseif($kry['education_type'] == 4){
                                echo "Perguruan Tinggi";
                            }else{
                                echo "-";
                            }
                            ?>
                            </td>
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
                            <?= ($kry['employee_status'] == 1) ? '<h6><span class="text text-primary">Probation</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 2) ? '<h6><span class="text text-success">Tetap</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 3) ? '<h6><span class="text text-warning">Resign</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 4) ? '<h6><span class="text text-danger">Phk</span></h6>' :'' ?>
                            <?= ($kry['employee_status'] == 5) ? '<h6><span class="text text-dark">Pensiun</span></h6>' :'' ?>
                            </td>
                        </tr>
                        <?php endforeach ?>
                        <?php } ?>
                      
                    </table>
                </div>
                
            </div>
            <script type="text/javascript">
                $(".selField").select2()
                </script>
</div>
