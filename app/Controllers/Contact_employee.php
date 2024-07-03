<?php

namespace App\Controllers;

use App\Models\Contact_model;
use App\Models\Karyawan_model;
use App\Models\Kecamatan_model;


class Contact_employee extends BaseController{

protected $contact_model;
protected $karyawan_model;
protected $kecamatan_model;
protected $session;

public function __construct()
{
    $this->session = session();
    $this->contact_model = new Contact_model();
    $this->karyawan_model = new Karyawan_model();
    $this->kecamatan_model = new Kecamatan_model();
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
        $contact = $this->contact_model->search($keyword);
        $pager = $this->contact_model->pager;
    }else{
        $contact = $this->contact_model->getContact_employee();
        $pager = $this->contact_model->pager;
    }

    $data = [
        'contact' => $contact,
        'pager' => $pager,
        'nomor' =>  nomor($this->request->getVar('page'), 5)

    ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/master/contact/contact_list', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
}

public function detail_contact($id)
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    $contact = $this->contact_model->getContact_id($id);
    $karyawan = $this->karyawan_model->getKaryawan_id($id);
    
    $data = [
        'contact' => $contact,
        'karyawan' => $karyawan
    ];
    
    echo view('admin/templates/header');
    echo view('admin/templates/sidebar');
    echo view('admin/templates/topbar');
    echo view('admin/master/contact/detail_contact', $data);
    echo view('admin/templates/js');
    echo view('admin/templates/footer');
    echo view('admin/templates/modal');
}

public function add_contact()
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    if($this->session->get('user_level') != 'admin'){
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }
    $contact = $this->contact_model->getContact_employee();
    $karyawan = $this->karyawan_model->findAll();
    $kecamatan = $this->kecamatan_model->findAll();

    $data = [
        'contact' => $contact,
        'karyawan' => $karyawan,
        'kecamatan' => $kecamatan,
        'validation' => \Config\Services::validation()
    ];
    
    echo view('admin/templates/header');
    echo view('admin/templates/sidebar');
    echo view('admin/templates/topbar');
    echo view('admin/master/contact/add_contact', $data);
    echo view('admin/templates/js');
    echo view('admin/templates/footer');
    echo view('admin/templates/modal');

}

public function save_contact()
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
            'errors' =>[
                'required' => 'Nama karyawan harus diisi'
                ]
            ],

            'contact_name' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama contact harus diisi'
                    ]
                ],

           'contact_type' => [
               'rules' => 'required',
               'errors' =>[
                   'required' => 'Silahkan pilih tipe contact terlebih dahulu'
               ]
            ],

            'jenis_kelamin' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih jenis kelamin terlebih dahulu'
                ]
            ],
    ])){
        $validation = \Config\Services::validation();
        return redirect()->to('contact_employee/add_contact')->withInput('validation', $validation);
    }

     $this->contact_model->save([
         'employee_id' => $this->request->getVar('employee_id'),
         'contact_type' => $this->request->getVar('contact_type'),
         'contact_name' => $this->request->getVar('contact_name'),
         'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
         'lahir_tempat' => $this->request->getVar('lahir_tempat'),
         'lahir_tanggal' => $this->request->getVar('lahir_tanggal'),
         'pekerjaan' => $this->request->getVar('pekerjaan'),
         'no_tlp' => $this->request->getVar('no_tlp'),
         'no_tlp2' => $this->request->getVar('no_tlp2'),
         'alamat_tinggal' => $this->request->getVar('alamat_tinggal'),
         'kecamatan_id' => $this->request->getVar('kecamatan_id')
     ]);

     session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
     return redirect()->to('contact_employee/index');
}

public function edit_contact($id)
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    if($this->session->get('user_level') != 'admin'){
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }
  $contact = $this->contact_model->getContact_id($id);
  $karyawan = $this->karyawan_model->findAll();
  $kecamatan = $this->kecamatan_model->findAll();

  $data = [
      'contact' => $contact,
      'karyawan' => $karyawan,
      'kecamatan' => $kecamatan,
      'validation' => \Config\Services::validation()
  ];
