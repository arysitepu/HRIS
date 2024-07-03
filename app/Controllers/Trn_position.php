<?php 

namespace App\Controllers;

use App\Models\Trn_position_model;
use App\Models\Karyawan_model;
use App\Models\Position_model;
use App\Models\Branch_model;
use App\Models\Formula_model;

class Trn_position extends BaseController{

    protected $trn_position_model;
    protected $karyawan_model;
    protected $position_model;
    protected $branch_model;
    protected $formula_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->trn_position_model = new Trn_position_model();
        $this->karyawan_model = new Karyawan_model();
        $this->position_model = new Position_model();
        $this->branch_model = new Branch_model();
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

        $keyword = $this->request->getVar('keyword');
        $branch_id = $this->request->getVar('branch_id');

        if($keyword || $branch_id){
            $position = $this->trn_position_model->search_position($keyword, $branch_id);
            // dd($position);
            $branch_id = $this->branch_model->findAll();
            $pager = $this->trn_position_model->pager;
        }else{

            $position = $this->trn_position_model->get_position();
            $branch_id = $this->branch_model->findAll();
            $pager = $this->trn_position_model->pager;
        }


        $data = [
            'position' => $position,
            'pager' => $pager,
            'branch_id' => $branch_id
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_position/list_position', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail_position($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        $position = $this->trn_position_model->getPosition_id($id);
        $data = [
            'position' => $position
        ];

       
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_position/detail_position', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add_position()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $nomorDokumen = $this->trn_position_model->nomorDokumen();
       
        $position = $this->trn_position_model->get_position();
        $karyawan = $this->karyawan_model->findAll();
        $branch = $this->branch_model->findAll();
        $mst_position = $this->position_model->findAll();
        $formula = $this->formula_model->getFormula();

        $data = [
            'position' => $position,
            'karyawan' => $karyawan,
            'branch_mst' => $branch,
            'position_mst' => $mst_position,
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen
           
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_position/add_position', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_position()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
         $this->trn_position_model->save([
           'trn_no' => $this->request->getVar('trn_no'),
           'employee_id' => $this->request->getVar('employee_id'),
           'employee_id_buat' => $this->request->getVar('employee_id_buat'),
           'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
           'position_id' => $this->request->getVar('position_id'),
           'position_id_old' => $this->request->getVar('position_id_old'),
           'branch_id' => $this->request->getVar('branch_id'),
           'branch_id_old' => $this->request->getVar('branch_id_old'),
           'trn_date' => $this->request->getVar('trn_date'),
           'position_start' => $this->request->getVar('position_start'),
           'position_start_old' => $this->request->getVar('position_start_old'),
           'note' => $this->request->getVar('note'),

       ]); 

       session()->setFlashdata('pesan', 'Data berhasil disimpan');
       return redirect()->to('trn_position/index');
    }

    public function edit_position($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $position = $this->trn_position_model->getPosition_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $branch = $this->branch_model->findAll();
        $mst_position = $this->position_model->findAll();
       

        $data = [
            'position' => $position,
            'karyawan' => $karyawan,
            'branch_mst' => $branch,
            'position_mst' => $mst_position
          
           
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_position/edit_position', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function post_position($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->trn_position_model->save([
            'trn_id' => $id,
            'posting' =>1
        ]);
    
        $branch = $this->request->getVar('branch_id');
        $position_id = $this->request->getVar('position_id');

        $data = [
            'branch_id' => $branch,
            'position_id' => $position_id
        ];

       
        $this->trn_position_model->posting($this->request->getVar('employee_id'), $data);
        session()->setFlashdata('pesan', 'Data berhasil di posting');
        return redirect()->to('trn_position/index');

    }

    public function unpost_position($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $trn_id = $id;
        $unposting_id = 0;
        $unposting = [
            'posting' => $unposting_id,
        ];
        // dd($unposting);
        $this->trn_position_model->update($trn_id, $unposting);

        $branch_id = $this->trn_position_model->getPosition_id($id);
        $position_id = $this->trn_position_model->getPosition_id($id);
        $employee_id_user = $this->trn_position_model->getPosition_id($id);
        $employee_id = $employee_id_user['employee_id'];
        $data = [
            'branch_id' => $branch_id['branch_id_old'],
            'position_id' => $position_id['position_id_old'],
        ];
        // dd($data);
        $this->trn_position_model->unposting($employee_id, $data);
        session()->setFlashdata('pesan','data berhasil di unposting');
        return redirect()->back();

    }

    public function update_position($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->trn_position_model->save([
            'trn_id' => $id, 
            'trn_no' => $this->request->getVar('trn_no'),
            'employee_id' => $this->request->getVar('employee_id'),
            'employee_id_buat' => $this->request->getVar('employee_id_buat'),
            'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
            'position_id' => $this->request->getVar('position_id'),
            'position_id_old' => $this->request->getVar('position_id_old'),
            'branch_id' => $this->request->getVar('branch_id'),
            'branch_id_old' => $this->request->getVar('branch_id_old'),
            'trn_date' => $this->request->getVar('trn_date'),
            'position_start' => $this->request->getVar('position_start'),
            'position_start_old' => $this->request->getVar('position_start_old'),
            'note' => $this->request->getVar('note'),
 
        ]); 
 
        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('trn_position/index');
     }

     public function delete_position($id)
     {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
         $this->trn_position_model->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('/trn_position');
     }

     public function add_position_id($id)
     {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $position = $this->trn_position_model->get_position()->getResultArray();
        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $karyawan_buat_setuju = $this->karyawan_model->findAll();
        $mst_position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();

        $data = [
            'position' => $position,
            'karyawan' => $karyawan,
            'karyawan_buat_setuju' => $karyawan_buat_setuju,
            'position_mst' => $mst_position,
            'position_sebelum' => $mst_position,
            'branch' => $branch,
            'branch_sebelum' => $branch
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_position/add_position_id', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
     }

     
    public function save_position_id()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
         $this->trn_position_model->save([
           'trn_no' => $this->request->getVar('trn_no'),
           'employee_id' => $this->request->getVar('employee_id'),
           'employee_id_buat' => $this->request->getVar('employee_id_buat'),
           'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
           'position_id' => $this->request->getVar('position_id'),
           'position_id_old' => $this->request->getVar('position_id_old'),
           'branch_id' => $this->request->getVar('branch_id'),
           'branch_id_old' => $this->request->getVar('branch_id_old'),
           'trn_date' => $this->request->getVar('trn_date'),
           'position_start' => $this->request->getVar('position_start'),
           'position_start_old' => $this->request->getVar('position_start_old'),

       ]); 

       session()->setFlashdata('pesan', 'Data berhasil disimpan');
       return redirect()->to('karyawan/index');
    }
    

}