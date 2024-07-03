<?php

namespace App\Controllers;
use App\Models\MstTraining_model;
use App\Models\Karyawan_model;

class Mst_training extends BaseController{

    protected $mst_training_model;
    protected $karyawan_model;
    protected $session;
    public function __construct()
    {
        $this->session = session();
        $this->mst_training_model = new MstTraining_model();
        $this->karyawan_model = new Karyawan_model();
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
            $mst_training = $this->mst_training_model->search_training($keyword);
            $pager = $this->mst_training_model->pager;
        }else{

            $mst_training = $this->mst_training_model->get_training();
            $pager = $this->mst_training_model->pager;
        }

        $data = [
            'mst_training' => $mst_training,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

     

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_training/list_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_training($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_training = $this->mst_training_model->getTraining_id($id);

        $data = [
            'mst_training' => $mst_training
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_training/detail_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add_training()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_training = $this->mst_training_model->get_training();
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'mst_training' => $mst_training,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_training/add_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_training()
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
                    'required'=> 'silahkan pilih karyawan terlebih dahulu'
                ]
            ],
        ])){

            $validation = \Config\Services::validation();
            return redirect()->to('mst_training/add_training')->withInput('validation', $validation);

        }
        $this->mst_training_model->save([
            'employee_id' => $this->request->getVar('employee_id'),
            'training_name' => $this->request->getVar('training_name'),
            'training_purpose' => $this->request->getVar('training_purpose'),
            'training_desc' => $this->request->getVar('training_desc'),
            'training_organizer' => $this->request->getVar('training_organizer'),
            'training_start' => $this->request->getVar('training_start'),
            'training_end' => $this->request->getVar('training_end'),
            'biaya_oleh' => $this->request->getVar('biaya_oleh'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan');
        return redirect()->to('mst_training/index');
    }

    public function edit_training($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $mst_training = $this->mst_training_model->getTraining_id($id);
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'mst_training' => $mst_training,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation()
        ];   

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_training/edit_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function update_training($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'training_name' =>[
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Nama pelatihan harus diisi'
                ]
            ],
        ])){

            $validation = \Config\Services::validation();
            return redirect()->to('mst_training/edit_training/'.$this->request->getVar('id'))->withInput()->with('validation', $validation);

        }

        $this->mst_training_model->save([
            'id' => $id,
            'employee_id' => $this->request->getVar('employee_id'),
            'training_name' => $this->request->getVar('training_name'),
            'training_purpose' => $this->request->getVar('training_purpose'),
            'training_desc' => $this->request->getVar('training_desc'),
            'training_organizer' => $this->request->getVar('training_organizer'),
            'training_start' => $this->request->getVar('training_start'),
            'training_end' => $this->request->getVar('training_end'),
            'biaya_oleh' => $this->request->getVar('biaya_oleh'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('mst_training/index');
    }

    public function delete_training($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_training_model->delete($id);
        session()->setFlashdata('pesan', 'Databerhasil dihapus');
        return redirect()->to('/mst_training');
    }

}