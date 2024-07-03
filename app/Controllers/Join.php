<?php

namespace App\Controllers;

use App\Models\Join_model;
use App\Models\Karyawan_model;
use App\Models\Position_model;
use App\Models\Branch_model;
use App\Models\Sbu_model;
use App\Models\Formula_model;

class Join extends BaseController{

    protected $join_model;
    protected $karyawan_model;
    protected $position_model;
    protected $branch_model;
    protected $sbu_model;
    protected $formula_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->join_model = new Join_model();
        $this->karyawan_model = new Karyawan_model();
        $this->position_model = new Position_model();
        $this->branch_model = new Branch_model();
        $this->sbu_model = new Sbu_model(); 
        $this->formula_model = new Formula_model();
        
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

        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        $tanggal = $this->request->getVar('tanggal');
        $tanggal_dari = $this->request->getVar('tanggal_dari');
        $tanggal_sampai = $this->request->getVar('tanggal_sampai');
        $nama = $this->request->getVar('nama');
        $branch_id = $this->request->getVar('branch_id');
        // dd($branch_id);
       

        if($tahun || $bulan || $tanggal || $nama || $branch_id || $tanggal_dari || $tanggal_sampai){
            $join = $this->join_model->search($nama,$tanggal,$bulan,$tahun, $branch_id, $tanggal_dari, $tanggal_sampai);
            $jumlah_join =  $this->join_model->count($nama,$tanggal,$bulan,$tahun, $branch_id, $tanggal_dari, $tanggal_sampai);
            // dd($jumlah_join);
            $branch_id = $this->branch_model->findAll();
            $pager = $this->join_model->pager;
        }else{
            $join = $this->join_model->getJoin();
            $jumlah_join = null;
            $branch_id = $this->branch_model->findAll();
            $pager = $this->join_model->pager;
        }

        // $join = $this->join_model->getJoin()->getResult();
      
        $data = [
            'join' => $join, 
            'jumlah_join' => $jumlah_join,
            'pager' => $pager,
            'branch_id' => $branch_id,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        
      
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/join/join_list', $data);
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

        $data = [
            'join' => $this->join_model->getJoin_id($id)
        ];

       
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/join/detail_join', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add_join()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $nomorDokumen = $this->join_model->nomorDokumen();
        $join = $this->join_model->getJoin();
        $karyawan = $this->karyawan_model->findAll();
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();
        $formula = $this->formula_model->getFormula();

        $data = [
            'join' => $join, 
            'karyawan' => $karyawan, 
            'position' => $position, 
            'branch' => $branch, 
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/join/add_join', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_join()
    {
        
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->join_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'position_id' => $this->request->getVar('position_id'),
            'branch_id' => $this->request->getVar('branch_id'),
            'employee_status' => $this->request->getVar('status'),
            'join_start' => $this->request->getVar('join_start'),
            'note' => $this->request->getVar('note'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('join/index');
    }

    public function post_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->join_model->save([
            'trn_id' => $id,
            'posting' =>1
        ]);

        $branch = $this->request->getVar('branch_id');
        $position_id = $this->request->getVar('position_id');
        $tanggal_masuk = $this->request->getVar('tanggal_masuk');
        $status = $this->request->getVar('status');

        $data = [
            'branch_id' => $branch,
            'position_id' => $position_id,
            'tanggal_masuk' => $tanggal_masuk,
            'employee_status' => $status
        ];


        $this->join_model->posting($this->request->getVar('employee_id'), $data);
        
        $this->sbu_model->get_sbu();
        session()->setFlashdata('pesan', 'Data berhasil di posting');
        return redirect()->to('join/index');
    }

    public function un_post_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->join_model->save([
            'trn_id' => $id,
            'posting' =>0
        ]);

        $branch = $this->request->getVar('branch_id');
        $position_id = $this->request->getVar('position_id');
        $tanggal_masuk = $this->request->getVar('tanggal_masuk');
        $status = $this->request->getVar('status');

        $data = [
            'branch_id' => $branch,
            'position_id' => $position_id,
            'tanggal_masuk' => $tanggal_masuk,
            'employee_status' => $status
        ];


        $this->join_model->posting($this->request->getVar('employee_id'), $data);
        
        $this->sbu_model->get_sbu();
        session()->setFlashdata('pesan', 'Data berhasil di unposting');
        return redirect()->to('join/index');
    }

    public function edit_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        
        $join = $this->join_model->getJoin_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();

        $data = [
            'join' => $join,
            'karyawan' => $karyawan,
            'position' => $position,
            'branch' => $branch
        ];

     

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/join/edit_join', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->join_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'position_id' => $this->request->getVar('position_id'),
            'branch_id' => $this->request->getVar('branch_id'),
            'employee_status' => $this->request->getVar('status'),
            'join_start' => $this->request->getVar('join_start'),
            'note' => $this->request->getVar('note'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('join/index');
    }

    public function delete_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->join_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('join');
    }

    public function print_list()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        $tanggal = $this->request->getVar('tanggal');
        $tanggal_dari = $this->request->getVar('tanggal_dari');
        $tanggal_sampai = $this->request->getVar('tanggal_sampai');
        $nama = $this->request->getVar('nama');
        $branch_id = $this->request->getVar('branch_id');
       
        
        if($tahun || $bulan || $tanggal || $nama || $branch_id || $tanggal_dari || $tanggal_sampai){
            $join = $this->join_model->searchPrint($nama,$tanggal,$bulan,$tahun, $branch_id, $tanggal_dari, $tanggal_sampai)->getResult();
            $jumlah_join =  $this->join_model->count($nama,$tanggal,$bulan,$tahun, $branch_id, $tanggal_dari, $tanggal_sampai);
            // dd($join);
            $branch_id = $this->branch_model->findAll();
            $pager = $this->join_model->pager;
        }else{
            $join = $this->join_model->getJoin_print()->getResult(); 
            $branch_id = $this->branch_model->findAll();
        }
      
        $data = [
            'join' => $join, 
            'branch_id' => $branch_id
        ];
        echo view('admin/templates/header');
        echo view('admin/join/print_list_join', $data);
        echo view('admin/templates/js');
        
    }

    public function excel_print_list()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        $tanggal = $this->request->getVar('tanggal');
        $tanggal_dari = $this->request->getVar('tanggal_dari');
        $tanggal_sampai = $this->request->getVar('tanggal_sampai');
        $nama = $this->request->getVar('nama');
        $branch_id = $this->request->getVar('branch_id');
       
        
        if($tahun || $bulan || $tanggal || $nama || $branch_id || $tanggal_dari || $tanggal_sampai){
            $join = $this->join_model->searchPrint($nama,$tanggal,$bulan,$tahun, $branch_id, $tanggal_dari, $tanggal_sampai)->getResult();
            $jumlah_join =  $this->join_model->count($nama,$tanggal,$bulan,$tahun, $branch_id, $tanggal_dari, $tanggal_sampai);
            // dd($join);
            $branch_id = $this->branch_model->findAll();
            $pager = $this->join_model->pager;
        }else{
            $join = $this->join_model->getJoin_print()->getResult(); 
            $branch_id = $this->branch_model->findAll();
        }
      
        $data = [
            'join' => $join, 
            'branch_id' => $branch_id
        ];
      
        echo view('admin/templates/header');
        
        echo view('admin/join/excel_list_join', $data);
        echo view('admin/templates/js');
        
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
            'join' => $this->join_model->getJoin_id($id)
        ];

      
        echo view('admin/templates/header');
       
        echo view('admin/join/print_detail', $data);
        echo view('admin/templates/js');
     
       
    }

   

}
