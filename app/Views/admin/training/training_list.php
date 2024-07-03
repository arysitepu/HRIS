

<!-- Begin Page Content -->
<div class="container-fluid">
<style>
    @media print{
        .navbar-nav,
        .card-header,
        .cardshadow,
        .btn,
        
        footer{
            display:none;
        }
    }
</style>
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800 align-center">Pelatihan karyawan</h1>
<div>
    <!-- <a href="<?= base_url('jaminan/printPDF') ?>" class="btn btn-success mb-3" >Print</a> -->
  
</div>

<div class="row">
    <div class="col">
   
    </div>
</div>

<div class="row mb-3">
    <div class="col">
    </div>
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">

            <div class="mb-3">
            <a href="/training/add_training" class="btn btn-outline-success"> <i class="fas fa-plus"></i> Add </a>
            </div>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                <thead>
                    <tr>
                    <th>No</th>
                        <th>Nomor Dokumen</th>
                        <th>Tipe training</th>
                        <th>Training Organizer</th>
                        <th>Training Start</th>
                        <th>Training End</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <?php $no=1; ?>
                <tbody>
                    <?php foreach ($training as $training) : ?>
                    <tr>
                    <td><?= $nomor++ ?></td>
                        <td><?= $training ['trn_no'] ?></td>
                        <td><?= $training['name_training'] ?></td>
                        <td><?= $training['training_organizer'] ?></td>
                        <td class="text-center"><?= date( "d-m-Y", strtotime($training['training_start'])) ?></td>
                        <td class="text-center"><?= date( "d-m-Y", strtotime($training['training_end'])) ?></td>
                      
                        <td>
                        <a href="/training/detail_training/<?= $training['trn_id'] ?>" class="btn btn-sm btn-outline-success" > <i class="fas fa-info-circle"></i> </a>
                        <a href="/training/edit_training/<?= $training['trn_id'] ?>" class="btn btn-sm btn-outline-primary" > <i class="fas fa-edit"></i> </a>
                        <form action="/training/<?= $training['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> </button>
                                </form>
                        </td>
                        
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

       
    </div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<script>
    $(document).ready(function () {
    $('#dataTable').DataTable();
});
</script>
            <!-- End of Main Content -->