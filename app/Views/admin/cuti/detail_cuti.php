<div class="container-fluid">

<div class="row ml-3">
  <a href="/trn_cuti/index" class="btn btn-outline-success mb-3"> <i class="fas fa-arrow-left"> </i> Back </a>
</div>
<div class="row">
<div class="col d-flex justify-content-between ml-3 mr-3">
<h3 class="">Detail</h3>
  <?php if(session()->get('user_level') == 'admin') : ?>
  <a href="/trn_cuti/print_cuti/<?= $cuti['trn_id'] ?>" class="btn btn-outline-danger" title="Print"><i class="fas fa-file-pdf"></i>Print</a>
  <?php endif ?>
</div>
  

</div>
  
<div class="alert alert-info mb-3 mt-3">
  Generate data terlebih dahulu untuk menyelesaikan penginputan cuti dengan cara klik tanggal dan klik tombol 
  <Span class="text-danger font-weight-bold">Generate</Span> seperti yang sudah disediakan
</div>

<?php if(session()->getFlashdata('pesan')) : ?>
<div class="alert alert-success">
  <?= session()->getFlashdata('pesan') ?>
</div>
<div class="card mt-3">

<?php endif; ?>

<?php if(session()->getFlashdata('error')) : ?>

<div class="alert alert-danger">
  <?= session()->getFlashdata('error') ?>
</div>
<div class="card">

<?php endif; ?>

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>
<div class="swal_error" data-swal_error="<?= session()->get('error') ?>"></div>
    <div class="card-body">
    <div class="accordion" id="accordionExample">
  <div class="card">
  <div class="card-header" id="heading1">
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="false" aria-controls="collapseTwo">
         Detail
        </button>
      </h2>
    </div>

    
    <div id="collapse1" class="collapse" aria-labelledby="heading2" data-parent="#accordionExample">
      <div class="card-body">
      <div class="row">
        <div class="col">
          <div class="table-responsive">
            <table class="table-bordered" style="width: 100%;">
                <tr>
                  <td>Nomor dokumen</td>
                  <td><?= $cuti['trn_no'] ?></td>
                </tr>

                <tr>
                  <td>Tanggal Dokumen</td>
                  <td><?= date("d-M-Y", strtotime($cuti['trn_date'])) ?></td>
                </tr>

                <tr>
                  <td>Nama Karyawan</td>
                  <td><?= $cuti['employee_name'] ?></td>
                </tr>

                <tr>
                  <td>Posisi</td>
                  <td><?= $cuti['position_name'] ?></td>
                </tr>

                <tr>
                  <td>SBU</td>
                  <td><?= $cuti['branch_name'] ?></td>
                </tr>

                <tr>
                  <td>Posisi</td>
                  <td><?= $cuti['position_name'] ?></td>
                </tr>

                <tr>
                  <td>Jenis</td>
                  <td><?= $cuti['cuti_name'] ?></td>
                </tr>

                <tr>
                  <td>Dari Tanggal</td>
                  <td><?= date("d-M-Y", strtotime($cuti['tgl_dari'])) ?></td>
                </tr>

                <tr>
                  <td>Sampai Tanggal</td>
                  <td><?= date("d-M-Y", strtotime($cuti['tgl_sampai'])) ?></td>
                </tr>

                <tr>
                  <td>Jumlah Cuti</td>
                  <td><?= $cuti['cuti_jumlah'] ?> Hari</td>
                </tr>

                <tr>
                  <td>Sisa Cuti</td>
                  <td>
                  <?php
                    $sisa_cuti = $cuti['hak_cuti'] - $cuti_jumlah['cuti_jumlah'];
                    echo $sisa_cuti ." ". "Hari";
                    ?>
                  </td>
                </tr>

                <tr>
                  <td>Alamat Cuti</td>
                  <td><?= $cuti['alamat_cuti'] ?></td>
                </tr>

                <tr>
                  <td>Serah Kerja</td>
                  <td><?= $cuti['serah_kerja'] ?></td>
                </tr>

                <tr>
                  <td>Membuat</td>
                  <td><?= $cuti['buat_name'] ?></td>
                </tr>

                <tr>
                  <td>Menyetujui</td>
                  <td><?= $cuti['setuju_name'] ?></td>
                </tr>

                <tr>
                  <td>Deskripsi</td>
                  <td><?= $cuti['cuti_desc'] ?></td>
                </tr>

                <?php if($cuti['cuti_id'] == 2): ?>
                <tr>
                  <td>surat sakit</td>
                  <td>
                    <?php if($cuti['gambar_sakit'] != null){ ?>
                    <button type="button" data-toggle="modal" data-target="#modalGambar">
                      <img class="avatar2" src="/img/<?= $cuti['gambar_sakit'] ?>" alt="">
                    </button> <a href="/trn_cuti/download_dokumen/<?= $cuti['trn_id'] ?>"> <i class="fas fa-download"></i>Download </a>
                    <?php }else{ ?>
                      Belum di upload
                      <?php } ?>
                  </td>
                </tr>

                <?php endif ?>
            </table>
          </div>
        </div>
      </div>

      </div>
    </div>
  </div>
    </div>
    <?php if(session()->get('user_level') == 'admin') : ?>
    <div class="card">
    <div class="card-header" id="heading2">
    
      <h2 class="mb-0">
        <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapseTwo">
          Tanggal
        </button>
      </h2>

      <?php endif ?>
    </div>

    <div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
      <form action="/trn_cuti/tgl_generateDetail/<?=$cuti['trn_id'] ?>" class="d-inline">
      <input type="hidden" name="cuti_type" value="<?= $cuti['cuti_type'] ?>" >
    <input type="hidden" name="trn_id" value="<?= $cuti['trn_id'] ?>" >
    <input type="hidden" name="cuti_id" value="<?= $cuti['cuti_id'] ?>" >
    <input type="hidden" name="start_date" value="<?= $cuti['tgl_dari'] ?>" readonly>
    <input type="hidden" name="end_date" value="<?= $cuti['tgl_sampai'] ?>" readonly>

    
    <button type="submit" class="btn btn-success"> Generate</button>
    <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
   <i class="fas fa-plus"></i> add date
    </button>
