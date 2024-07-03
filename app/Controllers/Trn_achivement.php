<?php 

namespace App\Controllers;

use App\Models\Branch_model;
use App\Models\Mst_achivement_model;
use App\Models\Trn_achivement_model;
use App\Models\Karyawan_model;



class Trn_achivement extends BaseController{

    protected $trn_achivement_model;
    protected $mst_achivement_model;
    protected $karyawan_model;
    protected $session;
    protected $branch_model;

    public function __construct()
    {
        $this->session = session();
        $this->trn_achivement_model = new Trn_achivement_model();
        $this->mst_achivement_model = new Mst_achivement_model();
        $this->karyawan_model = new Karyawan_model();
        $this->branch_model = new Branch_model();
    }

    public function index(){

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

            $mst_achivement = $this->mst_achivement_model->findAll();
            $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->findAll();
            $branch = $this->branch_model->findAll();
            $achivement = $this->trn_achivement_model->getTrnAchivement();
            $pager = $this->trn_achivement_model->pager;


        $data = [
            'achivement' => $achivement,
            'mst_achivement' => $mst_achivement, 
            'karyawan' => $karyawan,
            'branch' => $branch,
            'validation' => \Config\Services::validation(),
            'pager' => $pager,
            'nomor' => nomor($this->request->getVar('page'), 5)
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/achive/list_achive', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function search()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $nama = $this->request->getVar('nama');
        $branch_id = $this->request->getVar('branch_id');

        if($nama ||  $branch_id){
            $achivement = $this->trn_achivement_model->search($nama, $branch_id);
            $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->findAll();
            $branch = $this->branch_model->findAll();
            $mst_achivement = $this->mst_achivement_model->findAll();
            $pager = $this->trn_achivement_model->pager;
        }else{

            $mst_achivement = $this->mst_achivement_model->findAll();
            $karyawan = $this->karyawan_model->orderBy('employee_name', 'ASC')->findAll();
            $branch = $this->branch_model->findAll();
            $achivement = $this->trn_achivement_model->getTrnAchivement();
            $pager = $this->trn_achivement_model->pager;
        }

        $data = [
            'achivement' => $achivement,
            'mst_achivement' => $mst_achivement, 
            'karyawan' => $karyawan,
            'branch' => $branch,
            'validation' => \Config\Services::validation(),
            'pager' => $pager,
            'nomor' => nomor($this->request->getVar('page'), 5)
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/achive/list_achive', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');

    }

    public function save()
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
                    'required' => 'silahkan pilih karyawan terlebih dahulu'
                ]
            ],

                'id_achive' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'silahkan pilih achivement terlebih dahulu'
                    ]
                ],
                'tahun_terima' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'tahun terima harus diisi'
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
            session()->setFlashdata('pesan_error', 'data gagal diinput silahkan check inputan anda');
            return redirect()->to('trn_achivement/index')->withInput('validation', $validation);
        }

        $employee_id = $this->request->getVar('employee_id');
        $id_achive = $this->request->getVar('id_achive');
        $tahun_terima = $this->request->getVar('tahun_terima');
        $file_gambar = $this->request->getFile('gambar');
        if($file_gambar->getError() == 4){
            $nama_gambar = 'Default.jpg';
        }else{
            $nama_gambar = $file_gambar->getRandomName();
            $file_gambar->move('img', $nama_gambar);
        }

        $achivement = [
            'employee_id' => $employee_id,
            'id_achive' => $id_achive,
            'tahun_terima' => $tahun_terima,
            'gambar'      => $nama_gambar
        ];
        // dd($achivement);
        $this->trn_achivement_model->save($achivement);

        session()->setFlashdata('pesan', 'data berhasil ditambahakan');
        return redirect()->to('trn_achivement/index');  
    }

    public function edit($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }


        $achivement = $this->trn_achivement_model->getAchivementId($id);
        $mst_achivement = $this->mst_achivement_model->findAll();
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'achivement' => $achivement,
            'mst_achivement' => $mst_achivement, 
            'karyawan' => $karyawan,
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/achive/edit_achive', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update($id)
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
                    'required' => 'silahkan pilih karyawan terlebih dahulu'
                ]
            ],

                'id_achive' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'silahkan pilih achivement terlebih dahulu'
                    ]
                ],

                
                'tahun_terima' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'tahun terima harus diisi'
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
            session()->setFlashdata('pesan_error', 'data gagal diinput silahkan check inputan anda');
            return redirect()->back()->withInput('validation', $validation);
        }

        $employee_id = $this->request->getVar('employee_id');
        $id_achive = $this->request->getVar('id_achive');
        $tahun_terima = $this->request->getVar('tahun_terima');
        $file_gambar = $this->request->getFile('gambar');
      
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

        $achivement = [
            'trn_id' => $id,
            'employee_id' => $employee_id,
            'id_achive' => $id_achive,
            'tahun_terima' => $tahun_terima,
            'gambar'      => $nama_gambar
        ];
        // dd($achivement);
        $this->trn_achivement_model->save($achivement);

        
        session()->setFlashdata('pesan', 'data berhasil diupdate');
        return redirect()->back();  
    }

    public function detail($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }

        $achivement = $this->trn_achivement_model->getAchivementId($id);
        $mst_achivement = $this->mst_achivement_model->findAll();
        $karyawan = $this->karyawan_model->findAll();

        $data = [
            'achivement' => $achivement,
            'mst_achivement' => $mst_achivement, 
            'karyawan' => $karyawan,
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/achive/detail_achive', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function delete_achivement($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->trn_achivement_model->delete($id);
        session()->setFlashdata('pesan', 'data berhasil dihapus');
        return redirect()->to('/trn_achivement');
    }

}