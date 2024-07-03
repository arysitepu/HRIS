<?php

namespace App\Controllers;

use App\Models\Peringatan_model;
use App\Models\Karyawan_model;
use App\Models\Position_model;
use App\Models\Formula_model;


class Peringatan extends BaseController
{

    protected $peringatan_model;
    protected $karyawan_model;
    protected $position_model;
    protected $formula_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->karyawan_model = new Karyawan_model();
        $this->peringatan_model = new Peringatan_model();
        $this->position_model = new Position_model();
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
        $nama = $this->request->getVar('nama');
        $tahun = $this->request->getVar('tahun');
        $bulan = $this->request->getVar('bulan');
        
        $tanggal = $this->request->getVar('tanggal');
        if($nama || $tanggal || $bulan || $tahun){
            $peringatan = $this->peringatan_model->search($nama, $tanggal, $bulan, $tahun);
            $pager = $this->peringatan_model->pager;
        }else{
            $peringatan = $this->peringatan_model->getPeringatan();
            $pager = $this->peringatan_model->pager;
        }
        $data = [
            
            'peringatan' => $peringatan, 
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)

        ];
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/peringatan/peringatan_list', $data);
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
        $peringatan =  $this->peringatan_model->getPeringatan_id($id);

        $data = [
            'peringatan' => $peringatan
        ];

      
      
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/peringatan/detail_peringatan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
      
    }  

    public function add_peringatan()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $nomorDokumen = $this->peringatan_model->nomorDokumen();
        $peringatan = $this->peringatan_model->getPeringatan();
        $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->findAll();
        $position = $this->position_model->findAll();
        $formula = $this->formula_model->getFormula();

        $data = [
            'peringatan' => $peringatan,
            'karyawan' => $karyawan, 
            'position' => $position,
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/peringatan/add_peringatan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_peringatan()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $this->peringatan_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'position_id' => $this->request->getVar('position_id'),
            'sp_type' => $this->request->getVar('sp_type'),
            'sp_desc' => $this->request->getVar('sp_desc'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan');
        return redirect()->to('peringatan/index');
    }

    public function edit_peringatan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $peringatan = $this->peringatan_model->getPeringatan_id($id);
        $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->findAll();
        $position = $this->position_model->findAll();


        $data = [
            'peringatan' => $peringatan, 
            'karyawan' => $karyawan,
            'position' => $position
        ];

     

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/peringatan/edit_peringatan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_peringatan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $this->peringatan_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'position_id' => $this->request->getVar('position_id'),
            'sp_type' => $this->request->getVar('sp_type'),
            'sp_desc' => $this->request->getVar('sp_desc'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('peringatan/index');
    }

    public function delete_peringatan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $this->peringatan_model->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('peringatan');

    }

    public function detail_print($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $data = [
            'peringatan' => $this->peringatan_model->getPeringatan_id($id)
        ];

        echo view('admin/templates/header');
        
        echo view('admin/peringatan/print_peringatan', $data);
        echo view('admin/templates/js');
       
      
    }  

   public function print_list()
   {
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }
    $tahun = $this->request->getVar('tahun');
    $bulan = $this->request->getVar('bulan');
    
    $tanggal = $this->request->getVar('tanggal');
    if($tanggal || $bulan || $tahun){
        $peringatan = $this->peringatan_model->searchPrint($tanggal, $bulan, $tahun)->getResult();
    }else{
        $peringatan = $this->peringatan_model->getPeringatanPrint()->getResult();
    }
        $data = [
            
            'peringatan' => $peringatan

        ];
        echo view('admin/templates/header');
        echo view('admin/peringatan/print_peringatan_list', $data);
        echo view('admin/templates/js');
   }


}