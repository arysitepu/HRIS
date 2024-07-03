<?php

namespace App\Controllers;
use App\Models\TrnCutiPeriod_model;
use App\Models\Karyawan_model;
class TrnCuti_period extends BaseController{

    protected $cuti_period_model;
    protected $karyawan_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->cuti_period_model = new TrnCutiPeriod_model();
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
        $cuti_period = $this->cuti_period_model->getCuti_period()->getResultArray();
        $karyawan = $this->karyawan_model->findAll();
        $validation = \Config\Services::validation();
        $data = [
            'cuti_period' => $cuti_period,
            'karyawan' => $karyawan, 
            'validation' => $validation
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_cuti_period/cuti_period_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_period()
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
                'errors' => [
                    'required' => 'Silahkan Pilih Karyawan Terlebih Dahulu'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('trncuti_period/index')->withInput('validation', $validation);
        }

        $this->cuti_period_model->save([

            'employee_id' => $this->request->getVar('employee_id'),
            'periode' => $this->request->getVar('periode'),
            'cuti_qty' => $this->request->getVar('cuti_qty')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('trncuti_period/index');
    }

    public function update_period($id)
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
                'errors' => [
                    'required' => 'Silahkan Pilih Karyawan Terlebih Dahulu'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            return redirect()->to('trncuti_period/index')->withInput('validation', $validation);
        }

        $this->cuti_period_model->save([
            'trn_id' => $id,
            'employee_id' => $this->request->getVar('employee_id'),
            'periode' => $this->request->getVar('periode'),
            'cuti_qty' => $this->request->getVar('cuti_qty')
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('trncuti_period/index');
    }

    public function delete_period($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->cuti_period_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('trncuti_period');
    }

}