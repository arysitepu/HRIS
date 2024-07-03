<?php

namespace App\Controllers;

use App\Models\EducationEmployee_model;
use App\Models\Karyawan_model;



class Employee_education extends BaseController{

    protected $karyawan_model;
    protected $education_model;
    protected $session;

    public function __construct()
    {
        $this->education_model = new EducationEmployee_model();
        $this->karyawan_model = new Karyawan_model();
        $this->session = session();
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
            $education_employee = $this->education_model->search($keyword);
            $pager = $this->education_model->pager;

        }else{

            $education_employee = $this->education_model->getEducation_employee();
            $pager = $this->education_model->pager;
        }



        $data = [
            'education_employee' => $education_employee,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/education/education_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_education($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $education_employee = $this->education_model->getEducation_employee_id($id);

        $data = [
            'education_employee' => $education_employee
        ];

        
     
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/education/education_detail', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add_education()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $education_employee = $this->education_model->findAll();
        $karyawan = $this->karyawan_model->findAll();
        $data = [
            'education_employee' => $education_employee,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation()
        ];


        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/education/add_education', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_education()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'employee_id' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih karyawan terlebih dahulu'
                ]
            ],

            'education_type' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih jenis pendidikan terlebih dahulu'
                ]
            ],

            'education_name' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama sekolah / pendidikan tidak boleh kosong'
                ]
            ],
            'education_address' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Alamat tidak boleh kosong'
                ]
            ],
            'education_major' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Jurusan tidak boleh kosong'
                ]
            ],
            'ipk' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nilai tidak boleh kosong'
                ]
            ],
            'tahun_masuk' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tahun masuk tidak boleh kosong'
                ]
            ],
            'tahun_lulus' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tahun lulus tidak boleh kosong'
                ]
            ],
            'biaya_oleh' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih biaya terlebih dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal diinput silahkan periksa inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }

        $this->education_model->save([
            'employee_id' => $this->request->getVar('employee_id'),
            'education_type' => $this->request->getVar('education_type'),
            'education_name' => $this->request->getVar('education_name'),
            'education_address' => $this->request->getVar('education_address'),
            'education_major' => $this->request->getVar('education_major'),
            'ipk' => $this->request->getVar('ipk'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'biaya_oleh' => $this->request->getVar('biaya_oleh'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('employee_education/index');
    }

    public function edit_education($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $education_employee =  $this->education_model->getEducation_employee_id($id);
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'education_employee' => $education_employee,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation()
        ];

        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/education/edit_education', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function education_update($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'employee_id' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih karyawan terlebih dahulu'
                ]
            ],

            'education_type' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih jenis pendidikan terlebih dahulu'
                ]
            ],

            'education_name' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama sekolah / pendidikan tidak boleh kosong'
                ]
            ],
            'education_address' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Alamat tidak boleh kosong'
                ]
            ],
            'education_major' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Jurusan tidak boleh kosong'
                ]
            ],
            'ipk' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nilai tidak boleh kosong'
                ]
            ],
            'tahun_masuk' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tahun masuk tidak boleh kosong'
                ]
            ],
            'tahun_lulus' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tahun lulus tidak boleh kosong'
                ]
            ],
            'biaya_oleh' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih biaya terlebih dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal diinput silahkan periksa inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }

        $this->education_model->save([
            'id' => $id,
            'employee_id' => $this->request->getVar('employee_id'),
            'education_type' => $this->request->getVar('education_type'),
            'education_name' => $this->request->getVar('education_name'),
            'education_address' => $this->request->getVar('education_address'),
            'education_major' => $this->request->getVar('education_major'),
            'ipk' => $this->request->getVar('ipk'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'biaya_oleh' => $this->request->getVar('biaya_oleh'),
        ]);
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->back();
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
        $this->education_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->back();
    }
} 