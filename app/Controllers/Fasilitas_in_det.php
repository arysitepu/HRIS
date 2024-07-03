<?php 

namespace App\Controllers;
use App\Models\Mst_facility_model;
use App\Models\MstType_model;
use App\Models\Trn_fasilitas_in_det_model;
use App\Models\Trn_fasilitas_in_model;

class Fasilitas_in_det extends BaseController{

    protected $mst_fasilitas_model;
    protected $mst_type_model;
    protected $fasilitas_in_det_model;
    protected $fasilitas_in_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->mst_fasilitas_model = new Mst_facility_model();
        $this->mst_type_model = new MstType_model();
        $this->fasilitas_in_det_model = new Trn_fasilitas_in_det_model();
        $this->fasilitas_in_model = new Trn_fasilitas_in_model();
    }

    public function add_fasilitas_in_det($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
         if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_fasilitas = $this->mst_fasilitas_model->findAll();
        $mst_type = $this->mst_type_model->findAll();
        $fasilitas_in_det = $this->fasilitas_in_det_model->getFasilitasInDet_id($id);
        $fasilitas_in = $this->fasilitas_in_model->getFasilitas_in_id($id);

        $data= [
            'mst_fasilitas' => $mst_fasilitas,
            'mst_type' => $mst_type,
            'fasilitas_in_det' => $fasilitas_in_det,
            'fasilitas_in' => $fasilitas_in
        ];



        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas_in/fasilitas_in_det/add_fasilitas_in_det', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function save_detail()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->fasilitas_in_det_model->save([
            'trn_id' => $this->request->getVar('trn_id'),
            'facility_id' => $this->request->getVar('facility_id'),
            'qty' => $this->request->getVar('qty'),
            'kegunaan' => $this->request->getVar('kegunaan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil disimpan Silahkan lihat detail');
        return redirect()->to('fasilitas_in/index');
    }

    public function edit_fasilitas_detail($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_fasilitas = $this->mst_fasilitas_model->findAll();
        $mst_type = $this->mst_type_model->findAll();
        $fasilitas_in_det = $this->fasilitas_in_det_model->getFasilitasInDet_id($id);
        $fasilitas_in_detail = $this->fasilitas_in_det_model->getFasilitas_in($id);
        $fasilitas_in = $this->fasilitas_in_model->getFasilitas_in_id($id);

        $data= [
            'mst_fasilitas' => $mst_fasilitas,
            'mst_type' => $mst_type,
            'fasilitas_in_det' => $fasilitas_in_det,
            'fasilitas_in_detail' => $fasilitas_in_detail,
            'fasilitas_in' => $fasilitas_in
        ];



        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas_in/fasilitas_in_det/edit_fasilitas_in_det', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_detail($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->fasilitas_in_det_model->save([
            'id' => $id,    
            'trn_id' => $this->request->getVar('trn_id'),
            'facility_id' => $this->request->getVar('facility_id'),
            'qty' => $this->request->getVar('qty'),
            'kegunaan' => $this->request->getVar('kegunaan'),
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah Silahkan lihat detail');
        return redirect()->to('fasilitas_in/index');
    }

    public function delete_fasilitas_detail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->fasilitas_in_det_model->delete($id);
        session()->setFlashdata('pesan', 'Data Berhasil dihapus lihat detail');
        return redirect()->to('fasilitas_in/index');
    }

}