<div class="container-fluid">
   
    <div class="d-flex justify-content-between mb-3">
        <h3 class="text-center"> Detail Surat Peringatan</h3>
        <a href="/peringatan/index" class="btn btn-outline-success" ><i class="fas fa-arrow-left"></i> Back</a>

    </div>
    <a href="/peringatan/detail_print/<?= $peringatan['trn_id'] ?>" class="btn btn-outline-info mb-3" > <i class="fas fa-print"></i> Print</a>
     <div class="card shadow mb-4">

    <div class="card-body">

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <td>Nomor Document</td>
                <td><?= $peringatan['trn_no'] ?></td>
            </tr>
            <tr>
                <td>Nama Karyawan</td>
                <td><?= $peringatan['employee_name'] ?></td>
            </tr>
            <tr>
                <td>No KTP</td>
                <td><?= $peringatan['ktp'] ?></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td><?= $peringatan['position'] ?></td>
            </tr>
            <tr>
                <td>Membuat</td>
                <td><?= $peringatan['buat_name'] ?></td>
            </tr>
            <tr>
                <td>Menyetujui</td>
                <td><?= $peringatan['setuju_name'] ?></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td><?= $peringatan['sp_desc'] ?></td>
            </tr>
        </table>
    </div>


    </div>

     </div>

</div>