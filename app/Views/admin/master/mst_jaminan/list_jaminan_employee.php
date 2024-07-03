<div class="container-fluid">
    <div class="card shadow mb-4">

      <?php if(session()->getFlashdata('pesan')) : ?>
          <div class="alert alert-success">
            <?= session()->getFlashdata('pesan') ?>
          </div>
        <?php endif; ?>

        <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card-header text-center">
        <h5>List Jaminan Karyawan</h5>
    </div>

    <div class="card-body">
      <a href="/mst_jaminan/add_jaminan/" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword">
</form>

              <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Jenis jaminan</th>
                            <th scope="col">Nama jaminan</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                           <?php foreach($mst_jaminan as $jaminan) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $jaminan['employee_name'] ?></td>
                            <td><?= $jaminan['type_name'] ?></td>
                            <td><?= $jaminan['jaminan_name'] ?></td>
                            <td>
                                <a href="/mst_jaminan/detail_jaminan/<?= $jaminan['id'] ?>" class="btn btn-success"> <i class="fas fa-eye" ></i> </a>
                                <a href="/mst_jaminan/edit_jaminan/<?=  $jaminan['id'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>

                                <form action="/mst_jaminan/<?= $jaminan['id'] ?>" class="d-inline" method="post">
                                  <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> </button>
                                </form>
                            </td>
                          </tr>
                        </tbody>
                        <?php endforeach; ?>
          </table>
<div class="">
 <?= $pager->links('default', 'custom_pagination')  ?>
</div>

    </div>

    </div>
</div>