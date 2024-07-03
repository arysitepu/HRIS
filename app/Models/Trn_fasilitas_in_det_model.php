<?php 

namespace App\Models;

use CodeIgniter\Model;

class Trn_fasilitas_in_det_model extends Model{

    protected $table = 'trn_facility_in_det';
    protected $primaryKey = 'id';
    protected $allowedFields = ['trn_id', 'facility_id', 'qty', 'kegunaan'];
    
    public function getFasilitas_in_det($id)
    {
        return $this->select('trn_facility_in_det.*, trn_id, type_name, facility_name, facility_code')
        ->join('mst_facility', 'trn_facility_in_det.facility_id = mst_facility.facility_id')
        ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')->where(['trn_id' => $id])->get();
    }

    public function getFasilitasInDet_id($id = false)
    {
        if($id == false){
            $this->get();
        }
        return $this->table('trn_facility_in_det')->select('trn_facility_in_det.*, trn_facility_in_det.kegunaan as kegunaan_detail,
        trn_facility_in.trn_no, mst_facility.facility_name')
        ->join('mst_facility', 'trn_facility_in_det.facility_id = mst_facility.facility_id')
        ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
        ->join('trn_facility_in', 'trn_facility_in_det.trn_id = trn_facility_in.trn_id')->where(['id' => $id])->first();
        
    }

    public function getFasilitas_in($id = false)
    {
        if($id == false){
            $this->get();
        }

        return $this->table('trn_facility_in_det')
        ->join('mst_facility', 'trn_facility_in_det.facility_id = mst_facility.facility_id')
        ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
        ->join('trn_facility_in', 'trn_facility_in_det.trn_id = trn_facility_in.trn_id')->where(['trn_facility_in_det.trn_id' => $id])->first();
    }

}