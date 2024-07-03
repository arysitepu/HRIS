<?php

namespace App\Controllers;

use App\Models\Trn_cuti_model;
use App\Models\Karyawan_model;
use App\Models\Position_model;
use App\Models\Branch_model;
use App\Models\MstCuti_model;
use App\Models\Trn_tgl_model;
use App\Models\Libur_model;
use App\Models\Users_model;

class Trn_cuti extends BaseController
{

    protected $cuti_model;
    protected $karyawan_model;
    protected $position_model;
    protected $branch_model;
    protected $mst_cuti_model;
    protected $trn_tgl_model;
    protected $libur_model;
    protected $user_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->cuti_model = new Trn_cuti_model();
        $this->karyawan_model = new Karyawan_model();
        $this->position_model = new Position_model();
        $this->branch_model = new Branch_model();
        $this->mst_cuti_model = new MstCuti_model();
        $this->trn_tgl_model = new Trn_tgl_model();
        $this->libur_model = new Libur_model();
        $this->user_model = new Users_model();
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
        $cuti_id = $this->request->getVar('cuti_id');
        $awal_bulan = $this->request->getVar('awal_bulan');
        $akhir_bulan = $this->request->getVar('akhir_bulan');
        $keyword = $this->request->getVar('keyword');

        if($sbu || $cuti_id || $keyword || $awal_bulan || $akhir_bulan){
            $cuti = $this->cuti_model->search_by_month($sbu, $cuti_id, $keyword, $awal_bulan, $akhir_bulan);
            // dd($cuti);
            $jumlah_cuti = $this->cuti_model->count_search_by_month($sbu, $cuti_id, $keyword, $awal_bulan, $akhir_bulan);
            // dd([$cuti, $jumlah_cuti]);
        }else{
            if(session()->get('user_level') == 'admin'){
                $cuti = $this->cuti_model->get_cuti();
            }elseif(session()->get('user_level') == 'user'){
                $branchId = session()->get('branch_id');
                $cuti = $this->cuti_model->getCutiSbu($branchId);
                // dd($cuti);
            }
            $jumlah_cuti = 0;
        }
        
        if(session()->get('user_level') == 'admin'){
            $branch = $this->branch_model->findAll();
        }else{
            $id_sbu = session()->get('branch_id');
            $branch = $this->branch_model->find($id_sbu);
        }

        $branchId =  session()->get('branch_id');
        $employees = $this->karyawan_model->getKaryawanById($branchId)->getResultArray();
        // dd($karyawan);
        $jenis_cuti = $this->mst_cuti_model->findAll();
        $pager = $this->cuti_model->pager;

