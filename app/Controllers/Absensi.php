<?php

namespace App\Controllers;

use App\Models\Absensi_model;

class Absensi extends BaseController{

    protected $absensi_model;
    protected  $session;

    public function __construct()
    {
        $this->absensi_model = new Absensi_model();
        $this->session = session();
    }

    public function index()
    {
        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }
        
        $absensi = $this->absensi_model->getAbsensi()->getResultArray();

        $data = [
            'absensi' => $absensi,
            'validation' => \Config\Services::validation(),
        ];

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/absensi/index', $data);
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function save()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        // if(!$this->validate([
        //     'file_absensi' => [
        //         'rules' => 'required',
        //         'errors' => [
        //             'required' => 'file harus diisi'
        //         ]
        //     ]
        // ])){
        //     $validation = \Config\Services::validation();
        //     session()->setFlashdata('failed', 'data gagal disimpan');
        //     return redirect()->back()->withInput()->with('validation', $validation);
        // }

        $file_absensi = $this->request->getFile('file_absensi');

// dd($file_absensi);
if ($file_absensi->isValid() && $file_absensi->getExtension() == 'xlsx') {
    $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file_absensi->getPathname());
    $worksheet = $spreadsheet->getActiveSheet();

    $absensi_model = $this->absensi_model; // Ubah sesuai dengan model yang benar
    $data_to_insert = []; // Array untuk menyimpan semua data yang akan diimpor

    foreach ($worksheet->getRowIterator(2) as $row) {
        $cellIterator = $row->getCellIterator();
        $cellIterator->setIterateOnlyExistingCells(true);

        $data = [];
        foreach ($cellIterator as $cell) {
            $data[] = $cell->getFormattedValue();
        }

        $jam_masuk = $data[1];
        $jam_pulang = $data[2];
        $jam_masuk_formatted = \DateTime::createFromFormat('H:i', $jam_masuk);
        $jam_pulang_formatted = \DateTime::createFromFormat('H:i', $jam_pulang);

        if ($jam_masuk_formatted) {
            $jam_masuk_formatted = $jam_masuk_formatted->format('H:i');
        } else {
            $jam_masuk_formatted = null; 
        }

        if ($jam_pulang_formatted) {
            $jam_pulang_formatted = $jam_pulang_formatted->format('H:i');
        } else {
            $jam_pulang_formatted = null;
        }

        $tgl_absensi = $data[3];

        // Ubah format tanggal menjadi Y-m-d (dari d-m-Y)
        $tgl_absensi_formatted = \DateTime::createFromFormat('m-d-Y', $tgl_absensi);
        // dd($tgl_absensi);
        if ($tgl_absensi_formatted) {
            $tgl_absensi_formatted = $tgl_absensi_formatted->format('Y-m-d');
        } else {
            // Tangani nilai tanggal yang tidak valid
            $tgl_absensi_formatted = null;
        }

        // Pemecahan masalah: Cetak nilai yang diperlukan untuk debugging
        // dd($tgl_absensi); // Cetak nilai dari variabel $tgl_absensi
        // dd($tgl_absensi_formatted); // Cetak nilai dari variabel $tgl_absensi_formatted

        $absensi_data = [
            'employee_name' => $data[0],
            'jam_masuk' => $jam_masuk_formatted,
            'jam_pulang' => $jam_pulang_formatted,
            'tgl_absensi' => $tgl_absensi_formatted
        ];

        // Lakukan sesuatu dengan data absensi yang sudah diproses, misalnya simpan dalam array $data_to_insert.
        $data_to_insert[] = $absensi_data;
    }

    // Selanjutnya, Anda dapat menggunakan data yang telah diproses untuk melakukan tindakan yang sesuai, seperti menyimpannya ke database.
    $absensi_model->insertBatch($data_to_insert);
    
    session()->setFlashdata('success', 'Data berhasil digenerate');
    return redirect()->back();
        }
    }

}
