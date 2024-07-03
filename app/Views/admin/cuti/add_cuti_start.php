<div class="container-fluid">
   <div class="d-flex justify-content-between">
       <h3 class="text-center"> Add Data Attendance</h3>
       <a href="/trn_cuti/index/" class="btn btn-outline-success mb-3" > <i class="fas fa-arrow-left"></i> Back </a>
       </div>
        <div class="card shadow">
    <div class="card-body">
    
<form action="/trn_cuti/save_cuti_start" method="post">
<?= csrf_field() ?>
    <div class="row">
        <div class="col">
        <label for="" class="d-inline"> Nama Karyawan </label>
        <select name="employee_id" id="" class="selField form-control" style="width: 100%;">
            <option value="">Pilih</option>

            <?php foreach($karyawan as $kry) : ?>
            <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
            <?php endforeach; ?>
        </select>
        <div class="invalid-feedback">
           
        </div>
        </div>
        <div class="col">
        <label for="" class="d-inline">Jenis Cuti</label>
        <select name="cuti_id" id="" class="selField form-control">
            <option value="">Pilih</option>

            <?php foreach($mst_cuti as $m_cuti) : ?>
            <option value="<?= $m_cuti['cuti_id'] ?>"><?= $m_cuti['cuti_name'] ?></option>
            <?php endforeach ?>
            
        </select>
        </div>
    </div>

    <hr>
    

    <button type="submit" class="btn btn-outline-success"> <i class="fas fa-arrow-right"></i> next </button>
</form>

    </div>
    <script type="text/javascript">
       $(".selField").select2();
     </script>
     </div>

</div>