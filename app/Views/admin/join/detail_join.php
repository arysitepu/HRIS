<div class="container-fluid">
   <div class="">
    <h5>Detail Pengangkatan</h5>
   </div>

   <hr>
   
   <div class="">
       <a href="/join/index/" class="btn btn-outline-success mb-3 my-3" > <i class="fas fa-arrow-left"></i> Back </a>
   <a href="/join/detail_print/<?= $join['trn_id'] ?>" class="btn btn-outline-danger mb-3 my-3" >Print <i class="fas fa-file-pdf"></i> </a>
   </div>

   <div class="row">
    <div class="col">
    <div class="table-responsive">
        <table class="table table-bordered bg-white">
            <tr>
                <td>Nama Karyawan</td>
                <td><?= $join['employee_name'] ?></td>
            </tr>

            <tr>
                <td>Tempat/Tanggal Lahir</td>
                <td><?= $join['tempat_lahir'] ?> / <?= $join['tempat_lahir'] ?> </td>
            </tr>

            <tr>
                <td>Alamat</td>
                <td><?= $join['alamat'] ?> </td>
            </tr>

            <tr>
                <td>Position</td>
                <td><?= $join['position'] ?> </td>
            </tr>

            <tr>
                <td>SBU</td>
                <td><?= $join['branch'] ?> </td>
            </tr>

            <tr>
                <td>Tanggal Join</td>
                <td><?= date("d-M-Y", strtotime($join['join_start'])) ?> </td>
            </tr>

            <tr>
                <td>Status</td>
                <td> 
                <?php
                if($join['employee_status'] == 1){
                    echo "Probation";
                }elseif($join['employee_status'] == 2){
                    echo "Tetap";
                }
                ?> 
                </td>
            </tr>
            <tr>
                <td>Note</td>
                <td>
                    <?php if($join['note'] == null) : ?>
                        <span class="text-success">Tidak ada catatan</span>
                    <?php else : ?>
                        <span class="text-danger"><?= $join['note'] ?></span>
                    <?php endif ?>
                </td>
            </tr>
        </table>
    </div>
    </div>
   </div>
</div>