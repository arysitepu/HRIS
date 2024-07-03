<?php

namespace App\Controllers;
use App\Models\Karyawan_model;

class Home extends BaseController
{
    protected $karyawan_model;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->karyawan_model = new Karyawan_model();
    }
    public function index()
    {
        
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if(session()->get('user_level') == 'admin'){
            $total_karyawan = $this->karyawan_model->jumlah_karyawan();
            
            }elseif(session()->get('user_level') == 'user'){
            $branchId = session()->get('branch_id');
            $total_karyawan = $this->karyawan_model->getKaryawanCount_user($branchId);
            }

        // $total_karyawan = $this->karyawan_model->jumlah_karyawan();

      $data = [
          'total_karyawan' => $total_karyawan]; 
       
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/home/index', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    
}
