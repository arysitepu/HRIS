<?php 

namespace App\Controllers;

use App\Models\Mst_jaminan_model;
use App\Models\Karyawan_model;
use App\Models\MstType_model;

class Mst_jaminan extends BaseController{

    protected $karyawan_model ;
    protected $session;
    protected $mst_jaminan_model;
    protected $type_model;

    public function __construct()
    {
        $this->session = session();
        $this->mst_jaminan_model = new Mst_jaminan_model();
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
            $mst_jaminan = $this->mst_jaminan_model->search($keyword);
            $pager = $this->mst_jaminan_model->pager;
        }else{

            $mst_jaminan = $this->mst_jaminan_model->getJaminan();
            $pager = $this->mst_jaminan_model->pager;
        }


        $data = [
            'mst_jaminan' => $mst_jaminan,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_jaminan/list_jaminan_employee', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_jaminan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_jaminan = $this->mst_jaminan_model->getJaminan_id($id);

        $data = [
            'mst_jaminan' => $mst_jaminan
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_jaminan/detail_jaminan_employee', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function add_jaminan()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_jaminan = $this->mst_jaminan_model->findAll();
        $karyawan = $this->karyawan_model->findAll();
        $type = $this->type_model->findAll();

        $data = [
            'mst_jaminan' => $mst_jaminan,
            'karyawan' => $karyawan,
            'type' => $type,
            'validation'=> \Config\Services::validation()
        ];
    

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_jaminan/add_jaminan_employee', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function save_jaminan()
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

            'type_id' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih tipe jaminan terlebih dahulu'
                ]
            ],

            'jaminan_name' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama jaminan harus diisi'
                ]
            ],

            'jaminan_desc' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Deskripsi jaminan harus diisi'
                ]
            ],

            'doc_no' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nomor dokumen harus diisi'
                ]
            ],

            'tanggal_simpan' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tanggal simpan harus diisi'
                ]
            ],
        ])){

            $validation = \Config\Services::validation();
            return redirect()->to('mst_jaminan/add_jaminan')->withInput()->with('validation', $validation);

        }


        $this->mst_jaminan_model->save([
            'employee_id' => $this->request->getVar('employee_id'),
            'type_id' => $this->request->getVar('type_id'),
            'jaminan_name' => $this->request->getVar('jaminan_name'),
            'jaminan_desc' => $this->request->getVar('jaminan_desc'),
            'doc_no' => $this->request->getVar('doc_no'),
            'tanggal_simpan' => $this->request->getVar('tanggal_simpan'),
            'tanggal_kembali' => $this->request->getVar('tanggal_kembali'),

        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->to('mst_jaminan/index');
    }

    public function edit_jaminan($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_jaminan = $this->mst_jaminan_model->getJaminan_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $type = $this->type_model->findAll();

        $data = [
            'mst_jaminan' => $mst_jaminan,
            'karyawan' => $karyawan,
            'type' => $type,
            'validation'=> \Config\Services::validation()
        ];
    

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_jaminan/edit_jaminan_employee', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_jaminan($id)
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

            'type_id' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih tipe jaminan terlebih dahulu'
                ]
            ],

            'jaminan_name' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama jaminan harus diisi'
                ]
            ],

            'jaminan_desc' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Deskripsi jaminan harus diisi'
                ]
            ],

            'doc_no' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nomor dokumen harus diisi'
                ]
            ],

            'tanggal_simpan' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Tanggal simpan harus diisi'
                ]
            ],
        ])){

            $validation = \Config\Services::validation();
            return redirect()->to('mst_jaminan/edit_jaminan/'.$this->request->getVar('id'))->withInput()->with('validation', $validation);

        }

        $this->mst_jaminan_model->save([
            'id', $id,
            'employee_id' => $this->request->getVar('employee_id'),
            'type_id' => $this->request->getVar('type_id'),
            'jaminan_name' => $this->request->getVar('jaminan_name'),
            'jaminan_desc' => $this->request->getVar('jaminan_desc'),
            'doc_no' => $this->request->getVar('doc_no'),
            'tanggal_simpan' => $this->request->getVar('tanggal_simpan'),
            'tanggal_kembali' => $this->request->getVar('tanggal_kembali'),

        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('mst_jaminan/index');

    }

    public function delete_jaminan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_jaminan_model->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('mst_jaminan');

    }

}