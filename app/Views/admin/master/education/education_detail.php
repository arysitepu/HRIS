<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
      <h3>Detail Pendidikan</h3>
      <?php if(session()->get('user_level') == 'admin') : ?>
      <a href="/employee_education/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
      <?php elseif(session()->get('user_level') == 'user') : ?>
        <a href="/karyawan/detail_karyawan_pribadi/<?= $education_employee['employee_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
      <?php endif; ?>
    </div>

    <div class="card shadow">
        <div class="card-body">
          <div class="table table-responsive">
            <table class="table table-bordered">
             <tr>
                <td>Nama Karyawan</td>
                <td><?= $education_employee['employee_name'] ?></td>
             </tr>
             <tr>
                <td>Tipe Pendidikan</td>
                <td>
                <?php 
                        if($education_employee['education_type'] == 1){
                            echo 'SD';
                        }elseif($education_employee['education_type'] == 2){
                            echo 'SMP';
                        }elseif($education_employee['education_type'] == 3){
                            echo 'SMA';
                        }elseif($education_employee['education_type'] == 4){
                            echo 'PERGURUAN TINGGI';
                        }else{
                            echo '';
                        }
                        ?>
                </td>
             </tr>
             <tr>
                <td>Nama Pendidikan</td>
                <td> <?= $education_employee['education_name'] ?></td>
             </tr>
             <tr>
                <td>Jurusan Pendidikan</td>
                <td><?= $education_employee['education_major'] ?></td>
             </tr>
             <tr>
                <td>Nilai Pendidikan</td>
                <td>
                    <?php if($education_employee['ipk'] == 0) : ?>
                        <span class="text-danger">Nilai belum diinput</span>
                    <?php else : ?>
                        <span class=""><?= $education_employee['ipk'] ?></span>
                    <?php endif; ?>
                </td>
             </tr>
             <tr>
                <td>Tahun Masuk</td>
                <td><?= date("d-m-Y", strtotime($education_employee['tahun_masuk'])) ?></td>
             </tr>
             <tr>
                <td>Tahun lulus</td>
                <td><?= date("d-m-Y", strtotime($education_employee['tahun_lulus'])) ?></td>
             </tr>
             <tr>
                <td>Dibiayai oleh</td>
                <td>
                <?php 
                        if($education_employee['biaya_oleh'] == 1){
                            echo 'Biaya Sendiri';
                        }elseif($education_employee['biaya_oleh'] == 2){
                            echo 'Orang tua';
                        }elseif($education_employee['biaya_oleh'] == 3){
                            echo 'PT ATAP TEDUH LESTARI';
                        }else{
                            echo '';
                        }
                        ?>
                </td>
             </tr>
            </table>
          </div>
        </div>
    </div>
  
</div>