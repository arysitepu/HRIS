<?php

namespace App\Controllers;

use App\Models\Branch_model;
use App\Models\Users_model;


class Auth extends BaseController
{
    protected $user_model;
    protected $session;
    protected $branch_model;
    public function __construct()
    {
        $this->user_model = new Users_model();
        $this->session = session();
        $this->branch_model = new Branch_model();
    }
    public function login()
    {
        
        return view('/auth/login');
    }

    public function notAkses()
    {
        return view('auth/akses');
    }

    public function login_proces()
    {
     $data = $this->request->getVar();
     $user = $this->user_model->where('user_name', $data['username'])->first();
     if($user){
        // dd($user);
        if(!password_verify($data['password'], $user['user_password'])){
            session()->setFlashdata('password', 'Password salah');
            return redirect()->to('auth/login');
        }else{
            if($user['status_active'] == 1){
                $last_date_login = date('Y-m-d H:i:s');
                // $status = 1;
                $user_id = $user['user_id'];
                $update_user_login = [
                    'user_id' => $user_id,
                    'last_date_login' => $last_date_login,
                    // 'status_active' => $status
                ];
                // dd($update_user_login);
                $this->user_model->save($update_user_login);
    
                $sessLogin = [
                    'isLogin' => true,
                    'user_id' => $user['user_id'],
                    'username' => $user['user_name_full'],
                    'user_level' => $user['user_level'], 
                    'branch_id' => $user['branch_id'],
                    // 'status_active' => $user['status_active']
                ];
                // dd($sessLogin);
                session()->set($sessLogin);
                session()->setFlashdata('berhasil', 'berhasil masuk');
                return redirect()->to('/home/index');
            }else{
                session()->setFlashdata('username', 'Username sudah tidak active');
         return redirect()->to('/auth/login');
            }
        }
     }else{
         session()->setFlashdata('username', 'Username tidak ditemukan');
         return redirect()->to('/auth/login');
     }
        
     
    }

    public function logout()
    {
            $last_date_logout = date('Y-m-d H:i:s');
            // $status = 0;
            $user_id = session()->get('user_id');
            $update_user_logout = [
                'user_id' => $user_id,
                'last_date_logout' => $last_date_logout,
                // 'status_active' => $status
            ];
            // dd($update_user_logout);
            $this->user_model->save($update_user_logout);
            session()->destroy();
        
        return redirect()->to('/auth/login');
    }

