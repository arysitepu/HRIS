<div class="container-fluid">



    <div class="card shadow mb-4">

    <?php if(session()->getFlashdata('pesan')) : ?>

      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>

      <?php endif; ?>

  <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card-header text-center">
        <h5>List Pendidikan Karyawan</h5>
    </div>

    <div class="card-body">
      <a href="/education/add_education/" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword">
</form>



              <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Tipe Pendidikan</th>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">Tahun Masuk</th>
                            <th scope="col">Tahun Lulus</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($education as $edu) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $edu['employee_name'] ?></td>
                            <td>
                                <?= ($edu['education_type'] == '1') ? 'SD' :'' ?>
                                <?= ($edu['education_type'] == '2') ? 'SMP' :'' ?>
                                <?= ($edu['education_type'] == '3') ? 'SMA' :'' ?>
                                <?= ($edu['education_type'] == '4') ? 'Strata1' :'' ?>
                            </td>
                            <td><?= $edu['education_name'] ?></td>
                            <td><?= $edu['tahun_masuk'] ?></td>
                            <td><?= $edu['tahun_lulus'] ?></td>
                            <td>
                                <a href="/education/detail_education/<?= $edu['trn_id'] ?>" class="btn btn-success"> <i class="fas fa-eye" ></i> </a>
                                <a href="/education/edit_education/<?= $edu['trn_id'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>

                                <form action="/education/<?= $edu['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> </button>
                                </form>
                            </td>
                          </tr>
                        </tbody>
                        <?php endforeach; ?>
          </table>
<div class="">
<?= $pager->links('default', 'custom_pagination') ?>
</div>

    </div>

    </div>
</div>