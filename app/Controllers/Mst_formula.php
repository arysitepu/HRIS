<?php

namespace App\Controllers;

use App\Models\Formula_model;

class Mst_formula extends BaseController{

protected $formula_model;
protected $session;

public function __construct()
{
    $this->session = session();
    $this->formula_model = new Formula_model();
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
   $formula = $this->formula_model->findAll();

   $data = [
    'formula' => $formula
   ];

   echo view('admin/templates/header');
   echo view('admin/templates/sidebar');
   echo view('admin/templates/topbar');
   echo view('admin/master/mst_formula/formula_list', $data);
   echo view('admin/templates/js');
   echo view('admin/templates/footer');
   echo view('admin/templates/modal');

}

}