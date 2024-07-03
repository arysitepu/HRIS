<?php 

namespace App\Models;

use CodeIgniter\Model;

class Trn_fasilitas_det_model extends Model{

    protected $table = 'trn_facility_det';
    protected $primaryKey = 'id';
    
    protected $allowedFields = ['trn_id', 'facility_id', 'qty', 'gambar' ,'kegunaan'];
    
    public function get_fasilitas_det()
    {
        return $this->table('trn_facility_det')->join('mst_facility', 'trn_facility_det.facility_id = mst_facility.facility_id')
        ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
        ->join('trn_facility', 'trn_facility_det.trn_id = trn_facility.trn_id','LEFT')->get();
    }

    public function getFasilitas_det_id($id = false)
    {
        if($id == false){
            $this->get();
        }
       
         return $this->table('trn_facility_det')
        ->join('mst_facility', 'trn_facility_det.facility_id = mst_facility.facility_id')
        ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
        ->join('trn_facility', 'trn_facility_det.trn_id = trn_facility.trn_id','LEFT')->where(['trn_facility_det.trn_id' => $id])->first();
    }

    public function getFasilitas($id)
    {
        return $this->select('trn_facility_det.*, trn_id, type_name as type_name, facility_name, facility_code')
        ->join('mst_facility', 'trn_facility_det.facility_id = mst_facility.facility_id')
        ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
        ->where(['trn_id' => $id])->get();
    }

    public function getFasilitas_detail_id($id = false)
    {
        if($id == false){
            $this->get();
        }
       $builder = $this->select('trn_facility_det.*, trn_facility_det.kegunaan, trn_facility.trn_no, 
                                mst_facility.facility_name, 
                                mst_facility.facility_code, 
                                trn_facility_det.qty,
                                mst_employee.employee_name, 
                                branch.branch_name');
        $builder->join('mst_facility', 'trn_facility_det.facility_id = mst_facility.facility_id');
        $builder->join('mst_type', 'mst_facility.type_id = mst_type.type_id');
        $builder->join('trn_facility', 'trn_facility_det.trn_id = trn_facility.trn_id','LEFT');
        $builder->join('mst_employee', 'trn_facility.employee_id = mst_employee.employee_id', 'LEFT');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
        $query =  $builder->where(['id' => $id])->first();

        return $query;
    }

    // public function getFasilitas_detail_id($id = false)
    // {
    //     if($id == false){
    //         $this->get();
    //     }
    //     return $this->table('trn_facility_det')->select('trn_facility_det.*, trn_facility_det.kegunaan, trn_facility.trn_no, 
    //     mst_facility.facility_name, mst_facility.facility_code, trn_facility_det.qty')
    //     ->join('mst_facility', 'trn_facility_det.facility_id = mst_facility.facility_id')
    //     ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
    //     ->join('trn_facility', 'trn_facility_det.trn_id = trn_facility.trn_id','LEFT')->where(['id' => $id])->first();
    // }


    

}