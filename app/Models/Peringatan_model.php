<?php

namespace App\Models;
use CodeIgniter\Model;

class Peringatan_model extends Model
{
  protected $table = 'trn_sp';
  protected $primaryKey = 'trn_id';
  protected $allowedFields = ['trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'position_id',
                              'sp_type', 'sp_desc'];
  protected $useTimestamps = true;
  protected $createdField = 'create_date';
  protected $updatedField = 'update_date';

  public function getPeringatan()
  {   



    $query =  $this->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
    ->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id')
    ->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id')
    ->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id')
    ->join('mst_position', 'trn_sp.position_id = mst_position.position_id')
    ->paginate(5); 

   return $query;

  }

  public function getPeringatanPrint()
  {   
    $query =  $this->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
    ->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id')
    ->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id')
    ->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id')
    ->join('mst_position', 'trn_sp.position_id = mst_position.position_id')
    ->get(); 

   return $query;

  }

  public function getPeringatan_id($id = false)
  {
    
    
    if($id == false){
      return $this->get();
    }

 

    return $this->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name, e3.employee_name as setuju_name, e4.position_name as position, e1.no_ktp as ktp')
    ->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id')
    ->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id')
    ->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id')
    ->join('mst_position e4', 'trn_sp.position_id = e4.position_id',)
    ->where(['trn_id' => $id])->first();
   
  }

  public function searchPrint($tanggal, $bulan, $tahun)
  {
    $builder = $this->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name');
    $builder->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id');
    $builder->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id');
    $builder->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id');
    if($tanggal){
      $builder->where("trn_date", $tanggal);
    }elseif($bulan){
      $builder->where("DATE_FORMAT(trn_date, '%Y-%m')", $bulan);
    }elseif($tahun){
      $builder->where("DATE_FORMAT(trn_date, '%Y')", $tahun);
    }
    $query = $builder->get();
    return $query;
  }

public function search($nama, $tanggal, $bulan, $tahun)
{
    $builder = $this->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name');
    $builder->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id');
    $builder->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id');
    $builder->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id');
    $builder->join('mst_employee', 'trn_sp.employee_id = mst_employee.employee_id');
    if($nama){
      $builder->like('mst_employee.employee_name', $nama);
    }
    if($tanggal){
      $builder->where("trn_date", $tanggal);
    }elseif($bulan){
      $builder->where("DATE_FORMAT(trn_date, '%Y-%m')", $bulan);
    }elseif($tahun){
      $builder->where("DATE_FORMAT(trn_date, '%Y')", $tahun);
    }
    $query = $builder->paginate(5);
    return $query;
    }

// public function search_by_month($bulan)
// {
  


//   return $this->table('trn_sp')->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id')
//   ->where("DATE_FORMAT(trn_date,'%Y-%m')", $bulan)->paginate(5);
//   }

//   public function search_by_years($tahun)
// {
  


//   return $this->table('trn_sp')->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id')
//   ->where("DATE_FORMAT(trn_date,'%Y')", $tahun)->paginate(5);
//   }

//   public function search_by_name($nama)
//   {
//     return $this->table('trn_sp')->select('trn_sp.*, e1.employee_name ,e2.employee_name as buat_name ,e3.employee_name as setuju_name')
//   ->join('mst_employee e1', 'trn_sp.employee_id = e1.employee_id')
//   ->join('mst_employee e2', 'trn_sp.employee_id_buat = e2.employee_id')
//   ->join('mst_employee e3', 'trn_sp.employee_id_setuju = e3.employee_id')
//   ->join('mst_employee', 'trn_sp.employee_id = mst_employee.employee_id')
//   ->like('mst_employee.employee_name', $nama)->paginate(5);
//   }

  public function nomorDokumen()
    {
        $bulan = date('n');
        $tahun = date('Y');
        // $nomor = "ATL-/".$kode.$bulan."/".$tahun;
  
        $query = "SELECT max(trn_no) as maxKode FROM trn_sp WHERE month(trn_date)='$bulan'";
    
        $hasil = $this->query($query);
        $data  = $hasil->getRowArray();
      
        $no= (int) substr($data['maxKode'], 4, 4);
      
        
        
        $noUrut= $no + 1;
      
        $kode = sprintf("%04s", $noUrut);
        $nomor = "ATL-".$kode."/"."SP"."/".$tahun;
        // $nomorbaru = $kode.$nomor;
        
        return $nomor;
  
    }

}
