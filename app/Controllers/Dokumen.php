<?php 

namespace App\Controllers;
use App\Models\Dokumen_model;

class Dokumen extends BaseController{

    protected $dokumen_model;
    protected $session;

    public function __construct()
    {
        $this->dokumen_model = new Dokumen_model();
        $this->session = session();
    }

    public function index()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $keyword = $this->request->getVar('keyword');

        if($keyword){
            $dokumen = $this->dokumen_model->search($keyword); 
            $jumlah_dokumen = $this->dokumen_model->count_search($keyword);
            $pager = $this->dokumen_model->pager;

        }else{

            $dokumen = $this->dokumen_model->getDokumen();
            $jumlah_dokumen = $this->dokumen_model->jumlah_dokumen();
            $pager = $this->dokumen_model->pager;
        }

        

        $data = [
            'dokumen' => $dokumen,
            'validation' => \Config\Services::validation(),
            'pager' => $pager,
            'nomor' =>  nomor($this->request->getVar('page'), 5),
            'jumlah_dokumen' =>  $jumlah_dokumen
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/dokumen/list_dokumen', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save_dokumen()
	{

        // Memeriksa apakah user sudah login
    if (!$this->session->has('isLogin')) {
        return redirect()->to('auth/login');
    }

    // Memeriksa level user
    if ($this->session->get('user_level') != 'admin') {
        session()->setFlashdata('otorisasi', 'Anda bukan Admin');
        return redirect()->to('auth/notAkses');
    }

    // Melakukan validasi input

    if (!$this->validate([
        'nama_dokumen' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Nama Tidak boleh kosong'
            ]
        ],
        'deskripsi' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Deskripsi tidak boleh kosong'
            ]
        ],
       'dokumen' => [
            'rules' => 'uploaded[dokumen]|mime_in[dokumen,application/pdf,application/msword,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet]|max_size[dokumen,10240]',
            'errors' => [
                'uploaded' => 'Harus Ada File yang diupload',
                'mime_in' => 'File harus berupa PDF, MS Word, atau Excel',
                'max_size' => 'Ukuran File Maksimal adalah 10 MB'
            ]
        ]
    ])) {
        $validation = \Config\Services::validation();
        session()->setFlashdata('pesan_error', 'Data Gagal diinput ada yang salah');
        return redirect()->back()->withInput()->with('validation', $validation);
    }

    // Mendapatkan file yang diupload
    $file_dokumen = $this->request->getFile('dokumen');
    // dd($file_dokumen);
    // Memeriksa apakah file diupload atau tidak
    if ($file_dokumen->getError() == 4) {
        $nama_dokumen = 'Tidak ada dokumen';
    } else {
        // Generate nama file random dan pindahkan file ke folder 'dokumen'
        $nama_dokumen = $file_dokumen->getRandomName();
        $file_dokumen->move('dokumen', $nama_dokumen);
    }

    // Menyimpan data ke database
    $this->dokumen_model->save([
        'nama_dokumen' => $this->request->getVar('nama_dokumen'),
        'dokumen' => $nama_dokumen,
        'deskripsi' => $this->request->getVar('deskripsi'),
    ]);

    // Mengatur pesan sukses ke session
    session()->setFlashdata('pesan', 'Data Berhasil ditambahkan');
    return redirect()->back();
	}

    public function download($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $berkas = $this->dokumen_model;
		$data = $berkas->find($id);

		return $this->response->download('dokumen/' . $data['dokumen'], null);
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

        $dokumen = $this->dokumen_model->getDokumenId($id);

        $data = [
            'dokumen' => $dokumen,
            'validation' => \Config\Services::validation()
        ];
     
        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/dokumen/edit_dokumen', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function update_dokumen($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        if (!$this->validate([
			'nama_dokumen' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Tidak boleh kosong'
				]
			],

            'deskripsi' => [
				'rules' => 'required',
				'errors' => [
					'required' => 'Nama Tidak boleh kosong'
				]
			],

			'berkas' => [
				'rules' => 'mime_in[berkas,application/pdf,application/msword,application/msexcel]',
				'errors' => [
					'mime_in' => 'File Extention Harus Berupa pdf,msword,excel',
					'max_size' => 'Ukuran File Maksimal 10 MB'
				]
			]
		])) {
			// $validation = \Config\Services::validation();
            return redirect()->to('dokumen/edit/'.$this->request->getVar('id_dokumen'))->withInput();
		}

        $file_dokumen = $this->request->getFile('dokumen');

        if($file_dokumen->getError() == 4){
            $nama_dokumen = $this->request->getVar('dokumen_lama');
        }elseif($file_dokumen->getError() == null){
            $nama_dokumen = $file_dokumen->getRandomName();

            $file_dokumen->move('dokumen', $nama_dokumen);
        }else{
            $nama_dokumen = $file_dokumen->getRandomName();
            $file_dokumen->move('dokumen', $nama_dokumen);

            unlink('dokumen/'.$this->request->getVar('dokumen_lama'));
        }

        $this->dokumen_model->save([
            'id_dokumen' => $id,
            'nama_dokumen' => $this->request->getVar('nama_dokumen'),
            'deskripsi' => $this->request->getVar('deskripsi'),
            'dokumen' => $nama_dokumen
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');
        return redirect()->to('dokumen/index');
    }

    public function delete_dokumen($id)
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        if($this->session->get('user_level') != 'admin'){
            session()->setFlashdata('otorisasi', 'Anda bukan Admin');
            return redirect()->to('auth/notAkses');
        }

        $dokumen = $this->dokumen_model->find($id);


        if($dokumen['dokumen'] != 'default.jpg'){
            unlink('dokumen/' . $dokumen['dokumen']);
        }

        $this->dokumen_model->delete($id);

        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('dokumen');
    }


}