<?php

namespace App\Controllers;

use App\Models\Karyawan_model;
use App\Models\Branch_model;
use App\Models\Position_model;
use App\Models\Kecamatan_model;
use App\Models\Contact_model;
use App\Models\Family_model;
use App\Models\Fasilitas_model;
use App\Models\Mst_jaminan_model;
use App\Models\MstPosition_model;
use App\Models\MstTraining_model;
use App\Models\Trn_education_model;
use App\Models\Sbu_model;
use App\Models\EducationEmployee_model;
use App\Models\Trn_achivement_model;
use App\Models\Trn_cuti_model;

class Karyawan extends BaseController{

    protected $karyawan_model;
    protected $branch_model;
    protected $position_model;
    protected $kecamatan_model;
    protected $contact_model;
    protected $jaminan_model;
    protected $mst_position_model;
    protected $mst_training_model;
    protected $education_model;
    protected $sbu_model;
    protected $mst_education_model;
    protected $cuti_model;
    protected $session;
    protected $family_model;
    protected $fasilitas_model;
    protected $achievement_model;
    public function __construct()
    {
        $this->session = session();
        $this->karyawan_model = new Karyawan_model();
        $this->branch_model = new Branch_model();
        $this->position_model = new Position_model();
        $this->kecamatan_model = new Kecamatan_model();
        $this->contact_model = new Contact_model();
        $this->family_model = new Family_model();
        $this->fasilitas_model = new Fasilitas_model();   
        $this->jaminan_model = new Mst_jaminan_model(); 
        $this->mst_position_model = new MstPosition_model(); 
        $this->mst_training_model = new MstTraining_model(); 
        $this->education_model = new Trn_education_model(); 
        $this->sbu_model = new Sbu_model(); 
        $this->mst_education_model = new EducationEmployee_model();
        $this->cuti_model = new Trn_cuti_model();
        $this->achievement_model = new Trn_achivement_model();
    }

    public function index()
    {
       

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }

        $sbu = $this->request->getVar('sbu');
        $keyword = $this->request->getVar('keyword');
        $status = $this->request->getVar('status');
        $branch = $this->branch_model->findAll();

        if($sbu || $keyword || $status){
        
            if(session()->get('user_level') == 'admin'){
                $karyawan = $this->karyawan_model->search_multi($sbu, $keyword, $status);
                $jumlah_karyawan = $this->karyawan_model->search_multi_count($sbu, $keyword, $status);
            }elseif(session('user_level') == 'user'){
                $branchId = session()->get('branch_id');
                $sbu = session()->get('branch_id');
                $keyword = $this->request->getVar('keyword');
                $status = $this->request->getVar('status');
                $branch = $this->branch_model->findAll();

                $karyawan = $this->karyawan_model->search_multi_user($sbu, $keyword, $status, $branchId);
                $jumlah_karyawan = $this->karyawan_model->search_multi_count_user($sbu, $keyword, $status, $branchId);
            }
           
            $pager = $this->karyawan_model->pager;
           
        }else{

            if(session()->get('user_level') == 'admin'){
            $karyawan = $this->karyawan_model->getKaryawan('karyawan');
            $jumlah_karyawan = $this->karyawan_model->getKaryawanCount();
            
            }elseif(session()->get('user_level') == 'user'){
            $branchId = session()->get('branch_id');
            $karyawan = $this->karyawan_model->getKaryawanSbu($branchId);
            $jumlah_karyawan = $this->karyawan_model->getKaryawanCount_user($branchId);
            }
            $pager = $this->karyawan_model->pager;
             
        }

        $data = [
            'karyawan' => $karyawan,
            'pager' => $pager,
            'branch' => $branch,
            'jumlah_karyawan' => $jumlah_karyawan,
            'nomor' =>  nomor($this->request->getVar('page'), 5)
        ];

      
        // dd($data);
               
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/karyawan_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function karyawan_api()
    {
   
        $karyawan = $this->karyawan_model->getKaryawan();

        $data = [
            'karyawan' => $karyawan,
        ];

    return $this->response->setJSON($data);
}

    public function detail($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }

        $karyawan =  $this->karyawan_model->getKaryawan_id($id);
        $contact = $this->karyawan_model->getContact_id($id)->getResultArray();
        $family = $this->karyawan_model->getKeluarga_id($id)->getResultArray();
        $education = $this->karyawan_model->get_education($id)->getResultArray();
        $fasilitas = $this->karyawan_model->get_fasilitas($id)->getResultArray();
        $mst_jaminan = $this->karyawan_model->get_jaminan($id)->getResultArray();
        $mst_training = $this->karyawan_model->get_training($id)->getResultArray();
        $position = $this->karyawan_model->get_position($id)->getResultArray();

