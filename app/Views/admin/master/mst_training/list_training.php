<div class="container-fluid">

        <div class="card shadow mb-4">
            <div class="card-body py-3">

            <?php 
            if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
                </div>
            <?php endif; ?>

            

        <!-- sweet alert -->
        <div class="swal" data-swal="<?= session()->get('pesan'); ?>"></div>

        <!-- batas sweet alert -->
        
        <a href="/mst_training/add_training" class="btn btn-info"> <i class="fas fa-plus" ></i> Tambah Data </a>


            <!-- <a href="" class="btn btn-success mb-3" >Tambah Jabatan</a> -->

            </div>

            <div class="card-header py-3">
                <center>
                <h6 class="m-0 font-weight-bold text-dark">Daftar Pelatihan karyawan</h6>
                </center>
            </div>
        

            <div class="card-body">

        


        
            <form action="" class="d-inline">
            <button type="submit" class="btn btn-info float-right" > <i class="fas fa-search" ></i> </button>
            <input class="form-control col-md-2 d-inline float-right" name="keyword">
            </form>
            
            
                <div class="table-responsive">

            
                    <table class="table mt-3" id="dataTable" width="100%" cellspacing="0" >

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Nama Pelatihan</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th class="aksi" >Aksi</th>
                                
                            </tr>
                        </thead>
                        <?php $no=1; ?>
                        <tbody>
                            <?php foreach ($mst_training as $training) : ?>
                            <tr>
                                <td><?= $nomor++ ?></td>
                                <td><?= $training['employee_name'] ?></td>
                                <td><?= $training['training_name'] ?></td>
                                <td><?= $training['training_start'] ?></td>
                                <td><?= $training['training_end'] ?></td>
                                
                                <td class="aksi">
                                
                                <a href="/mst_training/detail_training/<?= $training['id'] ?>" class="btn btn-info" ><i class="fas fa-eye"></i></a>
                                <a href="/mst_training/edit_training/<?= $training['id'] ?>" class="btn btn-success" ><i class="fas fa-edit"></i></a>

                                <form action="/mst_training/<?= $training['id'] ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="delete">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.');" ><i class="fas fa-trash-alt"></i></button>

                                </form>
                                
                                </td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <div class="">
                   
                    <?= $pager->links('default', 'custom_pagination') ?>
                    </div>
                </div>
            </div>
        </div>

</div>
