<?php 

namespace App\Controllers;

use App\Models\Branch_model;

class Branch extends BaseController{

    protected $branch_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
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

        $keyword = $this->request->getVar('keyword');

        if($keyword){
            $branch = $this->branch_model->search($keyword);
            $pager = $this->branch_model->pager; 
        }else{

            $branch = $this->branch_model->getSbu();
            $pager = $this->branch_model->pager;
        }

        $data = [
            'branch' => $branch,
            'pager' =>  $pager, 
            'nomor' => nomor($this->request->getVar('page'), 5), 
            'validation' => \Config\Services::validation()
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/branch/list_branch', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $branch =   $this->branch_model->getSbu_id($id);

        $data = [
            'branch' => $branch,
            
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/branch/detail_branch', $data);
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
            'branch_code' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Code SBU Harus Diisi'
                ]
            ],

            'branch_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nama SBU Harus Diisi'
                ]
            ],

            'status' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Pilih Status Terlebih Dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Upsss data tidak terinput ada yang salah. . .');
            return redirect()->to('branch/index')->withInput('validation', $validation);
        }

        $this->branch_model->save([

            'branch_code' => $this->request->getVar('branch_code'),
            'branch_name' => $this->request->getVar('branch_name'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
            'fax' => $this->request->getVar('fax'),
            'email' => $this->request->getVar('email'),
            'status' => $this->request->getVar('status'),

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Ditambahkan');
        return redirect()->to('branch/index');

    }

    public function edit($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $branch =   $this->branch_model->getSbu_id($id);

        $data = [
            'branch' => $branch,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/branch/edit_branch', $data);
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
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'branch_code' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Code SBU Harus Diisi'
                ]
            ],

            'branch_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nama SBU Harus Diisi'
                ]
            ],

            'status' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Pilih Status Terlebih Dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Upsss data tidak terupdate ada yang salah. . .');
            return redirect()->to('branch/edit/'.$this->request->getVar('branch_id'))->withInput('validation', $validation);
        }

        $this->branch_model->save([
            'branch_id' => $id,
            'branch_code' => $this->request->getVar('branch_code'),
            'branch_name' => $this->request->getVar('branch_name'),
            'address' => $this->request->getVar('address'),
            'phone' => $this->request->getVar('phone'),
            'fax' => $this->request->getVar('fax'),
            'email' => $this->request->getVar('email'),
            'status' => $this->request->getVar('status'),

        ]);
        session()->setFlashdata('pesan', 'Data Berhasil Diubah');
        return redirect()->to('branch/edit/'.$this->request->getVar('branch_id'));

    }

    public function delete_branch($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->branch_model->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil Dihapus');
        return redirect()->to('/branch');
    }
}