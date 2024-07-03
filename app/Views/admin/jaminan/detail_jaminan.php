<div class="container-fluid">

        <div class="">
            <h3>Detail Jaminan</h3>
        </div>
        
        <div class="d-flex justify-content-between">
            <?php if(session()->get('user_level') == 'admin') : ?>
            <a class="btn btn-outline-success" href="/jaminan/index"> <i class="fas fa-arrow-left"></i> Back </a>
            <?php elseif(session()->get('user_level') == 'user') : ?>
                <a class="btn btn-outline-success" href="/karyawan/detail_karyawan_kantor/<?= $jaminan['employee_id'] ?>"> <i class="fas fa-arrow-left"></i> Back </a>
            <?php endif; ?>
            <a class="btn btn-outline-danger" href="/jaminan/print_jaminan/<?= $jaminan['trn_id'] ?>"> <i class="fas fa-file-pdf"></i> Print</a>
        </div>

        <br>

        
        <div class="row">
            <div class="col">
                <div class="table-responsive">
                        <table class="table table-bordered bg-white">
                            <tr>
                                <td>Nomor Dokumen</td>
                                <td><?= $jaminan['trn_no'] ?></td>
                            </tr>

                            <tr>
                                <td>Tanggal Dokumen</td>
                                <td><?= date( "d-m-Y", strtotime($jaminan['trn_date'])) ?></td>
                            </tr>

                            <tr>
                                <td>Nama Karyawan</td>
                                <td><?= $jaminan['employee_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Jaminan</td>
                                <td><?= $jaminan['jaminan_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Jenis Jaminan</td>
                                <td><?= $jaminan['type_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Status</td>
                                <td>
                                <?= ($jaminan['status'] == 1) ? 'Penyerahan': '' ?>
                                <?= ($jaminan['status'] == 2) ? 'Peminjaman': '' ?>
                                <?= ($jaminan['status'] == 3) ? 'Pengembalian': '' ?>
                                </td>
                            </tr>

                            <tr>
                                <td>Tanggal Diserahkan</td>
                                <td><?= date("d-M-Y" , strtotime($jaminan['tgl_serah'])) ?></td>
                            </tr>

                            <tr>
                                <td>Membuat</td>
                                <td><?= $jaminan['buat_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Menyetujui</td>
                                <td><?= $jaminan['setuju_name'] ?></td>
                            </tr>

                            <tr>
                                <td>Gambar Ijazah</td>
                                <td>
                                    <?php if($jaminan['gambar'] != null) : ?>
                                        <button type="button" class="btn" data-toggle="modal" data-target="#staticBackdrop">
                                            <img src="/img/<?= $jaminan['gambar'] ?>" alt="" class="img-thumbnail img-detail">
                                        </button>
                                    <?php else : ?>
                                        <span class="text-danger">Gambar belum diupload</span>
                                    <?php endif ?>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
</div>

<!-- modal view -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Gambar <?= $jaminan['jaminan_name'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row d-flex justify-content-center">
            <img src="/img/<?= $jaminan['gambar'] ?>" alt="" class="img-thumbnail">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- batas -->