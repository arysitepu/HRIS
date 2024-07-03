<?php

namespace App\Controllers;

use App\Models\Mst_facility_model;
use App\Models\MstType_model;
use App\Models\Branch_model;


class Mst_facility extends BaseController{

    protected $mst_facility_model;
    protected $mst_type_model;
    protected $branch_model;
    protected $session;


    public function __construct()
    {
        $this->session = session();
        $this->mst_facility_model = new Mst_facility_model();
        $this->mst_type_model = new MstType_model();
        $this->branch_model = new Branch_model();
    }

    public function index()
    {
    
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'anda bukan admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_facility = $this->mst_facility_model->getMst_fasilitas();
        $mst_type = $this->mst_type_model->findAll();
        $branch = $this->branch_model->findAll();
        $pager = $this->mst_facility_model->pager;

        $data = [
            'mst_facility' => $mst_facility,
            'pager' => $pager,
            'nomor' => nomor($this->request->getVar('page'), 5), 
            'mst_type' => $mst_type,
            'branch' => $branch,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_facility/facility_list', $data);
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
            session()->setFlashdata('otorisasi', 'anda bukan admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'facility_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nama Fasilitas harus diisi'
                ]
            ],

                'branch_id' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Pilih SBU terlebih dahulu'
                    ]
                ]

        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'upsss data tidak terinput ada yang salah . . .');
            return redirect()->to('mst_facility/index')->withInput('validation', $validation);
        }

        $this->mst_facility_model->save([
            'type_id' => $this->request->getVar('type_id'),
            'facility_name' => $this->request->getVar('facility_name'),
            'facility_code' => $this->request->getVar('facility_code'),
            'facility_condition' => $this->request->getVar('facility_condition'),
            'branch_id' => $this->request->getVar('branch_id'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('mst_facility/index');
    }

    public function edit($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'anda bukan admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_facility = $this->mst_facility_model->get_mst_fasilitas_id($id);
        $mst_type = $this->mst_type_model->findAll();
        $branch = $this->branch_model->findAll();
        $pager = $this->mst_facility_model->pager;

        $data = [
            'mst_facility' => $mst_facility,
            'pager' => $pager,
            'nomor' => nomor($this->request->getVar('page'), 5), 
            'mst_type' => $mst_type,
            'branch' => $branch,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_facility/edit_facility_mst', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'anda bukan admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'facility_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nama Fasilitas harus diisi'
                ]
            ],

                'branch_id' => [
                    'rules' => 'required', 
                    'errors' => [
                        'required' => 'Pilih SBU terlebih dahulu'
                    ]
                ]

        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'upsss data tidak terupdate ada yang salah . . .');
            return redirect()->to('mst_facility/edit/'.$this->request->getVar('facility_id'))->withInput('validation', $validation);
        }

        $this->mst_facility_model->save([
            'facility_id' => $id,
            'type_id' => $this->request->getVar('type_id'),
            'facility_name' => $this->request->getVar('facility_name'),
            'facility_code' => $this->request->getVar('facility_code'),
            'facility_condition' => $this->request->getVar('facility_condition'),
            'branch_id' => $this->request->getVar('branch_id'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('mst_facility/index');
    }

    public function delete_facility($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'anda bukan admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_facility_model->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        return redirect()->to('/mst_facility');

    }

}