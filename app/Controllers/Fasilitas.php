<?php 

namespace App\Controllers;

use App\Models\Branch_model;
use App\Models\Trn_fasilitas_model;
use App\Models\Karyawan_model;
use App\Models\Trn_fasilitas_det_model;
use App\Models\Mst_facility_model;
use App\Models\Formula_model;


class Fasilitas extends BaseController{

    protected $fasilitas_model;
    protected $karyawan_model;
    protected $fasilitas_det_model;
    protected $formula_model;
    protected $session;
    protected $mst_fasilitas_model;
    protected $branch_model;

    public function __construct()
    {
        $this->session = session();
        $this->fasilitas_model = new Trn_fasilitas_model();
        $this->karyawan_model = new Karyawan_model();
        $this->fasilitas_det_model = new Trn_fasilitas_det_model();
        $this->mst_fasilitas_model = new Mst_facility_model();
        $this->formula_model = new Formula_model();
        $this->branch_model = new Branch_model();
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

        $fasilitas = $this->fasilitas_model->get_fasilitas();
        $branchs = $this->branch_model->findAll();
        $pager = $this->fasilitas_model->pager;
        $data = [
            'fasilitas' => $fasilitas,
            'pager' => $pager,
            'branchs' => $branchs,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        // dd($data);
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/fasilitas_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function search_facility()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        
        $keyword = $this->request->getVar('keyword');
        $branch_id = $this->request->getVar('branch_id');
        $status = $this->request->getVar('status');
        $bulan_pinjam = $this->request->getVar('bulan_pinjam');
        $bulan_kembali = $this->request->getVar('bulan_kembali');
        
        if($keyword || $branch_id || $status || $bulan_pinjam || $bulan_kembali){
            $fasilitas = $this->fasilitas_model->search($keyword, $branch_id, $status, $bulan_pinjam, $bulan_kembali);
            // dd($fasilitas);
        }else{
            // dd($fasilitas);
            $fasilitas = $this->fasilitas_model->get_fasilitas();
        } 
            $branchs = $this->branch_model->findAll();
            $pager = $this->fasilitas_model->pager;
        
        $data = [
            'fasilitas' => $fasilitas,
            'pager' => $pager,
            'branchs' => $branchs,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/fasilitas_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_fasilitas($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $fasilitas = $this->fasilitas_model->getFasilitas_id($id);
        $fasilitas_det = $this->fasilitas_det_model->getFasilitas($id)->getResultArray();
        $data = [
            'fasilitas' => $fasilitas,
            'fasilitas_det' => $fasilitas_det
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/detail_fasilitas', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function print_detail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $fasilitas = $this->fasilitas_model->getFasilitas_id($id);
        $fasilitas_det = $this->fasilitas_det_model->getFasilitas($id)->getResultArray();
        $data = [
            'fasilitas' => $fasilitas,
            'fasilitas_det' => $fasilitas_det
        ];

        echo view('admin/templates/header');
        echo view('admin/trn_fasilitas/print_detail_fasilitas', $data);
        echo view('admin/templates/js');    
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
        
        $nomorDokumen = $this->fasilitas_model->nomorDokumen();
        $fasilitas = $this->fasilitas_model->get_fasilitas();
        $karyawan = $this->karyawan_model->findAll();
        $mst_fasilitas = $this->mst_fasilitas_model->findAll();
        $formula = $this->formula_model->getFormula();
        
        $data = [
            'fasilitas' => $fasilitas,
            'karyawan' => $karyawan,
            'mst_facility' => $mst_fasilitas, 
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen,
            'validation' => \Config\Services::validation()
        ];
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/add_fasilitas', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_fasilitas()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        if(!$this->validate([
            'trn_no' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nomor dokumen harus diisi'
                ]
            ], 

            'trn_date' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal dokumen harus diisi'
                ]
            ],

            'employee_id' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'employee_id_buat' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],
            'kegunaan' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Kegunaan tidak boleh kosong'
                ]
            ],
            'status' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih status'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal diinput silahkan perbaiki inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }
        $this->fasilitas_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'kegunaan' => $this->request->getVar('kegunaan'), 
            'status' => $this->request->getVar('status'), 
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('fasilitas/index');
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
        $fasilitas = $this->fasilitas_model->getFasilitas_id($id);
        $karyawan = $this->karyawan_model->orderby('employee_name', 'ASC')->where('employee_status', 2)->findAll();
        $mst_fasilitas = $this->mst_fasilitas_model->findAll();
        
        $data = [
            'fasilitas' => $fasilitas,
            'karyawan' => $karyawan,
            'mst_facility' => $mst_fasilitas,
            'validation' => \Config\Services::validation()
        ];

      
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/edit_fasilitas', $data);
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
            'trn_no' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nomor dokumen harus diisi'
                ]
            ], 

            'trn_date' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal dokumen harus diisi'
                ]
            ],

            'employee_id' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'employee_id_buat' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],
            'kegunaan' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Kegunaan tidak boleh kosong'
                ]
            ],
            'status' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih status'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal diinput silahkan perbaiki inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }

        $this->fasilitas_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
            'kegunaan' => $this->request->getVar('kegunaan'), 
            'status' => $this->request->getVar('status'), 
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('fasilitas/index');
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
        return redirect()->to('/fasilitas');
    }

}