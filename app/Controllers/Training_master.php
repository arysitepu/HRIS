<?php

namespace App\Controllers;
use App\Models\TrainingMaster_model;
class Training_master extends BaseController{

    protected $training_master_model;
    protected $session;
    public function __construct()
    {
        $this->training_master_model = new TrainingMaster_model();
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
        $master_training = $this->training_master_model->findAll();
        $data = [
            'mst_trainings' => $master_training,
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/mst_training/list_mst_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        if(!$this->validate([
            'name_training' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi data terlebih dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'data gagal diinput silahkan check inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }
        $name_training = $this->request->getVar('name_training');
        $mst_training = [
            'name_training' => $name_training
        ];
        // dd($mst_training);
        $this->training_master_model->save($mst_training);
        session()->setFlashdata('pesan', 'Data Berhasil disimpan');
        return redirect()->back();
    }

  public function update_mst_training($id)
  {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        if(!$this->validate([
            'name_training' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'isi data terlebih dahulu'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'data gagal diinput silahkan check inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }
        $name_training = $this->request->getVar('name_training');
        $id_training = $id;
        $mst_training = [
            'name_training' => $name_training,
            'id_training' => $id_training
        ];
        $this->training_master_model->save($mst_training);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->back();
  }

    public function delete_training_type($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->training_master_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->back();
    }
}