</form>
<div class="table-responsive mt-3">
      <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Tanggal Cuti</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php $no=1; ?>

  <?php foreach($cuti_tgl as $ctgl) : ?>

    <tr>
      <th scope="row"><?= $no++ ?></th>
      <td><?= date("D ,d-M-Y", strtotime($ctgl['tgl_cuti'])) ?></td>
      <td><a href="/trn_cuti/delete_tanggal/<?= $ctgl['id_tgl'] ?>" class="btn btn-danger" onclick="return confirm('apakah anda yakin?.')"> <i class="fas fa-trash-alt"></i></a>  </td>
    </tr>
   
    <?php endforeach; ?>
</table>
</div>

      </div>
    </div>
  </div>
</div>

<!-- modal tambah data -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah tanggal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/trn_cuti/add_tgl/<?= $cuti['trn_id'] ?>">
      <div class="modal-body">
          <input type="hidden" class="form-control" name="trn_id" value="<?= $cuti['trn_id'] ?>">
          <input type="hidden" class="form-control" name="cuti_id" value="<?= $cuti['cuti_id'] ?>">
          <input type="hidden" class="form-control" name="cuti_type" value="<?= $cuti['cuti_type'] ?>">
          <input type="date" class="form-control" name="tgl_cuti">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- batas -->

<!-- modal gambar -->
<div class="modal fade" id="modalGambar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bukti Surat Sakit</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <img class="" src="/img/<?= $cuti['gambar_sakit'] ?>" alt="">
      </div>
    </div>
  </div>
</div>
<!-- batas -->

</div>