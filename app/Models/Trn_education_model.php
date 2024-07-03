<?php 

namespace App\Models;

use CodeIgniter\Model;

class Trn_education_model extends Model{

    protected $table = 'trn_education';
    protected $primaryKey = 'trn_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'education_type',
                                'education_name', 'education_address', 'education_major', 'ipk', 'tahun_masuk', 'tahun_lulus', 'biaya'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function get_education()
    {
        return $this->table('trn_education')->select('trn_education.*, e1.employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
        ->join('mst_employee e1', 'trn_education.employee_id = e1.employee_id')
        ->join('mst_employee e2', 'trn_education.employee_id_buat = e2.employee_id')
        ->join('mst_employee e3', 'trn_education.employee_id_setuju = e3.employee_id')->paginate(5);
    }

    public function getEducation_id($id = false)
    {
        if($id == false){

        $this->get();
        }

        return $this->table('trn_education')->select('trn_education.*, e1.employee_name as employee_name, e2.employee_name as buat_name, e3.employee_name as setuju_name')
        ->join('mst_employee e1', 'trn_education.employee_id = e1.employee_id')
        ->join('mst_employee e2', 'trn_education.employee_id_buat = e2.employee_id')
        ->join('mst_employee e3', 'trn_education.employee_id_setuju = e3.employee_id')->where(['trn_id' => $id])->first();
    }

    public function search_education($keyword)
    {
       return $this->join('mst_employee', 'trn_education.employee_id = mst_employee.employee_id')->like(['employee_name' => $keyword])->paginate(5);
    }

    public function nomorDokumen()
{
    $bulan = date('n');
    $tahun = date('Y');
    // $nomor = "ATL-/".$kode.$bulan."/".$tahun;

    $query = "SELECT max(trn_no) as maxKode FROM trn_education WHERE month(trn_date)='$bulan'";

    $hasil = $this->query($query);
    $data  = $hasil->getRowArray();
  
    $no= (int) substr($data['maxKode'], 4, 4);
  
    
    
    $noUrut= $no + 1;
  
    $kode = sprintf("%04s", $noUrut);
    $nomor = "ATL-".$kode."/"."EDU"."/".$tahun;
    // $nomorbaru = $kode.$nomor;
    
    return $nomor;

}


}