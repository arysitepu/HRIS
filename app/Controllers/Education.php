<?php 

namespace App\Controllers;
use App\Models\Trn_education_model;
use App\Models\Karyawan_model;

class Education extends BaseController{

    protected $education_model;
    protected $karyawan_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->education_model = new Trn_education_model();
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
            $education = $this->education_model->search_education($keyword);
            $pager = $this->education_model->pager;
        }else{

            $education = $this->education_model->get_education();
            $pager = $this->education_model->pager;
        }


        $data = [
            'education' => $education,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

     
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_education/list_education', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_education($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $education = $this->education_model->getEducation_id($id);

        $data = [
            'education' => $education
        ];

     
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_education/detail_education', $data);
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
        $nomorDokumen = $this->education_model->nomorDokumen();
        $education = $this->education_model->get_education();
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'education' => $education,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation(),
            'nomordokumen' => $nomorDokumen
        ];

      
         
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_education/add_education', $data);
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
            'trn_no' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nomor Dokumen harus diisi'
                ]
            ],

            'trn_date' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tanggal dokumen harus diisi'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('education/add_education')->withInput('validation', $validation);
        }

      $this->education_model->save([
          'trn_no' => $this->request->getVar('trn_no'),
          'trn_date' => $this->request->getVar('trn_date'),
          'employee_id_buat' => $this->request->getVar('employee_id_buat'),
          'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
          'employee_id' => $this->request->getVar('employee_id'),
          'education_type' => $this->request->getVar('education_type'),
          'education_name' => $this->request->getVar('education_name'),
          'education_address' => $this->request->getVar('education_address'),
          'education_major' => $this->request->getVar('education_major'),
          'ipk' => $this->request->getVar('ipk'),
          'tahun_masuk' => $this->request->getVar('tahun_masuk'),
          'tahun_lulus' => $this->request->getVar('tahun_lulus'),
          'biaya' => $this->request->getVar('biaya'),
      ]);

      session()->setFlashdata('pesan', 'Data berhasil ditambahakan');
      return redirect()->to('education/index');
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

        $education = $this->education_model->getEducation_id($id);
        $karyawan = $this->karyawan_model->findAll();
        
        $data = [
            'education' => $education,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_education/edit_education', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_education($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        if(!$this->validate([
            'trn_no' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nomor Dokumen harus diisi'
                ]
            ],

            'trn_date' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tanggal dokumen harus diisi'
                ]
            ],

            'education_name' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama sekolah harus diisi'
                ]
            ],
            
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal diupdate silahkan periksa inputan anda');
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->education_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'education_type' => $this->request->getVar('education_type'),
            'education_name' => $this->request->getVar('education_name'),
            'education_address' => $this->request->getVar('education_address'),
            'education_major' => $this->request->getVar('education_major'),
            'ipk' => $this->request->getVar('ipk'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'biaya' => $this->request->getVar('biaya'),
        ]);
  
        session()->setFlashdata('pesan', 'Data berhasil diedit');
        return redirect()->back();
    }

    public function delete_education($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->education_model->delete($id);

        session()->setFlashdata('pesan', 'data berhasil di hapus');
        return redirect()->to('/education');
    }

    public function add_education_id($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $education = $this->education_model->get_education();
        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $karyawan1 = $this->karyawan_model->findAll();
        $data = [
            'education' => $education,
            'karyawan' => $karyawan,
            'karyawan1' => $karyawan1
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_education/add_education_id', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function save_education_id()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->education_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'education_type' => $this->request->getVar('education_type'),
            'education_name' => $this->request->getVar('education_name'),
            'education_address' => $this->request->getVar('education_address'),
            'education_major' => $this->request->getVar('education_major'),
            'ipk' => $this->request->getVar('ipk'),
            'tahun_masuk' => $this->request->getVar('tahun_masuk'),
            'tahun_lulus' => $this->request->getVar('tahun_lulus'),
            'biaya' => $this->request->getVar('biaya'),
        ]);
      session()->setFlashdata('pesan', 'Data berhasil ditambahakan');
      return redirect()->to('karyawan/index');
    }


}