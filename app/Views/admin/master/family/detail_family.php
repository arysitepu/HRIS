<div class="container-fluid">

        <div class="d-flex justify-content-between mb-3">
            <h3>Detail Keluarga karyawan</h3>
            <a class="btn btn-outline-success" href="/family/index"><i class="fas fa-arrow-left"></i> Back</a></li>
        </div>
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <tr>
                                <td>Nama Karyawan</td>
                                <td><?= $family['employee_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Nama Keluarga</td>
                                <td><?= $family['family_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Hubungan Keluarga</td>
                                <td>
                                <?php 
                                    if($family['family_type'] == 1){
                                        echo "Ayah";
                                    }elseif($family['family_type'] == 2){
                                        echo "Ibu";
                                    }elseif($family['family_type'] == 3){
                                        echo "Saudara";
                                    }elseif($family['family_type'] == 4){
                                        echo "Anak";
                                    }elseif($family['family_type'] == 5){
                                        echo "Suami";
                                    }elseif($family['family_type'] == 6){
                                        echo "Istri";
                                    }else{
                                        echo "";
                                    } 
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>
                                <?php 
                                    if($family['jenis_kelamin'] == 'L'){
                                        echo 'Laki - Laki';
                                    }elseif($family['jenis_kelamin'] == 'P'){
                                        echo 'Perempuan';
                                    }else{
                                        echo "";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Tempat Lahir</td>
                                <td><?= $family['lahir_tempat'] ?></td>
                            </tr>

                            <tr>
                                <td>Tanggal Lahir</td>
                                <td><?= date("d-M-Y", strtotime($family['lahir_tanggal'])) ?></td>
                            </tr>

                            <tr>
                                <td>Pekerjaan</td>
                                <td>
                                <?php 
                                    if($family['pekerjaan'] == 1){
                                        echo "Pegawai Negeri";
                                    }elseif($family['pekerjaan'] == 2){
                                        echo "Pegawai Swasta";
                                    }elseif($family['pekerjaan'] == 3){
                                        echo "Ibu Rumah Tangga";
                                    }elseif($family['pekerjaan'] == 4){
                                        echo "Wiraswasta";
                                    }else{
                                        echo "Belum Bekerja";
                                    }
                                    ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Pendidikan</td>
                                <td>
                                <?php 
                                    if($family['pendidikan'] == 1){
                                        echo "SD";
                                    }elseif($family['pendidikan'] == 2){
                                        echo "SMP";
                                    }elseif($family['pendidikan'] == 3){
                                        echo "SMA";
                                    }elseif($family['pendidikan'] == 4){
                                        echo "STRATA 1";
                                    }elseif($family['pendidikan'] == 5){
                                        echo "STRATA 2";
                                    }elseif($family['pendidikan'] == 6){
                                        echo "DOKTORAL";
                                    }else{
                                        echo "-";
                                    }
                                    ?>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>Jurusan</td>
                                <td><?= $family['jurusan'] ?></td>
                            </tr>

                            <tr>
                                <td>Asal Sekolah</td>
                                <td><?= $family['sekolah_nama'] ?></td>
                            </tr>
                            
                            <tr>
                                <td>Alamat Sekolah asal</td>
                                <td><?= $family['sekolah_alamat'] ?></td>
                            </tr>

                            <tr>
                                <td>Nomor Telephone</td>
                                <td><?= $family['no_tlp'] ?></td>
                            </tr>

                            <tr>
                                <td>Nomor Telephone2</td>
                                <td><?= $family['no_tlp2'] ?></td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>


</div>