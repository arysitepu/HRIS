<?php

namespace App\Controllers;
use App\Models\Position_model;

class Position extends BaseController
{
    protected $karyawan_model;
    protected $session;
    protected $position_model;
    public function __construct()
    {
        $this->session = session();
        $this->position_model = new Position_model();
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

        $position = $this->position_model->findAll();

      $data = [
          'position' => $position,
          'validation' => \Config\Services::validation()
        ]; 
       

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/position/list_position', $data);
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
            'position_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ' Posisi Harus Diisi!'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('position/index')->withInput()->with('validation', $validation);
        }

        $this->position_model->save([
            'position_name' => $this->request->getVar('position_name')
        ]);
        session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
        return redirect()->to('position/index');
 
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

        $position = $this->position_model->getPosition_id($id);

        $data = [
            'position' => $position,
            'validation' => \Config\Services::validation()
          
          ]; 
       
  
          echo view('admin/templates/header');
          echo view('admin/templates/sidebar');
          echo view('admin/templates/topbar');
          echo view('admin/master/position/list_position', $data);
          echo view('admin/templates/js');
          echo view('admin/templates/footer');
          echo view('admin/templates/modal', $data);
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
            'position_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Posisi harus diisi'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('position/edit')->withInput()->with('validation', $validation);
        }

        $this->position_model->save([
            'position_id' => $id,
            'position_name' => $this->request->getVar('position_name')
        ]);

        session()->setFlashdata('pesan', 'Data Berhasil di ubah');
        return redirect()->to('position/index');
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

        $this->position_model->delete($id);
    
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('position/index');
    }

    
}