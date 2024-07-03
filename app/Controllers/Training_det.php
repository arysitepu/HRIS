<?php

namespace App\Controllers;

use App\Models\Training_det_model;
use App\Models\Karyawan_model;
use App\Models\Training_model;



class Training_det extends BaseController{

    protected $training_det_model;
    protected $karyawan_model;
    protected $training_model; 
    protected $session;

    public function __construct()
    {
        $this->training_det_model = new Training_det_model();
        $this->karyawan_model = new Karyawan_model();
        $this->training_model = new Training_model();
        $this->session = session();
    }

public function save_training_det($id)
{

    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

  $this->training_det_model->save([
      'trn_id' => $id,
      'employee_id' => $this->request->getVar('employee_id'),
      'biaya' => $this->request->getVar('biaya')
  ]);

  session()->setFlashdata('pesan', 'Data berhasil disimpan');
  return redirect()->back();
}

public function edit_training_det($id)
{

    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    $training_det = $this->training_det_model->getTraining_det_id($id);
    $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->where('employee_status', 2)->orWhere('employee_status', 1)->findAll();

    $data = [
        'training_det' => $training_det,
        'karyawan' => $karyawan
    ];

    echo view('admin/templates/header');
    echo view('admin/templates/sidebar');
    echo view('admin/templates/topbar');
    
    echo view('admin/training/training_det/edit_training_det', $data);
    echo view('admin/templates/js');
    echo view('admin/templates/footer');
    
    echo view('admin/templates/modal');
}

public function update_training_det($id)
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    $training_id = $this->training_det_model->find($id);
    $id_training = $training_id['trn_id'];

    $this->training_det_model->save([
        'id' => $id,
        'employee_id' => $this->request->getVar('employee_id'),
        'biaya' => $this->request->getVar('biaya')
    ]);
    // $transaction_id = $this->training_model->find('id');
  
    session()->setFlashdata('pesan', 'Data berhasil diubah');
    return redirect()->to('training/detail_training/'.$id_training);
}

public function delete_training_det($id)
{

    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    $this->training_det_model->delete($id);
    session()->setFlashdata('pesan', 'Data berhasil dihapus');
    return redirect()->back();
}

}