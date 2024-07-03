<?php

namespace App\Controllers;
use App\Models\Training_model;
use App\Models\Karyawan_model;
use App\Models\Training_det_model;
use App\Models\Formula_model;
use App\Models\TrainingMaster_model;

class Training extends BaseController{

    protected $training_model;
    protected $karyawan_model;
    protected $training_det_model;
    protected $formula_model;
    protected $session;
    protected $mst_training_model;

    public function __construct()
    {
        $this->session = session();
        $this->training_model = new Training_model();
        $this->karyawan_model = new Karyawan_model();
        $this->training_det_model = new Training_det_model();
        $this->formula_model = new Formula_model();
        $this->mst_training_model = new TrainingMaster_model();
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

        $training = $this->training_model->get_training();
        $pager = $this->training_model->pager;

        $data = [
            'training' => $training,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];
        
        // dd($data);
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        
        echo view('admin/training/training_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        
        echo view('admin/templates/modal');
    }

    public function detail_training($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $training = $this->training_model->getTraining_detail($id);
        $training_det = $this->training_det_model->getTraining_det($id)->getResultArray();
        $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->where('employee_status', 2)->orWhere('employee_status', 1)->findAll();

        $data = [
            'training' => $training,
            'training_det' => $training_det, 
            'karyawan' => $karyawan,
        
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/training/detail_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function print_detail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $training = $this->training_model->getTraining_detail($id);
        $training_det = $this->training_det_model->getTraining_det($id)->getResultArray();
        $data = [
            'trn_id' => $id,
            'training' => $training,
            'training_det' => $training_det, 
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/training/print_training', $data);
        echo view('admin/templates/js');
    }

    public function add_training()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $nomorDokumen = $this->training_model->nomorDokumen();
        $training = $this->training_model->get_training();
        $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->where('employee_status', 2)->orWhere('employee_status', 1)->findAll();
        $formula = $this->formula_model->getFormula();
        $mst_training_model = $this->mst_training_model->findAll();
        $data = [
            'training' => $training,
            'karyawan' => $karyawan,
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen,
            'validation' => \Config\Services::validation(),
            'mst_trainings' => $mst_training_model
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        
        echo view('admin/training/add_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        
        echo view('admin/templates/modal');
    }

    public function save_training()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if(!$this->validate([
            'trn_no' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'nomor dokumen harus diisi'
                ]
            ],

            'trn_date' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal training harus diisi!.'
                ]
            ],

            'employee_id_buat' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan pilih karyawan'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan pilih karyawan'
                ]
            ],

            'id_training' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'pilih tipe training terlebih dahulu.'
                ]
            ],

            'training_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan isi nama training.'
                ]
            ],

            'training_purpose' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan isi training purpose'
                ]
            ],

            'training_desc' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Deskripsi training harus diisi!.'
                ]
            ],

            'training_organizer' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'organizer training harus diisi!.'
                ]
            ],

            'training_start' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'tanggal start training harus diisi!.'
                ]
            ],

            'trn_date' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal training harus diisi!.'
                ]
            ],

            'training_end' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal selesai training harus diisi!.'
                ]
            ],



        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal disimpan silahkan check inputan');
            return redirect()->back()->withInput()->with('validation', $validation);
        }

        $this->training_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'id_training' => $this->request->getVar('id_training'),
            'training_name' => $this->request->getVar('training_name'),
            'training_purpose' => $this->request->getVar('training_purpose'),
            'training_desc' => $this->request->getVar('training_desc'),
            'training_organizer' => $this->request->getVar('training_organizer'),
            'training_start' => $this->request->getVar('training_start'),
            'training_end' => $this->request->getVar('training_end')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->back();
    }

    public function edit_training($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $training = $this->training_model->getTraining_detail($id);
        $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->where('employee_status', 2)->orWhere('employee_status', 1)->findAll();
        $mst_training_model = $this->mst_training_model->findAll();
        $data = [
            'training' => $training,
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation(),
            'mst_trainings' => $mst_training_model
        ];
      

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/training/edit_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_training($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if(!$this->validate([
            'trn_no' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'nomor dokumen harus diisi'
                ]
            ],

            'trn_date' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal training harus diisi!.'
                ]
            ],

            'employee_id_buat' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan pilih karyawan'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan pilih karyawan'
                ]
            ],

            'id_training' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'pilih tipe training terlebih dahulu.'
                ]
            ],

            'training_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan isi nama training.'
                ]
            ],

            'training_purpose' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'silahkan isi training purpose'
                ]
            ],

            'training_desc' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Deskripsi training harus diisi!.'
                ]
            ],

            'training_organizer' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'organizer training harus diisi!.'
                ]
            ],

            'training_start' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'tanggal start training harus diisi!.'
                ]
            ],

            'trn_date' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal training harus diisi!.'
                ]
            ],

            'training_end' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal selesai training harus diisi!.'
                ]
            ],



        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal disimpan silahkan check inputan');
            return redirect()->back()->withInput()->with('validation', $validation);
        }

       $this->training_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'id_training' => $this->request->getVar('id_training'),
            'training_name' => $this->request->getVar('training_name'),
            'training_purpose' => $this->request->getVar('training_purpose'),
            'training_desc' => $this->request->getVar('training_desc'),
            'training_organizer' => $this->request->getVar('training_organizer'),
            'training_start' => $this->request->getVar('training_start'),
            'training_end' => $this->request->getVar('training_end')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function delete_training($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $this->training_model->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('training');
    }

    

}

