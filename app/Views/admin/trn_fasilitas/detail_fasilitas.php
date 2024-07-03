<div class="container-fluid">

  <div class="d-flex justify-content-between">
    <h3>Detail Fasilitas Karyawan</h3>
    <?php if(session()->get('user_level') == 'admin') : ?>
    <a href="/fasilitas/index/" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    <?php elseif(session()->get('user_level') == 'user') : ?>
      <a href="/karyawan/detail_karyawan_kantor/<?= $fasilitas['employee_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
      <?php endif; ?>
  </div>
  <a href="/fasilitas/print_detail/<?= $fasilitas['trn_id'] ?>" class="btn btn-outline-danger"> <i class="fas fa-print"></i>Print </a>
  <?php if(session()->getFlashdata('pesan')) : ?>
                    <div class="alert alert-success mt-3">
                    <?= session()->getFlashdata('pesan') ?>
                    </div>
    <?php endif; ?>
<div class="card mt-3">
        <div class="mt-3">
            <h5 class="text-center"> <b> Fasilitas <?= $fasilitas['employee_name'] ?></b></h5>
        </div>
<hr>
    <div class="card-body">

      <div class="table table-responsive">
        <table class="table table-bordered">
            <tr>
              <td>No Document</td>
              <td><?= $fasilitas['trn_no'] ?></td>
            </tr>

            <tr>
              <td>Tangal Document</td>
              <td><?= $fasilitas['trn_date'] ?></td>
            </tr>

            <tr>
              <td>Status</td>
              <td class="text-success">
              <?= ($fasilitas['status'] == 1) ? 'Penyerahan' : '' ?> <?= ($fasilitas['status'] == 2) ? 'Pengembalian' : '' ?>  
              </td>
            </tr>

            <tr>
              <td>Nama Karyawan</td>
              <td><?= $fasilitas['employee_name'] ?></td>
            </tr>

            <tr>
              <td>Membuat</td>
              <td><?= $fasilitas['buat_name'] ?></td>
            </tr>

            <tr>
              <td>Menyetujui</td>
              <td><?= $fasilitas['setuju_name'] ?></td>
            </tr>
        </table>
      </div>
            
    </div>
 </div>

 <br>

 <div class="card">
 <div class="mt-3">
            <h5 class="text-center"> <b> List fasilitas</b></h5>
 </div>
<hr>
 <div class="card-body">

  <a href="/fasilitas_det/add_fasilitas_det/<?= $fasilitas['trn_id'] ?>" class="btn btn-outline-info mb-3"><i class="fas fa-plus"></i> Add </a>
 <table class="table">
                        <thead class="">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Type</th>
                            <th scope="col">Nama Fasilitas</th>
                            <th scope="col">Code</th>
                            <th scope="col">Jumlah</th>
                            <th scope="col">Kegunaan</th>
                            <th scope="col">Aksi</th>
                          </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($fasilitas_det as $fasilitas_det) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $fasilitas_det['type_name']  ?></td>
                            <td><?= $fasilitas_det['facility_name']  ?></td>
                            <td><?= $fasilitas_det['facility_code'] ?></td>
                            <td><?= $fasilitas_det['qty'] ?></td>
                            <td><?= $fasilitas_det['kegunaan'] ?></td>
                            <td>
                                <a href="/fasilitas_det/detail_facility_user/<?= $fasilitas_det['id'] ?>" class="btn btn-outline-success"> <i class="fas fa-info-circle" ></i> </a>
                                <a href="/fasilitas_det/edit_fasilitas_det/<?= $fasilitas_det['id'] ?>" class="btn btn-outline-primary"> <i class="fas fa-edit"></i> </a>
                                <a href="/fasilitas_det/delete_fasilitas_det/<?= $fasilitas_det['id'] ?>" class="btn btn-outline-danger" onclick="return confirm('apakah anda yakin?.')"> <i class="fas fa-trash-alt"></i> </a>
                               
                            </td>
                          </tr>
                        </tbody>
                       <?php endforeach; ?>
          </table>

         
 </div>

 
 </div>

</div>