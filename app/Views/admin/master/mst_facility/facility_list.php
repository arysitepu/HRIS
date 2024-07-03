<div class="container-fluid">
        <div class="">
            <h3 class="">Fasilitas</h3>
        </div>
        <?php if(session()->getFlashdata('pesan')) { ?>
            <div class="alert alert-success">
                <?= session()->getFlashdata('pesan') ?>
            </div>
        <?php }elseif(session()->getFlashdata('pesan_error')){ ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('pesan_error') ?>
            </div>
        <?php } ?>

        <div class="swal_error" data-swal_error="<?= session()->get('pesan_error') ?>"></div>
        <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card">
        <div class="card-body">
        <div class="">
            <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#exampleModal"> <i class="fas fa-plus"></i> 
            Tambah data
        </button>
        </div>
<br>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Tipe Fasilitas</th>
                        <th scope="col">Nama Fasilitas</th>
                        <th scope="col">SBU</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach($mst_facility as $fasilitas) : ?>
                    <tr>
                    <th scope="row"><?= $nomor++ ?></th>
                    <td><?= $fasilitas['type_name'] ?></td>
                    <td><?= $fasilitas['facility_name'] ?></td>
                    <td><?= $fasilitas['branch_name'] ?></td>
                    <td>
                        <a href="/mst_facility/edit/<?= $fasilitas['facility_id'] ?>" data-title="Edit" class="btn btn-outline-primary"><i class="fas fa-edit"></i> </a>
                        <form action="/mst_facility/<?= $fasilitas['facility_id'] ?>" class="d-inline" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-outline-danger" data-title="Hapus" onclick="return confirm('apakah anda yakin?.')"> <i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>

            <div class="">
                <?= $pager->links('default', 'custom_pagination') ?>
            </div>
        </div>

        <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add data fasilitas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="/mst_facility/save" method="post">
      <div class="modal-body">
        <div class="row">
                <div class="col">
                <label for="">Tipe Fasilitas</label>
                <select name="type_id" id="" class="selField" style="width: 100%;">
                   <option value="">Pilih</option>
                   <?php foreach($mst_type as $type) : ?>
                   <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                   <?php endforeach ?>
                </select>
                </div>
                <div class="col">
                <label for="">Nama fasilitas</label>
                <input type="text" class="form-control <?= ($validation->hasError('facility_name')) ? 'is-invalid' : '' ?>" name="facility_name">
                <div class="invalid-feedback">
                    <?= $validation->getError('facility_name') ?>
                </div>
                </div>
        </div>
<hr>
        <div class="row">
                <div class="col">
                <label for="">Code fasilitas</label>
                <input type="text" class="form-control" name="facility_code">
                </div>
                <div class="col">
                <label for="">Kondisi fasilitas</label>
                <input type="text" class="form-control" name="facility_condition">
                </div>
                <div class="col">
                <label for="">SBU</label>
                <select name="branch_id" id="" class="selField <?= ($validation->hasError('branch_id')) ? 'is-invalid' : '' ?>" style="width: 100%;">
                    <option value="">Pilih</option>

                    <?php foreach($branch as $sbu) : ?>
                    <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('branch_id') ?>
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

<!-- batas modal -->

    </div>

    <script type="text/javascript">
       $(".selField").select2();
     </script>
</div>