    public function user()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        // $users = $this->user_model->orderBy('user_name', 'ASC')->findAll();
        $users = $this->user_model->getUsers()->getResultArray();
        $branches = $this->branch_model->orderBy('branch_name', 'ASC')->findAll();
        $data = [
            'users' => $users,
            'branches' => $branches,
            'validation' => \Config\Services::validation()
        ];
        // dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/user/list_user', $data);
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
            'user_name' => [
                'rules' => 'required|min_length[6]|max_length[15]|is_unique[mst_user.user_name]', 
                'errors' => [
                    'required' => 'username harus diisi',
                    'min_length' => 'username minimal 6 karakter',
                    'max_length' => 'username maksimal 15 karakter',
                    'is_unique' => 'username sudah digunakan'
                ]
            ],
            'user_name_full' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'user_email' => [
                'rules' => 'required|valid_email|is_unique[mst_user.user_email]', 
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'is_unique' => 'Email sudah digunakan'
                ]
            ],
            'branch_id' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih SBU terlebih dahulu'
                ]
            ],
            'user_password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password minimal 8 karakter.'
                ]
            ],
            'pass_confirm' => [
                'rules' => 'required|matches[user_password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi.',
                    'matches' => 'Konfirmasi password tidak sesuai dengan password.'
                ]
            ],
            'user_level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih level terlebih dahulu password harus diisi.',
                ]
            ],

        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal disimpan silahkan check inputan');
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        $user_name = $this->request->getVar('user_name');
        $user_name_full = $this->request->getVar('user_name_full');
        $user_email = $this->request->getVar('user_email');
        $branch_id = $this->request->getVar('branch_id');
        $user_password = password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT);
        $user_level = $this->request->getVar('user_level');
        $status_active = 1;
        $create_user = session()->get('user_id');

        $mst_user = [
            'user_name' => $user_name,
            'user_name_full' => $user_name_full,
            'user_email' => $user_email,
            'branch_id' => $branch_id,
            'user_password' => $user_password,
            'user_level' => $user_level,
            'status_active' => $status_active,
            'create_user' => $create_user
        ];
        $this->user_model->save($mst_user);
        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');
        return redirect()->back();
    }

    public function detail_user($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $user = $this->user_model->getUsersId($id);
        $data = [
            'user' => $user,
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/user/detail_user', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function edit_user($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $user = $this->user_model->getUsersId($id);
        $branches = $this->branch_model->orderBy('branch_name', 'ASC')->findAll();
        $data = [
            'user' => $user,
            'validation' => \Config\Services::validation(),
            'branches' => $branches
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/user/edit_user', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_user($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if(!$this->validate([
            'user_name' => [
                'rules' => 'required|min_length[6]|max_length[15]', 
                'errors' => [
                    'required' => 'username harus diisi',
                    'min_length' => 'username minimal 6 karakter',
                    'max_length' => 'username maksimal 15 karakter',
                ]
            ],
            'user_name_full' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Nama harus diisi'
                ]
            ],
            'user_email' => [
                'rules' => 'required|valid_email', 
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                ]
            ],
            'branch_id' => [
                'rules' => 'required', 
                'errors' => [
                    'required' => 'Silahkan pilih SBU terlebih dahulu'
                ]
            ],
            'user_level' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Silahkan Pilih level terlebih dahulu password harus diisi.',
                ]
            ],

        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal disimpan silahkan check inputan');
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        
        $user_name = $this->request->getVar('user_name');
        $user_name_full = $this->request->getVar('user_name_full');
        $user_email = $this->request->getVar('user_email');
        $branch_id = $this->request->getVar('branch_id');
        $user_level = $this->request->getVar('user_level');
        $status_active = $this->request->getVar('status_active');
        $create_user = session()->get('user_id');

        $mst_user = [
            'user_id' => $id,
            'user_name' => $user_name,
            'user_name_full' => $user_name_full,
            'user_email' => $user_email,
            'branch_id' => $branch_id,
            'user_level' => $user_level,
            'status_active' => $status_active,
            'create_user' => $create_user
        ];
        // dd($mst_user);
        $this->user_model->save($mst_user);
        session()->setFlashdata('pesan', 'Data berhasil diupdate');
        return redirect()->back();
    }

    public function change_password($id)
    {

        $user = $this->user_model->find($id);
        $data = [
            'user' => $user,
            'validation' => \Config\Services::validation(),
        ];
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/user/change_password', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_password($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if(!$this->validate([
            'user_password' => [
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'Password harus diisi.',
                    'min_length' => 'Password minimal 8 karakter.'
                ]
            ],
            'pass_confirm' => [
                'rules' => 'required|matches[user_password]',
                'errors' => [
                    'required' => 'Konfirmasi password harus diisi.',
                    'matches' => 'Konfirmasi password tidak sesuai dengan password.'
                ]
            ],
        ])){
            $validation = \Config\Services::validation();
            session()->setFlashdata('pesan_error', 'Data gagal disimpan silahkan check inputan');
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        $user = $this->user_model->find($id);
        $user_name = $user['user_name'];
        $user_name_full = $user['user_name_full'];
        $user_email = $user['user_email'];
        $branch_id = $user['branch_id'];
        $user_level = $user['user_level'];
        $user_password = password_hash($this->request->getVar('user_password'), PASSWORD_DEFAULT);
        $status_active = $user['status_active'];
        $create_user = session()->get('user_id');

        $mst_user = [
            'user_id' => $id,
            'user_name' => $user_name,
            'user_name_full' => $user_name_full,
            'user_email' => $user_email,
            'branch_id' => $branch_id,
            'user_level' => $user_level,
            'user_password' => $user_password,
            'status_active' => $status_active,
            'create_user' => $create_user
        ];
        // dd($mst_user);
        $this->user_model->save($mst_user);
        session()->setFlashdata('pesan', 'Password berhasil diubah');
        return redirect()->to('auth/edit_user/'.$user['user_id']);

    }

    public function delete_user($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
        $this->user_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->back();
    }

    
}
