<div class="container-fluid">
    <div class="d-flex justify-content-between mb-3">
        <h3>Edit data</h3>
        <a href="/mst_achivement/index" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
    </div>
    <div class="card shadow">
        <form action="/mst_achivement/update/<?= $mst_achivement['id_achive'] ?>" method="post">
            <div class="card-body">
                <div class="row">
                    <div class="col col-md-10">
                        <input type="hidden" name="id_achive" value="<?= $mst_achivement['id_achive'] ?>">
                        <input type="text" class="form-control" name="name_achivement" value="<?= $mst_achivement['name'] ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-outline-primary"> <i class="fas fa-edit"></i> Edit data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>