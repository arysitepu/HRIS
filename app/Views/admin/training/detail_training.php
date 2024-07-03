<div class="container-fluid">
   
    <div class="d-flex justify-content-between mb-3">
        <h3 class="">Detail Pelatihan Karyawan</h3>
        <a href="/training/index" class="btn btn-outline-success" > <i class="fas fa-arrow-left"></i> Back </a>
    </div>

    <div class="row mb-3">
        <div class="col">
            <form action="/training/print_detail/<?= $training['trn_id'] ?>">
                <button type="submit" formaction="/training/print_detail/<?= $training['trn_id'] ?>" class="btn btn-outline-danger"> <i class="fas fa-file-pdf"></i> PDF </button>
            </form>
        </div>
    </div>

    <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan') ?>
            </div>
    <?php endif; ?>

    <?php if(session()->getFlashdata('pesan_error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('pesan_error') ?>
            </div>
    <?php endif; ?>
    <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

    <!-- <a href="/training/print_training/<?= $training['trn_id'] ?>" class="btn btn-outline-danger mb-3" > <i class="fas fa-print"></i> Print</a> -->
     <div class="card shadow mb-4">

    <div class="card-body">
    
        <div class="table table-responsive">
            <table class="table table-bordered">
                <tr>
                    <td>Nomor Document</td>
                    <td><?= $training['trn_no'] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Dokumen</td>
                    <td><?= $training['trn_date'] ?></td>
                </tr>
                <tr>
                    <td>Tipe training</td>
                    <td><?= $training['name_training'] ?></td>
                </tr>
                <tr>
                    <td>Training Organizer</td>
                    <td><?= $training['training_organizer'] ?></td>
                </tr>
                <tr>
                    <td>Nama Pelatihan</td>
                    <td><?= $training['training_name'] ?></td>
                </tr>
                <tr>
                    <td>Training purpose</td>
                    <td><?= $training['training_purpose'] ?></td>
                </tr>
                <tr>
                    <td>Deskripsi</td>
                    <td><?= $training['training_desc'] ?></td>
                </tr>
                <tr>
                    <td>Tanggal Mulai</td>
                    <td><?= date("d-m-Y" , strtotime($training['training_start'])) ?></td>
                </tr>
                <tr>
                    <td>Tanggal Selesai</td>
                    <td><?= date("d-m-Y" , strtotime($training['training_end'])) ?></td>
                </tr>
                <tr>
                    <td>Membuat</td>
                    <td><?= $training['buat_name'] ?></td>
                </tr>
                <tr>
                    <td>Menyetujui</td>
                    <td><?= $training['setuju_name'] ?></td>
                </tr>
                
            </table>
        </div>
    


    </div>

     </div>

     <div class="card-shadow mb-4">

     <!-- form tambah data -->

     <a class="btn btn-outline-primary mb-3" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
    <i class="fas fa-plus"></i> Add
     </a>

  <div class="collapse" id="collapseExample">
  <div class="card card-body mb-3">
  <form action="/training_det/save_training_det/<?= $training['trn_id'] ?>">
        
        <div class="row">
            <input type="hidden" name="id">
        
            <div class="col">
             <label for="">Nama Karyawan</label>
                <select name="employee_id" id="" class="form-control">
         
                 <option value="">Pilih</option>
         
                 <?php foreach($karyawan as $kry) : ?>
                 <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
         
                 <?php endforeach; ?>
         
                </select>
            </div>
        
            <div class="col">
                <label for="">Biaya</label>
                <input type="text" class="form-control" name="biaya">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-outline-info"> <i class="fas fa-save"></i> Save </button>
        </form>
  </div>
</div>

<!-- batas form tambah data  -->

         <div class="card">
         <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Karyawan</th>
                            <th scope="col">Biaya</th>
                            <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach($training_det as $training_det) : ?>
                          <tr>
                            <th scope="row"><?= $no++ ?></th>
                            <td><?= $training_det['employee_name']  ?></td>
                            <td>Rp. <?= rupiah($training_det['biaya'])  ?></td>
                            
                            <td>
                                <!-- <a href="/fasilitas/detail_fasilitas/" class="btn btn-success"> <i class="fas fa-eye" ></i> </a> -->
                                <a href="/training_det/edit_training_det/<?= $training_det['id'] ?>" class="btn btn-primary"> <i class="fas fa-edit"></i> </a>
                                <a href="/training_det/delete_training_det/<?= $training_det['id'] ?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')"> <i class="fas fa-trash-alt"></i> </a>
                               
                            </td>
                          </tr>
                        </tbody>
                       <?php endforeach; ?>
          </table>


         </div>
     </div>

</div>

<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
