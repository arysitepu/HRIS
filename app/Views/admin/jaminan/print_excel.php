<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=DataJaminan.xls");
header("Cache-Control: no-cache, must-revalidate");
header("Pragma: no-cache");
?>

<div class="card-header">
        <center>
        <h6 class="m-0 font-weight-bold text-dark">Daftar Jaminan Karyawan</h6>
        </center>
    </div>

    <div class="card-body">

        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                        <tr>
                            <td rowspan="11" class="text-center"> <img src="/img/atl.jpg" alt="" width="200"></td>
                            <td colspan="2" class="text-center">PT. ATAP TEDUH LESTARI</td>
                            <td>Nomor Dokumen</td>
                            <td>ATL-HO-SOP-HRD-04-02</td>
                        </tr>

                        <tr >
                            <td class="text-center" rowspan="10" colspan="2"> <br><br> FORM <br> JAMINAN</td>
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
                            <td rowspan="">25 February 2022</td>
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

        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" border="1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama Karyawan</th>
                        <th>SBU</th>
                        <th>Nama Jaminan</th>
                        <th>Tanggal Serah Terima</th>
                       
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                    <?php foreach ($jaminan as $j) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $j['trn_no'] ?></td>
                        <td><?= $j['trn_date'] ?></td>
                        <td><?= $j['employee_name'] ?></td>
                        <td><?= $j['branch_name'] ?></td>
                        <td><?= $j['jaminan_name'] ?></td>
                        <td><?= $j['tgl_serah'] ?></td>
                        
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>


