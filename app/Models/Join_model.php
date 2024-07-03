<?php

namespace App\Models;
use CodeIgniter\Model;

class Join_model extends Model
{
  protected $table = 'trn_join';
  protected $primaryKey = 'trn_id';
  protected $useTimestamps = true;
  protected $allowedFields = ['trn_no', 'trn_date', 
                              'employee_id_buat', 
                              'employee_id_setuju', 
                              'employee_id', 
                              'position_id', 
                              'branch_id', 
                              'employee_status',
                              'join_start', 
                              'note',
                              'posting'];
  protected $createdField = 'create_date';
  protected $updatedField = 'update_date';

  public  function getJoin()
  {

    $builder = $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
    e4.position_name as position, e5.branch_name as branch');
    $builder->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id');
    $builder->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id');
    $builder->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id');
    $builder->join('mst_position e4', 'trn_join.position_id = e4.position_id');
    $builder->join('branch e5', 'trn_join.branch_id = e5.branch_id');
    $query = $builder->paginate(5);
    // $query =  $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
    // e4.position_name as position, e5.branch_name as branch')
    // ->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id')
    // ->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id')
    // ->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id')
    // ->join('mst_position e4', 'trn_join.position_id = e4.position_id')
    // ->join('branch e5', 'trn_join.branch_id = e5.branch_id')
    // ->paginate(5); 

   return $query;
  }

  public  function getJoin_print()
  {
    $builder = $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
    e4.position_name as position, e5.branch_name as branch');
    $builder->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id');
    $builder->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id');
    $builder->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id');
    $builder->join('mst_position e4', 'trn_join.position_id = e4.position_id');
    $builder->join('branch e5', 'trn_join.branch_id = e5.branch_id');

    $query = $builder->get(); 

   return $query;
  }

public function getJoin_id($id = false)
{
  if($id == false){
    return $this->get();
  }

return $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
  e4.position_name as position, e5.branch_name as branch,e1.lahir_tempat as tempat_lahir, e1.lahir_tanggal as tanggal_lahir, e1.alamat_ktp as alamat')
  ->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id')
  ->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id')
  ->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id')
  ->join('mst_position e4', 'trn_join.position_id = e4.position_id')
  ->join('branch e5', 'trn_join.branch_id = e5.branch_id')->where(['trn_id' => $id])->first();

}

public function search($nama,$tanggal, $bulan, $tahun, $branch_id, $tanggal_dari, $tanggal_sampai)
  {

    $builder = $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name,
                              e3.employee_name as setuju_name,
                              e4.position_name as position, 
                              branch.branch_name as branch, 
                              branch.branch_id');
    $builder->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id');
    $builder->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id');
    $builder->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id');
    $builder->join('mst_position e4', 'trn_join.position_id = e4.position_id');
    $builder->join('branch', 'trn_join.branch_id = branch.branch_id');
    $builder->join('mst_employee', 'trn_join.employee_id = mst_employee.employee_id');

    if($nama){
      $query = $builder->like(['mst_employee.employee_name' => $nama]);
      
    }elseif($branch_id && $tanggal_dari && $tanggal_sampai){
      $query = $builder->where('trn_join.branch_id', $branch_id)
                     ->where('join_start>=', $tanggal_dari)
                     ->where('join_start<=', $tanggal_sampai);
    }elseif($tanggal_dari && $tanggal_sampai){
      $query = $builder->where('join_start>=', $tanggal_dari)
               ->where('join_start<=', $tanggal_sampai);
    }elseif($tanggal){
      $query = $builder->where('join_start', $tanggal);
     
    }elseif($bulan){
      $query = $builder->where("DATE_FORMAT(join_start, '%Y-%m')", $bulan);
     
    }elseif($tahun){
      $query = $builder->where("DATE_FORMAT(join_start, '%Y')", $tahun);
     
    }elseif($branch_id){
      $query = $builder->where('trn_join.branch_id', $branch_id);
    }
    return $query->paginate(5);

  }

