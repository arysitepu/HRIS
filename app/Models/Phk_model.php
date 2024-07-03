<?php

namespace App\Models;
use CodeIgniter\Model;

class Phk_model extends Model
{
  protected $table = 'trn_phk';
  protected $primaryKey = 'trn_id';
  protected $useTimestamps = true;
  protected $allowedFields = ['trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'phk_date', 'phk_desc', 'employee_status', 'posting']; 
  protected $createdField = 'create_date';
  protected $updatedField = 'update_date';

  public function getPhk()
  {             
      $query = $this->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id')
      ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
      ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
      ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
      ->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')
      ->paginate(5);
 
      return $query;

  
  }

  public function PrintList()
  {             

      $query = $this->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id')
      ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
      ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
      ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
      ->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')
      // ->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')
      ->get();
 
      return $query;

  
  }

  public function getPhk_id($id = false)
  {
    
    if($id == false){
      return $this->get();
    }
    // return $this->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')->where(['trn_id' => $id])->first();
    return  $this->select('trn_phk.*, e1.employee_name as employee_name,e2.employee_name as buat_name ,e3.employee_name as setuju_name ')
    ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
    ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
    ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')->where(['trn_id' => $id])->first();
   
}

public function search_multiple($nama, $tahun, $bulan, $keyword)
{
  $builder = $this->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id');
  $builder->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id');
  $builder->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id');
  $builder->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id');
  $builder->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id');

  if($nama){
    $query = $builder->like('mst_employee.employee_name', $nama)->paginate(5);
    return $query;  
  }elseif($tahun){
    $query = $builder->where("DATE_FORMAT(trn_date,'%Y')", $tahun)->paginate(5);
    return $query;
  }elseif($bulan){
    $query = $builder->where("DATE_FORMAT(trn_date,'%Y-%m')", $bulan)->paginate(5);
    return $query;
  }elseif($keyword){
    $query = $builder->where('trn_date', $keyword)->paginate(5);
    return $query;
  }
}

public function search($tahun, $bulan, $keyword)
{
  $builder = $this->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id');
  $builder->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id');
  $builder->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id');
  $builder->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id');
  $builder->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id');

if($tahun){
    $query = $builder->where("DATE_FORMAT(trn_date,'%Y')", $tahun)->get();
    return $query;
  }elseif($bulan){
    $query = $builder->where("DATE_FORMAT(trn_date,'%Y-%m')", $bulan)->get();
    return $query;
  }elseif($keyword){
    $query = $builder->where('trn_date', $keyword)->get();
    return $query;
  }
}


public function searchPrint($keyword)
{
  return $this->table('trn_phk')->select('trn_phk.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
  ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
  ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
  ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
  ->where('trn_date', $keyword)->get(); 
}

// public function searchPrint($keyword)
// {
//   return $this->table('trn_phk')->select('trn_phk.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
//   ->where('trn_date', $keyword)->get(); 
// }

public function search_by_month($bulan)
{


  return $this->table('trn_phk')->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id')
  ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
  ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
  ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
  ->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')
  ->where("DATE_FORMAT(trn_date,'%Y-%m')", $bulan)->paginate(5);
  
}

public function search_by_monthPrint($bulan)
{

  return $this->table('trn_phk')->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
  ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
  ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
  ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
  ->where("DATE_FORMAT(trn_date,'%Y-%m')", $bulan)->get();
  
}

public function search_by_years($tahun)
{
  return $this->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id')
  ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
  ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
  ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
  ->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')
  ->where("DATE_FORMAT(trn_date,'%Y')", $tahun)->paginate(5);
}

public function search_by_name($nama)
{
  return $this->table('trn_phk')->select('trn_phk.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name, mst_employee.branch_id, mst_employee.position_id')
  ->join('mst_employee e1', 'trn_phk.employee_id = e1.employee_id')
  ->join('mst_employee e2', 'trn_phk.employee_id_buat = e2.employee_id')
  ->join('mst_employee e3', 'trn_phk.employee_id_setuju = e3.employee_id')
  ->join('mst_employee', 'trn_phk.employee_id = mst_employee.employee_id')
  
  ->like('mst_employee.employee_name', $nama)->paginate(5);
}


public function nomorDokumen()
{
    $bulan = date('n');
    $tahun = date('Y');
    // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

    $query = "SELECT max(trn_no) as maxKode FROM trn_phk WHERE month(trn_date)='$bulan'";

    $hasil = $this->query($query);
    $data  = $hasil->getRowArray();
  
    $no= (int) substr($data['maxKode'], 4, 4);
  
    
    
    $noUrut= $no + 1;
  
    $kode = sprintf("%04s", $noUrut);
    $nomor = "ATL-".$kode."/"."PHK"."/".$tahun;
    // $nomorbaru = $kode.$nomor;
    
    return $nomor;

}

public function nomorDokumenResign()
{
    $bulan = date('n');
    $tahun = date('Y');
    // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

    $query = "SELECT max(trn_no) as maxKode FROM trn_phk WHERE month(trn_date)='$bulan'";

    $hasil = $this->query($query);
    $data  = $hasil->getRowArray();
  
    $no= (int) substr($data['maxKode'], 4, 4);
  
    
    
    $noUrut= $no + 1;
  
    $kode = sprintf("%04s", $noUrut);
    $nomor = "ATL-".$kode."/"."RESIGN"."/".$tahun;
    // $nomorbaru = $kode.$nomor;
    
    return $nomor;

}

public function nomorDokumenPensiun()
{
    $bulan = date('n');
    $tahun = date('Y');
    // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

    $query = "SELECT max(trn_no) as maxKode FROM trn_phk WHERE month(trn_date)='$bulan'";

    $hasil = $this->query($query);
    $data  = $hasil->getRowArray();
  
    $no= (int) substr($data['maxKode'], 4, 4);
  
    
    
    $noUrut= $no + 1;
  
    $kode = sprintf("%04s", $noUrut);
    $nomor = "ATL-".$kode."/"."PEN"."/".$tahun;
    // $nomorbaru = $kode.$nomor;
    
    return $nomor;

}

public function posting($employee_id, $data)
  {
    $db = \Config\Database::connect();
    $builder = $db->table('mst_employee');
    $builder->where('employee_id',  $employee_id);
    // $builder->where('status');
    $builder->update($data);
  }

public function nomorDokumen1()
{
    $bulan = date('n');
    $tahun = date('Y');
    // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

    $query = "SELECT max(trn_no) as maxKode FROM trn_phk WHERE month(trn_date)='$bulan'";

    $hasil = $this->query($query);
    $data  = $hasil->getRowArray();
  
    $no= (int) substr($data['maxKode'], 4, 4);
  
    
    
    $noUrut= $no + 1;
  
    $kode = sprintf("%04s", $noUrut);
    $nomor = "ATL-".$kode."/"."OUT"."/".$tahun;
    // $nomorbaru = $kode.$nomor;
    
    return $nomor;

}

  
}