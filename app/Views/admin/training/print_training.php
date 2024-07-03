<style>
    @media print{
        .btn,
        footer{
            display:none;
        }
    }
</style>
<div class="container-fluid">
<div class="mb-3 mt-3">
    <a href="/training/detail_training/<?= $training['trn_id'] ?>" class="btn btn-outline-success kembali"> <i class="fas fa-arrow-left"></i> Back </a>
</div>
<div class="py-3">

            <h3 style="color: black;" class="text-center">PELATIHAN KARYAWAN | PT. ATAP TEDUH LESTARI</h3>

            <table border="1" style="width:100%; color:black;">
        <tr>
            <td>Nomor Dokumen</td>
            <td><?= $training['trn_no'] ?></td>
            
        </tr>

        <tr>
            <td> Tanggal dokumen</td>
            <td><?= date("d-m-Y", strtotime($training['trn_date'])) ?></td>
        </tr>

        <tr>
            <td>Tipe training</td>
            <td><?= $training['training_name'] ?></td>
        </tr>

        <tr>
            <td>Training Organizer</td>
            <td><?= $training['training_organizer'] ?></td>
        </tr>

        <tr>
            <td>Nama Pelatihan</td>
            <td><?= $training['training_name'] ?></td>
        </tr>

        <tr>
            <td>Training purpose</td>
            <td><?= $training['training_purpose'] ?></td>
        </tr>

        <tr>
            <td>Deskripsi</td>
            <td><?= $training['training_desc'] ?></td>
        </tr>
        <tr>
            <td>Tanggal Mulai</td>
            <td><?= date("d-m-Y" , strtotime($training['training_start'])) ?></td>
        </tr>
        <tr>
            <td>Tanggal Selesai</td>
            <td><?= date("d-m-Y" , strtotime($training['training_end'])) ?></td>
        </tr>
        <tr>
            <td>Membuat</td>
            <td><?= $training['buat_name'] ?></td>
        </tr>
        <tr>
            <td>Menyetujui</td>
            <td><?= $training['setuju_name'] ?></td>
        </tr>
    </table>
    
<br>
    <h4 style="color:black" class="text-center">List Fasilitas</h4>

    <br>
    <table border="1" style="width:100%; color:black;">
    <tr>
        <td scope="col">No</td>
        <td scope="col">Nama karyawan</td>
        <td scope="col">Biaya</td>
        
    </tr>
    <?php $nomor= 1; ?>
    <?php foreach($training_det as $trn_det) : ?>
    <tr>
        <td><?= $nomor++ ?></td>
        <td scope="col"><?= $trn_det['employee_name']  ?></td>
        <td scope="col"><?= rupiah($trn_det['biaya'])  ?></td>
    </tr>

    <?php endforeach; ?>
    </table>
</div>
</div>
<script>
    window.onload = function() {
    window.print();
    }
</script>