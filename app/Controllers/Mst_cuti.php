<?php

namespace App\Controllers;

use App\Models\MstCuti_model;

class Mst_cuti extends BaseController{


    protected $mst_cuti;
    protected $session;

    public function __construct()
    {

        $this->session = session();
        $this->mst_cuti = new MstCuti_model();
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

        $cuti_name = $this->request->getVar('cuti_name');

        if($cuti_name){
            $mst_cuti = $this->mst_cuti->search($cuti_name);
            $pager = $this->mst_cuti->pager;    
        }else{

            $mst_cuti = $this->mst_cuti->paginate(5);
            $pager = $this->mst_cuti->pager;
        }
        $data = [
            'mst_cuti' => $mst_cuti,
            'pager' => $pager
        ];

      

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_cuti/cuti_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function save_cuti()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_cuti->save([

            'cuti_name' => $this->request->getVar('cuti_name'),
            'cuti_type' => $this->request->getVar('cuti_type'),
            'potong_cuti' => $this->request->getVar('potong_cuti'),
            'qty_max' => $this->request->getVar('qty_max'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('mst_cuti/index');
    }

    public function update_cuti($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_cuti->save([
            'cuti_id' => $id,
            'cuti_name' => $this->request->getVar('cuti_name'),
            'cuti_type' => $this->request->getVar('cuti_type'),
            'potong_cuti' => $this->request->getVar('potong_cuti'),
            'qty_max' => $this->request->getVar('qty_max'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('mst_cuti/index');
    }

    public function delete_cuti($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_cuti->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('mst_cuti');
    }


}