<?php

namespace App\Controllers;
use App\Models\Fasilitas_model;
use App\Models\Karyawan_model;
use App\Models\MstType_model;



class Fasilitas_karyawan extends BaseController{

    protected $fasilitas_model;
    protected $karyawan_model;
    protected $type_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->fasilitas_model = new Fasilitas_model();
        $this->karyawan_model = new Karyawan_model();
        $this->type_model = new MstType_model();
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
            $fasilitas_karyawan = $this->fasilitas_model->search($keyword);
            $pager = $this->fasilitas_model->pager;
        }else{
            $fasilitas_karyawan = $this->fasilitas_model->getFasilitas_karyawan();
            $pager = $this->fasilitas_model->pager;
        }


        $data = [
            'fasilitas' => $fasilitas_karyawan,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];
        

       

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/fasilitas/fasilitas_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_fasilitas($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $fasilitas_karyawan = $this->fasilitas_model->getFasilitas_id($id);

        $data = [
            'fasilitas' => $fasilitas_karyawan
        ];
        
        

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/fasilitas/detail_fasilitas', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add_fasilitas()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $fasilitas_karyawan = $this->fasilitas_model->getFasilitas_karyawan();
        $karyawan = $this->karyawan_model->findAll();
        $type = $this->type_model->findAll();

        $data = [
            'fasilitas' => $fasilitas_karyawan,
            'karyawan' => $karyawan,
            'type' => $type,
            'validation' => \Config\Services::validation()
        ];
        

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/fasilitas/add_fasilitas', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        if(!$this->validate([
            'employee_id' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Silahkan Pilih Karyawan terlebih dahulu.'
                 ]
            ],

            'type_id' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Silahkan Pilih Tipe Fasilitas terlebih dahulu.'
                 ]
            ],


            'facility_name' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Nama Fasilitas harus diisi.'
                 ]
            ],

            
            'facility_desc' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Desktipsi Fasilitas harus diisi.'
                 ]
            ],

            'facility_asset_no' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Nomor fasilitas harus diisi.'
                 ]
            ],

        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/fasilitas_karyawan/add_fasilitas')->withInput('validation', $validation);
        }

        $this->fasilitas_model->save([
            'employee_id' => $this->request->getVar('employee_id'),
            'type_id' => $this->request->getVar('type_id'),
            'facility_name' => $this->request->getVar('facility_name'),
            'facility_desc' => $this->request->getVar('facility_desc'),
            'facility_asset_no' => $this->request->getVar('facility_asset_no'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('/fasilitas_karyawan/index');
    }

    public function edit_fasilitas($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $fasilitas_karyawan = $this->fasilitas_model->getFasilitas_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $type = $this->type_model->findAll();

        $data = [
            'fasilitas' => $fasilitas_karyawan,
            'karyawan' => $karyawan,
            'type' => $type,
            'validation' => \Config\Services::validation()
        ];

        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/fasilitas/edit_fasilitas', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_fasilitas($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'employee_id' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Silahkan Pilih Karyawan terlebih dahulu.'
                 ]
            ],

            'type_id' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Silahkan Pilih Tipe Fasilitas terlebih dahulu.'
                 ]
            ],


            'facility_name' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Nama Fasilitas harus diisi.'
                 ]
            ],

            
            'facility_desc' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Desktipsi Fasilitas harus diisi.'
                 ]
            ],

            'facility_asset_no' =>[
                'rules' => 'required',
                'errors'=>[
                    'required' =>'Nomor fasilitas harus diisi.'
                 ]
            ],

        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('/fasilitas_karyawan/edit_fasilitas/'.$this->request->getVar('id'))->withInput('validation', $validation);
        }


        $this->fasilitas_model->save([
            'id' => $id,
            'employee_id' => $this->request->getVar('employee_id'),
            'type_id' => $this->request->getVar('type_id'),
            'facility_name' => $this->request->getVar('facility_name'),
            'facility_desc' => $this->request->getVar('facility_desc'),
            'facility_asset_no' => $this->request->getVar('facility_asset_no'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('/fasilitas_karyawan/index');
    }

    public function delete_fasilitas($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->fasilitas_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/fasilitas_karyawan');
    }


}
