<?php 

namespace App\Models;

use CodeIgniter\Model;

class Trn_fasilitas_model extends Model{

    protected $table = 'trn_facility';
    protected $primaryKey = 'trn_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'tgl_pinjam', 
                                'tgl_kembali', 'kegunaan', 'status'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';


    public function get_fasilitas()
    {

        $builder = $this->table('trn_facility');
        $builder->select('trn_facility.*, mst_employee.*, branch.*, 
                          trn_facility.status, branch.status AS branch_status,
                          branch.branch_name,
                          branch.branch_id');
        $builder->join('mst_employee', 'trn_facility.employee_id = mst_employee.employee_id');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
        $query = $builder->paginate(5);
        return $query;

        // $builder = $this->table('trn_facility.*');
        // $builder->join('mst_employee', 'trn_facility.employee_id = mst_employee.employee_id');
        // $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
        // $query = $builder->paginate(5);
        // return $query;
    }

    // public function get_fasilitas()
    // {
    //     return $this->table('trn_facility')->join('mst_employee', 'trn_facility.employee_id = mst_employee.employee_id')->paginate(5);
    // }

    public function getFasilitas_id($id = false)
    {
        if($id == false){
            $this->get();
        }

        return $this->select('trn_facility.*, e1.employee_name as employee_name, e2.employee_name as buat_name, 
        e3.employee_name as setuju_name')
        ->join('mst_employee e1', 'trn_facility.employee_id = e1.employee_id')
        ->join('mst_employee e2', 'trn_facility.employee_id_buat = e2.employee_id')
        ->join('mst_employee e3', 'trn_facility.employee_id_setuju = e3.employee_id')
        ->where(['trn_id' => $id])->first();
    }

    public function search($keyword, $branch_id, $status,$bulan_pinjam, $bulan_kembali)
    {

        $builder = $this->table('trn_facility');
        $builder->select('trn_facility.*, mst_employee.*, branch.*, 
                          trn_facility.status, branch.status AS branch_status,
                          branch.branch_name,
                          branch.branch_id');
        $builder->join('mst_employee', 'trn_facility.employee_id = mst_employee.employee_id');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');

        if($keyword){
            $builder->like('mst_employee.employee_name', "%$keyword%");
        }

        if($branch_id){
            $builder->where('mst_employee.branch_id', $branch_id);
        }

        if($status){
            $builder->where('trn_facility.status', $status);
        }

        if($bulan_pinjam && $bulan_kembali){
            $builder->where("DATE_FORMAT(trn_facility.tgl_pinjam, '%Y-%m') >=", $bulan_pinjam);
            $builder->where("DATE_FORMAT(trn_facility.tgl_kembali, '%Y-%m') <=", $bulan_kembali);
        }elseif($bulan_pinjam){
            $builder->where("DATE_FORMAT(trn_facility.tgl_pinjam, '%Y-%m')", $bulan_pinjam);
        }elseif($bulan_kembali){
            $builder->where("DATE_FORMAT(trn_facility.tgl_kembali, '%Y-%m')", $bulan_kembali);
        }
        $query = $builder->paginate(5);
        return $query;

       
    }

    public function nomorDokumen()
    {
        $bulan = date('n');
        $tahun = date('Y');
        // $nomor = "ATL-/".$kode.$bulan."/".$tahun;
  
        $query = "SELECT max(trn_no) as maxKode FROM trn_facility WHERE month(trn_date)='$bulan'";
    
        $hasil = $this->query($query);
        $data  = $hasil->getRowArray();
      
        $no= (int) substr($data['maxKode'], 4, 4);
      
        
        
        $noUrut= $no + 1;
      
        $kode = sprintf("%04s", $noUrut);
        $nomor = "ATL-".$kode."/"."FAS"."/".$tahun;
        // $nomorbaru = $kode.$nomor;
        
        return $nomor;
  
    }

}