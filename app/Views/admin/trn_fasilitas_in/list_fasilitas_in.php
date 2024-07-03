<div class="container-fluid">



    <div class="card shadow mb-4">

    <?php if(session()->getFlashdata('pesan')) : ?>

      <div class="alert alert-success">
        <?= session()->getFlashdata('pesan') ?>
      </div>

      <?php endif; ?>

  <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <div class="card-header text-center">
        <h5>List Fasilitas kembali</h5>
    </div>

    <div class="card-body">
      <a href="/fasilitas_in/add_fasilitas_in/" class="btn btn-outline-success mb-3"> <i class="fas fa-plus"></i> Tambah data </a>

<form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword" placeholder="Search by name">
</form>



              <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Tanggal Transaksi</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($fasilitas_in as $fas) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $fas['employee_name'] ?></td>
                            <td> <?= $fas['tgl_pinjam'] ?></td>
                            <td><?= date("d-m-Y" ,strtotime($fas['tgl_kembali'])) ?></td>
                            <td><?= $fas['trn_date'] ?></td>
                            <td>
                                <a href="/fasilitas_in/detail_fasilitas_in/<?= $fas['trn_id'] ?>" class="btn btn-success"> <i class="fas fa-eye" ></i> </a>
                                <a href="/fasilitas_in/edit_fasilitas_in/<?= $fas['trn_id'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>

                                <form action="/fasilitas_in/<?= $fas['trn_id'] ?>" class="d-inline" method="post">
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