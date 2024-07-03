<?php 

namespace App\Controllers;

use App\Models\Trn_fasilitas_in_model;
use App\Models\Karyawan_model;
use App\Models\Trn_fasilitas_in_det_model;

class Fasilitas_in extends BaseController{

    protected $fasilitas_in_model;
    protected $karyawan_model;
    protected $session;
    protected $fasilitas_in_det_model;

    public function __construct()
    {
        $this->session = session();
        $this->fasilitas_in_model = new Trn_fasilitas_in_model();
        $this->karyawan_model = new Karyawan_model();
        $this->fasilitas_in_det_model = new Trn_fasilitas_in_det_model();
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
            $fasilitas_in = $this->fasilitas_in_model->search($keyword);
            $pager = $this->fasilitas_in_model->pager;
        }else{

            $fasilitas_in = $this->fasilitas_in_model->getFasilitas_in();
            $pager = $this->fasilitas_in_model->pager;
        }


        $data = [
            'fasilitas_in' => $fasilitas_in,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas_in/list_fasilitas_in', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_fasilitas_in($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $fasilitas_in = $this->fasilitas_in_model->getFasilitas_in_id($id);
        $fasilitas_in_det = $this->fasilitas_in_det_model->getFasilitas_in_det($id)->getResultArray();
        
        $data = [
            'fasilitas_in' => $fasilitas_in,
            'fasilitas_in_det' => $fasilitas_in_det
        ];

    
      
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas_in/detail_fasilitas_in', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    

    public function add_fasilitas_in()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $karyawan = $this->karyawan_model->findAll();
        $fasilitas_in = $this->fasilitas_in_model->getFasilitas_in();
        
        $data = [
            'fasilitas_in' => $fasilitas_in,
            'karyawan' => $karyawan,
            
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas_in/add_fasilitas_in', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_fasilitas_in()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->fasilitas_in_model->save([
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('fasilitas_in/index');
    }

    public function edit_fasilitas_in($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $fasilitas_in = $this->fasilitas_in_model->getFasilitas_in_id($id);
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'fasilitas_in' => $fasilitas_in,
            'karyawan' => $karyawan
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas_in/edit_fasilitas_in', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_fasilitas_in($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->fasilitas_in_model->save([
            'trn_id' => $id,
            'trn_no' => $this->request->getVar('trn_no'),
            'trn_date' => $this->request->getVar('trn_date'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'employee_id' => $this->request->getVar('employee_id'),
            'tgl_pinjam' => $this->request->getVar('tgl_pinjam'),
            'tgl_kembali' => $this->request->getVar('tgl_kembali'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('fasilitas_in/index');
    }

    public function delete_fasilitas_in($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->fasilitas_in_model->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        return redirect()->to('fasilitas_in');
    }

}