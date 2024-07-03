<?php

namespace App\Models;

use CodeIgniter\Model;

class Mst_facility_model extends Model{

    protected $table = 'mst_facility';
    protected $primaryKey = 'facility_id';
    protected $useTimestamp = true;
    protected $allowedFields = ['type_id', 'facility_name', 'facility_code', 'facility_condition', 'branch_id'];
    protected $createdField = 'create_date';
    protected $updateField = 'update_date';

    public function getMst_fasilitas()
    {
        $builder = $this->table('mst_facility');
        $builder->join('mst_type', 'mst_facility.type_id = mst_type.type_id');
        $builder->join('branch', 'mst_facility.branch_id = branch.branch_id');
        $query = $builder->paginate(5);
        return $query;
    }
    
    public function get_mst_fasilitas_id($id)
    {
        $builder = $this->table('mst_facility');
        $builder->join('mst_type', 'mst_facility.type_id = mst_type.type_id');
        $builder->join('branch', 'mst_facility.branch_id = branch.branch_id');
        $query = $builder->where(['facility_id' => $id])->first();
        return $query;   
    }

}