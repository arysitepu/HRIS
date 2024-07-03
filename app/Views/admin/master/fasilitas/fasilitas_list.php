<div class="container-fluid">
  <div class="">
      <h3>Fasilitas</h3>
  </div>
  <?php if(session()->getFlashdata('pesan')) : ?>
    <div class="alert alert-success">
      <?= session()->getFlashdata('pesan') ?>
    </div>
    <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
    <?php endif; ?>


  <div class="card shadow mb-3 mt-3">
    <div class="card-body">
      <a href="/fasilitas_karyawan/add_fasilitas/" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword">
</form>



              <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Tipe Fasilitas</th>
                            <th scope="col">Nama Fasilitas</th>
                            <th scope="col">Nomor asset fasilitas</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($fasilitas as $fas) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $fas['employee_name'] ?></td>
                            <td><?= $fas['type_name'] ?></td>
                            <td><?= $fas['facility_name'] ?></td>
                            <td><?= $fas['facility_asset_no'] ?></td>
                            <td>
                                <a href="/fasilitas_karyawan/detail_fasilitas/<?= $fas['id'] ?>" class="btn btn-success"> <i class="fas fa-eye" ></i> </a>
                                <a href="/fasilitas_karyawan/edit_fasilitas/<?= $fas['id'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>

                                <form action="/fasilitas_karyawan/<?= $fas['id'] ?>" class="d-inline" method="post">
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