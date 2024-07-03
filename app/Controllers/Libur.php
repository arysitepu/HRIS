<?php

namespace App\Controllers;

use App\Models\Libur_model;

class Libur extends BaseController{
    
    protected $libur_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->libur_model = new Libur_model();
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

        $jenis_libur = $this->request->getVar('jenis_libur');
        $bulan = $this->request->getVar('bulan');

        if($jenis_libur){
            $libur = $this->libur_model->search($jenis_libur, $bulan);
            // $pager = $this->libur_model->pager;
        }elseif($bulan){
            $libur = $this->libur_model->search($jenis_libur, $bulan);
            // $pager = $this->libur_model->pager;
        }
        else{
            $libur = $this->libur_model->getLibur()->getResultArray();
            // $pager = $this->libur_model->pager;
        }


        $data = [
            'libur' => $libur, 
            'validation' => \Config\Services::validation(),
        ];


        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/libur/libur_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }


   

    public function save_libur()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        if(!$this->validate([
            'jenis_libur' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Jenis libur harus diisi!.'
                ]
            ],

            'tgl_libur' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Tanggal libur harus diisi!.'
                ]
            ],

        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('libur/index')->withInput()->with('validation', $validation);
        }

        $this->libur_model->save([
            'tgl_libur' => $this->request->getVar('tgl_libur'),
            'jenis_libur' => $this->request->getVar('jenis_libur')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil disimpan');
        return redirect()->to('libur/index');
    }

    public function editLibur($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $libur = $this->libur_model->get_liburDetail($id);

        $data = [
            'libur' => $libur,
            'validation' => \Config\Services::validation()
        ];

        

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/libur/edit_libur', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_libur($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'jenis_libur' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Jenis Libur Harus Diisi'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('libur/editLibur/'.$this->request->getVar('id_libur'))->withInput()->with('validation', $validation);
        }

        $data = [
            'id_libur' => $id,
            'jenis_libur' => $this->request->getVar('jenis_libur'), 
            'tgl_libur' => $this->request->getVar('tgl_libur')
        ];

        $this->libur_model->save($data);

        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->to('libur/index');
    }

    public function delete_libur($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->libur_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil di hapus');
        return redirect()->to('libur/index');
    }

}
