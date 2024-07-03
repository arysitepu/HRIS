<div class="container-fluid">
    <div class="d-flex justify-content-between">
    <h3>Detail Contact Karyawan</h3>
    <?php if(session()->get('user_level') == 'admin') : ?>
        <a class="btn btn-outline-success" href="/contact_employee/index"> <i class="fas fa-arrow-left"></i> Back </a></li>
        <?php elseif(session()->get('user_level') == 'user'): ?>
            <a class="btn btn-outline-success" href="/karyawan/detail_karyawan_pribadi/<?= $contact['employee_id'] ?>"> <i class="fas fa-arrow-left"></i> Back </a></li>
    <?php endif; ?>
</div>

<br>

<div class="row">
    <div class="col">
        <div class="table-responsive">
            <table class="table table-bordered bg-white">
                    <tr>
                        <td>Nama Karyawan</td>
                    <td><a class="" href="/karyawan/detail/<?= $contact['employee_id'] ?>" data-title-1="Click untuk melihat karyawan"><?= $contact['employee'] ?></a></td>
                    </tr>

                    <tr>
                        <td>Contact type</td>
                        <td>
                        <?php 
                            if($contact['contact_type'] == 1){
                                echo "Ayah";
                            }elseif($contact['contact_type'] == 2){
                                echo "Ibu";
                            }elseif($contact['contact_type'] == 3){
                                echo "Kakak";
                            }elseif($contact['contact_type'] == 4){
                                echo "Adik";
                            }elseif($contact['contact_type'] == 5){
                                echo "Saudara";
                            }elseif($contact['contact_type'] == 6){
                                echo "Suami";
                            }elseif($contact['contact_type'] == 7){
                                echo "Istri";
                            }elseif($contact['contact_type'] == 8){
                                echo "Anak";
                            }else{
                                echo "";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Nama Contact</td>
                        <td><?= $contact['contact_name'] ?></td>
                    </tr>

                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                        <?php 
                            if($contact['jenis_kelamin'] == 'L'){
                                echo 'Laki - Laki';
                            }elseif($contact['jenis_kelamin'] == 'P'){
                                echo 'Perempuan';
                            }else{
                                echo "";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Tempat Lahir</td>
                        <td><?= $contact['lahir_tempat'] ?></td>
                    </tr>

                    <tr>
                        <td>Tanggal Lahir</td>
                        <td><?= ($contact['lahir_tanggal'] == 0) ? '-' : date("d-M-Y", strtotime($contact['lahir_tanggal']))  ?></td>
                    </tr>

                    <tr>
                        <td>Pekerjaan</td>
                        <td>
                        <?php 
                            if($contact['pekerjaan'] == 1){
                                echo "Ibu Rumah Tangga";
                            }elseif($contact['pekerjaan'] == 2){
                                echo "Pegawai Swasta";
                            }elseif($contact['pekerjaan'] == 3){
                                echo "Pegawai Negeri";
                            }elseif($contact['pekerjaan'] == 4){
                                echo "Wiraswasta";
                            }elseif($contact['pekerjaan'] == 5){
                                echo "Pelajar";
                            }else{
                                echo "";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>Nomor Hanphone 1</td>
                        <td><?= $contact['no_tlp'] ?></td>
                    </tr>

                    <tr>
                        <td>Nomor Hanphone 2</td>
                        <td><?= $contact['no_tlp2'] ?></td>
                    </tr>

                    <tr>
                        <td>Alamat Tinggal</td>
                        <td><?= $contact['alamat_tinggal'] ?></td>
                    </tr>

                    
                    <tr>
                        <td>Kecamatan</td>
                        <td><?= $contact['kecamatan'] ?></td>
                    </tr>
            </table>
        </div>
    </div>
</div>

</div>