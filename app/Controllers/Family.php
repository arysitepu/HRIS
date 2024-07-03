<?php

namespace App\Controllers;

use App\Models\Family_model;
use App\Models\Karyawan_model;

class Family extends BaseController{

    protected $family_model;
    protected $karyawan_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->family_model = new Family_model();
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
            $family = $this->family_model->search($keyword);
            $pager = $this->family_model->pager;
        }else{

            $family = $this->family_model->getFamily_employee();
            $pager = $this->family_model->pager;
        }


        $data = [
            'family' => $family,
            'pager' =>$pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/family/family_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_family($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $family = $this->family_model->getFamily_id($id);
        $karyawan = $this->karyawan_model->getKaryawan_id($id);

        $data = [
            'family' => $family,
            'karyawan' => $karyawan
        ];
        
        

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/family/detail_family', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function add_family()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $family = $this->family_model->getFamily_employee();
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'family' => $family,
            'karyawan'=> $karyawan,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/family/add_family', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_family()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'employee_id'=> [
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Silahkan pilih karyawan terlebih dahulu'
                ]
            ],
            'family_name'=> [
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Nama Keluarga tidak boleh kosong'
                ]
            ],
            'family_type'=> [
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Silahkan pilih hubungan keluarga terlebih dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('family/add_family')->withInput('validation', $validation);
        }

        $this->family_model->save([
            'employee_id' =>$this->request->getVar('employee_id'),
            'family_type' =>$this->request->getVar('family_type'),
            'family_name' =>$this->request->getVar('family_name'),
            'jenis_kelamin' =>$this->request->getVar('jenis_kelamin'),
            'lahir_tempat' =>$this->request->getVar('lahir_tempat'),
            'lahir_tanggal' =>$this->request->getVar('lahir_tanggal'),
            'pekerjaan' =>$this->request->getVar('pekerjaan'),
            'pendidikan' =>$this->request->getVar('pendidikan'),
            'jurusan' =>$this->request->getVar('jurusan'),
            'sekolah_nama' =>$this->request->getVar('sekolah_nama'),
            'sekolah_alamat' =>$this->request->getVar('sekolah_alamat'),
            'no_tlp' =>$this->request->getVar('no_tlp'),
            'no_tlp2' =>$this->request->getVar('no_tlp2'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil ditambahakan');
        return redirect()->to('family/index');

    }

    public function edit_family($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $family = $this->family_model->getFamily_id($id);
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'family' => $family,
            'karyawan'=> $karyawan,
            'validation' => \Config\Services::validation()
           
        ];


        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/family/edit_family', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function update_family($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'employee_id'=> [
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Silahkan pilih karyawan terlebih dahulu'
                ]
            ],
            'family_name'=> [
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Nama Keluarga tidak boleh kosong'
                ]
            ],
            'family_type'=> [
                'rules' => 'required',
                'errors'=>[
                    'required'=> 'Silahkan pilih hubungan keluarga terlebih dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('family/edit_family/'.$this->request->getVar('id'))->withInput()->with('validation', $validation);
        }
        
        $this->family_model->save([
            'id'=> $id,
            'employee_id' =>$this->request->getVar('employee_id'),
            'family_type' =>$this->request->getVar('family_type'),
            'family_name' =>$this->request->getVar('family_name'),
            'jenis_kelamin' =>$this->request->getVar('jenis_kelamin'),
            'lahir_tempat' =>$this->request->getVar('lahir_tempat'),
            'lahir_tanggal' =>$this->request->getVar('lahir_tanggal'),
            'pekerjaan' =>$this->request->getVar('pekerjaan'),
            'pendidikan' =>$this->request->getVar('pendidikan'),
            'jurusan' =>$this->request->getVar('jurusan'),
            'sekolah_nama' =>$this->request->getVar('sekolah_nama'),
            'sekolah_alamat' =>$this->request->getVar('sekolah_alamat'),
            'no_tlp' =>$this->request->getVar('no_tlp'),
            'no_tlp2' =>$this->request->getVar('no_tlp2'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->to('family/index');

    }

    public function delete($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->family_model->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('family');

    }

    
    public function delete_family($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->family_model->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('karyawan/index');

    }

    public function add_family_id($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $family = $this->family_model->getFamily_employee();

        $data = [
            'karyawan' => $karyawan,
            'family' => $family
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/family/add_family_id', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_family_id()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
             
        $this->family_model->save([
            'employee_id' =>$this->request->getVar('employee_id'),
            'family_type' =>$this->request->getVar('family_type'),
            'family_name' =>$this->request->getVar('family_name'),
            'jenis_kelamin' =>$this->request->getVar('jenis_kelamin'),
            'lahir_tempat' =>$this->request->getVar('lahir_tempat'),
            'lahir_tanggal' =>$this->request->getVar('lahir_tanggal'),
            'pekerjaan' =>$this->request->getVar('pekerjaan'),
            'pendidikan' =>$this->request->getVar('pendidikan'),
            'jurusan' =>$this->request->getVar('jurusan'),
            'sekolah_nama' =>$this->request->getVar('sekolah_nama'),
            'sekolah_alamat' =>$this->request->getVar('sekolah_alamat'),
            'no_tlp' =>$this->request->getVar('no_tlp'),
            'no_tlp2' =>$this->request->getVar('no_tlp2'),
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil tambahkan');
        return redirect()->to('karyawan/index');
    }


}