<?php

namespace App\Models;

use CodeIgniter\Model;

class Trn_position_model extends Model{

    protected $table = 'trn_position';
    protected $primaryKey = 'trn_id';
    protected $allowedFields = ['trn_no', 
                                'trn_date', 
                                'employee_id_buat', 
                                'employee_id_setuju', 
                                'employee_id', 
                                'position_id',
                                'position_id_old', 
                                'branch_id', 
                                'branch_id_old', 
                                'position_start', 
                                'position_start_old',
                                'note', 
                                'posting'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function get_position()
    {
        return $this->select('trn_position.*, p1.position_name as position_name, p2.position_name as position_name_old,
        b1.branch_name as branch_name, b2.branch_name as branch_name_old, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
        ->join('mst_position p1', 'trn_position.position_id = p1.position_id')
        ->join('mst_position p2', 'trn_position.position_id_old = p2.position_id')
        ->join('branch b1', 'trn_position.branch_id = b1.branch_id')
        ->join('branch b2', 'trn_position.branch_id_old = b2.branch_id')
        ->join('mst_employee e1', 'trn_position.employee_id = e1.employee_id')
        ->join('mst_employee e2', 'trn_position.employee_id_buat = e2.employee_id')
        ->join('mst_employee e3', 'trn_position.employee_id_setuju = e3.employee_id')
        ->paginate(5);
    }

    public function getPosition_id($id = false)
    {
        if($id == false){
            $this->get();
        }

        return $this->select('trn_position.*, p1.position_name as position_name, p2.position_name as position_name_old,
        b1.branch_name as branch_name, b2.branch_name as branch_name_old, 
        e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
        ->join('mst_position p1', 'trn_position.position_id = p1.position_id')
        ->join('mst_position p2', 'trn_position.position_id_old = p2.position_id')
        ->join('branch b1', 'trn_position.branch_id = b1.branch_id')
        ->join('branch b2', 'trn_position.branch_id_old = b2.branch_id')
        ->join('mst_employee e1', 'trn_position.employee_id = e1.employee_id')
        ->join('mst_employee e2', 'trn_position.employee_id_buat = e2.employee_id')
        ->join('mst_employee e3', 'trn_position.employee_id_setuju = e3.employee_id')
        ->where(['trn_id' => $id])->first();
    }

    public function posting($employee_id, $data)
    {
      $db = \Config\Database::connect();
      $builder = $db->table('mst_employee');
      $builder->where('employee_id', $employee_id);
      $builder->update($data);
    }

    public function unposting($employee_id, $data)
    {
      $db = \Config\Database::connect();
      $builder = $db->table('mst_employee');
      $builder->where('employee_id', $employee_id);
      $builder->update($data);
    }

    public function search_position($keyword, $branch_id)
    {
        $builder = $this->select('trn_position.*, p1.position_name as position_name, 
                                    p2.position_name as position_name_old,
                                    b1.branch_name as branch_name, 
                                    b2.branch_name as branch_name_old,
                                    e1.employee_name as employee_name, 
                                    e2.employee_name as buat_name, 
                                    e3.employee_name as setuju_name');
        $builder->join('mst_position p1', 'trn_position.position_id = p1.position_id');
        $builder->join('mst_position p2', 'trn_position.position_id_old = p2.position_id');
        $builder->join('branch b1', 'trn_position.branch_id = b1.branch_id');
        $builder->join('branch b2', 'trn_position.branch_id_old = b2.branch_id');
        $builder->join('mst_employee e1', 'trn_position.employee_id = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_position.employee_id_buat = e2.employee_id');
        $builder->join('mst_employee e3', 'trn_position.employee_id_setuju = e3.employee_id');
        $builder->join('mst_employee ', 'trn_position.employee_id = mst_employee.employee_id');

        if($keyword){
            $builder->like(['mst_employee.employee_name' => $keyword]);
        }elseif($branch_id){
            $builder->where('trn_position.branch_id', $branch_id);
        }
        $query = $builder->paginate(5);
        return $query;
        // return $this->select('trn_position.*, p1.position_name as position_name, p2.position_name as position_name_old,
        // b1.branch_name as branch_name, b2.branch_name as branch_name_old, 
        // e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
        // ->join('mst_position p1', 'trn_position.position_id = p1.position_id')
        // ->join('mst_position p2', 'trn_position.position_id_old = p2.position_id')
        // ->join('branch b1', 'trn_position.branch_id = b1.branch_id')
        // ->join('branch b2', 'trn_position.branch_id_old = b2.branch_id')
        // ->join('mst_employee e1', 'trn_position.employee_id = e1.employee_id')
        // ->join('mst_employee e2', 'trn_position.employee_id_buat = e2.employee_id')
        // ->join('mst_employee e3', 'trn_position.employee_id_setuju = e3.employee_id')
        // ->join('mst_employee ', 'trn_position.employee_id = mst_employee.employee_id')
        // ->like(['mst_employee.employee_name' => $keyword])->paginate(5);
    }

    public function nomorDokumen()
    {
        $bulan = date('n');
        $tahun = date('Y');
        // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

        $query = "SELECT max(trn_no) as maxKode FROM trn_position WHERE month(trn_date)='$bulan'";
    
        $hasil = $this->query($query);
        $data  = $hasil->getRowArray();
      
        $no= (int) substr($data['maxKode'], 4, 4);
      
        
        
        $noUrut= $no + 1;
      
        $kode = sprintf("%04s", $noUrut);
        $nomor = "ATL-".$kode."/"."JAB"."/".$tahun;
        // $nomorbaru = $kode.$nomor;
        
        return $nomor;
    }

}