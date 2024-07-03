<div class="container-fluid">

<div class="">
        <h3>Keluarga Karyawan</h3>
  </div>
  <?php if(session()->getFlashdata('pesan')) : ?>
          <div class="alert alert-success">
            <?= session()->getFlashdata('pesan') ?>
          </div>
        <?php endif; ?>

        <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
    <div class="card shadow mb-3 mt-3">
    <div class="card-body">
      <a href="/family/add_family/" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword">
</form>

              <table class="table table-bordered">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Nama Anggota Keluarga</th>
                            <th scope="col">Hubungan Keluarga</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                           <?php foreach($family as $fam) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $fam['employee_name'] ?></td>
                            <td><?= $fam['family_name'] ?></td>
                            <td>
                              <?php 
                              if($fam['family_type'] == 1){
                                echo "Ayah";
                              }elseif($fam['family_type'] == 2){
                                echo "Ibu";
                              }elseif($fam['family_type'] == 3){
                                echo "Saudara";
                              }elseif($fam['family_type'] == 4){
                                echo "Anak";
                              }elseif($fam['family_type'] == 5){
                                echo "Suami";
                              }elseif($fam['family_type'] == 6){
                                echo "Istri";
                              }else{
                                echo "";
                              }
                              ?>
                          </td>
                            <td>
                                <a href="/family/detail_family/<?= $fam['id'] ?>" class="btn btn-success" data-title="Detail"> <i class="fas fa-info-circle" ></i> </a>
                                <a href="/family/edit_family/<?=  $fam['id'] ?>" class="btn btn-primary" data-title="Edit Data"> <i class="fas fa-edit"></i> </a>

                                <form action="/family/<?= $fam['id'] ?>" class="d-inline" method="post">
                                  <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')" data-title="Hapus Data"> <i class="fas fa-trash-alt" ></i> </button>
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