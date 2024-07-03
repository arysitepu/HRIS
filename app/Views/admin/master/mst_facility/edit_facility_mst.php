<div class="container-fluid">

<div class="d-flex justify-content-between">
    <h4 class="text-center">Edit Fasilitas</h4>
    <a href="/mst_facility/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
</div>
<br>
<?php if(session()->getFlashdata('pesan_error')) { ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('pesan_error') ?>
            </div>
        <?php }?>

        <div class="swal_error" data-swal_error="<?= session()->get('pesan_error') ?>"></div>
    <div class="card shadow">
        <div class="card-body">
        <form action="/mst_facility/update/<?= $mst_facility['facility_id'] ?>" method="post">
        <input type="hidden" name="facility_id" value="<?= $mst_facility['facility_id'] ?>">
        <div class="row">
                <div class="col">
                <label for="">Tipe Fasilitas</label>
                <select name="type_id" id="" class="selField" style="width: 100%;">
                   <option value="<?= $mst_facility['type_id'] ?>"><?= $mst_facility['type_name'] ?></option>
                   <?php foreach($mst_type as $type) : ?>
                   <option value="<?= $type['type_id'] ?>"><?= $type['type_name'] ?></option>
                   <?php endforeach ?>
                </select>
                </div>
                <div class="col">
                <label for="">Nama fasilitas</label>
                <input type="text" class="form-control <?= ($validation->hasError('facility_name')) ? 'is-invalid' : '' ?>" name="facility_name" value="<?= $mst_facility['facility_name'] ?>">
                <div class="invalid-feedback">
                    <?= $validation->getError('facility_name') ?>
                </div>
                </div>
        </div>
<hr>
        <div class="row">
                <div class="col">
                <label for="">Code fasilitas</label>
                <input type="text" class="form-control" name="facility_code" value="<?= $mst_facility['facility_code'] ?>">
                </div>
                <div class="col">
                <label for="">Kondisi fasilitas</label>
                <input type="text" class="form-control" name="facility_condition" value="<?= $mst_facility['facility_condition'] ?>">
                </div>
                <div class="col">
                <label for="">SBU</label>
                <select name="branch_id" id="" class="selField <?= ($validation->hasError('branch_id')) ? 'is-invalid' : '' ?>" style="width: 100%;">
                    <option value="<?= $mst_facility['branch_id'] ?>"><?= $mst_facility['branch_name'] ?></option>

                    <?php foreach($branch as $sbu) : ?>
                    <option value="<?= $sbu['branch_id'] ?>"><?= $sbu['branch_name'] ?></option>
                    <?php endforeach ?>
                </select>
                <div class="invalid-feedback">
                    <?= $validation->getError('branch_id') ?>
                </div>
                </div>
        </div>

        <br>
      <div class="">
        <button type="submit" class="btn btn-outline-success"> <i class="fas fa-edit"></i> Update</button>
      </div>

      </form>
        </div>
    </div>

    <script type="text/javascript">
       $(".selField").select2();
     </script>
</div>