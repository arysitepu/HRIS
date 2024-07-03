<div class="container-fluid">
    <div class="container">
        <h3>Pelatihan</h3>
    
        <?php if(session()->getFlashdata('pesan')) { ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('pesan') ?>
        </div>
        <?php }elseif(session()->getFlashdata('pesan_error')){ ?>
        <div class="alert alert-danger">
            <?= session()->getFlashdata('pesan_error') ?>
        </div>
        <?php } ?>

        <div class="card">
            <div class="card-shadow">
            <div class="card-body">
                <div class="">
                <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-plus"></i> Add
                </button>
                </div>
                        <div class="table table-responsive">
                            <table id="training" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Training name</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        <?php foreach($mst_trainings as $mst_training) : ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $mst_training['name_training'] ?></td>
                                            <td>
                                            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#Edit<?= $mst_training['id_training'] ?>">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                                <form action="/mst_training_type/<?= $mst_training['id_training'] ?>" method="post" class="d-inline">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="_method" value="delete">
                                                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                    </div>
       
                </div>
        
            </div>
</div>

<div class="">
    <!-- add data -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Data Pelatihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/training_master/add" method="POST">
            <?= csrf_field() ?>
            <div class="row">
            <div class="col">
                <label for="">Nama tipe training</label>
                <input type="text" class="form-control <?= ($validation->hasError('name_training')) ? 'is-invalid' : '' ?>" name="name_training">
                <div class="invalid-feedback">
                    <?= $validation->getError('name_training') ?>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="">
    <!-- edit data -->
<?php foreach($mst_trainings  as $mst_training) : ?>
<div class="modal fade" id="Edit<?= $mst_training['id_training'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Data Pelatihan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/training_master/update_mst_training/<?= $mst_training['id_training'] ?>" method="POST">
            <?= csrf_field() ?>
            <input type="hidden" name="id_training" value="<?= $mst_training['id_training'] ?>">
            <div class="row">
            <div class="col">
                <label for="">Name training</label>
                <input type="text" class="form-control <?= ($validation->hasError('name_training')) ? 'is-invalid' : '' ?>" name="name_training"
                value="<?= $mst_training['name_training'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('name_training') ?>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-outline-primary">Update changes</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>

<script>
    $(document).ready(function () {
    $('#training').DataTable();
});
</script>