        $employee_id = $karyawan['employee_id'];
        $tahun = date('Y');
        $cuti_jumlah = $this->cuti_model->count_jumlah_cuti_detail($employee_id, $tahun)->getRowArray();

        $data = [
            'karyawan' => $karyawan,
            'contact' => $contact,
            'family' => $family,
            'education' => $education,
            'fasilitas' => $fasilitas,
            'mst_jaminan' => $mst_jaminan,
            'mst_training' => $mst_training,
            'position' => $position,
            'cuti_jumlah' => $cuti_jumlah
        ];
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/detail_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function detail_karyawan_pribadi($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }

        $karyawan =  $this->karyawan_model->getKaryawan_id($id);
        $contact = $this->karyawan_model->getContact_id($id)->getResultArray();
        $family = $this->karyawan_model->getKeluarga_id($id)->getResultArray();
        $education = $this->karyawan_model->get_education($id)->getResultArray();
        $fasilitas = $this->karyawan_model->get_fasilitas($id)->getResultArray();
        $mst_jaminan = $this->karyawan_model->get_jaminan($id)->getResultArray();
        $mst_training = $this->karyawan_model->get_training($id)->getResultArray();
        $position = $this->karyawan_model->get_position($id)->getResultArray();
        $data = [
            'karyawan' => $karyawan,
            'contact' => $contact,
            'family' => $family,
            'education' => $education,
            'fasilitas' => $fasilitas,
            'mst_jaminan' => $mst_jaminan,
            'mst_training' => $mst_training,
            'position' => $position
          
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/detail_karyawan_pribadi', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function detail_karyawan_kantor($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }

        $karyawan =  $this->karyawan_model->getKaryawan_id($id);
        $contact = $this->karyawan_model->getContact_id($id)->getResultArray();
        $family = $this->karyawan_model->getKeluarga_id($id)->getResultArray();
        $education = $this->karyawan_model->get_education($id)->getResultArray();
        $fasilitas = $this->karyawan_model->get_fasilitas($id)->getResultArray();
        $jaminan = $this->karyawan_model->get_jaminan($id)->getResultArray();
        $mst_training = $this->karyawan_model->get_training($id)->getResultArray();
        $position = $this->karyawan_model->get_position($id)->getResultArray();
        $join = $this->karyawan_model->get_join($id)->getResultArray();
        $achievements = $this->achievement_model->getAchivement_employee($id)->getResultArray();
        // dd($achievements);
        $data = [
            'karyawan' => $karyawan,
            'contact' => $contact,
            'family' => $family,
            'education' => $education,
            'fasilitas' => $fasilitas,
            'jaminan' => $jaminan,
            'mst_training' => $mst_training,
            'position' => $position,
            'join' => $join,
            'achievements' => $achievements
          
        ];

        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/detail_karyawan_kantor', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }


    public function add()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }

        // session();
        $karyawan = $this->karyawan_model->findAll();
        $kecamatan = $this->kecamatan_model->findAll();
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();
        $data = [
            'karyawan' => $karyawan,
            'branch' => $branch,
            'position' => $position,
            'kecamatan' => $kecamatan,
            'validation' => \Config\Services::validation()
           
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/add_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }
        
