<div class="container-fluid">

    <div class="d-flex justify-content-between mb-3">
        <h3>Detail fasilitas <?= $fasilitas_detail['facility_name'] ?></h3>
        <a href="/fasilitas/detail_fasilitas/<?= $fasilitas_detail['trn_id'] ?>" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>
    
    <div class="card mb-5">
        <div class="card-shadow">
            <div class="card-body">
                <div class="table table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <td>Nama Asset</td>
                            <td><?= $fasilitas_detail['facility_name'] ?></td>
                        </tr>

                        <tr>
                            <td>Pemilik</td>
                            <td><?= $fasilitas_detail['employee_name'] ?></td>
                        </tr>

                        <tr>
                            <td>SBU</td>
                            <td><?= $fasilitas_detail['branch_name'] ?></td>
                        </tr>

                        <tr>
                            <td>Gambar</td>
                            <td>
                            <?php if($fasilitas_detail['gambar'] != null) : ?>
                            <button type="button" class="btn" data-toggle="modal" data-target="#staticBackdrop">
                                <img src="/img/<?= $fasilitas_detail['gambar'] ?>" alt="" class="img-thumbnail img-detail">
                            </button>
                            <?php else : ?>
                               <span class="text-danger">Gambar belum di upload</span> 
                            <?php endif ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- modal view -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Gambar <?= $fasilitas_detail['facility_name'] ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row d-flex justify-content-center">
            <img src="/img/<?= $fasilitas_detail['gambar'] ?>" alt="" class="img-thumbnail">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
<!-- batas -->