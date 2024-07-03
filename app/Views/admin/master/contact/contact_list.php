 <!-- Begin Page Content -->
 <div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Contact Karyawan</h1>
<?php if(session()->getFlashdata('pesan')) :?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('pesan'); ?>
    </div>
    <?php endif; ?>

    <div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-body">
    <a href="/contact_employee/add_contact" class="btn btn-success mb-3"> <i class="fas fa-plus"></i> Tambah Contact</a>
    <form action="" class="d-inline">
        <button type="submit"  class="btn btn-info  d-inline float-right"> <i class="fas fa-search"></i></button>
        <input type="text" name="keyword" class="form-control d-inline float-right col-md-2" placeholder="Search. . .">
        <label for=""></label>
    </form>
    
    
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Contact</th>
                        <th>Contact type</th>
                        <th>Jenis Kelamin</th>
                        <th>Nama Karyawan</th>
                        <!-- <th>Alamat</th> -->
                        <th>No. Handphone</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
               <?php $no=1; ?>
                <tbody>
                    <?php foreach($contact as $con) : ?>
                    <tr>
                        <td><?= $nomor++ ?></td>
                        <td><?= $con['contact_name'] ?></td>
                        <td>
                            <?php 
                            if($con['contact_type'] == 1){
                                echo "Ayah";
                            }elseif($con['contact_type'] == 2){
                                echo "Ibu";
                            }elseif($con['contact_type'] == 3){
                                echo "Kakak";
                            }elseif($con['contact_type'] == 4){
                                echo "Adik";
                            }elseif($con['contact_type'] == 5){
                                echo "Saudara";
                            }elseif($con['contact_type'] == 6){
                                echo "Suami";
                            }elseif($con['contact_type'] == 7){
                                echo "Istri";
                            }elseif($con['contact_type'] == 8){
                                echo "Anak";
                            }else{
                                echo "";
                            }
                            ?>
                            </td>
                            <td>
                                <?php 
                                if($con['jenis_kelamin'] == 'L'){
                                    echo 'Laki - Laki';
                                }elseif($con['jenis_kelamin'] == 'P'){
                                    echo 'Perempuan';
                                }else{
                                    echo "";
                                }
                                ?>
                            </td>
                        <td><?= $con['employee'] ?></td>
                        <!-- <td><?= $con['alamat_tinggal'] ?></td> -->
                        <!-- <td>
                            <?php 
                            if($con['pekerjaan'] == 1){
                                echo "Ibu Rumah Tangga";
                            }elseif($con['pekerjaan'] == 2){
                                echo "Pegawai Swasta";
                            }elseif($con['pekerjaan'] == 3){
                                echo "Pegawai Negeri";
                            }elseif($con['pekerjaan'] == 4){
                                echo "Wiraswasta";
                            }elseif($con['pekerjaan'] == 5){
                                echo "Pelajar";
                            }else{
                                echo "";
                            }
                            ?>
                        </td> -->
                        <td><?= $con['no_tlp'] ?></td>
                        <td>
                            <a href="/contact_employee/detail_contact/<?= $con['id'] ?>" class="btn btn-success" data-title="Detail"><i class="fas fa-info-circle"></i></a>
                            <a href="/contact_employee/edit_contact/<?= $con['id'] ?>" data-title="Edit Data" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                         
                           
                            <form action="/contact_employee/<?= $con['id'] ?>" class="d-inline" method="post">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" data-title="Hapus Data" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.');"><i class="fas fa-trash-alt"></i> </button>
                            </form>
                        </td>
                    </tr>
                   <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="">
            <?= $pager->links('default', 'custom_pagination') ?>
        </div>
    </div>
</div>



</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->