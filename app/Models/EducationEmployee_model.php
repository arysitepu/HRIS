<?php

namespace App\Models;
use CodeIgniter\Model;

class EducationEmployee_model extends Model{

    protected $table = 'mst_employee_education';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'education_type', 'education_name', 'education_address', 'education_major', 'ipk',
                                'tahun_masuk', 'tahun_lulus', 'biaya_oleh'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';
    

    public function getEducation_employee()
    {
        return $this->select('mst_employee_education.*, mst_employee.employee_name')
        ->join('mst_employee', 'mst_employee_education.employee_id = mst_employee.employee_id', 'LEFT')->paginate(5);
    }

    public function getEducation_employee_id($id)
    {
        return $this->select('mst_employee_education.*, mst_employee.employee_name, mst_employee.gambar')
        ->join('mst_employee', 'mst_employee_education.employee_id = mst_employee.employee_id', 'LEFT')
        ->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->join('mst_employee', 'mst_employee_education.employee_id = mst_employee.employee_id', 'LEFT')
        ->like(['employee_name' => $keyword])->paginate(5);
    }

}