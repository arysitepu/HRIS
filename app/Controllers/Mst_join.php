<?php 

namespace App\Controllers;

use App\Models\Karyawan_model;
use App\Models\Mst_join_model;

class Mst_join extends BaseController{

    protected $mst_join_model;
    protected $karyawan_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->mst_join_model = new Mst_join_model();
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

        $keyword = $this->request->getVar('keyword');

        if($keyword){
            $mst_join = $this->mst_join_model->search($keyword);
            $pager = $this->mst_join_model->pager;
        }else{

            $mst_join = $this->mst_join_model->getJoin_employee();
            $pager = $this->mst_join_model->pager;
           
        }
        $karyawan = $this->karyawan_model->findAll();


        $data = [
            'join' => $mst_join,
            'karyawan'=> $karyawan,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_join/list_join', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_join()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        
     $this->mst_join_model->save([

        'employee_id' => $this->request->getVar('employee_id'),
        'join_start' => $this->request->getVar('join_start'),
        'join_end' => $this->request->getVar('join_end`'),

     ]);

     session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
     return redirect()->to('mst_join/index');

    }

    public function edit_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_join = $this->mst_join_model->getJoin_id($id);
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'join' => $mst_join,
            'karyawan' => $karyawan
        ];
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/mst_join/edit_join', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function update_join($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_join_model->save([
            'id' => $id,
            'employee_id' => $this->request->getVar('employee_id'),
            'join_start' => $this->request->getVar('join_start'),
            'join_end' => $this->request->getVar('join_end`'),
    
         ]);

         session()->setFlashdata('pesan', 'Data berhasil diubah');
         return redirect()->to('mst_join/index');

    }

    public function delete_join($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->mst_join_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('mst_join/index');
    }


}