<?php

namespace App\Controllers;

use App\Models\Branch_model;
use App\Models\Jaminan_model;
use App\Models\Karyawan_model;
use App\Models\MstType_model;
use Dompdf\Dompdf;
use App\Models\Formula_model;

class Jaminan extends BaseController
{
    protected $jaminan_model;
    protected $karyawan_model;
    protected $type_model;
    protected $formula_model;
    protected $session;
    protected $branch_model;

    public function __construct()
    {
        $this->session = session();
        $this->jaminan_model = new Jaminan_model();
        $this->karyawan_model = new Karyawan_model();
        $this->type_model = new MstType_model();
        $this->formula_model = new Formula_model();
        $this->branch_model = new Branch_model();
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
        $tahun = $this->request->getVar('tahun');
        $branch_id = $this->request->getVar('branch_id');
        $bulan = $this->request->getVar('bulan');
        $tanggal = $this->request->getVar('tanggal');
        $nama = $this->request->getVar('nama');
       
        if($tanggal || $branch_id ||$bulan || $tahun || $nama ){
            $jaminan = $this->jaminan_model->search($nama, $tanggal, $bulan, $tahun, $branch_id);
            $branch = $this->branch_model->findAll();
            $jumlah_jaminan = $this->jaminan_model->count_search($nama, $tanggal, $bulan, $tahun, $branch_id);
            // dd($jumlah_jaminan);
            $pager = $this->jaminan_model->pager;
        }else{
            $jaminan = $this->jaminan_model->getJaminan();
            $branch = $this->branch_model->findAll();
            $pager = $this->jaminan_model->pager;
            $jumlah_jaminan = null;
        }
        
        $data = [
            
            'jaminan' => $jaminan,
            'branch' => $branch,
            'pager' => $pager,
            'jumlah_jaminan' => $jumlah_jaminan,
            'nomor' => nomor($this->request->getVar('page'), 5), 
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/jaminan/jaminan_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function detail($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        } 

        $jaminan =  $this->jaminan_model->getJaminan_id($id);
        $type = $this->jaminan_model->getJaminan_id($id);

        $data = [
            'jaminan' => $jaminan,
            'type' => $type
        ];

       

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        
        echo view('admin/jaminan/detail_jaminan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        
        echo view('admin/templates/modal');
      
    }    

    public function print_jaminan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        } 

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $data = [
            'jaminan' => $this->jaminan_model->getJaminan_id($id)
        ];

        echo view('admin/templates/header');
        
        
        echo view('admin/jaminan/print_detail', $data);
        echo view('admin/templates/js');
    }   

    public function add_jaminan()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $nomorDokumen = $this->jaminan_model->nomorDokumen();
        $jaminan = $this->jaminan_model->getJaminan();
        $karyawan = $this->karyawan_model->findAll();
        $type = $this->type_model->findAll();
        $formula = $this->formula_model->getFormula();

        $data = [
            'jaminan' => $jaminan,
            'karyawan' => $karyawan,
            'type' => $type,
            'formula' => $formula,
            'nomordokumen' => $nomorDokumen,
            'nomor' =>  nomor($this->request->getVar('page'), 5),
            'validation' => \Config\Services::validation()
        ];
        
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        
        echo view('admin/jaminan/add_jaminan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        
        echo view('admin/templates/modal');
    }

