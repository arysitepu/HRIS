<?php

namespace App\Controllers;
use App\Models\Trn_cuti_model;
use App\Models\Karyawan_model;
use App\Models\Position_model;
use App\Models\Branch_model;
use App\Models\MstCuti_model;
use App\Models\Trn_tgl_model;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Controllers\BaseController;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class ExportExcel extends BaseController{

    protected $session;

    public function __construct()
    {
        $this->session = session();
    }


    public function index()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        echo view('admin/templates/header');
        echo view('admin/templates/sidebar');
        echo view('admin/templates/topbar');
        echo view('admin/report/export_excel/download-index');
        echo view('admin/templates/js');
        echo view('admin/templates/footer');
        echo view('admin/templates/modal');
    }

    public function trn_cuti()
    {

        if(!$this->session->has('isLogin')){
            return redirect()->to('auth/login');
        }

        $bulan = $this->request->getVar('bulan');
        
        $cuti = new Trn_cuti_model();

        if($bulan){
            $dataCuti = $cuti->search_by_bulan($bulan)->getResultArray();
            $spreadsheet = new Spreadsheet();

           
            // tulis header/nama kolom 
            $sheet = $spreadsheet->setActiveSheetIndex(0);
            $sheet->setCellValue('A1', 'REKAPITULASI ATTEDANCE BULAN'.' '.date("M-Y",strtotime($bulan)));
            $sheet->mergeCells('A1:H2');
            $sheet->getStyle('A1')->getFont()->setBold(true);
            $sheet->setCellValue('A3', 'Nama Karyawan');
            $sheet->setCellValue('B3', 'Jabatan');
            $sheet->setCellValue('C3', 'Bulan');
            $sheet->setCellValue('D3', 'Cuti');
            $sheet->setCellValue('E3', 'Cuti Khusus');
            $sheet->setCellValue('F3', 'Sakit');
            $sheet->setCellValue('G3', 'Ul');
            $sheet->setCellValue('H3', 'Total');

            $sheet->getStyle('A3:H3')->getFont()->setBold(true);
            $sheet->getStyle('A3:H3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                  ->getStartColor()->setARGB('ffffff00');
            
            $column = 4;
            // tulis data mobil ke cell
            foreach($dataCuti as $data) {

                $cuti = $data['c'];
                $sakit = $data['s'];
                $cuti_khusus = $data['ck'];
                $ul = $data['ul'];

                $jumlah = $cuti + $sakit + $cuti_khusus + $ul;

                $sheet = $spreadsheet->setActiveSheetIndex(0);
                $sheet->setCellValue('A' . $column, $data['employee_name']);
                $sheet->setCellValue('B' . $column, $data['position_name']);
                $sheet->setCellValue('C' . $column, date("M-Y", strtotime($data['tgl_dari'])));
                $sheet->setCellValue('D' . $column, $data['c']);
                $sheet->setCellValue('E' . $column, $data['ck']);
                $sheet->setCellValue('F' . $column, $data['s']);
                $sheet->setCellValue('G' . $column, $data['ul']);
                $sheet->setCellValue('H' . $column, $jumlah);
                $column++;
            }

            $styleArray = [
                'borders' => [
                    'allborders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ],
            ];

            $sheet->getStyle('A3:H'.($column-1))->applyFromArray($styleArray);

            $sheet->getColumnDimension('A')->setAutoSize(true);
            $sheet->getColumnDimension('B')->setAutoSize(true);
            $sheet->getColumnDimension('C')->setAutoSize(true);
            $sheet->getColumnDimension('D')->setAutoSize(true);
            $sheet->getColumnDimension('E')->setAutoSize(true);
            $sheet->getColumnDimension('F')->setAutoSize(true);
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            // tulis dalam format .xlsx
            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename=dataCuti.xlsx');
            header('Cache-Control: max-age=0');
            $writer->save('php://output');
            exit();
        
            $writer->save('php://output');

           
    
        }

            
   }
        
   public function trn_cuti_tahun()
   {

    if(!$this->session->has('isLogin')){
        return redirect()->to('auth/login');
    }

       $tahun = $this->request->getVar('years');
       $branch = $this->request->getVar('branch');
       
       $cuti = new Trn_cuti_model();

       if($tahun){
           $dataCuti = $cuti->search_by_years($tahun, $branch)->getResultArray();
           $spreadsheet = new Spreadsheet();

          
           // tulis header/nama kolom 
           $sheet = $spreadsheet->setActiveSheetIndex(0);
           $sheet->setCellValue('A1', 'REKAPITULASI R19 SELURUH KARYAWAN PT. ATAP TEDUH LESTARI');
           $sheet->mergeCells('A1:C1');
           $sheet->setCellValue('A2', 'TAHUN'." ".$tahun);
           $sheet->setCellValue('A3', 'NO');
           $sheet->mergeCells('A3:A4');
           $sheet->setCellValue('B3', 'URAIAN');
           $sheet->mergeCells('B3:C4');
           $sheet->setCellValue('D3', 'JUMLAH');
           $sheet->mergeCells('D3:H3');

           $sheet->setCellValue('A5', "");
           $sheet->mergeCells("A5:BD5");

           //sebelah jumlah =bulan JANURI
           $sheet->setCellValue('I3', 'JAN');
           $sheet->mergeCells('I3:L3');

           //BULAN FEBUARY
           $sheet->setCellValue('M3', 'FEB');
           $sheet->mergeCells('M3:P3');

           //BULAN MARET
           $sheet->setCellValue('Q3', 'MAR');
           $sheet->mergeCells('Q3:T3');

           //BULAN APRIL 
           $sheet->setCellValue('U3', 'APR');
           $sheet->mergeCells('U3:X3');

           //BULAN MEI
           $sheet->setCellValue('Y3', 'MEI');
           $sheet->mergeCells('Y3:AB3');

           //BULAN JUNI
           $sheet->setCellValue('AC3', 'JUN');
           $sheet->mergeCells('AC3:AF3');

           //BULAN JULI
           $sheet->setCellValue('AG3', 'JUL');
           $sheet->mergeCells('AG3:AJ3');

           //BULAN AGUSTUS
           $sheet->setCellValue('AK3', 'AUGUST');
           $sheet->mergeCells('AK3:AN3');

           //BULAN SEPTEMBER
           $sheet->setCellValue('AO3', 'SEP');
           $sheet->mergeCells('AO3:AR3');

           //BULAN OKTOBER
           $sheet->setCellValue('AS3', 'OKT');
           $sheet->mergeCells('AS3:AV3');

           //BULAN NOVEMBER
           $sheet->setCellValue('AW3', 'NOV');
           $sheet->mergeCells('AW3:AZ3');

           //BULAN DESEMBER
           $sheet->setCellValue('BA3', 'DEC');
           $sheet->mergeCells('BA3:BD3');
    
            

           //Bawah Januari
           $sheet->setCellValue('I4', 'S');
           $sheet->setCellValue('J4', 'C');
           $sheet->setCellValue('K4', 'CK');
           $sheet->setCellValue('L4', 'UL');

           //bawah Febuary
           $sheet->setCellValue('M4', 'S');
           $sheet->setCellValue('N4', 'C');
           $sheet->setCellValue('O4', 'CK');
           $sheet->setCellValue('P4', 'UL');

           //bawah MARET
           $sheet->setCellValue('Q4', 'S');
           $sheet->setCellValue('R4', 'C');
           $sheet->setCellValue('S4', 'CK');
           $sheet->setCellValue('T4', 'UL');

           //bawah APRIL
           $sheet->setCellValue('U4', 'S');
           $sheet->setCellValue('V4', 'C');
           $sheet->setCellValue('W4', 'CK');
           $sheet->setCellValue('X4', 'UL');

           //bawah MEI
           $sheet->setCellValue('Y4', 'S');
           $sheet->setCellValue('Z4', 'C');
           $sheet->setCellValue('AA4', 'CK');
           $sheet->setCellValue('AB4', 'UL');

           //bawah JUNI
           $sheet->setCellValue('AC4', 'S');
           $sheet->setCellValue('AD4', 'C');
           $sheet->setCellValue('AE4', 'CK');
           $sheet->setCellValue('AF4', 'UL');

           //bawah JULI
           $sheet->setCellValue('AG4', 'S');
           $sheet->setCellValue('AH4', 'C');
           $sheet->setCellValue('AI4', 'CK');
           $sheet->setCellValue('AJ4', 'UL');

           //bawah AGUSTUS
           $sheet->setCellValue('AK4', 'S');
           $sheet->setCellValue('AL4', 'C');
           $sheet->setCellValue('AM4', 'CK');
           $sheet->setCellValue('AN4', 'UL');

           //bawah SEPTEMBER
           $sheet->setCellValue('AO4', 'S');
           $sheet->setCellValue('AP4', 'C');
           $sheet->setCellValue('AQ4', 'CK');
           $sheet->setCellValue('AR4', 'UL');

           //bawah OKTOBER
           $sheet->setCellValue('AS4', 'S');
           $sheet->setCellValue('AT4', 'C');
           $sheet->setCellValue('AU4', 'CK');
           $sheet->setCellValue('AV4', 'UL');

           //bawah NOVEMBER
           $sheet->setCellValue('AW4', 'S');
           $sheet->setCellValue('AX4', 'C');
           $sheet->setCellValue('AY4', 'CK');
           $sheet->setCellValue('AZ4', 'UL');

           //bawah DESEMBER
           $sheet->setCellValue('BA4', 'S');
           $sheet->setCellValue('BB4', 'C');
           $sheet->setCellValue('BC4', 'CK');
           $sheet->setCellValue('BD4', 'UL');


           //BAWAH JUMLAH
           $sheet->setCellValue('D4', 'S');
           $sheet->setCellValue('E4', 'C');
           $sheet->setCellValue('F4', 'CK');
           $sheet->setCellValue('G4', 'UL');
           $sheet->setCellValue('H4', 'Total');


           $column = 6;
           $nomor=1;
           // tulis data mobil ke cell
           foreach($dataCuti as $data) {

            $awal = new \DateTime($data['tanggal_masuk']);
            $akhir = new \DateTime($data['tanggal_keluar']);
            $akhir1 = date_create();
            
            if($data['tanggal_keluar'] != null){
                $jarak = $akhir->diff($awal);
            }else{
                $jarak = $akhir1->diff($awal);
            }


               $cuti = $data['c'];
               $sakit = $data['s'];
               $cuti_khusus = $data['ck'];
               $ul = $data['ul'];

               $jumlah = $cuti + $sakit + $cuti_khusus + $ul;

               $sheet = $spreadsheet->setActiveSheetIndex(0);
               $sheet->setCellValue('A' . $column, $nomor++);
               $sheet->setCellValue('B' . $column, $data['employee_name'] );
               $sheet->setCellValue('C' . $column, "Masuk". " ". date("d-m-Y", strtotime($data['join_start'])).","." "."Masa Kerja"." ". $jarak->y." "."Tahun"." ".$jarak->m." "."Bulan");
               $sheet->setCellValue('D' . $column, ($data['s']) ? $data['s'] : '-' );
               $sheet->setCellValue('E' . $column, ($data['c']) ? $data['c'] : '-' );
               $sheet->setCellValue('F' . $column, ($data['ck']) ? $data['ck'] : '-' );
               $sheet->setCellValue('G' . $column, ($data['ul']) ? $data['ul'] : '-' );
               $sheet->setCellValue('H' . $column, $jumlah);

               //BULAN JANUARI
               $sheet->setCellValue('I' . $column, ($data['sjan']) ? $data['sjan'] : "-" );
               $sheet->setCellValue('J' . $column, ($data['cjan']) ? $data['cjan'] : "-");
               $sheet->setCellValue('K' . $column, ($data['ckjan']) ? $data['ckjan'] : "-");
               $sheet->setCellValue('L' . $column, ($data['uljan']) ? $data['uljan'] : "-" );

               //BULAN FEBUARI
               $sheet->setCellValue('M' . $column, ($data['sfeb']) ? $data['sfeb'] : "-" );
               $sheet->setCellValue('N' . $column, ($data['cfeb']) ? $data['cfeb'] : "-" );
               $sheet->setCellValue('O' . $column, ($data['ckfeb']) ? $data['ckfeb'] : "-" );
               $sheet->setCellValue('P' . $column, ($data['ulfeb']) ? $data['ulfeb'] : "-" );

               //BULAN MARET
               $sheet->setCellValue('Q' . $column, ($data['smar']) ? $data['smar'] : "-" );
               $sheet->setCellValue('R' . $column, ($data['cmar']) ? $data['cmar'] : "-" );
               $sheet->setCellValue('S' . $column, ($data['ckmar']) ? $data['ckmar'] : "-" );
               $sheet->setCellValue('T' . $column, ($data['ulmar']) ? $data['ulmar'] : "-" );

               //BULAN APRIL
               $sheet->setCellValue('U' . $column, ($data['sapr']) ? $data['sapr'] : "-" );
               $sheet->setCellValue('V' . $column, ($data['capr']) ? $data['capr'] : "-" );
               $sheet->setCellValue('W' . $column, ($data['ckapr']) ? $data['ckapr'] : "-" );
               $sheet->setCellValue('X' . $column, ($data['ulapr']) ? $data['ulapr'] : "-" );

               //BULAN MEI
               $sheet->setCellValue('Y' . $column, ($data['smei']) ? $data['smei'] : "-" );
               $sheet->setCellValue('Z' . $column, ($data['cmei']) ? $data['cmei'] : "-" );
               $sheet->setCellValue('AA' . $column, ($data['ckmei']) ? $data['ckmei'] : "-" );
               $sheet->setCellValue('AB' . $column, ($data['ulmei']) ? $data['ulmei'] : "-" );

               //BULAN JUNI
               $sheet->setCellValue('AC' . $column, ($data['sjun']) ? $data['sjun'] : "-" );
               $sheet->setCellValue('AD' . $column, ($data['cjun']) ? $data['cjun'] : "-" );
               $sheet->setCellValue('AE' . $column, ($data['ckjun']) ? $data['ckjun'] : "-" );
               $sheet->setCellValue('AF' . $column, ($data['uljun']) ? $data['uljun'] : "-" );

               //BULAN JULI
               $sheet->setCellValue('AG' . $column, ($data['sjul']) ? $data['sjul'] : "-" );
               $sheet->setCellValue('AH' . $column, ($data['cjul']) ? $data['cjul'] : "-" );
               $sheet->setCellValue('AI' . $column, ($data['ckjul']) ? $data['ckjul'] : "-" );
               $sheet->setCellValue('AJ' . $column, ($data['uljul']) ? $data['uljul'] : "-" );

               //BULAN AGUSTUS
               $sheet->setCellValue('AK' . $column, ($data['sagus']) ? $data['sagus'] : "-" );
               $sheet->setCellValue('AL' . $column, ($data['cagus']) ? $data['cagus'] : "-" );
               $sheet->setCellValue('AM' . $column, ($data['ckagus']) ? $data['ckagus'] : "-");
               $sheet->setCellValue('AN' . $column, ($data['ulagus']) ? $data['ulagus'] : "-" );

               //BULAN SEPTEMBER
               $sheet->setCellValue('AO' . $column, ($data['ssep']) ? $data['ssep'] : "-" );
               $sheet->setCellValue('AP' . $column, ($data['csep']) ? $data['csep'] : "-" );
               $sheet->setCellValue('AQ' . $column, ($data['cksep']) ? $data['cksep'] : "-" );
               $sheet->setCellValue('AR' . $column, ($data['ulsep']) ? $data['ulsep'] : "-" );

               //BULAN OKTOBER
               $sheet->setCellValue('AS' . $column, ($data['sokt']) ? $data['sokt'] : "-" );
               $sheet->setCellValue('AT' . $column, ($data['cokt']) ? $data['cokt'] : "-" );
               $sheet->setCellValue('AU' . $column, ($data['ckokt']) ? $data['ckokt'] : "-" );
               $sheet->setCellValue('AV' . $column, ($data['ulokt']) ? $data['ulokt'] : "-" );

               //BULAN NOVEMBER
               $sheet->setCellValue('AW' . $column, ($data['snov']) ? $data['snov'] : "-" );
               $sheet->setCellValue('AX' . $column, ($data['cnov']) ? $data['cnov'] : "-" );
               $sheet->setCellValue('AY' . $column, ($data['cknov']) ? $data['cknov'] : "-" );
               $sheet->setCellValue('AZ' . $column, ($data['ulnov']) ? $data['ulnov'] : "-" );

               //BULAN DESEMBER
               $sheet->setCellValue('BA' . $column, ($data['sdes']) ? $data['sdes'] : "-" );
               $sheet->setCellValue('BB' . $column, ($data['cdes']) ? $data['cdes'] : "-" );
               $sheet->setCellValue('BC' . $column, ($data['ckdes']) ? $data['ckdes'] : "-" );
               $sheet->setCellValue('BD' . $column, ($data['uldes']) ? $data['uldes'] : "-" );


               $column++;
           }

           $styleArray = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'ff000000'],
                ],
            ],
        ];


           $sheet->getStyle('A3:BD'.($column-1))->applyFromArray($styleArray);

           $sheet->getColumnDimension('A')->setAutoSize(true);
           $sheet->getColumnDimension('B')->setAutoSize(true);
           $sheet->getColumnDimension('C')->setAutoSize(true);
           $sheet->getColumnDimension('D')->setAutoSize(true);
           $sheet->getColumnDimension('E')->setAutoSize(true);
           $sheet->getColumnDimension('F')->setAutoSize(true);
           $sheet->getColumnDimension('G')->setAutoSize(true);
           $sheet->getColumnDimension('H')->setAutoSize(true);
           // tulis dalam format .xlsx
           $writer = new Xlsx($spreadsheet);

           header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
           header('Content-Disposition: attachment;filename=dataCuti.xlsx');
           header('Cache-Control: max-age=0');
           $writer->save('php://output');
           exit();
       
           $writer->save('php://output');

          
   
       }

           
  }
       

}