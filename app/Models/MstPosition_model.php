<?php

namespace App\Models;
use CodeIgniter\Model;

class MstPosition_model extends Model{

    protected $table = 'mst_employee_position';
    protected $primary_key = 'id';
    protected $allowedFields = ['employee_id', 'position_id', 'position_date', 'branch_id'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';
    

    public function get_position()
    {
        return $this->table('mst_employee_position')
        ->join('mst_employee', 'mst_employee_position.employee_id = mst_employee.employee_id')
        ->join('mst_position', 'mst_employee_position.position_id = mst_position.position_id')
        ->join('branch', 'mst_employee_position.branch_id = branch.branch_id')->paginate(5);
    }

    public function getPosition_id($id = false)
    {

        if($id == false){
            $this->get();
        }

        return $this->table('mst_employee_position')
        ->join('mst_employee', 'mst_employee_position.employee_id = mst_employee.employee_id')
        ->join('mst_position', 'mst_employee_position.position_id = mst_position.position_id')
        ->join('branch', 'mst_employee_position.branch_id = branch.branch_id')->where(['id' => $id])->first();

    }

    public function search_position($keyword)
    {
        return $this->table('mst_employee_position')
        ->join('mst_employee', 'mst_employee_position.employee_id = mst_employee.employee_id')
        ->join('mst_position', 'mst_employee_position.position_id = mst_position.position_id')
        ->join('branch', 'mst_employee_position.branch_id = branch.branch_id')->like(['employee_name' => $keyword])->paginate(5);
    }

}