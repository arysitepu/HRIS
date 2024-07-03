<?php

namespace App\Controllers;
use App\Models\Trn_cuti_model;
use App\Models\MstCuti_model;
use App\Models\Karyawan_model;
use App\Models\Libur_model;
use App\Models\Branch_model;
use App\Models\Report_model;
use App\Models\Users_model;


class Report extends BaseController{

    protected $trn_cuti_model;
    protected $mst_cuti_model;
    protected $karyawan_model;
    protected $libur_model;
    protected $branch_model;
    protected $report_model;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->trn_cuti_model = new Trn_cuti_model();
        $this->mst_cuti_model = new MstCuti_model();
        $this->karyawan_model = new Karyawan_model();
        $this->libur_model = new Libur_model();
        $this->branch_model = new Branch_model();
        $this->report_model = new Report_model();
    }

    public function index()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/report/index');
        echo view('admin/templates/js');
        // echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function report_karyawan_user()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $branch = $this->branch_model->findAll();
        $karyawan = [];
        $count_tetap= 0;
        $count_sbu = 0;
        $count_probation = 0;
        $count_resign = 0;
        $sbu_name['branch_name'] = "";
        $sbu_name['branch_id'] = "cabang";

        $data = [
            'branch' => $branch,
            'karyawan' => $karyawan,
            'count_tetap' => $count_tetap,
            'count_sbu' => $count_sbu,
            'count_probation' => $count_probation ,
            'count_resign' => $count_resign,
            'sbu_name' => $sbu_name,

        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/report/report_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function report_karyawan()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $branch = $this->branch_model->findAll();
        $karyawan = [];
        $count_tetap= 0;
        $count_sbu = 0;
        $count_probation = 0;
        $count_resign = 0;
        $sbu_name['branch_name'] = "";
        $sbu_name['branch_id'] = "cabang";

        $data = [
            'branch' => $branch,
            'karyawan' => $karyawan,
            'count_tetap' => $count_tetap,
            'count_sbu' => $count_sbu,
            'count_probation' => $count_probation ,
            'count_resign' => $count_resign,
            'sbu_name' => $sbu_name,

        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/report/report_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function search_report_karyawan_user()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $status = $this->request->getVar('status');
        $sbu = session()->get('branch_id');
        // dd($sbu);
        if($sbu || $status){
            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            // dd($karyawan);
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu);
            $sbu_name = $this->report_model->get_sbu($sbu)->getRowArray();
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu);
            
            $branch = $this->branch_model->findAll();
        }else{

            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu, $status);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu, $status);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu, $status);
            $sbu_name['branch_name'] = "";
            $sbu_name['branch_id'] = "";
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu, $status);
            // dd($karyawan);
            $branch = $this->branch_model->findAll();
        }

        if ($sbu_name === null) {
            $sbu_name = ['branch_name' => "", 'branch_id' => ""];
        }

        $data = [
            'karyawan' => $karyawan,
            'branch' => $branch, 
            'count_tetap' => $count_tetap,
            'count_probation' => $count_probation,
            'count_sbu' => $count_sbu,
            'count_resign' => $count_resign,
            'sbu_name' => $sbu_name,
            'sbu' => $sbu
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/report/report_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }    

    public function search_report_karyawan()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $sbu = $this->request->getVar('sbu');
        $status = $this->request->getVar('status');

        if($sbu || $status){
            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            // dd($karyawan);
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu);
            $sbu_name = $this->report_model->get_sbu($sbu)->getRowArray();
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu);
            
            $branch = $this->branch_model->findAll();
        }else{

            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu, $status);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu, $status);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu, $status);
            $sbu_name['branch_name'] = "";
            $sbu_name['branch_id'] = "";
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu, $status);
            // dd($karyawan);
            $branch = $this->branch_model->findAll();
        }

        if ($sbu_name === null) {
            $sbu_name = ['branch_name' => "", 'branch_id' => ""];
        }

        $data = [
            'karyawan' => $karyawan,
            'branch' => $branch, 
            'count_tetap' => $count_tetap,
            'count_probation' => $count_probation,
            'count_sbu' => $count_sbu,
            'count_resign' => $count_resign,
            'sbu_name' => $sbu_name,
            'sbu' => $sbu
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/report/report_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function cetak_excel()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if(session()->get('user_level') == 'admin'){
            $sbu = $this->request->getVar('sbu');
        }elseif(session()->get('user_level') == 'user'){
            $sbu = session()->get('branch_id');
        }
        $status = $this->request->getVar('status');

        if($sbu){
            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu);
            $sbu_name = $this->report_model->get_sbu($sbu)->getRowArray();
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu);
            
            $branch = $this->branch_model->findAll();
        }else{

            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu);
            $sbu_name['branch_name'] = "";
            $sbu_name['branch_id'] = "";
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu);
            // dd($karyawan);
            $branch = $this->branch_model->findAll();
        }

        $data = [
            'karyawan' => $karyawan,
            'branch' => $branch, 
            'count_tetap' => $count_tetap,
            'count_probation' => $count_probation,
            'count_sbu' => $count_sbu,
            'count_resign' => $count_resign,
            'sbu_name' => $sbu_name,
            'sbu' => $sbu
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/report/excel_karyawan_report.php', $data);
        echo view('admin/templates/js');
        // echo view('admin/templates/footer');
        // echo view('admin/templates/modal');

    }

    public function cetak_pdf()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if(session()->get('user_level') == 'admin'){
            $sbu = $this->request->getVar('sbu');
        }elseif(session()->get('user_level') == 'user'){
            $sbu = session()->get('branch_id');
        }
        $status = $this->request->getVar('status');

        if($sbu){
            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu);
            $sbu_name = $this->report_model->get_sbu($sbu)->getRowArray();
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu);
            
            $branch = $this->branch_model->findAll();
        }else{

            $karyawan = $this->report_model->getKaryawanReport($sbu, $status)->getResultArray();
            $count_tetap = $this->report_model->getKaryawanCount_tetap($sbu);
            $count_probation = $this->report_model->getKaryawanCount_probation($sbu);
            $count_sbu = $this->report_model->getKaryawanCount_sbu($sbu);
            $sbu_name['branch_name'] = "";
            $sbu_name['branch_id'] = "";
            $count_resign = $this->report_model->getKaryawanCount_resign($sbu);
            // dd($karyawan);
            $branch = $this->branch_model->findAll();
        }

        $data = [
            'karyawan' => $karyawan,
            'branch' => $branch, 
            'count_tetap' => $count_tetap,
            'count_probation' => $count_probation,
            'count_sbu' => $count_sbu,
            'count_resign' => $count_resign,
            'sbu_name' => $sbu_name,
            'sbu' => $sbu
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/report/pdf_karyawan_report.php', $data);
        echo view('admin/templates/js');
        // echo view('admin/templates/footer');
        // echo view('admin/templates/modal');

    }

    public function report_cuti()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $bulan = $this->request->getVar('bulan');

        if($bulan){
            $cuti = $this->trn_cuti_model->search_by_bulan($bulan)->getResultArray();
            $mst_cuti = $this->mst_cuti_model->findAll();
         
        }else{
            $cuti = $this->trn_cuti_model->search_by_bulan($bulan)->getResultArray();
            // $cuti = $this->trn_cuti_model->get_report()->getResultArray();
            $mst_cuti = $this->mst_cuti_model->findAll();
        }
        $data = [
            'cuti' => $cuti,
            'mst_cuti' => $mst_cuti
        ];

        echo view('admin/templates/header');
       
        echo view('admin/report/cuti_report', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal'); 

    }

    public function report_cuti_tahun()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $years = "kosong";
        $cuti = [];
        $branchId = session()->get('branch_id');
        $sbu = $this->branch_model->find($branchId);
        // dd($sbu);
        $mst_cuti = [];
        $karyawan = [];
        $branch = $this->branch_model->findAll();
        $cabang = "kosong";
       
        $data = [
            'cuti' => $cuti,
            'mst_cuti' => $mst_cuti, 
            'karyawan' => $karyawan, 
            'years' => $years,
            'branch' => $branch,
            'cabang' => $cabang,
            'sbu' => $sbu
        ];

        // dd($data);  

        echo view('admin/templates/header'); 
        echo view('admin/report/cuti_report_tahun', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal'); 
    }


    public function search_report_cuti_tahun()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $years = $this->request->getVar('years');
        $branch = $this->request->getVar('sbu');
        $cabang = "";
        $branchId = session()->get('branch_id');
        $sbu = $this->branch_model->find($branchId);

        if($years && $branch){
            $cuti = $this->trn_cuti_model->search_by_years($years, $branch)->getResultArray();
            // dd($cuti);
            $mst_cuti = $this->mst_cuti_model->findAll();
            $karyawan = $this->karyawan_model->findAll();
            $branch = $this->branch_model->findAll();

        }elseif($years || $branch){
            $cuti = $this->trn_cuti_model->search_by_years($years, $branch)->getResultArray();
            $mst_cuti = $this->mst_cuti_model->findAll();
            $karyawan = $this->karyawan_model->findAll();
            $branch = $this->branch_model->findAll();
        }else{
            $cuti = $this->trn_cuti_model->get_report_tahun()->getResultArray();
            $mst_cuti = $this->mst_cuti_model->findAll();
            $karyawan = $this->karyawan_model->findAll();
            $branch = $this->branch_model->findAll();
        }
        $data = [
            'cuti' => $cuti,
            'mst_cuti' => $mst_cuti, 
            'karyawan' => $karyawan, 
            'years' => $years,
            'branch' => $branch, 
            'cabang' => $cabang,
            'sbu' => $sbu
        ];

        // dd($data);   

        echo view('admin/templates/header');
        echo view('admin/report/cuti_report_tahun', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal'); 
    }

    public function report_excel()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $years = $this->request->getVar('years');
        $branch = $this->request->getVar('sbu');

        $yb = [$years, $branch];

        // dd($years);

        if($years){
            $cuti = $this->trn_cuti_model->search_by_years($years, $branch, $yb)->getResultArray();
            $mst_cuti = $this->mst_cuti_model->findAll();
            $karyawan = $this->karyawan_model->findAll();
            $bulan = ["Januari", "Febuary", "Maret", "April", "Mei", "Juni", "July",
            "Agustus", "September", "Oktober", "November", "Desember"];

        }else{

            $cuti = $this->trn_cuti_model->get_report_tahun()->getResultArray();
            $mst_cuti = $this->mst_cuti_model->findAll();
            $karyawan = $this->karyawan_model->findAll();
            $bulan = ["Januari", "Febuary", "Maret", "April", "Mei", "Juni", "July",
                    "Agustus", "September", "Oktober", "November", "Desember"];
        }

        

        $data = [
            'cuti' => $cuti,
            'mst_cuti' => $mst_cuti, 
            'karyawan' => $karyawan, 
            'bulan' => $bulan,
            'years' => $years
        ];

        // dd($data);


        echo view('admin/templates/header');
       
        echo view('admin/report/report_excel', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal'); 
    }

}