        $data = [
            'cuti' => $cuti,
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5),
            'jumlah_cuti' => $jumlah_cuti, 
            'branch' => $branch,
            'mst_cuti' => $jenis_cuti,
            'employees' => $employees
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/cuti_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }


    

    public function detail_cuti($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
        $cuti = $this->cuti_model->get_cutiId($id);
        // $tanggal_cuti = $this->trn_tgl_model->getDetail($id)->getResultArray();
        // dd($tanggal_cuti);
        $employee_id = $cuti['employee_id'];
        $tahun = date("Y", strtotime($cuti['tgl_dari']));
        $tanggal = $cuti['tgl_dari'];
        $cuti_jumlah = $this->cuti_model->count_jumlah_cuti_id($employee_id, $tahun, $tanggal)->getRowArray();
        
        $cuti_tgl = $this->cuti_model->get_tglId($id)->getResultArray();
        
        

        $data = [
            'cuti' => $cuti,
            'cuti_tgl' => $cuti_tgl,
            'cuti_jumlah' => $cuti_jumlah,
            'validation' => \Config\Services::validation()
            // 'tanggal_cuti' => $tanggal_cuti
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/detail_cuti', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function download_dokumen($id){

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $berkas = $this->cuti_model;
        $data = $berkas->find($id);
        
        return $this->response->download('img/'.$data['gambar_sakit'], null);
    }


    public function add_cuti_start()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
        $cuti = $this->cuti_model->get_cuti();
        if(session()->get('user_level') == 'admin'){
            $karyawan = $this->karyawan_model->findAll();
        }elseif(session()->get('user_level') == 'user'){
            $branchId =  session()->get('branch_id');
            $karyawan = $this->karyawan_model->getKaryawanById($branchId)->getResultArray();
        }
        $branch = $this->branch_model->findAll();
        $position = $this->position_model->findAll();
        $mst_cuti = $this->mst_cuti_model->findAll();

        $data = [
            'cuti' => $cuti,
            'karyawan' => $karyawan,
            'branch' => $branch,
            'position' => $position,
            'mst_cuti' => $mst_cuti
        ];

        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/add_cuti_start', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function add_cuti()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
        $cuti = $this->cuti_model->get_cuti();
        $karyawan = $this->karyawan_model->findAll();
        $branch = $this->branch_model->findAll();
        $position = $this->position_model->findAll();
        $mst_cuti = $this->mst_cuti_model->findAll();

        $data = [
            'cuti' => $cuti,
            'karyawan' => $karyawan,
            'branch' => $branch,
            'position' => $position,
            'mst_cuti' => $mst_cuti
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/add_cuti', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }


    public function save_cuti_start()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }

        // $trn_date = $this->request->getVar('trn_date');
        // dd($trn_date);

        $karyawan = $this->karyawan_model->findAll();
        // $karyawan_id = $this->karyawan_model->getKaryawan_detail()->getRowArray();
        $mst_cuti = $this->mst_cuti_model->findAll();
        $position = $this->position_model->findAll();
        $branch = $this->branch_model->findAll();
        $nomorDokumen = $this->cuti_model->nomorDokumen();
        // dd($nomorDokumen);

         $s_employee_id = $this->request->getVar('employee_id');
        if ($s_employee_id != null) {
            $this->session->set('employee_id', $s_employee_id);
        } else {
            $s_employee_id = $this->session->get('employee_id');
        }
        $data['s_employee_id'] = $s_employee_id;

        $s_cuti_id = $this->request->getVar('cuti_id');
        if ($s_cuti_id != null) {
            $this->session->set('cuti_id', $s_cuti_id);
        } else {
            $s_cuti_id = $this->session->get('cuti_id');
        }
        $data['s_cuti_id'] = $s_cuti_id;

        $employee_name = $this->cuti_model->get_id_post_employee($s_employee_id)->getRow();
        $cuti_name = $this->cuti_model->get_id_post_cuti($s_cuti_id)->getRow();
        
        // dd($employee_name);
        $data = [
            // 'employee' => $employee,
            'employee_name' => $employee_name,
            'jenis_cuti' => $s_cuti_id,
            'mst_cuti' => $mst_cuti,
            'karyawan' => $karyawan,
            'position' => $position,
            'branch' => $branch,
            'cuti_name' => $cuti_name, 
            'nomorDokumen' => $nomorDokumen,
            'validation' => \Config\Services::validation()
            // 'karyawan_id' => $karyawan_id
        ]; 

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/add_cuti', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_cuti()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }

    //    $trn_date = $this->request->getVar('trn_date');
    //    dd($trn_date);

        $jumlah_cuti = $this->request->getVar('cuti_jumlah');
        $cuti_hak = $this->request->getVar('hak_cuti');
        $tgl_dari = $this->request->getVar('tgl_dari');
        $employee_id = $this->request->getVar('employee_id');
        $jenis_cuti = $this->request->getVar('cuti_id');
        $total = $this->cuti_model->count_jumlah_cuti($employee_id, $jenis_cuti, $tgl_dari)->getRow();

        if(!$this->validate([
            'tgl_dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],

            'tgl_sampai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],

            'gambar_sakit' => [
                'rules' => 'ext_in[gambar_sakit,png,jpg,gif]',
                'errors' => [
                    'ext_in' => 'file harus berupa gambar'
                ]
            ],

            'employee_id_buat' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih terlebih dahulu yang membuat'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih terlebih dahulu yang menyetujui'
                ]
            ],
        ])){
            session()->setFlashdata('pesan_error', 'Data gagal di tambahkan mohon kembali periksa inputan anda');
            return redirect()->to('trn_cuti/save_cuti_start')->withInput();
        }

        $file_gambar_sakit = $this->request->getFile('gambar_sakit');
        // dd($file_gambar_sakit);

        if($file_gambar_sakit->getError() == 4){
            $nama_gambar_sakit = null;
        }else{
            $nama_gambar_sakit = $file_gambar_sakit->getRandomName();
            // dd($nama_gambar_sakit);
            $file_gambar_sakit->move('img', $nama_gambar_sakit);
        }

        $total_cuti_ambil = $total->cuti_jumlah + $jumlah_cuti;

        if($total_cuti_ambil > $cuti_hak){
            session()->setFlashdata('pesan_error', 'Data Tidak terinput cuti Yang anda ambil melebihi hak cuti');
            return redirect()->to('trn_cuti/save_cuti_start');
        }else{
            $this->cuti_model->save([
                'trn_no' => $this->request->getVar('trn_no'),
                'trn_date' => $this->request->getVar('trn_date'),
                'employee_id_buat' => $this->request->getVar('employee_id_buat'),
                'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
                'employee_id' => $this->request->getVar('employee_id'),
                'position_id' => $this->request->getVar('position_id'),
                'branch_id' => $this->request->getVar('branch_id'),
                'cuti_id' => $this->request->getVar('cuti_id'),
                'cuti_desc' => $this->request->getVar('cuti_desc'),
                'cuti_jumlah' => $this->request->getVar('cuti_jumlah'),
                'tgl_dari' => $this->request->getVar('tgl_dari'),
                'tgl_sampai' => $this->request->getVar('tgl_sampai'),
                // 'periode' => $this->request->getVar('periode'),
                'hak_cuti' => $this->request->getVar('hak_cuti'),
                'serah_kerja' => $this->request->getVar('serah_kerja'),
                'alamat_cuti' => $this->request->getVar('alamat_cuti'),
                'gambar_sakit' => $nama_gambar_sakit
            ]);
            $cutiModel = $this->cuti_model;
            $trn_id = $cutiModel->insertID();
            session()->setFlashdata('pesan', 'Data berhasil disimpan');
            return redirect()->to('trn_cuti/detail_cuti/'.$trn_id);
        }

        
    }

    public function detail_data($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $cuti = $this->cuti_model->getIzin_id($id);

        $data = [
            'izin_modal' => $cuti
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/cuti_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function edit_cuti($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
        $cuti = $this->cuti_model->getCuti_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $branch = $this->branch_model->findAll();
        $position = $this->position_model->findAll();
        $mst_cuti = $this->mst_cuti_model->findAll();
        $data = [
            // 'employee_name' => $employee_name,
            'cuti' => $cuti,
            'karyawan' => $karyawan,
            'branch' => $branch,
            'position' => $position,
            'mst_cuti' => $mst_cuti,
            'validation' => \Config\Services::validation()
            // 'cuti_name' => $cuti_name
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/cuti/edit_cuti', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_cuti($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }

        if(!$this->validate([
            'tgl_dari' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],

            'tgl_sampai' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Tanggal harus diisi'
                ]
            ],

            'gambar_sakit' => [
                'rules' => 'ext_in[gambar_sakit,png,jpg,gif]',
                'errors' => [
                    'ext_in' => 'file harus berupa gambar'
                ]
            ],
        ])){
            session()->setFlashdata('pesan_error', 'Data gagal di tambahkan mohon kembali periksa inputan anda');
            return redirect()->to('trn_cuti/edit_cuti/'.$this->request->getVar('trn_id'))->withInput();
        }

        $cuti = $this->cuti_model->getCuti_id($id);
        $jumlah_cuti = $this->request->getVar('cuti_jumlah');
        $cuti_hak = $this->request->getVar('hak_cuti');
        $tgl_dari = $this->request->getVar('tgl_dari');
        $employee_id = $this->request->getVar('employee_id');
        $jenis_cuti = $cuti['cuti_id'];
        $total = $this->cuti_model->count_jumlah_cuti($employee_id, $jenis_cuti, $tgl_dari)->getRow();


        $file_gambar_sakit = $this->request->getFile('gambar_sakit');

        if($file_gambar_sakit->getError() == 4){
            $nama_gambar_sakit = $this->request->getVar('gambar_lama_sakit');
        }elseif($file_gambar_sakit->getError() == null){
            $nama_gambar_sakit = $file_gambar_sakit->getRandomName();
            $file_gambar_sakit->move('img', $nama_gambar_sakit);
        }else{
            $nama_gambar_sakit = $file_gambar_sakit->getRandomName();

            $file_gambar_sakit->move('img', $nama_gambar_sakit);
            unlink('img/'.$this->request->getVar('gambar_lama_sakit'));
        }

        $total_cuti_ambil = $total->cuti_jumlah + $jumlah_cuti;



        if($total_cuti_ambil > $cuti_hak){
            session()->setFlashdata('pesan_error', 'Data Tidak bisa di upate cuti Yang anda ambil melebihi hak cuti');
            return redirect()->to('trn_cuti/edit_cuti/'.$this->request->getVar('trn_id'));
        }else{

            $this->cuti_model->save([
                'trn_id' => $id,
                'trn_no' => $this->request->getVar('trn_no'),
                'trn_date' => $this->request->getVar('trn_date'),
                'employee_id_buat' => $this->request->getVar('employee_id_buat'),
                'employee_id_setuju' => $this->request->getVar('employee_id_setuju'),
                'employee_id' => $this->request->getVar('employee_id'),
                'position_id' => $this->request->getVar('position_id'),
                'branch_id' => $this->request->getVar('branch_id'),
                'cuti_id' => $this->request->getVar('cuti_id'),
                'cuti_desc' => $this->request->getVar('cuti_desc'),
                'cuti_jumlah' => $this->request->getVar('cuti_jumlah'),
                'tgl_dari' => $this->request->getVar('tgl_dari'),
                'tgl_sampai' => $this->request->getVar('tgl_sampai'),
                // 'periode' => $this->request->getVar('periode'),
                'hak_cuti' => $this->request->getVar('hak_cuti'),
                'serah_kerja' => $this->request->getVar('serah_kerja'),
                'alamat_cuti' => $this->request->getVar('alamat_cuti'),
                'gambar_sakit' => $nama_gambar_sakit
            ]);
            // $trn_id = $this->cuti_model->insertID($id);
            session()->setFlashdata('pesan', 'Data berhasil diedit');
            return redirect()->to('trn_cuti/index');
        }
    }

    public function delete_cuti($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
        // $this->cuti_model->delete($id);
        $this->cuti_model->delete_data($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('trn_cuti ');
    }

    public function tgl_generate($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $trn_id = $this->request->getVar('trn_id');
        $cuti_id = $this->request->getVar('cuti_id');
        $cuti_type = $this->request->getVar('cuti_type');

        // Variable that store the date interval
        // of period 1 day
        $interval = new \DateInterval('P1D');
        $realEnd = new \DateTime($this->request->getVar('end_date'));
        $realEnd->add($interval);
        $period = new \DatePeriod(new \DateTime($this->request->getVar('start_date')), $interval, $realEnd);
        
        $cek_generate = $this->cuti_model->check_generate($trn_id, $cuti_id, $cuti_type);


        if(isset($cek_generate) > 0){
           $this->cuti_model->hapus_tgl($trn_id, $cuti_id, $cuti_type);
        }

            foreach ($period as $date) {
                $tanggal = $date->format('Y-m-d');
    
                $data_date = [
                    'tgl_cuti' => $tanggal,
                    'trn_id' => $trn_id,
                    'cuti_id' => $cuti_id,
                    'cuti_type' => $cuti_type
                ];
                $this->trn_tgl_model->save($data_date);
        }

        session()->setFlashdata('pesan', 'Data berhasil digenerate');      
        return redirect()->to('trn_cuti/edit_cuti/'. $id);
    }

    public function tgl_generateDetail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        
        $trn_id = $this->request->getVar('trn_id');
        $cuti_id = $this->request->getVar('cuti_id');
        $cuti_type = $this->request->getVar('cuti_type');


        // Variable that store the date interval
        // of period 1 day
        $interval = new \DateInterval('P1D');
        $realEnd = new \DateTime($this->request->getVar('end_date'));
        $realEnd->add($interval);
        $period = new \DatePeriod(new \DateTime($this->request->getVar('start_date')), $interval, $realEnd);
        
        $cek_generate = $this->cuti_model->check_generate($trn_id, $cuti_id, $cuti_type);
        


        if(isset($cek_generate) > 0){
           $this->cuti_model->hapus_tgl($trn_id, $cuti_id, $cuti_type);
        }
       
            foreach ($period as $date) {

                $tanggal = $date->format('Y-m-d');
                $date_time = \DateTime::createFromFormat('Y-m-d', $tanggal);
                $minggu = $date_time->format('D');
               
                $tgl_libur = null;
                $data_libur = $this->libur_model->where(['tgl_libur' => $tanggal])->first();
                if ($data_libur != null) {
                    $tgl_libur = $data_libur['tgl_libur'];
                }
                
                
               
                $data_date = [
                    'tgl_cuti' => $tanggal,
                    'trn_id' => $trn_id,
                    'cuti_id' => $cuti_id,
                    'cuti_type' => $cuti_type,
                ];
              
                if ($minggu != "Sun") {
                    if ($tgl_libur == null) {
                        $this->trn_tgl_model->save($data_date);
                    }
                }
           
                
        }

        session()->setFlashdata('pesan', 'Tanggal berhasil digenerate');      
        return redirect()->to('trn_cuti/detail_cuti/'. $id);
    }

    public function add_tgl($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
        'tgl_cuti' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Tanggal harus diisi.'
            ]
        ]
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('error', 'Tanggal gagal disimpan');      
            return redirect()->to('trn_cuti/detail_cuti/'. $id)->withInput()->with('validation', $validation);
        }

        $tanggal = [
            'trn_id' => $this->request->getVar('trn_id'),
            'cuti_type' => $this->request->getVar('cuti_type'),
            'cuti_id' => $this->request->getVar('cuti_id'),
            'tgl_cuti' => $this->request->getVar('tgl_cuti')
        ];

        // dd($tanggal);

        $this->trn_tgl_model->save($tanggal);
        session()->setFlashdata('pesan', 'Tanggal berhasil disimpan');      
        return redirect()->to('trn_cuti/detail_cuti/'. $id);
        // dd($tanggal);
    }

    public function delete_tanggal($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->trn_tgl_model->delete($id);
        session()->setFlashdata('pesan', 'Tanggal berhasil dihapus disilahkan lihat detail kembali untuk memastikan');      
        return redirect()->to('trn_cuti/index/');

    }

    public function print_cuti($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $print = $this->cuti_model->get_cutiId($id);
        $employee_id = $print['employee_id'];
        $tahun = date("Y", strtotime($print['tgl_dari']));
        $tanggal = $print['tgl_dari'];
        $cuti_jumlah = $this->cuti_model->count_jumlah_cuti_id($employee_id, $tahun, $tanggal)->getRowArray();

        $data = [
            'cuti' => $print,
            'cuti_jumlah' => $cuti_jumlah
        ];     

        echo view('admin/templates/header');
        echo view('admin/cuti/print_cuti', $data);
      
    }

    public function pdf($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $print = $this->cuti_model->get_cutiId($id);

        $data = [
            'cuti' => $print
        ];
        echo view('admin/cuti/print_cuti', $data);

    }
    
}
