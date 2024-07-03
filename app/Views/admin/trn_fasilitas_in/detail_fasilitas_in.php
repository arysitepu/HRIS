<div class="container-fluid">

<a href="/fasilitas_in/index/" class="btn btn-success mb-3 ml-3" >Kembali ke table</a>

<a href="/karyawan/detail_karyawan_kantor/<?= $fasilitas_in['employee_id'] ?>" class="btn btn-success mb-3 ml-3" >Kembali ke detail karyawan</a>
   
<div class="card shadow mb-4 col-md-10" style="margin: auto;">

        <div class="card-header">
            <h5 class="text-center"> <b> Header</b></h5>
        </div>

    <div class="card-body">

            <div class="row">
                <div class="col">
                <label for="" class="d-inline">Nomor Dokumen </label>
                <input type="text" class="form-control d-inline text-center" value="<?= $fasilitas_in['trn_no'] ?>" readonly>
                </div>

                <div class="col">
                <label for="" class="d-inline">Tanggal Dokumen </label>
                <input type="text" class="form-control d-inline text-center" value="<?= $fasilitas_in['trn_date'] ?>" readonly>
                </div>
            </div>
            <hr>

            <div class="row">
                <div class="col">
                <label for="" class="d-inline">Nama Karyawan</label>
                <input type="text" class="form-control d-inline" value="<?= $fasilitas_in['employee_name'] ?>" readonly>
                </div>
                <div class="col">
                <label for="" class="d-inline">Dibuat</label>
                <input type="text" class="form-control d-inline" value="<?= $fasilitas_in['buat_name'] ?>" readonly>
                </div>

                <div class="col">
                <label for="" class="d-inline">Disetujui</label>
                <input type="text" class="form-control d-inline" value="<?= $fasilitas_in['setuju_name'] ?>" readonly>
                </div>
            </div>
<hr>
            <div class="row">
                <div class="col">
                <label for="" class="d-inline">Tanggal Pinjam</label>
                <input type="text" class="form-control d-inline" value="<?= $fasilitas_in['tgl_pinjam'] ?>" readonly>
                </div>
                <div class="col">
                <label for="" class="d-inline">Tanggal Kembali</label>
                <input type="text" class="form-control d-inline" value="<?= $fasilitas_in['tgl_kembali'] ?>" readonly>
                </div>

              
            </div>

    </div>
 </div>


 <div class="card shadow mb-4 col-md-10" style="margin: auto;">
 <div class="card-header">
            <h5 class="text-center"> <b> List fasilitas</b></h5>
 </div>

 <div class="card-body">
  

         <a href="/fasilitas_in_det/add_fasilitas_in_det/<?= $fasilitas_in['trn_id'] ?>" class="btn btn-info mb-3"><i class="fas fa-plus"></i>Tambah data</a>

       
         
 <table class="table">
                        <thead class="thead-dark">
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
                            <?php foreach($fasilitas_in_det as $fasilitas_det) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $fasilitas_det['type_name']  ?></td>
                            <td><?= $fasilitas_det['facility_name']  ?></td>
                            <td><?= $fasilitas_det['facility_code'] ?></td>
                            <td><?= $fasilitas_det['qty'] ?></td>
                            <td><?= $fasilitas_det['kegunaan'] ?></td>
                            <td>
                                <!-- <a href="/fasilitas_in/detail_fasilitas/" class="btn btn-success"> <i class="fas fa-eye" ></i> </a> -->
                                <a href="/fasilitas_in_det/edit_fasilitas_detail/<?= $fasilitas_det['id'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>
                                <a href="/fasilitas_in_det/delete_fasilitas_detail/<?= $fasilitas_det['id'] ?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')"> <i class="fas fa-trash-alt"></i> </a>
                               
                            </td>
                          </tr>
                        </tbody>
                       <?php endforeach; ?>
          </table>

         
 </div>

 
 </div>

</div>