    public function save_jaminan()
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
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ], 

            'employee_id_buat' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'jaminan_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Isi nama jaminan terlebih dahulu'
                ]
            ],

            'type_id' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama jaminan'
                ]
            ],

            'gambar' => [
                'rules' => 'uploaded[gambar]|max_size[gambar,3072]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'uploaded' => 'Silahkan upload gambar terlebih dahulu',
                    'max_size' => 'Ukuran gambar maksimal 3MB',
                    'is_image' => 'File yang diupload harus gambar',
                    'mime_in' => 'Format gambar harus jpg, jpeg, gif, atau png'
                ]
              ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Upsss data tidak terinput ada yang salah. . .');
            return redirect()->to('jaminan/add_jaminan')->withInput('validation', $validation);
        }

        $trn_no =  $this->request->getVar('trn_no');
        $trn_date =  date('Y-m-d');
        $employee_id_buat =  $this->request->getVar('employee_id_buat');
        $employee_id_setuju =  $this->request->getVar('employee_id_setuju');
        $employee_id =  $this->request->getVar('employee_id');
        $type_id =  $this->request->getVar('type_id');
        $jaminan_name =  $this->request->getVar('jaminan_name');
        $jaminan_desc =  $this->request->getVar('jaminan_desc');
        $tgl_serah =  $this->request->getVar('tgl_serah');
        $status =  $this->request->getVar('status');
        $file_gambar =  $this->request->getFile('gambar');
        if($file_gambar->getError() == 4){
            $nama_gambar = 'Default.jpg';
        }else{
            $nama_gambar = $file_gambar->getRandomName();
            $file_gambar->move('img', $nama_gambar);
        }
        $jaminan = [
            'trn_no' => $trn_no,
            'trn_date' => $trn_date,
            'employee_id_buat' => $employee_id_buat,
            'employee_id_setuju' => $employee_id_setuju,
            'employee_id' => $employee_id,
            'type_id' => $type_id,
            'jaminan_name' => $jaminan_name,
            'jaminan_desc' => $jaminan_desc,
            'tgl_serah' => $tgl_serah,
            'status' => $status,
            'gambar' => $nama_gambar
        ];

        // dd($jaminan);

        $this->jaminan_model->save($jaminan);

        session()->setFlashdata('pesan', 'Data berhasil disimpan');
        return redirect()->to('jaminan/index');
    }

    public function edit_jaminan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $jaminan = $this->jaminan_model->getJaminan_id($id);
        $karyawan = $this->karyawan_model->findAll();
        $type = $this->type_model->findAll();

        $data = [
            'jaminan' => $jaminan,
            'karyawan' => $karyawan,
            'type' => $type,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        
        echo view('admin/jaminan/edit_jaminan', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        
        echo view('admin/templates/modal');
    }

    public function update_jaminan($id)
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
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ], 

            'employee_id_buat' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'employee_id_setuju' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama karyawan'
                ]
            ],

            'jaminan_name' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Isi nama jaminan terlebih dahulu'
                ]
            ],

            'type_id' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih nama jaminan'
                ]
            ],

            'gambar' => [
                'rules' => 'max_size[gambar,3072]|is_image[gambar]|mime_in[gambar,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'max_size' => 'Ukuran gambar maksimal 3MB',
                    'is_image' => 'File yang diupload harus gambar',
                    'mime_in' => 'Format gambar harus jpg, jpeg, gif, atau png'
                ]
              ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Upsss data tidak terinput ada yang salah. . .');
            return redirect()->back()->withInput('validation', $validation);
        }


        $trn_no =  $this->request->getVar('trn_no');
        $trn_date =  date('Y-m-d');
        $employee_id_buat =  $this->request->getVar('employee_id_buat');
        $employee_id_setuju =  $this->request->getVar('employee_id_setuju');
        $employee_id =  $this->request->getVar('employee_id');
        $type_id =  $this->request->getVar('type_id');
        $jaminan_name =  $this->request->getVar('jaminan_name');
        $jaminan_desc =  $this->request->getVar('jaminan_desc');
        $tgl_serah =  $this->request->getVar('tgl_serah');
        $status =  $this->request->getVar('status');
        $file_gambar =  $this->request->getFile('gambar');
        if($file_gambar->getError() == 4){
            $nama_gambar = $this->request->getVar('gambar_lama');
        }elseif($file_gambar->getError() == null){
            $nama_gambar = $file_gambar->getRandomName();
            $file_gambar->move('img', $nama_gambar);
        }else{
            $nama_gambar = $file_gambar->getRandomName();
            $file_gambar->move('img', $nama_gambar);
            unlink('img/' . $this->request->getVar('gambar_lama'));
        }
        $jaminan = [
            'trn_id' => $id,
            'trn_no' => $trn_no,
            'trn_date' => $trn_date,
            'employee_id_buat' => $employee_id_buat,
            'employee_id_setuju' => $employee_id_setuju,
            'employee_id' => $employee_id,
            'type_id' => $type_id,
            'jaminan_name' => $jaminan_name,
            'jaminan_desc' => $jaminan_desc,
            'tgl_serah' => $tgl_serah,
            'status' => $status,
            'gambar' => $nama_gambar
        ];

        // dd($jaminan);
        $this->jaminan_model->save($jaminan);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->back();
    }

    public function delete_jaminan($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->jaminan_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/jaminan');
    }

    public function printPDF()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $jaminan = $this->jaminan_model->getJaminan()->getResult();
        $data = [
            'jaminan' => $jaminan
        ];
        $html = view('admin/print_pdf', $data);
            // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();
    }
    
    public function print_list_jaminan()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $tahun = $this->request->getVar('tahun');
        $branch_id = $this->request->getVar('branch_id');
        $bulan = $this->request->getVar('bulan');
        $tanggal = $this->request->getVar('tanggal');
        $nama = $this->request->getVar('nama');
        $sbu = $this->branch_model->find($branch_id) ;
       
        if($tanggal || $branch_id ||$bulan || $tahun || $nama ){
            $jaminan = $this->jaminan_model->search_print($nama, $tanggal, $bulan, $tahun, $branch_id)->getResultArray();
            $branch = $this->branch_model->findAll();
            $branch_name = $sbu;
            // dd($branch_name);
            // $branch_name = $this->jaminan_model->search($nama, $tanggal, $bulan, $tahun, $branch_id);
            $jumlah_jaminan = $this->jaminan_model->count_search($nama, $tanggal, $bulan, $tahun, $branch_id);
            // dd($jumlah_jaminan);
           
        }else{
            $jaminan = $this->jaminan_model->getJaminan();
            $branch = $this->branch_model->findAll();
            $jumlah_jaminan = null;
            $branch_name['branch_name'] = null;
        }
        
        
        $data = [
            
            'jaminan' => $jaminan,
            'branch' => $branch,
            'branch_name' => $branch_name,
            'jumlah_jaminan' => $jumlah_jaminan
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/jaminan/print_list_jaminan', $data);
        echo view('admin/templates/js');
    }

    public function export_excel()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $tahun = $this->request->getVar('tahun');
        $branch_id = $this->request->getVar('branch_id');
        $bulan = $this->request->getVar('bulan');
        $tanggal = $this->request->getVar('tanggal');
        $nama = $this->request->getVar('nama');
        $sbu = $this->branch_model->find($branch_id) ;

        if($tanggal || $branch_id ||$bulan || $tahun || $nama ){
            $jaminan = $this->jaminan_model->search_print($nama, $tanggal, $bulan, $tahun, $branch_id)->getResultArray();
            $branch = $this->branch_model->findAll();
            $branch_name = $sbu;
            // dd($branch_name);
            // $branch_name = $this->jaminan_model->search($nama, $tanggal, $bulan, $tahun, $branch_id);
            $jumlah_jaminan = $this->jaminan_model->count_search($nama, $tanggal, $bulan, $tahun, $branch_id);
            // dd($jumlah_jaminan);
           
        }else{
            $jaminan = $this->jaminan_model->getJaminan();
            $branch = $this->branch_model->findAll();
            $jumlah_jaminan = null;
            $branch_name['branch_name'] = null;
        }
        
        $data = [
            'jaminan' => $jaminan,
            'branch' => $branch,
            'branch_name' => $branch_name,
            'jumlah_jaminan' => $jumlah_jaminan
        ];
        
        echo view('admin/templates/header');
        echo view('admin/jaminan/print_excel', $data);
        echo view('admin/templates/js');
    }
   

}
