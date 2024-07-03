<div class="container-fluid">

    <a href="/training/detail_training/<?= $training_det['trn_id'] ?>" class="btn btn-outline-info mb-3"> <i class="fas fa-arrow-left"></i> Back </a>

    <div class="card">

    <div class="card-body">

        <form action="/training_det/update_training_det/<?= $training_det['id'] ?>">
        
        <div class="row">
            <input type="hidden" value="<?= $training_det['id'] ?>" name="id">
        
            <div class="col">
             <label for="">Nama Karyawan</label>
                <select name="employee_id" id="" class="form-control">
         
                 <option value="<?= $training_det['employee_id'] ?>"><?= $training_det['employee_name'] ?></option>
         
                 <?php foreach($karyawan as $kry) : ?>
                 <option value="<?= $kry['employee_id'] ?>"><?= $kry['employee_name'] ?></option>
         
                 <?php endforeach; ?>
         
                </select>
            </div>
        
            <div class="col">
                <label for="">Biaya</label>
                <input type="text" class="form-control" name="biaya" value="<?= $training_det['biaya'] ?>">
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-outline-info"> <i class="fas fa-edit"></i>Ubah Data </button>
        </form>
    </div>
    
    </div>
</div>
