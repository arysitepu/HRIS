<?php 

namespace App\Controllers;
use App\Models\Mst_facility_model;
use App\Models\MstType_model;
use App\Models\Trn_fasilitas_det_model;
use App\Models\Trn_fasilitas_model;

class Fasilitas_det extends BaseController{

    protected $mst_fasilitas_model;
    protected $type_model;
    protected $fasilitas_det_model;
    protected $fasilitas_model;
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->mst_fasilitas_model = new Mst_facility_model();
        $this->type_model = new MstType_model();
        $this->fasilitas_det_model = new Trn_fasilitas_det_model();
        $this->fasilitas_model = new Trn_fasilitas_model();
    }

    public function add_fasilitas_det($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }
            
        $mst_fasilitas = $this->mst_fasilitas_model->findAll();
        $type = $this->type_model->findAll();
        $fasilitas_det = $this->fasilitas_det_model->getFasilitas_det_id($id);
        $fasilitas = $this->fasilitas_model->getFasilitas_id($id);
        

    $data = [
        'mst_fasilitas' => $mst_fasilitas,
        'type' => $type,
        'fasilitas_det' => $fasilitas_det,
        'fasilitas' => $fasilitas,
        'validation' => \Config\Services::validation()
    ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/fasilitas_det/add_fasilitas_det', $data);
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


        if(!$this->validate([
            'qty' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Qty harus diisi'
                ]
              ],

              'facility_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis fasilitas terlebih dahulu'
                ]
              ],

              'kegunaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kegunaan harus diisi'
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
                session()->setFlashdata('error', 'Data gagal diinput silahkan perbaiki inputan anda');
                return redirect()->back()->withInput();
            }


        $trn_id      = $this->request->getVar('trn_id');
        $facility_id = $this->request->getVar('facility_id');
        $qty         = $this->request->getVar('qty');
        $kegunaan    = $this->request->getVar('kegunaan');
        $file_gambar = $this->request->getFile('gambar');
        if($file_gambar->getError() == 4){
            $nama_gambar = 'Default.jpg';
        }else{
            $nama_gambar = $file_gambar->getRandomName();
            $file_gambar->move('img', $nama_gambar);
        }

        $facility_detail = [
            'trn_id'      => $trn_id,
            'facility_id' => $facility_id,
            'qty'         => $qty,
            'kegunaan'    => $kegunaan,
            'gambar'      => $nama_gambar
        ];
        // dd($facility_detail);

        $this->fasilitas_det_model->save($facility_detail);

        session()->setFlashdata('pesan', 'Data Berhasil di tambahkan silahkan lihat detail');
        return redirect()->back();
    }

    public function getFacilityCode()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if($this->request->isAJAX()){
            $facility_id = $this->request->getVar('facility_id');
            $fasilitas = $this->mst_fasilitas_model->find($facility_id);
            if ($fasilitas) {
                return $this->response->setJSON($fasilitas);
            } else {
                return $this->response->setJSON(['error' => 'Fasilitas tidak ditemukan']);
            }
        }
    }

    public function edit_fasilitas_det($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $mst_fasilitas = $this->mst_fasilitas_model->findAll();
        $type = $this->type_model->findAll();
        // $fasilitas_det = $this->fasilitas_det_model->getFasilitas_det_id($id);
        $fasilitas_detail = $this->fasilitas_det_model->getFasilitas_detail_id($id);
        // $fasilitas = $this->fasilitas_model->getFasilitas_id($id);

        $data = [
            'mst_fasilitas' => $mst_fasilitas,
            'type' => $type,
            // 'fasilitas_det' => $fasilitas_det,
            // 'fasilitas' => $fasilitas,
            'fasilitas_detail' => $fasilitas_detail,
            'validation' => \Config\Services::validation()
        ];

//   dd($data);

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/fasilitas_det/edit_fasilitas_det', $data);
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

        if(!$this->validate([
            'qty' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Qty harus diisi'
                ]
              ],

              'facility_id' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Pilih jenis fasilitas terlebih dahulu'
                ]
              ],

              'kegunaan' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'kegunaan harus diisi'
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
                session()->setFlashdata('error', 'Data gagal diinput silahkan perbaiki inputan anda');
                return redirect()->back()->withInput();
            }

        
        $trn_id      = $this->request->getVar('trn_id');
        $facility_id = $this->request->getVar('facility_id');
        $qty         = $this->request->getVar('qty');
        $kegunaan    = $this->request->getVar('kegunaan');
        $file_gambar = $this->request->getFile('gambar');
        // dd($file_gambar);
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

        $facility_detail = [
            'id' => $id,
            'trn_id'      => $trn_id,
            'facility_id' => $facility_id,
            'qty'         => $qty,
            'kegunaan'    => $kegunaan,
            'gambar'      => $nama_gambar
        ];

        // dd($facility_detail);

        $this->fasilitas_det_model->save($facility_detail);

        session()->setFlashdata('pesan', 'Data Berhasil diubah');
        return redirect()->back();

    }

    public function detail_facility_user($id)
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        // if($this->session->get('user_level') != 'admin'){
        //     session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        //     return redirect()->to('auth/notAkses');
        // }
        $fasilitas_detail = $this->fasilitas_det_model->getFasilitas_detail_id($id);
        $data = [
            'fasilitas_detail' => $fasilitas_detail
        ];
    //    dd($data);
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/trn_fasilitas/fasilitas_det/detail_fasilitas_user', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function delete_fasilitas_det($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $this->fasilitas_det_model->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->back();
    }

}