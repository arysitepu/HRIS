<div class="contaier-fluid">
<div class="container">
    <h3>Absensi</h3>

    <?php if(session()->getFlashdata('success')) : ?>
    <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif ?>

    <?php if(session()->getFlashdata('failed')) : ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('failed') ?></div>
    <?php endif ?>

    <div class="swal" data-swal="<?= session()->get('success') ?>"></div>
    <div class="swal_error" data-swal_error="<?= session()->get('failed') ?>"></div>
        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
            <i class="fas fa-file-import"></i> Import data
        </button>

    <div class="card my-3">
        <div class="card-header text-center">
           List Absensi ATL
        </div>

        <div class="card-body">
        <div class="table table-responsive">
        <table id="test" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama karyawan</th>
                <th>Jam Masuk</th>
                <th>Jam Pulang</th>
                <th>Tanggal Absensi</th>
                <!-- <th>Aksi</th> -->
            </tr>
        </thead>
        <tbody>
            <?php $no=1; ?>
            <?php foreach($absensi as $absen) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $absen['employee_name'] ?></td>
                <td><?= $absen['jam_masuk'] ?></td>
                <td><?= $absen['jam_pulang'] ?></td>
                <td><?= $absen['tgl_absensi'] ?></td>
                <!-- <td>
                    <a href="" class="btn btn-outline-primary"> <i class="fas fa-edit"></i> </a>
                </td> -->
            </tr>
            <?php endforeach ?>
        </tbody>
        </table>
        </div>
        </div>
    </div>
    </div>
</div>

<!-- add modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload file</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/absensi/save" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <input type="file" class="form-control <?= ($validation->hasError('file_absensi')) ? 'is-invalid' : '' ?>" name="file_absensi">
        <div class="invalid-feedback">
            <?= $validation->getError('file_absensi') ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- batas -->

<script>
    $(document).ready(function () {
    $('#test').DataTable();
});
</script>