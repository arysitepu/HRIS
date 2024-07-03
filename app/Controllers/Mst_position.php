<?php

namespace App\Controllers;

use App\Models\MstPosition_model;
use App\Models\Karyawan_model;
use App\Models\Branch_model;
use App\Models\Position_model;

class Mst_position extends BaseController{

    
    protected $karyawan_model;
    protected $branch_model;
    protected $position_model;
    protected $mst_position_model;
    protected $session;

    public function __construct()
    {

        $this->session = session();

        $this->mst_position_model = new MstPosition_model();
        $this->branch_model = new Branch_model();
        $this->karyawan_model = new Karyawan_model();
        $this->position_model = new Position_model();
    
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

        $keyword = $this->request->getVar('keyword');

        if($keyword){
            $mst_position = $this->mst_position_model->search_position($keyword);
            $pager = $this->mst_position_model->pager;
        }else{
            
            $mst_position = $this->mst_position_model->get_position();
            $pager = $this->mst_position_model->pager;
        }

        $karyawan = $this->karyawan_model->findAll();
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();

        $data = [
            'mst_position' => $mst_position,
            'karyawan' => $karyawan,
            'position' => $position,
            'branch' => $branch,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];


        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_position/position_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_position()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_position_model->save([

        'employee_id' => $this->request->getVar('employee_id'),
        'position_id' => $this->request->getVar('position_id'),
        'branch_id' => $this->request->getVar('branch_id'),
        'position_date' => $this->request->getVar('position_date'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan');
        return redirect()->to('mst_position/index');
    }

    public function edit_position($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $mst_position = $this->mst_position_model->getPosition_id($id);
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'mst_position' => $mst_position,
            'position' => $position,
            'branch' => $branch,
            'karyawan' => $karyawan
        ];

        

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_position/edit_position', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function update_position($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_position_model->save([

            'id' => $id,
            'employee_name' => $this->request->getVar('employee_id'),
            'employee_id' => $this->request->getVar('employee_id'),
            'position_id' => $this->request->getVar('position_id'),
            'branch_id' => $this->request->getVar('branch_id'),
            'position_date' => $this->request->getVar('position_date'),
            ]);
    
            session()->setFlashdata('pesan', 'Data Berhasil disimpan');
            return redirect()->to('mst_position/index');

    }

    public function delete_position($id)
    {
        
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_position_model->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/mst_position');
    }


}