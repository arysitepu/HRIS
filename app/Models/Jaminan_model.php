<?php

namespace App\Models;
use CodeIgniter\Model;

class Jaminan_model extends Model
{
  protected $table = 'trn_jaminan';
  protected $primaryKey = 'trn_id';
  protected $useTimestamps = true;
  protected $allowedFields = ['trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'jaminan_name', 'jaminan_desc',
                              'tgl_serah', 'type_id', 'status', 'gambar'];
  protected $createdField = 'create_date';
  protected $updatedField = 'update_date';

  public function getJaminan()
  {      
    
   $builder = $this->table('trn_jaminan'); 
   $builder->select('trn_jaminan.*, mst_employee.employee_name, branch.branch_name');
   $builder->join('mst_employee', 'trn_jaminan.employee_id = mst_employee.employee_id');
   $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
   $query = $builder->paginate(5);
    

   return $query;
  }

  public function getPrintJaminan()
  {      
    
    $builder = $this->table('trn_jaminan'); 
    $builder->select('trn_jaminan.*, mst_employee.employee_name, branch.branch_name,');
    $builder->join('mst_employee', 'trn_jaminan.employee_id = mst_employee.employee_id');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $query = $builder->get();
     
 
    return $query;

  //   $query =  $this->select('trn_jaminan.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
  //   mst_type.type_name as type_name')
  //   ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
  //   ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
  //   ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
  //   ->join('mst_type', 'trn_jaminan.type_id = mst_type.type_id')
  //   ->get(); 

  //  return $query;
  }

  public function countJaminan()
  {      
    
    $query =  $this->select('trn_jaminan.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
    mst_type.type_name as type_name')
    ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
    ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
    ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
    ->join('mst_type', 'trn_jaminan.type_id = mst_type.type_id')
    ->CountAllResults(); 

   return $query;
  }

  

  public function getJaminan_id($id)
  {
    
    
      if($id == false){
        return $this->get();
      }
      return $this->select('trn_jaminan.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name, 
      mst_type.type_name as type_name')
      ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
      ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
      ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
      ->join('mst_type', 'trn_jaminan.type_id = mst_type.type_id')
      ->where(['trn_id' => $id])->first();
     
  }


public function search($nama, $tanggal, $bulan, $tahun, $branch_id)
{
  
   $builder = $this->table('trn_jaminan'); 
   $builder->select('trn_jaminan.*, mst_employee.employee_name, branch.branch_name');
   $builder->join('mst_employee', 'trn_jaminan.employee_id = mst_employee.employee_id');
   $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
   if($tanggal){
    $query = $builder->where('trn_date', $tanggal)->paginate(5);
     
   }elseif($branch_id){
    $query = $builder->where('mst_employee.branch_id', $branch_id)->paginate(5);
  
   }elseif($bulan){
    $query = $builder->where("DATE_FORMAT(trn_date, '%Y-%m')", $bulan)->paginate(5);
  
   }elseif($tahun){
    $query = $builder->where("DATE_FORMAT(trn_date, '%Y')", $tahun)->paginate(5);
  
   }elseif($nama){
    $query = $builder->like(['mst_employee.employee_name' => $nama])->paginate(5);
    
   }
   return $query;

}

public function count_search($nama, $tanggal, $bulan, $tahun, $branch_id)
{
  $builder = $this->table('trn_jaminan'); 

   $builder->select('trn_jaminan.*, mst_employee.employee_name, branch.branch_name');
   $builder->join('mst_employee', 'trn_jaminan.employee_id = mst_employee.employee_id');
   $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
   if ($tanggal) {
        $builder->where('trn_date', $tanggal);
    }
    if ($branch_id) {
        $builder->where('mst_employee.branch_id', $branch_id);
    }
    if ($bulan) {
        $builder->where("DATE_FORMAT(trn_date, '%Y-%m')", $bulan);
    }
    if ($tahun) {
        $builder->where("DATE_FORMAT(trn_date, '%Y')", $tahun);
    }
    if ($nama) {
        $builder->like('mst_employee.employee_name', $nama);
    }
    return $builder->countAllResults(); // Call without parameters
  
}



public function getJaminan_print()
{
  
  $query = null;
  
  // $query =  $this->select('trn_jaminan.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name,
  // mst_type.type_name as type_name')
  // ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
  // ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
  // ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
  // ->join('mst_type', 'trn_jaminan.type_id = mst_type.type_id')
  // ->get(); 

 return $query;
}

public function search_print($nama, $tanggal, $bulan, $tahun, $branch_id)
{
  
  $builder = $this->table('trn_jaminan'); 
  $builder->select('trn_jaminan.*, mst_employee.employee_name, branch.branch_name');
  $builder->join('mst_employee', 'trn_jaminan.employee_id = mst_employee.employee_id');
  $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
  if($tanggal){
   $query = $builder->where('trn_date', $tanggal);
    
  }elseif($branch_id){
   $query = $builder->where('mst_employee.branch_id', $branch_id);
 
  }elseif($bulan){
   $query = $builder->where("DATE_FORMAT(trn_date, '%Y-%m')", $bulan);
 
  }elseif($tahun){
   $query = $builder->where("DATE_FORMAT(trn_date, '%Y')", $tahun);
 
  }elseif($nama){
   $query = $builder->like(['mst_employee.employee_name' => $nama]);
   
  }
  return $query->get();
}
// public function search_print($keyword)
// {
  
// // return $this->table('trn_sp')->like('trn_date', $keyword);

//   return $this->select('trn_jaminan.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
//   ->where('trn_date', $keyword)->get();
// }

// public function search_by_month_print($bulan)
// {
//   return $this->select('trn_jaminan.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
//   ->where("DATE_FORMAT(trn_date, '%Y-%m')", $bulan)->get();
// }

// public function search_by_years_print($tahun)
// {
//   return $this->select('trn_jaminan.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_jaminan.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_jaminan.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_jaminan.employee_id_setuju = e3.employee_id')
//   ->where("DATE_FORMAT(trn_date, '%Y')", $tahun)->get();
// }

public function nomorDokumen()
  {
      $bulan = date('n');
      $tahun = date('Y');
      // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

      $query = "SELECT max(trn_no) as maxKode FROM trn_jaminan WHERE month(trn_date)='$bulan'";
  
      // dd($query);

      $hasil = $this->query($query);
      $data  = $hasil->getRowArray();
      
    
      $no= (int) substr($data['maxKode'], 4, 4);
      
      
      $noUrut= $no + 1;
    
      $kode = sprintf("%04s", $noUrut);
      $nomor = "ATL-".$kode."/"."JAMINAN"."/".$tahun;
      // $nomorbaru = $kode.$nomor;
      
      return $nomor;

  }


  
  
    
}