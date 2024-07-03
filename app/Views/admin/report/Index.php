<div class="container-fluid">
    <div class="d-flex justify-content-between">
        <h3>Report</h3>
        <a href="" class="btn btn-outline-success"> <i class="fas fa-arrow-left"></i> Back </a>
       
    </div>

<div class="row mt-3">
    <div class="col"> 
            <img src="/assets/img/report.png" alt="" class="img-fluid mt-3 mb-3 ml-3 mr-3">
    </div>

    <div class="col">
        <div class="card">
            <div class="card-header text-center">
                List Report                
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <a href="/report/report_karyawan/" class="btn btn-outline-success btn-block"> <i class="fas fa-file"></i> Report karyawan </a>
                </div>
                <?php if(session()->get('user_level') == 'admin') : ?>
                <div class="row mb-3">
                    <a href="/jaminan/print_list_jaminan" class="btn btn-outline-success btn-block"> <i class="fas fa-file"></i> Report Jaminan </a>
                </div>
                <div class="row">
                    <a href="/join/print_list" class="btn btn-outline-success btn-block"> <i class="fas fa-file"></i> Report Pengangkatan </a>
                </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>    
    
</div>