<div class="container-fluid">
    <h3>MASTER FORMULA</h3>

    <div class="card">
        <div class="card-header">
            <h5 class="text-center">List</h5>
        </div>

        <div class="card-body">
            <select name="" id="" class="form-control">
                <option value="">Formula</option>

                <?php foreach($formula as $frm) : ?>
                <option value=""><?= $frm['facility_format'] ?></option>
                <option value=""><?= $frm['facility_in_format'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
</div>