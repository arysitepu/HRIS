<div class="container-fluid">
   
    <div class="d-flex justify-content-between mb-3">
      <h3>Add Fasilitas</h3>
    <a href="/fasilitas/detail_fasilitas/<?= $fasilitas['trn_id'] ?>" class="btn btn-outline-success" > <i class="fas fa-arrow-left"></i> Back Detail </a>
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
    <div class="card shadow mb-4">

    <div class="card-body">
    
                            <form action="/fasilitas_det/save_detail/" method="post" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="id" value="<?= $fasilitas['trn_id'] ?>">
                                <div class="row">
                                    <div class="col">
                                    <label for="" class="d-inline"> Nomor Dokumen </label>
                                    <input type="text" class="form-control d-inline" value="<?= $fasilitas['trn_no'] ?>" readonly name="trn_id">
                                    <input type="hidden" class="form-control d-inline" value="<?= $fasilitas['trn_id'] ?>" readonly name="trn_id">
                                    <div class="invalid-feedback">
                                    
                                    </div>
                                    </div>
                                    <div class="col">
                                    <label for="" class="d-inline"> Qty </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('qty')) ? 'is-invalid' : ''; ?>" value="" name="qty">
                                    <div class="invalid-feedback">
                                    <?= $validation->getError('qty') ?>
                                    </div>
                                    </div>

                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col">
                                    <label for="" class="d-inline"> Jenis Fasilitas </label>
                                    <select name="facility_id" id="facility_id" class="form-control <?= ($validation->hasError('facility_id')) ? 'is-invalid' : ''; ?>">
                                        <option value="">Pilih</option>
                                        <?php foreach($mst_fasilitas as $mst_fasilitas) : ?>
                                        <option value="<?= $mst_fasilitas['facility_id'] ?>"><?= $mst_fasilitas['facility_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                    <?= $validation->getError('facility_id') ?>
                                    </div>
                                    </div>
                                    
                                    <div class="col">
                                        <label for="" class="d-inline">Kode fasilitas</label>
                                        <input type="text" class="form-control" name="facility_code" id="facility_code" readonly>
                                    </div>

                                    <div class="col">
                                    <label for="" class="d-inline"> Kegunaan </label>
                                    <input type="text" class="form-control <?= ($validation->hasError('kegunaan')) ? 'is-invalid' : ''; ?>" value="" name="kegunaan">
                                    <div class="invalid-feedback">
                                    <?= $validation->getError('kegunaan') ?>
                                    </div>
                                    </div>
                                </div>

                            <hr>

                            <div class="row">
                                <div class="col">
                                    <label for="">Image Upload</label>
                                    <input type="file" class="form-control <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" name="gambar">
                                    <div class="invalid-feedback">
                                    <?= $validation->getError('gambar') ?>
                                    </div>
                                </div>
                            </div>
                        <hr>
                                <button type="submit" class="btn btn-outline-success"> <i class="fas fa-save"></i> Save </button>
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