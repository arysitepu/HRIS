<?php

namespace App\Controllers;

use App\Models\Phk_model;
use App\Models\Karyawan_model;
use App\Models\Position_model;
use App\Models\Formula_model;
use App\Models\Sbu_model;


class Phk extends BaseController
{
    protected $phk_model;
    protected $formula_model;
    protected $session;
    protected $karyawan_model;
    protected $position_model;
    protected $sbu_model;

    public function __construct()
    {
        $this->session = session();
        $this->phk_model = new Phk_model();
        $this->karyawan_model = new Karyawan_model();
        $this->position_model = new Position_model();
        $this->formula_model = new Formula_model();
        $this->sbu_model = new Sbu_model();
        
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
        $nama = $this->request->getVar('nama');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        $keyword = $this->request->getVar('keyword');
       
        if($keyword){
            $phk = $this->phk_model->search_multiple($nama, $tahun, $bulan, $keyword);
            $pager = $this->phk_model->pager;
        }elseif($bulan){
            $phk = $this->phk_model->search_multiple($nama, $tahun, $bulan, $keyword);
            $pager = $this->phk_model->pager;
        }elseif($tahun){
            $phk = $this->phk_model->search_multiple($nama, $tahun, $bulan, $keyword);
            $pager = $this->phk_model->pager;
        }elseif($nama){
            $phk = $this->phk_model->search_multiple($nama, $tahun, $bulan, $keyword);
            $pager = $this->phk_model->pager;
        }else{
            
            $phk = $this->phk_model->getPhk();
            $pager = $this->phk_model->pager;
        }
      
        
                $data = [
            
            'phk' => $phk,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/phk/phk_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $phk = $this->phk_model->getPhk_id($id);
        $data = [
            'phk' => $phk
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/phk/detail_phk', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        
      
    }  

    public function add_phk()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $nomorDokumen = $this->phk_model->nomorDokumen();
        $nomorDokumenResign = $this->phk_model->nomorDokumenResign();
        $nomorDokumenPensiun = $this->phk_model->nomorDokumenPensiun();
        $nomorDokumen1 = $this->phk_model->nomorDokumen1();
        $phk = $this->phk_model->getPhk();
        $karyawan = $this->karyawan_model->findAll();
        $formula = $this->formula_model->getFormula();
        $data = [
            'phk' => $phk,
            'karyawan' => $karyawan, 
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen,
            'nomordokumenresign' => $nomorDokumenResign,
            'nomordokumenpensiun' => $nomorDokumenPensiun,
            'nomordokumen1' => $nomorDokumen1
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/phk/add_phk', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');

    }

    public function save_phk()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->phk_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'phk_date' => $this->request->getVar('phk_date'),
            'phk_desc' => $this->request->getVar('phk_desc'),
            'employee_status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('phk/index');
    }

    public function post_phk($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->phk_model->save([
            'trn_id' => $id,
            'posting' =>1
        ]);

        $branch = $this->request->getVar('branch_id');
        $position_id = $this->request->getVar('position_id');
        $tanggal_keluar = $this->request->getVar('tanggal_keluar');
        $status = $this->request->getVar('status');
       
        $data = [
            'branch_id' => $branch,
            'position_id' => $position_id,
            'tanggal_keluar' => $tanggal_keluar,
            // 'employee_status' => 2
            'employee_status' => $status
        ];
        
        $this->phk_model->posting($this->request->getVar('employee_id'), $data);
        $this->sbu_model->nik_out();
        session()->setFlashdata('pesan', 'Data berhasil di posting');
        return redirect()->to('phk/index');
    }

    public function edit_phk($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $phk = $this->phk_model->getPhk_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $data = [
            'phk' => $phk,
            'karyawan' => $karyawan, 
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/phk/edit_phk', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
    }

    public function update_phk($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->phk_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'phk_date' => $this->request->getVar('phk_date'),
            'phk_desc' => $this->request->getVar('phk_desc'),
            'employee_status' => $this->request->getVar('status'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('phk/index');
    }

    public function delete_phk($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->phk_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('phk');
    }

    public function detail_print($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $data = [
            'phk' => $this->phk_model->getPhk_id($id)
        ];

        echo view('admin/templates/header');
        echo view('admin/phk/print_phk', $data);
        echo view('admin/templates/js');
       
        
      
    }  

    public function print()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');

        $keyword = $this->request->getVar('keyword');
     
        if($keyword){
            $phk = $this->phk_model->search($tahun, $bulan, $keyword)->getResultArray();
          
        }elseif($bulan){
            $phk = $this->phk_model->search($tahun, $bulan, $keyword)->getResultArray();
          
        }elseif($tahun){
            $phk = $this->phk_model->search($tahun, $bulan, $keyword)->getResultArray();
          
        }else{
            
            $phk = $this->phk_model->getPhk();
          
        }
        
                $data = [
            
            'phk' => $phk
        ];



        echo view('admin/templates/header');
        echo view('admin/phk/print_list_phk', $data);
        echo view('admin/templates/js');
       

    }

   
}