<div class="container-fluid">

<h3 class="mb-3">Fasilitas Karyawan</h3>

<button class="btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-filter"></i> Filter
  </button>
  <a href="/fasilitas/index" class="btn btn-outline-info"> <i class="fas fa-sync"></i> Reset </a>
</p>
<div class="collapse" id="collapseExample">
  <div class="card card-body mb-3">
    <form action="/fasilitas/search_facility" method="GET">
   <div class="row">
   <div class="col">
      <label for="">SBU</label>
      <select name="branch_id" id="" class="form-control">
        <option value="">Silahkan pilih SBU</option>
        <?php foreach($branchs as $branch) : ?>
        <option value="<?= $branch['branch_id'] ?>"><?= $branch['branch_name'] ?></option>
        <?php endforeach ?>
      </select>
    </div>
    <div class="col">
      <label for="">Name</label>
      <input type="text" class="form-control" name="keyword">
    </div>
    <div class="col">
      <label for="">Status</label>
      <select name="status" id="" class="form-control">
        <option value="">Silahkan pilih Status</option>
        
        <option value="1">Penyerahan</option>
        <option value="2">Pengembalian</option>
      </select>
    </div>
   </div>
   <hr>
   <div class="row">
    <div class="col">
    <label for="">Bulan pinjam</label>
    <input type="month" class="form-control" name="bulan_pinjam">
    </div>
    <div class="col">
    <label for="">Bulan Kembali</label>
    <input type="month" class="form-control" name="bulan_kembali">
    </div>
   </div>
   <hr>
   <div class="row">
    <div class="col">
      <button type="submit" class="btn btn-outline-success"> <i class="fas fa-search"></i> Search </button>
    </div>
   </div>
   </form>
  </div>
</div>
  
<?php if(session()->getFlashdata('pesan')) : ?>

<div class="alert alert-success">
  <?= session()->getFlashdata('pesan') ?>
</div>

<?php endif; ?>

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
    <div class="card shadow mb-4">
    <div class="card-body">
      <a href="/fasilitas/add_fasilitas/" class="btn btn-outline-success mb-3"> <i class="fas fa-plus"></i> Add </a>

<!-- <form action="" class="d-inline">
  <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
  <input class="form-control col-md-2 d-inline float-right" name="keyword">
</form> -->



              <table class="table table-bordered">
                        <thead class="table-bordered">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">SBU</th>
                            <th scope="col">Tanggal Pinjam</th>
                            <th scope="col">Tanggal Kembali</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($fasilitas as $fas) : ?>
                          <tr>
                            <th scope="row"><?= $nomor++ ?></th>
                            <td><?= $fas['employee_name'] ?></td>
                            <td><?= $fas['branch_name'] ?></td>
                            <td> <?= $fas['tgl_pinjam'] ?></td>
                            <td><?= $fas['tgl_kembali'] ?></td>
                            <td><?= ($fas['status'] == 1) ? 'Penyerahan' : '' ?>
                            <?= ($fas['status'] == 2) ? 'Pengembalian' : '' ?>
                          </td>
                            <td>
                                <a href="/fasilitas/detail_fasilitas/<?= $fas['trn_id'] ?>" data-title="Detail" class="btn btn-outline-success"> <i class="fas fa-info-circle" title="DETAIL" ></i> </a>
                                <a href="/fasilitas/edit_fasilitas/<?= $fas['trn_id'] ?>" data-title="Edit Data" class="btn btn-outline-primary"> <i class="fas fa-edit"></i> </a>

                                <form action="/fasilitas/<?= $fas['trn_id'] ?>" class="d-inline" method="post">
                                <input type="hidden" name="_method" value="DELETE">
                                  <button type="submit" data-title="Hapus Data" class="btn btn-outline-danger" onclick="return confirm('apakah anda yakin?.')" > <i class="fas fa-trash-alt" ></i> </button>
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