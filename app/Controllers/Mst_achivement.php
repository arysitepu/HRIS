<?php 

namespace App\Controllers;

use App\Models\Mst_achivement_model;

class Mst_achivement extends BaseController{

    protected $mst_achivement_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();

        $this->mst_achivement_model = new Mst_achivement_model();
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

        $mst_achivement = $this->mst_achivement_model->getMstAchivement();
        $pager = $this->mst_achivement_model->pager;
        $data = [
            'mst_achivement' => $mst_achivement, 
            'pager' => $pager,
            'nomor' => nomor($this->request->getVar('page'), 5),
            'validation' => \Config\Services::validation()
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/achive/achive_list', $data);
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
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ]
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal ditambahkan ada yang salah');
            return redirect()->to('/mst_achivement/index')->withInput('validation', $validation);
        }

        $achivement_name = $this->request->getVar('name');

        $this->mst_achivement_model->save([
            'name' => $achivement_name
        ]);

       session()->setFlashdata('pesan', 'Data berhasil di tambahkan');
       return redirect()->to('/mst_achivement/index');
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

        $mst_achivement = $this->mst_achivement_model->getAchivementId($id);

        $data = [
            'mst_achivement' => $mst_achivement
        ];

        // dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/achive/edit_achive', $data);
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
        $achivement_name = $this->request->getVar('name_achivement');
        // dd($achivement_name);

        $this->mst_achivement_model->save([
            'id_achive' => $id,
            'name' => $achivement_name, 
        ]);

       session()->setFlashdata('pesan', 'Data berhasil di update');
       return redirect()->to('/mst_achivement/index');
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
        $this->mst_achivement_model->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil di hapus');
       return redirect()->to('mst_achivement');
    }

}