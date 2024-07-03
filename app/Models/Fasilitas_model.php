<?php

namespace App\Models;
use CodeIgniter\Model;

class Fasilitas_model extends Model{

    protected $table = 'mst_employee_facility';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'type_id', 'facility_name', 'facility_desc', 'facility_asset_no'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getFasilitas_karyawan()
    {
        return $this->join('mst_employee', 'mst_employee_facility.employee_id = mst_employee.employee_id', 'LEFT')
        ->join('mst_type', 'mst_employee_facility.type_id = mst_type.type_id', 'LEFT')->paginate(5);
    }

    public function getFasilitas_id($id)
    {
        return $this->join('mst_employee', 'mst_employee_facility.employee_id = mst_employee.employee_id', 'LEFT')
        ->join('mst_type', 'mst_employee_facility.type_id = mst_type.type_id', 'LEFT')->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->join('mst_employee', 'mst_employee_facility.employee_id = mst_employee.employee_id', 'LEFT')
        ->join('mst_type', 'mst_employee_facility.type_id = mst_type.type_id', 'LEFT')->like(['employee_name' => $keyword])->paginate(5);
    }



}