// dd($data);

    echo view('admin/templates/header');    
    echo view('admin/templates/sidebar');
    echo view('admin/templates/topbar');
    echo view('admin/master/contact/edit_contact_employee', $data);
    echo view('admin/templates/js');
    echo view('admin/templates/footer');
    echo view('admin/templates/modal');
  
}

public function update_contact($id)
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
            'errors' =>[
                'required' => 'Nama karyawan harus diisi'
                ]
            ],

            'contact_name' => [
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Nama contact harus diisi'
                    ]
                ],

           'contact_type' => [
               'rules' => 'required',
               'errors' =>[
                   'required' => 'Silahkan pilih tipe contact terlebih dahulu'
               ]
            ],

            'jenis_kelamin' =>[
                'rules' => 'required',
                'errors' =>[
                    'required' => 'Silahkan pilih jenis kelamin terlebih dahulu'
                ]
            ],
    ])){
        $validation = \Config\Services::validation();
        return redirect()->to('contact_employee/edit_contact/'.$this->request->getVar('id'))->withInput('validation', $validation);
    }


    $this->contact_model->save([
        'id' => $id,
        'employee_id' => $this->request->getVar('employee_id'),
        'contact_type' => $this->request->getVar('contact_type'),
        'contact_name' => $this->request->getVar('contact_name'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'lahir_tempat' => $this->request->getVar('lahir_tempat'),
        'lahir_tanggal' => $this->request->getVar('lahir_tanggal'),
        'pekerjaan' => $this->request->getVar('pekerjaan'),
        'no_tlp' => $this->request->getVar('no_tlp'),
        'no_tlp2' => $this->request->getVar('no_tlp2'),
        'alamat_tinggal' => $this->request->getVar('alamat_tinggal'),
        'kecamatan_id' => $this->request->getVar('kecamatan_id')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil diubah');
    return redirect()->to('contact_employee/index');
}

public function delete_contact($id)
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    if($this->session->get('user_level') != 'admin'){
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }
    $this->contact_model->delete($id);

    session()->setFlashdata('pesan', 'Data berhasil dihapus');
    return redirect()->to('/contact_employee');
}

public function detail_employee($id)
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    if($this->session->get('user_level') != 'admin'){
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }
    $karyawan = $this->karyawan_model->getKaryawan_id($id);
    $contact = $this->contact_model->getContact_id($id);
    $data = [
        'karyawan' => $karyawan,
        'contact' => $contact
    ];

    echo view('admin/templates/header');    
    echo view('admin/templates/sidebar');
    echo view('admin/templates/topbar');
    echo view('admin/master/detail_karyawan', $data);
    echo view('admin/templates/js');
    echo view('admin/templates/footer');
    echo view('admin/templates/modal');
  
}

public function add_contact_id($id)
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    if($this->session->get('user_level') != 'admin'){
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }
    $karyawan = $this->karyawan_model->getKaryawan_id($id);
    $contact = $this->contact_model->getContact_employee();
    $kecamatan = $this->kecamatan_model->findAll();

    $data = [
        'contact' => $contact,
        'karyawan' => $karyawan,
        'kecamatan' => $kecamatan
    ];

    echo view('admin/templates/header');    
    echo view('admin/templates/sidebar');
    echo view('admin/templates/topbar');
    echo view('admin/master/contact/add_contact_id', $data);
    echo view('admin/templates/js');
    echo view('admin/templates/footer');
    echo view('admin/templates/modal');
}

public function save_contact_id()
{
    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

    if($this->session->get('user_level') != 'admin'){
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }
    
    $this->contact_model->save([
        'employee_id' => $this->request->getVar('employee_id'),
        'contact_type' => $this->request->getVar('contact_type'),
        'contact_name' => $this->request->getVar('contact_name'),
        'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
        'lahir_tempat' => $this->request->getVar('lahir_tempat'),
        'lahir_tanggal' => $this->request->getVar('lahir_tanggal'),
        'pekerjaan' => $this->request->getVar('pekerjaan'),
        'no_tlp' => $this->request->getVar('no_tlp'),
        'no_tlp2' => $this->request->getVar('no_tlp2'),
        'alamat_tinggal' => $this->request->getVar('alamat_tinggal'),
        'kecamatan_id' => $this->request->getVar('kecamatan_id')
    ]);

    session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
    return redirect()->to('karyawan/index');
}


}
