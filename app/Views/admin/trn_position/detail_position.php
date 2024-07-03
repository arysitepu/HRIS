<div class="container-fluid">


<div class="d-flex justify-content-between">
    <h3>Detail Mutasi jabatan</h3>
    <?php if(session()->get('user_level') == 'admin') : ?>
    <a href="/trn_position/index/" class="btn btn-outline-success mb-3" > <i class="fas fa-arrow-left"></i> Back </a>
    <?php elseif(session()->get('user_level') == 'user') : ?>
        <a href="/karyawan/detail_karyawan_kantor/<?= $position['employee_id'] ?>" class="btn btn-outline-success mb-3" > <i class="fas fa-arrow-left"></i> Back </a>
    <?php endif ?>
</div>

<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                <tr>
                    <td>Nomor Dokumen</td>
                    <td><?= $position['trn_no'] ?></td>
                </tr>

                <tr>
                    <td>Tanggal Dokumen</td>
                    <td><?= date("d-M-Y", strtotime($position['trn_date'])) ?></td>
                </tr>

                <tr>
                    <td>Nama Karyawan</td>
                    <td><?= $position['employee_name'] ?></td>
                </tr>

                <tr>
                    <td>Posisi sekarang</td>
                    <td><?= $position['position_name'] ?></td>
                </tr>
                
                <tr>
                    <td>Posisi Sebelumnya</td>
                    <td><?= $position['position_name_old'] ?></td>
                </tr>

                <tr>
                    <td>SBU Sekarang</td>
                    <td><?= $position['branch_name'] ?></td>
                </tr>

                <tr>
                    <td>SBU Sebelumnya</td>
                    <td><?= $position['branch_name_old'] ?></td>
                </tr>

                <tr>
                    <td>Start Position</td>
                    <td><?= date("d-M-Y", strtotime($position['position_start'])) ?></td>
                </tr>

                <tr>
                    <td>Start Position Old</td>
                    <td><?= date("d-M-Y", strtotime($position['position_start_old'])) ?></td>
                </tr>

                <tr>
                    <td>Dibuat</td>
                    <td><?= $position['buat_name'] ?></td>
                </tr>

                <tr>
                    <td>Disetujui</td>
                    <td><?= $position['setuju_name'] ?></td>
                </tr>

                <tr>
                    <td>Note / Keterangan</td>
                    <td>
                        <?php if($position['note'] == null) : ?>
                            <span class="text-success">Tidak ada catatan</span>
                        <?php else : ?>
                            <span class="text-danger"><?= $position['note'] ?></span>
                        <?php endif ?>
                    </td>
                </tr>


            </table>
        </div>
    </div>
</div>
</div>