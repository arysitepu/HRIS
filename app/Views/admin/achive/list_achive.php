<div class="container-fluid">
  
    <h3>Achievement</h3>
    <button class="btn btn-outline-primary mb-3" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-filter"></i> Filter
  </button>

  <div class="collapse" id="collapseExample">
  <div class="card card-body mb-3">
    <form action="/trn_achivement/search" method="GET">
   <div class="row">
    <div class="col">
      <input type="text" class="form-control" name="nama" placeholder="search by name">
    </div>
    <div class="col">
      <select name="branch_id" id="" class="form-control">
        <option value="">Pilih SBU</option>
        <?php foreach($branch as $sbu) : ?>
          <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
   </div>
   <hr>
   <div class="row">
    <div class="col">
      <button class="btn btn-outline-success"> <i class="fas fa-search"></i> Search </button>
    </div>
   </div>
   </form>
  </div>
  </div>
    

    <?php if(session()->getFlashdata('pesan')){ ?>
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
    <div class="card">
        <div class="container-fluid mt-3">
          <!-- <form action="" class="d-inline">
            <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
            <input class="form-control col-md-2 d-inline float-right" name="nama" placeholder="search by name...">
          </form> -->
          <button type="button" class="btn btn-outline-success mb-3" data-toggle="modal" data-target="#exampleModal">
          <i class="fas fa-plus"></i> Add
        </button>
        </div>
        <div class="card-body">
      
          <div class="table-responsive mt-3">
        <table class="table table-bordered">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Karyawan</th>
                <th scope="col">Posisi</th>
                <th scope="col">SBU</th>
                <th scope="col">Achivement</th>
                <th scope="col">Tahun Terima</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach($achivement as $acv) : ?>
                <tr>
                <th scope="row"><?= $nomor++ ?></th>
                <td><?= $acv['employee_name'] ?></td>
                <td><?= $acv['position_name'] ?></td>
                <td><?= $acv['branch_name'] ?></td>
                <td><?= $acv['name'] ?></td>
                <td><?= $acv['tahun_terima'] ?></td>
                <td>
                  <a href="/trn_achivement/detail/<?= $acv['trn_id'] ?>" class="btn btn-sm btn-outline-success"> <i class="fas fa-info-circle"></i> </a>
                  <a href="/trn_achivement/edit/<?= $acv['trn_id'] ?>" class="btn btn-sm btn-outline-primary"> <i class="fas fa-edit"></i></a>
                  <form action="/trn_achivement/<?= $acv['trn_id'] ?>" class="d-inline" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('apakah anda yakin?.');"> <i class="fas fa-trash-alt"></i> </button>
            </form>
                </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
        <div class="">
        <?= $pager->links('default', 'custom_pagination') ?>
      </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal hide fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add data achievement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/trn_achivement/save/" method="post" enctype="multipart/form-data">
      <div class="modal-body">
      <div class="row">
        <div class="col">
          <select name="employee_id" id="" class="form-control <?= ($validation->hasError('employee_id'))  ? 'is-invalid' : '' ?>">
            <option value="">Pilih karyawan</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"> <?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('employee_id') ?>
          </div>
        </div>

        <div class="col">
        <select name="id_achive" id="" class="form-control <?= ($validation->hasError('id_achive')) ? 'is-invalid' : ''; ?>">
            <option value="">Pilih Jenis achievement</option>
            <?php foreach($mst_achivement as $acvhive) : ?>
            <option value="<?= $acvhive['id_achive'] ?>"> <?= $acvhive['name'] ?></option>
            <?php endforeach; ?>
          </select>
          <div class="invalid-feedback">
            <?= $validation->getError('id_achive') ?>
          </div>
        </div>
      </div>

<hr>
        <div class="row">
        <div class="col">
                <label for="">Tahun Terima</label>
                <input type="text" id="datepicker" class="form-control <?= ($validation->hasError('tahun_terima')) ? 'is-invalid' : ''; ?>" name="tahun_terima">
                <div class="invalid-feedback">
                <?= $validation->getError('tahun_terima') ?>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
          <div class="col">
            <label for="">Upload gambar</label>
            <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar">
            <div class="invalid-feedback">
            <?= $validation->getError('gambar') ?>
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
 


  <script type="text/javascript">
    $(".theSelect").select2({
      tags: true
    });
    </script>

</div>