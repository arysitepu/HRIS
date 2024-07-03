<div class="container-fluid">

<div class="mb-3">
        <h3>Pendidikan</h3>
    </div>

  <?php if(session()->getFlashdata('pesan')) : ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>
    <?php endif; ?>
    <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
<div class="card shadow mb-4 mt-3">
    <div class="card-body">
      <a href="/employee_education/add_education/" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword">
</form>

              <table class="table table-bordered">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Jenis Pendidikan</th>
                            <th scope="col">Nama Sekolah</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($education_employee as $edu) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $edu['employee_name']?></td>
                            <td>
                              <?php
                              if($edu['education_type'] == 1){
                                echo "SD";
                              }elseif($edu['education_type'] == 2){
                                echo "SMP";
                              }elseif($edu['education_type'] == 3){
                                echo "SMA";
                              }elseif($edu['education_type'] == 4){
                                echo "Perguruan tinggi";
                              }else{
                                echo "";  
                              }
                              ?>
                            </td>
                            <td><?= $edu['education_name'] ?></td>
                            <td>
                                <a href="/employee_education/detail_education/<?= $edu['id'] ?>" class="btn btn-success" data-title="Detail"> <i class="fas fa-info-circle" ></i> </a>
                                <a href="/employee_education/edit_education/<?= $edu['id'] ?>" class="btn btn-primary" data-title="Edit Data"> <i class="fas fa-edit"></i> </a>

                                <form action="/employee_education/<?= $edu['id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')" data-title="Hapus Data" > <i class="fas fa-trash-alt" ></i> </button>
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