  public function count($nama,$tanggal, $bulan, $tahun, $branch_id, $tanggal_dari, $tanggal_sampai)
  {
    $builder = $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name,
    e3.employee_name as setuju_name,
    e4.position_name as position, 
    branch.branch_name as branch, 
    branch.branch_id');
    $builder->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id');
    $builder->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id');
    $builder->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id');
    $builder->join('mst_position e4', 'trn_join.position_id = e4.position_id');
    $builder->join('branch', 'trn_join.branch_id = branch.branch_id');
    $builder->join('mst_employee', 'trn_join.employee_id = mst_employee.employee_id');

        if($nama){
        $query = $builder->like(['mst_employee.employee_name' => $nama]);

        }elseif($branch_id && $tanggal_dari && $tanggal_sampai){
        $query = $builder->where('trn_join.branch_id', $branch_id)
        ->where('join_start>=', $tanggal_dari)
        ->where('join_start<=', $tanggal_sampai);
        }elseif($tanggal_dari && $tanggal_sampai){
        $query = $builder->where('join_start>=', $tanggal_dari)
        ->where('join_start<=', $tanggal_sampai);
        }elseif($tanggal){
        $query = $builder->where('join_start', $tanggal);

        }elseif($bulan){
        $query = $builder->where("DATE_FORMAT(join_start, '%Y-%m')", $bulan);

        }elseif($tahun){
        $query = $builder->where("DATE_FORMAT(join_start, '%Y')", $tahun);

        }elseif($branch_id){
        $query = $builder->where('trn_join.branch_id', $branch_id);
        }
        return $query->CountAllResults();

  }

  public function searchPrint($nama,$tanggal, $bulan, $tahun, $branch_id, $tanggal_dari, $tanggal_sampai)
  {

        $builder = $this->select('trn_join.*, e1.employee_name ,e2.employee_name as buat_name,
        e3.employee_name as setuju_name,
        e4.position_name as position, 
        branch.branch_name as branch, 
        branch.branch_id');
        $builder->join('mst_employee e1', 'trn_join.employee_id = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_join.employee_id_buat = e2.employee_id');
        $builder->join('mst_employee e3', 'trn_join.employee_id_setuju = e3.employee_id');
        $builder->join('mst_position e4', 'trn_join.position_id = e4.position_id');
        $builder->join('branch', 'trn_join.branch_id = branch.branch_id');
        $builder->join('mst_employee', 'trn_join.employee_id = mst_employee.employee_id');

        if($nama){
        $query = $builder->like(['mst_employee.employee_name' => $nama]);

        }elseif($branch_id && $tanggal_dari && $tanggal_sampai){
        $query = $builder->where('trn_join.branch_id', $branch_id)
        ->where('join_start>=', $tanggal_dari)
        ->where('join_start<=', $tanggal_sampai);
        }elseif($tanggal_dari && $tanggal_sampai){
        $query = $builder->where('join_start>=', $tanggal_dari)
        ->where('join_start<=', $tanggal_sampai);
        }elseif($tanggal){
        $query = $builder->where('join_start', $tanggal);

        }elseif($bulan){
        $query = $builder->where("DATE_FORMAT(join_start, '%Y-%m')", $bulan);

        }elseif($tahun){
        $query = $builder->where("DATE_FORMAT(join_start, '%Y')", $tahun);

        }elseif($branch_id){
        $query = $builder->where('trn_join.branch_id', $branch_id);
        }
        return $query->get();

  }

 

  public function posting($employee_id, $data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('mst_employee');
    $builder->where('employee_id',  $employee_id);
    // $builder->where('status');
    $builder->update($data);
  }

  public function nomorDokumen()
  {
      $bulan = date('n');
      $tahun = date('Y');
      // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

      $query = "SELECT max(trn_no) as maxKode FROM trn_join WHERE month(trn_date)='$bulan'";
      // dd($query);
      $hasil = $this->query($query);
      $data  = $hasil->getRowArray();
      // dd($data);
    
      $no= (int) substr($data['maxKode'], 4, 4);
      
      
      $noUrut= $no + 1;
    
      $kode = sprintf("%04s", $noUrut);
      $nomor = "ATL-".$kode."/"."ANGKAT"."/".$tahun;
      // $nomorbaru = $kode.$nomor;
      
      return $nomor;

  }

}