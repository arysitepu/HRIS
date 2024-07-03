<div class="container-fluid">
    <h3>Achievement</h3>
    
    <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal">
       <i class="fas fa-plus"></i> Add
    </button>

    <?php if(session()->getFlashdata('pesan')) { ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
    </div>
    <?php }elseif(session()->getFlashdata('pesan_error')){ ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('pesan_error') ?>
    </div>
    <?php } ?>

    <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
    <div class="swal_error" data-swal_error="<?= session()->get('pesan_error') ?>"></div>

    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama Achivement</th>
                    <th scope="col">Aksi</th>
                    
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1;  ?>

                    <?php foreach($mst_achivement as $achivement) : ?>
                    <tr>
                    <th scope="row"><?= $nomor++ ?></th>
                    <td><?= $achivement['name'] ?></td>
                    <td>
                        <a href="/mst_achivement/edit/<?= $achivement['id_achive'] ?>" class="btn btn-primary" data-title="Edit Data"> <i class="fas fa-edit"></i> </a>
                        
                        <form action="/mst_achivement/<?= $achivement['id_achive'] ?>" class="d-inline" method="post">
                            <input type="hidden" name="_method" value="delete">
                            <button type="submit" class="btn btn-danger" data-title="Hapus Data" onclick="return confirm('apakah anda yakin?.')"> <i class="fas fa-trash-alt"></i> </button>
                        </form>
                    </td>
                    
                    </tr>

                    <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
        
    </div>
    
            <div class="mt-3">
                <?= $pager->links('default', 'custom_pagination') ?>
            </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/mst_achivement/save/" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="row">
            <div class="col">
                <label for="">Nama Achivement</label>
                <input type="text" class="form-control <?= ($validation->hasError('name')) ? 'is-invalid' : '' ?>" name="name">
                <div class="invalid-feedback">
                <?= $validation->getError('name') ?>
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