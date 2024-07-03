<style>
    @media print{
        .navbar-nav,
        .card-header,
        .card,
        .cardshadow,
        .btn,
        .form-group,
        .jaminan,
        .aksi,
        footer{
            display:none;
        }
    }
</style>

<div class="container-fluid">

    <a href="/fasilitas/detail_fasilitas/<?= $fasilitas['trn_id'] ?>" class="btn btn-outline-success mt-3"> <i class="fas fa-arrow-left"></i> Back </a>
    <a href="" onclick="window.print()" class="btn btn-outline-danger mt-3" > <i class="fas fa-file-pdf"></i> PDF</a>
<div class="py-3">

            <h3 style="color: black;" class="text-center">FASILITAS KARYAWAN | PT. ATAP TEDUH LESTARI</h3>

            <table border="1" style="width:100%; color:black;">
        <tr>
            <td >Nomor Dokumen</td>
            <td> <?= $fasilitas['trn_no'] ?></td>
            
        </tr>

        <tr>
            <td>  Tanggal dokumen</td>
            <td><?= date("d-m-Y", strtotime($fasilitas['trn_date'])) ?></td>
        </tr>

        <tr>
            <td>Status</td>
            <td><?= ($fasilitas['status'] == 1) ? 'Penyerahan' : '' ?> <?= ($fasilitas['status'] == 2) ? 'Pengembalian' : '' ?></td>
        </tr>

        <tr>
            <td>Nama Karyawan</td>
            <td><?= $fasilitas['employee_name'] ?></td>
        </tr>

        <tr>
            <td>Membuat</td>
            <td><?= $fasilitas['buat_name'] ?></td>
        </tr>

        <tr>
            <td>menyetujui</td>
            <td><?= $fasilitas['setuju_name'] ?></td>
        </tr>
    </table>
    
<br>
    <h4 style="color:black" class="text-center">List Fasilitas</h4>

    <br>
    <table border="1" style="width:100%; color:black;">
    <tr>
        <td scope="col">No</td>
        <td scope="col">Type</td>
        <td scope="col">Nama Fasilitas</td>
        <td scope="col">Code</td>
        <td scope="col">Jumlah</td>
        <td scope="col">Kegunaan</td>
        
    </tr>
    <?php $nomor= 1; ?>
    <?php foreach($fasilitas_det as $fasilitas_det) : ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td scope="col"><?= $fasilitas_det['type_name']  ?></td>
        <td scope="col"><?= $fasilitas_det['facility_name']  ?></td>
        <td scope="col"><?= $fasilitas_det['facility_code'] ?></td>
        <td scope="col"><?= $fasilitas_det['qty'] ?></td>
        <td scope="col"><?= $fasilitas_det['kegunaan'] ?></td>
    </tr>

    <?php endforeach; ?>
    </table>
</div>
</div>