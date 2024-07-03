<div class="container-fluid">
        <div class="d-flex justify-content-between mb-3">
            <h3 class="text-center">  Update Data Fasilitas </h3>
            <a href="/fasilitas/detail_fasilitas/<?= $fasilitas_detail['trn_id'] ?>" class="btn btn-outline-success" > <i class="fas fa-arrow-left"></i> Back Detail</a>
        </div>

        <?php if(session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-success">
                <?= session()->getFlashdata('pesan') ?>
                </div>
        <?php endif; ?>

        <?php if(session()->getFlashdata('error')) : ?>
        <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

<div class="swal" data-swal="<?= session()->get('pesan') ?>"></div>

     <div class="card shadow">
    <div class="card-body">
    
<form action="/fasilitas_det/update_detail/<?= $fasilitas_detail['id'] ?>" method="post" enctype="multipart/form-data">
<?= csrf_field() ?>
<input type="hidden" name="id" value="<?= $fasilitas_detail['id'] ?>">
<input type="hidden" name="gambar_lama" value="<?= $fasilitas_detail['gambar'] ?>">
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nomor Dokumen </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_detail['trn_no'] ?>" readonly name="trn_id">
        <input type="hidden" class="form-control d-inline" value="<?= $fasilitas_detail['trn_id'] ?>" readonly name="trn_id">
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline"> Qty </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_detail['qty'] ?>" name="qty">
        <div class="invalid-feedback">
           
        </div>
        </div>

    </div>
    <hr>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Jenis Fasilitas </label>
         <select name="facility_id" id="facility_id" class="form-control">
   
            <option value="<?= $fasilitas_detail['facility_id'] ?>"><?= $fasilitas_detail['facility_name'] ?></option>

            <?php foreach($mst_fasilitas as $mst_fasilitas) : ?>
            <option value="<?= $mst_fasilitas['facility_id'] ?>"><?= $mst_fasilitas['facility_name'] ?></option>
            <?php endforeach; ?>
        </select>
        </div>

        <div class="col">
        <label for="" class="d-inline">Kode fasilitas</label>
        <input type="text" class="form-control" name="facility_code" id="facility_code" value="<?= $fasilitas_detail['facility_code'] ?>" readonly>
        </div>
    </div>

<hr>

<div class="row">
<div class="col">
        <label for="" class="d-inline"> Kegunaan </label>
        <input type="text" class="form-control d-inline" value="<?= $fasilitas_detail['kegunaan'] ?>" name="kegunaan">
        <div class="invalid-feedback">
           
        </div>
</div>

<div class="col">
    <label for="" class="d-inline">Upload Image</label>
    <input type="file" class="form-control" name="gambar">
</div>
</div>
<hr>
<div class="row mb-3">
    <div class="col">
        <img src="/img/<?= $fasilitas_detail['gambar'] ?>" alt="" class="img-thumbnail img-detail">
    </div>
</div>

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-edit"></i> Update </button>
</form>

    </div>

     </div>

</div>

<script>
    $(document).ready(function() {
        $('#facility_id').change(function() {
            let facility_id = $(this).val();
            if (facility_id) {
                $.ajax({
                    url: '<?= base_url('Fasilitas_det/getFacilityCode') ?>',
                    type: 'GET',
                    data: { facility_id: facility_id },
                    success: function(response) {
                        if (response.error) {
                            $('#facility_code').val(response.error);
                        } else {
                            $('#facility_code').val(response.facility_code);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error: ", status, error); // Debugging
                        alert('Terjadi kesalahan saat mengambil data.');
                    }
                });
            } else {
                $('#facility_code').val('');
            }
        });
    });
</script>