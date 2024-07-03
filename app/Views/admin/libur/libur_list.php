

<div class="container-fluid">

    <h3>Hari Libur</h3>

    <div class="containter-fluid">
    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#addModal">
        <i class="fas fa-plus"></i> Add
    </button>

    <button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-filter"> </i> Filter
  </button>

  <div class="mt-3">
  <div class="collapse" id="collapseExample">
  <div class="card card-body">

  <form action="/libur/index" method="get">
    <div class="row">
        <div class="col">
            <label for="">cari berdasarkan bulan:</label>
            <input type="month" class="form-control" name="bulan">
        </div>
    </div>
<br>
    <button type="submit" class="btn btn-outline-info"> <i class="fas fa-search"></i> Search </button>
    </form>
  </div>
</div>
</div>
    </div>

    <div class="mt-3">

        <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
            <?php endif; ?>
        </div>
    <div class="card mt-3">
        <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
        <div class="card-header">
            <h5 class="text-center"> <strong>List Hari Libur</strong> </h5>
        </div>

        <div class="card-body">

        <div class=" table table-responsive">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
            <tr>
                <th>No</th>
                <th>Jenis libur</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        <?php $no=1; ?>
        <?php foreach($libur as $lb) : ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= $lb['jenis_libur'] ?></td>
                <td><?= date("d-M-Y", strtotime($lb['tgl_libur'])) ?></td>
                <td>
                <a href="/libur/editlibur/<?= $lb['id_libur'] ?>" data-title="Edit Data" class="btn btn-primary"> <i class="fas fa-edit" title="Edit Data"></i> </a>
                <form action="/libur/<?= $lb['id_libur'] ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="delete">
                        <button type="submit" data-title="Hapus Data" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </button>
                </form>
                </td>
            </tr>
        <?php endforeach ?>
        </tbody>
            </table>
            </div>
      
        </div>
    </div>

    <!-- tambah data -->

    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data Hari Libur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/libur/save_libur" method="post">
        <?= csrf_field() ?>
      <div class="modal-body">
            
                <div class="row">
                    <div class="col">
                    <label for="" class="font-weight-bold">Jenis Libur</label>
                    <input type="text" class="form-control <?= ($validation->hasError('jenis_libur')) ? 'is-invalid' : '' ?>" name="jenis_libur" >
                    <div class="invalid-feedback">
                        <?= $validation->getError('jenis_libur') ?>
                    </div>
                    </div>
                    <div class="col">
                        <label for="" class="font-weight-bold">Tanggal Libur</label>
                        <input type="date" class="form-control  <?= ($validation->hasError('tgl_libur')) ? 'is-invalid' : '' ?>" name="tgl_libur">
                        <div class="invalid-feedback">
                            <?= $validation->getError('tgl_libur') ?>
                        </div>
                    </div>
                </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>

</div>
<script>
    $(document).ready(function () {
    $('#example').DataTable();
});
</script>