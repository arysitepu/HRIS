<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h3 class="">Detail karyawan keluar</h3>
        
        <a href="/phk/index" class="btn btn-outline-success mb-3" > <i class="fas fa-arrow-left"></i> Back </a>
    </div>

     <div class="card shadow mb-4">

    <div class="card-body">
    <?php if($phk['employee_status'] == 4) : ?>
        <a href="/phk/detail_print/<?= $phk['trn_id'] ?>"  class="btn btn-outline-danger mb-3" > <i class="fas fa-file-pdf"></i> Print</a>
        <?php endif ?>
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>Nomor Document</td>
                <td><?= $phk['trn_no'] ?></td>
            </tr>
            <tr>
                <td>Tanggal Transaksi</td>
                <td><?= date("d-m-Y", strtotime($phk['trn_date'])) ?></td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td><?= $phk['employee_name'] ?></td>
            </tr>
            <tr>
                <td>Membuat</td>
                <td><?= $phk['buat_name'] ?></td>
            </tr>
            <tr>
                <td>Menyetujui</td>
                <td><?= $phk['setuju_name'] ?></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><?= $phk['phk_desc'] ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>
                <?php if($phk['employee_status'] == 3):?>
                    <span class="text-warning">Resign</span>
                <?php elseif($phk['employee_status'] == 4) : ?>
                    <span class="text-danger">PHK</span>
                <?php elseif($phk['employee_status'] == 5) : ?>
                    <span class="text-success">Pensiun</span>
                <?php else : ?>
                    <span></span>
                <?php endif; ?>
                </td>
            </tr>
        </table>
    </div>
    </div>

     </div>

</div>