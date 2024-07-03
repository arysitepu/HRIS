 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home/index">

<div class="card-hide" style="width: 5rem;">
  <img class="card-img-top" src="/img/logo.png" alt="Card image cap">
  
</div>


    <div class="sidebar-brand-text mx-3">HRD</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
    <a class="nav-link" href="/home/index">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<div class="sidebar-heading">
    Interface
</div>

<?php if(session()->get('user_level') == 'admin') : ?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo1"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-users"></i>
        <span>Master data</span>
    </a>
    <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Masterdata</h6>
            <a class="collapse-item" href="/karyawan/index">Karyawan</a>
            <a class="collapse-item" href="/mst_cuti/index">Attedance</a>
            <a class="collapse-item" href="/mst_facility/index">Fasilitas</a>
            <a class="collapse-item" href="/position/index">Jabatan</a>
            <a class="collapse-item" href="/libur/index">Hari Libur</a>
            <a class="collapse-item" href="/branch/index">SBU</a>
            <a class="collapse-item" href="/mst_achivement/index">Achivement</a>
            <a class="collapse-item" href="/training_master/index">Pelatihan</a>
            <a class="collapse-item" href="/auth/user">User</a>
        </div>
    </div>
</li>
<?php endif; ?>

<?php if(session()->get('user_level') == 'admin') : ?>
<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-sync"></i>
        <span>Transaksi Pribadi</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Transaksi Pribadi</h6>
            <a class="collapse-item" href="/contact_employee/index">Contact karyawan</a>
            <a class="collapse-item" href="/family/index">Keluarga Karyawan</a>
            <a class="collapse-item" href="/employee_education/index">Pendidikan</a>
            
            
        </div>
    </div>
</li>

<?php endif; ?>

<?php if(session()->get('user_level') == 'admin') : ?>
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo3"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-sync"></i>
        <span>Transaksi ATL</span>
    </a>
    <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Transaksi Pribadi</h6>
            <a class="collapse-item" href="/join/index">Pengangkatan</a>
            <a class="collapse-item" href="/trn_position/index">Mutasi Jabatan</a>
            <a class="collapse-item" href="/fasilitas/index">Fasilitas Karyawan</a>
            <a class="collapse-item" href="/absensi/index">Absensi</a>
            <a class="collapse-item" href="/training/index">Pelatihan Karyawan</a>
            <a class="collapse-item" href="/jaminan/index">Jaminan</a>
            <a class="collapse-item" href="/peringatan/index">Surat Peringatan</a>
            <a class="collapse-item" href="/phk/index">Karyawan Keluar</a> 
            <a class="collapse-item" href="/trn_cuti/index">Attendance</a>
            <a class="collapse-item" href="/trn_achivement/index">Achievement</a>
        </div>
    </div>
</li>
<?php endif ?>

<?php if(session()->get('user_level') != 'admin') : ?>
<li class="nav-item">
<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo3"
        aria-expanded="true" aria-controls="collapseTwo">
        <i class="fas fa-fw fa-sync"></i>
        <span>Transaksi ATL</span>
    </a>
    <div id="collapseTwo3" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
    <h6 class="collapse-header">Transaksi ATL</h6>
    <a class="collapse-item" href="/trn_cuti/index">Attedance</a>
    <a class="collapse-item" href="/karyawan/index">Karyawan</a>
    </div>
    </div>

    <?php endif ?>


</li>

<li class="nav-item">
    <div id="collapseTwo2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Materdata</h6>
            <a class="collapse-item" href="/mst_jaminan/index">Jaminan karyawan</a>
            <a class="collapse-item" href="/mst_join/index">Karyawan Join</a>
            <a class="collapse-item" href="/fasilitas_karyawan/index">Fasilitas Karyawan</a>
        </div>
    </div>
</li>


<li class="nav-item">
    <a class="nav-link" href="/dokumen/index">
        <i class="fas fa-fw fa-file"></i>
        <span>Document</span></a>
        
</li>

<?php if(session()->get('user_level') == 'admin') : ?>
<li class="nav-item">
    <a class="nav-link" href="/report/index">
        <i class="fas fa-fw fa-file"></i>
        <span>Report</span></a>
        
</li>
<?php endif ?>

<!-- Divider -->
<hr class="sidebar-divider d-none d-md-block">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->