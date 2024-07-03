<?php

namespace App\Models;

use App\Controllers\Branch;
use CodeIgniter\Model;

class Trn_cuti_model extends Model
{

    protected $table = 'trn_cuti';
    protected $primaryKey = 'trn_id';
    protected $useTimestamps = true;
    protected $allowedFields = [
        'trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'position_id', 'branch_id',
        'cuti_id', 'cuti_desc', 'gambar_sakit','cuti_jumlah', 'tgl_dari', 'tgl_sampai', 'hak_cuti', 'serah_kerja', 'alamat_cuti',
        'posting'
    ];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function get_cuti()
    {

        $builder = $this->select('trn_cuti.*, position_name, cuti_name, branch_name, trn_cuti.hak_cuti, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name');
        $builder->join('mst_employee e1', 'trn_cuti.employee_id = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_cuti.employee_id_buat = e2.employee_id');
        $builder->join('mst_employee e3', 'trn_cuti.employee_id_setuju = e3.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');
        $query = $builder->orderBy('tgl_dari', 'DESC')->paginate(5);

        return $query;
    }

    public function getCutiSbu($branchId)
    {
        $builder = $this->select('trn_cuti.*, position_name, cuti_name, branch_name, trn_cuti.hak_cuti, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name');
        $builder->join('mst_employee e1', 'trn_cuti.employee_id = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_cuti.employee_id_buat = e2.employee_id');
        $builder->join('mst_employee e3', 'trn_cuti.employee_id_setuju = e3.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');
        
        // Menambahkan kriteria cabang
        $builder->where('trn_cuti.branch_id', $branchId);
    
        // Order by dan paginasi tetap dapat diterapkan
        $query = $builder->orderBy('tgl_dari', 'DESC')->paginate(5);
    
        return $query;
    }
    public function count_get_cuti()
    {
        return $this->table('trn_cuti')->select('trn_cuti.*, position_name, cuti_name, branch_name, trn_cuti.hak_cuti, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
            ->join('mst_employee e1', 'trn_cuti.employee_id = e1.employee_id')
            ->join('mst_employee e2', 'trn_cuti.employee_id_buat = e2.employee_id')
            ->join('mst_employee e3', 'trn_cuti.employee_id_setuju = e3.employee_id')
            ->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT')
            ->join('mst_position', 'trn_cuti.position_id = mst_position.position_id')
            ->join('branch', 'trn_cuti.branch_id = branch.branch_id')
            ->CountAllResults();
    }

    public function get_cutiId($id = false)
    {
        if ($id == false) {
            $this->get();
        }

        return $this->table('trn_cuti')->select('trn_cuti.*, position_name, cuti_name, branch_name, trn_cuti.hak_cuti, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_cuti.cuti_type')
            ->join('mst_employee e1', 'trn_cuti.employee_id = e1.employee_id')
            ->join('mst_employee e2', 'trn_cuti.employee_id_buat = e2.employee_id')
            ->join('mst_employee e3', 'trn_cuti.employee_id_setuju = e3.employee_id')
            ->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT')
            ->join('mst_position', 'trn_cuti.position_id = mst_position.position_id')
            ->join('branch', 'trn_cuti.branch_id = branch.branch_id')
            ->where(['trn_id' => $id])->first();
    }


    public function get_report()
    {

        $db = \Config\Database::connect();
        
        $builder = $db->table('trn_tgl');
        $builder->select('trn_tgl.*, trn_cuti.trn_id, mst_employee.employee_name,
        mst_position.position_name as position_name, tgl_dari,

        IF(mst_cuti.cuti_type="Cuti Khusus", count(trn_tgl.tgl_cuti), 0) as ck,
        IF(trn_cuti.cuti_id=2, count(trn_tgl.tgl_cuti), 0) as s,
        IF(trn_cuti.cuti_id=1, COUNT(trn_tgl.tgl_cuti), 0) as c,
        IF(trn_cuti.cuti_id=39, COUNT(trn_tgl.tgl_cuti), 0) as ul,
        ');
        $builder->join('trn_cuti', 'trn_tgl.trn_id = trn_cuti.trn_id');
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->groupby(["(tgl_cuti)", 'trn_cuti.employee_id', 'tgl_cuti']);
        $builder->distinct();
        $query = $builder->get();

        return $query;
    }

    public function getCuti_id($id = false)
    {
        if ($id == false) {
            $this->get();
        }
        return $this->table('trn_cuti')->select('trn_cuti.*, position_name, cuti_name, branch_name, trn_cuti.hak_cuti, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
            ->join('mst_employee e1', 'trn_cuti.employee_id = e1.employee_id')
            ->join('mst_employee e2', 'trn_cuti.employee_id_buat = e2.employee_id')
            ->join('mst_employee e3', 'trn_cuti.employee_id_setuju = e3.employee_id')
            ->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id')
            ->join('mst_position', 'trn_cuti.position_id = mst_position.position_id')
            ->join('branch', 'trn_cuti.branch_id = branch.branch_id')
            // ->join('trn_tgl', 'trn_cuti.trn_id = trn_tgl.trn_id','LEFT')
            ->where(['trn_cuti.trn_id' => $id])->first();
    }

    public function get_tglId($id = false)
    {

        if ($id == false) {
            return $this->get();
        }

        $builder = $this->select('trn_cuti.*, trn_tgl.id as id_tgl, trn_tgl.tgl_cuti');
        $builder->join('trn_tgl', 'trn_cuti.trn_id = trn_tgl.trn_id');
        $query = $builder->where(['trn_tgl.trn_id' => $id])->get();

        return $query;
    }

    public function search($keyword)
    {
        return $this->table('trn_cuti')
            ->select('trn_cuti.*, mst_employee.employee_name,
        e1.employee_name as buat_name, mst_position.position_name, mst_cuti.cuti_name, 
        branch.branch_name, e2.employee_name as setuju_name')
            ->join('mst_employee e1', 'trn_cuti.employee_id_buat = e1.employee_id')
            ->join('mst_employee e2', 'trn_cuti.employee_id_setuju = e2.employee_id')
            ->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id')
            ->join('mst_position', 'trn_cuti.position_id = mst_position.position_id')
            ->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id')
            ->join('branch', 'trn_cuti.branch_id = branch.branch_id')
            ->like('mst_employee.employee_name', $keyword)
            ->orderBy('tgl_dari', 'ASC')
            ->paginate(5);
    }

    public function count_search($keyword)
    {
        return $this->table('trn_cuti')
            ->select('trn_cuti.*, mst_employee.employee_name,
        e1.employee_name as buat_name, mst_position.position_name, mst_cuti.cuti_name, 
        branch.branch_name, e2.employee_name as setuju_name')
            ->join('mst_employee e1', 'trn_cuti.employee_id_buat = e1.employee_id')
            ->join('mst_employee e2', 'trn_cuti.employee_id_setuju = e2.employee_id')
            ->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id')
            ->join('mst_position', 'trn_cuti.position_id = mst_position.position_id')
            ->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id')
            ->join('branch', 'trn_cuti.branch_id = branch.branch_id')
            ->like('mst_employee.employee_name', $keyword)->countAllResults($keyword);
    }


    // test

    public function search_by_month($sbu, $cuti_id, $keyword, $awal_bulan, $akhir_bulan)
    {
        
        $builder = $this->table('trn_cuti');
        $builder->select('trn_cuti.*, 
                          mst_position.position_name, 
                          mst_cuti.cuti_name, 
                          branch.branch_name, 
                          trn_cuti.hak_cuti, 
                          employee_name as employee_name,');
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');
        
    
        if ($sbu) {
            $builder->where('trn_cuti.branch_id', $sbu);
        }
    
        if ($cuti_id) {
            $builder->where('trn_cuti.cuti_id', $cuti_id);
        }

        if($keyword){
            if(session()->get('user_level') == 'admin'){
            $builder->like('mst_employee.employee_name', $keyword);
            }elseif(session()->get('user_level') == 'user'){
                $builder->where('mst_employee.employee_id', $keyword);
            }
        }

        
        if ($awal_bulan && $akhir_bulan) {
            $builder->where("DATE_FORMAT(trn_cuti.tgl_dari, '%Y-%m') >=", $awal_bulan);
            $builder->where("DATE_FORMAT(trn_cuti.tgl_dari, '%Y-%m') <=", $akhir_bulan);
        } elseif ($awal_bulan) {
            $builder->where("DATE_FORMAT(trn_cuti.tgl_dari, '%Y-%m')", $awal_bulan);
        }
        
        return $builder->paginate(5);
       
    }

    // batas


   

    public function search_by_month_user($awal_bulan, $akhir_bulan, $branchId)
    {

        // $db = \Config\Database::connect();

        $builder = $this->table('trn_cuti');
        $builder->select('trn_cuti.*, position_name, cuti_name, branch_name, trn_cuti.hak_cuti, 
                        e1.employee_name as employee_name, e2.employee_name as buat_name, 
                        e3.employee_name as setuju_name');

        $builder->join('mst_employee e1', 'trn_cuti.employee_id = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_cuti.employee_id_buat = e2.employee_id');
        $builder->join('mst_employee e3', 'trn_cuti.employee_id_setuju = e3.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');

        if($awal_bulan && $akhir_bulan){
            $query = $builder->where("DATE_FORMAT(tgl_dari, '%Y-%m') >=", $awal_bulan)
                 ->where("DATE_FORMAT(tgl_dari, '%Y-%m') <=", $akhir_bulan)
                 ->where('trn_cuti.branch_id', $branchId)
                 ->paginate(5);
                 
                 return $query;
        }elseif($awal_bulan){
            $query = $builder->where("DATE_FORMAT(tgl_dari, '%Y-%m')", $awal_bulan)
                 ->where('trn_cuti.branch_id', $branchId)
                 ->paginate(5);
                 return $query;
        }
    }


    // new code count filter
    public function count_search_by_month($sbu, $cuti_id, $keyword , $awal_bulan, $akhir_bulan)
    {
        
        $builder = $this->table('trn_cuti');
        $builder->select('trn_cuti.*, 
                          mst_position.position_name, 
                          mst_cuti.cuti_name, 
                          branch.branch_name, 
                          trn_cuti.hak_cuti, 
                          employee_name as employee_name,');
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id', 'LEFT');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');
        
    
        if ($sbu) {
            $builder->where('trn_cuti.branch_id', $sbu);
        }
    
        if ($cuti_id) {
            $builder->where('trn_cuti.cuti_id', $cuti_id);
        }

        if($keyword){
            if(session()->get('user_level') == 'admin'){
            $builder->like('mst_employee.employee_name', $keyword);
            }elseif(session()->get('user_level') == 'user'){
                $builder->where('mst_employee.employee_id', $keyword);
            }
        }

        
        
        if ($awal_bulan && $akhir_bulan) {
            $builder->where("DATE_FORMAT(trn_cuti.tgl_dari, '%Y-%m') >=", $awal_bulan);
            $builder->where("DATE_FORMAT(trn_cuti.tgl_dari, '%Y-%m') <=", $akhir_bulan);
        } elseif ($awal_bulan) {
            $builder->where("DATE_FORMAT(trn_cuti.tgl_dari, '%Y-%m')", $awal_bulan);
        }
        
        return $builder->countAllResults();
       
    }
    // 


    

    public function search_by_bulan($bulan)
    {


        $db = \Config\Database::connect();
        
        $builder = $db->table('trn_tgl');
        $builder->select('trn_tgl.*, trn_cuti.trn_id, mst_employee.employee_name,
        mst_position.position_name as position_name, tgl_dari,

       
         COUNT(IF( trn_tgl.cuti_id = 2, tgl_cuti, NULL)) as s,
         COUNT(IF( trn_tgl.cuti_id = 1, tgl_cuti, NULL)) as c,
         COUNT(IF( trn_tgl.cuti_id = 39, tgl_cuti, NULL)) as ul,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus", tgl_cuti, NULL)) as ck
         ,
        
        ');
        $builder->join('trn_cuti', 'trn_tgl.trn_id = trn_cuti.trn_id');
       
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->groupby(["Month(tgl_cuti)", 'trn_cuti.employee_id']);
        $query = $builder->where("DATE_FORMAT(tgl_cuti, '%Y-%m')", $bulan)->get();

        return $query;
        
    }


    public function search_by_years($years, $branch)
    {

        
        $db = \Config\Database::connect();
        $db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        $builder = $db->table('trn_tgl');
        $builder->select('trn_tgl.*, trn_cuti.trn_id, mst_employee.employee_name, trn_cuti.branch_id, branch.branch_name,
        mst_position.position_name as position_name, tgl_dari, mst_employee.tanggal_masuk as join_start, 
        mst_employee.tanggal_masuk as tanggal_masuk, mst_employee.tanggal_keluar,

       
         COUNT(IF( trn_tgl.cuti_id = 2, tgl_cuti, NULL)) as s,
         COUNT(IF( trn_tgl.cuti_id = 1, tgl_cuti, NULL)) as c,
         COUNT(IF( trn_tgl.cuti_id = 39, tgl_cuti, NULL)) as ul,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus", tgl_cuti, NULL)) as ck,

         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="01", tgl_cuti, NULL)) as sjan,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="02", tgl_cuti, NULL)) as sfeb,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="03", tgl_cuti, NULL)) as smar,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="04", tgl_cuti, NULL)) as sapr,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="05", tgl_cuti, NULL)) as smei,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="06", tgl_cuti, NULL)) as sjun,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="07", tgl_cuti, NULL)) as sjul,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="08", tgl_cuti, NULL)) as sagus,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="09", tgl_cuti, NULL)) as ssep,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="10", tgl_cuti, NULL)) as sokt,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="11", tgl_cuti, NULL)) as snov,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="12", tgl_cuti, NULL)) as sdes,



         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="01", tgl_cuti, NULL)) as cjan,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="02", tgl_cuti, NULL)) as cfeb,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="03", tgl_cuti, NULL)) as cmar,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="04", tgl_cuti, NULL)) as capr,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="05", tgl_cuti, NULL)) as cmei,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="06", tgl_cuti, NULL)) as cjun,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="07", tgl_cuti, NULL)) as cjul,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="08", tgl_cuti, NULL)) as cagus,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="09", tgl_cuti, NULL)) as csep,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="10", tgl_cuti, NULL)) as cokt,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="11", tgl_cuti, NULL)) as cnov,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="12", tgl_cuti, NULL)) as cdes,

         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="01", tgl_cuti, NULL)) as ckjan,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="02", tgl_cuti, NULL)) as ckfeb,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="03", tgl_cuti, NULL)) as ckmar,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="04", tgl_cuti, NULL)) as ckapr,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="05", tgl_cuti, NULL)) as ckmei,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="06", tgl_cuti, NULL)) as ckjun,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="07", tgl_cuti, NULL)) as ckjul,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="08", tgl_cuti, NULL)) as ckagus,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="09", tgl_cuti, NULL)) as cksep,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="10", tgl_cuti, NULL)) as ckokt,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="11", tgl_cuti, NULL)) as cknov,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="12", tgl_cuti, NULL)) as ckdes,

         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="01", tgl_cuti, NULL)) as uljan,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="02", tgl_cuti, NULL)) as ulfeb,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="03", tgl_cuti, NULL)) as ulmar,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="04", tgl_cuti, NULL)) as ulapr,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="05", tgl_cuti, NULL)) as ulmei,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="06", tgl_cuti, NULL)) as uljun,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="07", tgl_cuti, NULL)) as uljul,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="08", tgl_cuti, NULL)) as ulagus,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="09", tgl_cuti, NULL)) as ulsep,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="10", tgl_cuti, NULL)) as ulokt,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="11", tgl_cuti, NULL)) as ulnov,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="12", tgl_cuti, NULL)) as uldes,




         COUNT(IF(tgl_cuti=1,1,0)) AS Januari,
         ,
        
        ');
        $builder->join('trn_cuti', 'trn_tgl.trn_id = trn_cuti.trn_id');
       
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');
        $builder->groupby(["Year(tgl_cuti)", 'trn_cuti.branch_id' , 'trn_cuti.employee_id',]);

        if($years && $branch){
            $query = $builder->where("branch.branch_id", $branch)
            ->where("DATE_FORMAT(tgl_cuti, '%Y')", $years)->get();
        return $query;

        }elseif($years){
            $query = $builder->where("DATE_FORMAT(tgl_cuti, '%Y')", $years)->get();
        return $query;
        }elseif($branch){
            $query = $builder->where("branch.branch_id", $branch)->get();
        return $query;
        }else{
            "";
        }
       
    }

    public function get_report_tahun()
    {

        $db = \Config\Database::connect();
        
        $builder = $db->table('trn_tgl');
        $builder->select('trn_tgl.*, trn_cuti.trn_id, mst_employee.employee_name,
        mst_position.position_name as position_name, tgl_dari, mst_employee.tanggal_masuk as join_start, 
        mst_employee.tanggal_masuk, mst_employee.tanggal_keluar, branch.branch_name,

        COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="01", tgl_cuti, NULL)) as sjan,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="02", tgl_cuti, NULL)) as sfeb,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="03", tgl_cuti, NULL)) as smar,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="04", tgl_cuti, NULL)) as sapr,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="05", tgl_cuti, NULL)) as smei,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="06", tgl_cuti, NULL)) as sjun,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="07", tgl_cuti, NULL)) as sjul,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="08", tgl_cuti, NULL)) as sagus,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="09", tgl_cuti, NULL)) as ssep,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="10", tgl_cuti, NULL)) as sokt,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="11", tgl_cuti, NULL)) as snov,
         COUNT(IF( trn_tgl.cuti_id = 2 AND MONTH(tgl_cuti)="12", tgl_cuti, NULL)) as sdes,



         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="01", tgl_cuti, NULL)) as cjan,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="02", tgl_cuti, NULL)) as cfeb,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="03", tgl_cuti, NULL)) as cmar,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="04", tgl_cuti, NULL)) as capr,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="05", tgl_cuti, NULL)) as cmei,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="06", tgl_cuti, NULL)) as cjun,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="07", tgl_cuti, NULL)) as cjul,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="08", tgl_cuti, NULL)) as cagus,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="09", tgl_cuti, NULL)) as csep,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="10", tgl_cuti, NULL)) as cokt,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="11", tgl_cuti, NULL)) as cnov,
         COUNT(IF( trn_tgl.cuti_id = 1 AND MONTH(tgl_cuti)="12", tgl_cuti, NULL)) as cdes,

         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="01", tgl_cuti, NULL)) as ckjan,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="02", tgl_cuti, NULL)) as ckfeb,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="03", tgl_cuti, NULL)) as ckmar,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="04", tgl_cuti, NULL)) as ckapr,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="05", tgl_cuti, NULL)) as ckmei,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="06", tgl_cuti, NULL)) as ckjun,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="07", tgl_cuti, NULL)) as ckjul,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="08", tgl_cuti, NULL)) as ckagus,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="09", tgl_cuti, NULL)) as cksep,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="10", tgl_cuti, NULL)) as ckokt,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="11", tgl_cuti, NULL)) as cknov,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus" AND MONTH(tgl_cuti) ="12", tgl_cuti, NULL)) as ckdes,

         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="01", tgl_cuti, NULL)) as uljan,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="02", tgl_cuti, NULL)) as ulfeb,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="03", tgl_cuti, NULL)) as ulmar,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="04", tgl_cuti, NULL)) as ulapr,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="05", tgl_cuti, NULL)) as ulmei,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="06", tgl_cuti, NULL)) as uljun,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="07", tgl_cuti, NULL)) as uljul,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="08", tgl_cuti, NULL)) as ulagus,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="09", tgl_cuti, NULL)) as ulsep,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="10", tgl_cuti, NULL)) as ulokt,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="11", tgl_cuti, NULL)) as ulnov,
         COUNT(IF( trn_tgl.cuti_id = 39 AND MONTH(tgl_cuti) ="12", tgl_cuti, NULL)) as uldes,
       
         COUNT(IF( trn_tgl.cuti_id = 2, tgl_cuti, NULL)) as s,
         COUNT(IF( trn_tgl.cuti_id = 1, tgl_cuti, NULL)) as c,
         COUNT(IF( trn_tgl.cuti_id = 39, tgl_cuti, NULL)) as ul,
         COUNT(IF( trn_tgl.cuti_type ="Cuti Khusus", tgl_cuti, NULL)) as ck
         ,
        
        ');
        $builder->join('trn_cuti', 'trn_tgl.trn_id = trn_cuti.trn_id');
       
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id');
        $builder->join('mst_position', 'trn_cuti.position_id = mst_position.position_id');
        $builder->join('branch', 'trn_cuti.branch_id = branch.branch_id');
        $builder->groupby('trn_cuti.employee_id');
        $query = $builder->where("DATE_FORMAT(tgl_dari, '%Y')")->get();

        return $query;
    }

    public function get_id_post_employee($id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('mst_employee');
        $builder->select('*');
        $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id');
        $builder->where('employee_id', $id);
        $query = $builder->get();

        return $query;
    }

    public function get_id_post_cuti($id)
    {
        $db = \Config\Database::connect();

        $builder = $db->table('mst_cuti');
        $builder->select('*');
        $builder->where('cuti_id', $id);
        $query = $builder->get();

        return $query;
    }

    public function count_jumlah_cuti($employee_id, $cuti_id, $tgl_dari)
    {
        // $db = \Config\Database::connect();

        $builder = $this->selectSum('cuti_jumlah');
        // $builder->select('*');
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id');
        $builder->where('trn_cuti.employee_id', $employee_id);
        $builder->where('trn_cuti.cuti_id', $cuti_id);
        $builder->where('YEAR(tgl_dari)',  $tgl_dari);
        $query = $builder->get();

        return $query;
    }

    public function count_jumlah_cuti_detail($employee_id, $tahun)
    {
        // $db = \Config\Database::connect();

        $builder = $this->selectSum('cuti_jumlah');
        // $builder->select('*');
        $builder->join('mst_employee', 'trn_cuti.employee_id = mst_employee.employee_id');
        $builder->join('mst_cuti', 'trn_cuti.cuti_id = mst_cuti.cuti_id');
        $builder->where('trn_cuti.employee_id', $employee_id);
        $builder->where('YEAR(tgl_dari)',  $tahun);
        $query = $builder->get();

        return $query;
    }

    public function count_jumlah_cuti_id($id, $tahun, $tanggal)
    {
        // $db = \Config\Database::connect();

        $builder = $this->selectSum('cuti_jumlah');
        $builder->where('employee_id', $id);
        $builder->where('YEAR(tgl_dari)',  $tahun);
        $builder->where('tgl_dari<=',  $tanggal);
        $query = $builder->get();

        return $query;
    }
 

    public function check_generate($id)
    {
        $builder = $this->db->table('trn_tgl');
        $builder->selectCount('id');
        $builder->where(['trn_id' => $id]);
        $builder->get();

        return $builder;
    }

    public function hapus_tgl($id)
    {

        $builder = $this->db->table('trn_tgl');
        $builder->where('trn_id', $id);
        $builder->delete();

        return $builder;
    }

    public function delete_data($id)
    {
        $db = \Config\Database::connect();

        // Hapus data dari tabel utama
        $this->db->table('trn_cuti')->delete(['trn_id' => $id]);

        // Hapus data dari tabel lain
        $this->db->table('trn_tgl')->delete(['trn_id' => $id]);
    }

    public function nomorDokumen()
  {
      $bulan = date('n');
      $tahun = date('Y');
      // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

      $query = "SELECT max(trn_no) as maxKode FROM trn_cuti WHERE month(trn_date)='$bulan'";
    //   dd($query);
      $hasil = $this->query($query);
      $data  = $hasil->getRowArray();
    //   dd($data);
    
      $no= (int) substr($data['maxKode'], 4, 4);
      
      
      $noUrut= $no + 1;
    
      $kode = sprintf("%04s", $noUrut);
      $nomor = "ATL-".$kode."/"."CUTI"."/".$tahun;
      // $nomorbaru = $kode.$nomor;
      
      return $nomor;

  }
}