        if(!$this->validate([
            'employee_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama Lengkap harus diisi!'
                ]
            ],

            'hak_cuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'hak cuti harus diisi!'
                ]
            ],
            'start_cuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Start Cuti harus diisi!'
                ]
            ],

            'gambar' => [
                'rules' => 'ext_in[gambar,png,jpg,gif]',
                'errors' => [
                    'ext_in' => 'file harus berupa gambar'
                ]
            ],


        ])){
            
            // $validation = \Config\Services::validation();
            // return redirect()->to('karyawan/add')->withInput()->with('validation', $validation);
            return redirect()->to('karyawan/add')->withInput();
        }

        //ambil gambar

        $file_gambar = $this->request->getFile('gambar');
        // dd($file_gambar);
        //batas ambil gambar

        //cek apakah tidak ada gambar yang di upoad
        if($file_gambar->getError() == 4){
            $nama_gambar = 'default.jpg';
        }else{

            //generate nama gambar random
            $nama_gambar = $file_gambar->getRandomName();
           //batas
    
            //pindahkan file ke folder img
            $file_gambar->move('img', $nama_gambar);
            //batas
        }
        //batas
     
        $this->karyawan_model->save([
        'employee_name' => $this->request->getVar('employee_name'),
        'employee_nickname' => $this->request->getVar('employee_nickname'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'lahir_tempat' => $this->request->getVar('lahir_tempat'),
        'lahir_tanggal' => $this->request->getVar('lahir_tanggal'),
        'position_id' => $this->request->getVar('position_id'),
        'branch_id' => $this->request->getVar('branch_id'),
        'no_ktp' => $this->request->getVar('no_ktp'),
        'no_kk' => $this->request->getVar('no_kk'),
        'no_bpjs_tk' => $this->request->getVar('no_bpjs_tk'),
        'no_bpjs_kes' => $this->request->getVar('no_bpjs_kes'),
        'no_npwp' => $this->request->getVar('no_npwp'),
        'alamat_ktp' => $this->request->getVar('alamat_ktp'),
        'alamat_tinggal' => $this->request->getVar('alamat_tinggal'),
        'kecamatan_id' => $this->request->getVar('kecamatan_id'),
        'kode_pos' => $this->request->getVar('kode_pos'),
        'status_rumah' => $this->request->getVar('status_rumah'),
        'status_nikah' => $this->request->getVar('status_nikah'),
        'etnis' => $this->request->getVar('etnis'),
        'agama' => $this->request->getVar('agama'),
        'gol_darah' => $this->request->getVar('gol_darah'),
        'no_tlp' => $this->request->getVar('no_tlp'),
        'no_tlp2' => $this->request->getVar('no_tlp2'),
        'email_pribadi' => $this->request->getVar('email_pribadi'),
        'email_kantor' => $this->request->getVar('email_kantor'),
        'badan_tinggi' => $this->request->getVar('badan_tinggi'),
        'badan_berat' => $this->request->getVar('badan_berat'),
        'hak_cuti' => $this->request->getVar('hak_cuti'),
        'start_cuti' => $this->request->getVar('start_cuti'),
        'no_rek' => $this->request->getVar('no_rek'),
        'employee_status' => $this->request->getVar('employee_status'),
        'gambar' => $nama_gambar
       ]);

     

       $this->sbu_model->get_sbu();
       session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
       return redirect()->to('karyawan/index');

    }

    public function edit($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
       

        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $kecamatan = $this->kecamatan_model->findAll();
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();
        $data = [
            'karyawan' => $karyawan,
            'branch' => $branch,
            'position' => $position,
            'kecamatan' => $kecamatan,
            'validation' => \Config\Services::validation()
           
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/edit_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update($id)
    {
        

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }

        if(!$this->validate([
            'employee_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => ' Nama Lengkap harus diisi!'
                ]
            ],

            'hak_cuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'hak cuti harus diisi!'
                ]
            ],
            'start_cuti' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Start Cuti harus diisi!'
                ]
            ],

            'gambar' => [
                'rules' => 'ext_in[gambar,png,jpg,gif]',
                'errors' => [
                    'ext_in' => 'file harus berupa gambar'
                ]
            ],


        ])){
        
            return redirect()->to('karyawan/edit/'.$this->request->getVar('employee_id'))->withInput();
        }

       $file_gambar = $this->request->getFile('gambar');
        // dd($file_gambar);
       //cek gambar, apakah tetap gambar lama
        if($file_gambar->getError() == 4){
            $nama_gambar = $this->request->getVar('gambar_lama');
        }elseif($file_gambar->getError() == null){
              //generate nama gambar random
              $nama_gambar = $file_gambar->getRandomName();
              //batas
       
               //pindahkan file ke folder img
               $file_gambar->move('img', $nama_gambar);
               //batas
        }else{
            //generate nama file random

            $nama_gambar = $file_gambar->getRandomName();

            //pindahkan gambar
            $file_gambar->move('img', $nama_gambar);
            //batas

            //kalau filenya baru hapus file yang lama
            unlink('img/' . $this->request->getVar('gambar_lama'));
            //batas
        }
       //

        $this->karyawan_model->save([
            'employee_id' => $id,
            'employee_name' => $this->request->getVar('employee_name'),
            'employee_nickname' => $this->request->getVar('employee_nickname'),
            'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
            'lahir_tempat' => $this->request->getVar('lahir_tempat'),
            'lahir_tanggal' => $this->request->getVar('lahir_tanggal'),
            'position_id' => $this->request->getVar('position_id'),
            'branch_id' => $this->request->getVar('branch_id'),
            'no_ktp' => $this->request->getVar('no_ktp'),
            'no_kk' => $this->request->getVar('no_kk'),
            'no_bpjs_tk' => $this->request->getVar('no_bpjs_tk'),
            'no_bpjs_kes' => $this->request->getVar('no_bpjs_kes'),
            'no_npwp' => $this->request->getVar('no_npwp'),
            'alamat_ktp' => $this->request->getVar('alamat_ktp'),
            'alamat_tinggal' => $this->request->getVar('alamat_tinggal'),
            'kecamatan_id' => $this->request->getVar('kecamatan_id'),
            'kode_pos' => $this->request->getVar('kode_pos'),
            'status_rumah' => $this->request->getVar('status_rumah'),
            'status_nikah' => $this->request->getVar('status_nikah'),
            'etnis' => $this->request->getVar('etnis'),
            'agama' => $this->request->getVar('agama'),
            'gol_darah' => $this->request->getVar('gol_darah'),
            'no_tlp' => $this->request->getVar('no_tlp'),
            'no_tlp2' => $this->request->getVar('no_tlp2'),
            'email_pribadi' => $this->request->getVar('email_pribadi'),
            'email_kantor' => $this->request->getVar('email_kantor'),
            'badan_tinggi' => $this->request->getVar('badan_tinggi'),
            'badan_berat' => $this->request->getVar('badan_berat'),
            'hak_cuti' => $this->request->getVar('hak_cuti'),
            'start_cuti' => $this->request->getVar('start_cuti'),
            'no_rek' => $this->request->getVar('no_rek'),
            'tanggal_masuk' => $this->request->getVar('tanggal_masuk'),
            'tanggal_keluar' => $this->request->getVar('tanggal_keluar'),
            'employee_status' => $this->request->getVar('employee_status'),
            'gambar' => $nama_gambar,
           ]);

           $this->sbu_model->get_sbu();
          
           session()->setFlashdata('pesan', 'Data Berhasil diubah');
           return redirect()->to('karyawan/index');
    }

    public function delete($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        //cari gambar berdasarkan id
        $karyawan = $this->karyawan_model->find($id);
        //batas

        //cek jika file gambarnya default
        if($karyawan['gambar'] != 'default.jpg'){

            
                    //hapus gambar
                    unlink('img/' . $karyawan['gambar'] );
                    //batas
        }
        //batas

        $this->karyawan_model->delete($id);

        session()->setFlashdata('pesan', 'Data Berhasil dihapus');
        return redirect()->to('karyawan'); 
    }

    public function get_contact($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $contact = $this->karyawan_model->getContact_detail_id($id)->getRowArray();

        $data =[
            'karyawan' =>$karyawan,
            'contact' =>$contact
        ];

    //   dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/karyawan/contact/detail_contact', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function get_keluarga($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/login');
        // }

        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $family = $this->karyawan_model->getKeluarga_detail_id($id)->getRowArray();

        $data=[
            'karyawan' => $karyawan,
            'family' => $family
        ];  

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/karyawan/keluarga/detail_keluarga', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function get_education($id)
    {
      
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        $education = $this->mst_education_model->getEducation_employee_id($id);
        $karyawan = $this->karyawan_model->getKaryawan_id($id);
        $data = [
            
            'education' => $education,
            'karyawan' => $karyawan
        ];

// dd($data);
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/education/education_detail', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }



    public function get_facility($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        $fasilitas = $this->karyawan_model->getFacility_id($id)->getRowArray();
        

        $data= [
            'facility' => $fasilitas
        ];

       

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/detail_fasilitas', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function get_jaminan($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        $jaminan = $this->karyawan_model->getJaminan_id($id)->getRowArray();

        $data = [
            'mst_jaminan' => $jaminan
        ];

       

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/detail_jaminan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function get_training($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        $mst_training = $this->karyawan_model->getTraining_id($id)->getRowArray();

        $data = [
            'mst_training' => $mst_training
        ];

       
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/detail_training', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
        
    }

    public function get_position($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/login');
        }

        $position = $this->karyawan_model->getPosition_id($id)->getRowArray();

        $data = [
            'position' => $position
        ];

       

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/karyawan/position/detail_position', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function cetak_karyawan()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $karyawan = $this->karyawan_model->cetakKaryawan()->getResultArray();
        $branch = $this->branch_model->findAll();
        $jumlah_karyawan = $this->karyawan_model->getKaryawanCount();

        $data = [
            'karyawan' =>  $karyawan,
            'branch' => $branch,
            'jumlah_karyawan' => $jumlah_karyawan
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/master/cetak_karyawan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/modal');

    }



}