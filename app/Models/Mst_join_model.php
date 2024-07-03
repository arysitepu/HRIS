<?php


namespace App\Models;
use CodeIgniter\Model;

class Mst_join_model extends Model{


    protected $table = 'mst_employee_join';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'join_start', 'join_end'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getJoin_employee()
    {
        return $this->table('mst_employee_join')->join('mst_employee', 'mst_employee_join.employee_id = mst_employee.employee_id')->paginate(5);
    }

    public function getJoin_id($id = false)
    {
        if($id == false){
            return $this->get();
        }

        return $this->table('mst_employee_join')->join('mst_employee', 'mst_employee_join.employee_id = mst_employee.employee_id')
        ->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->table('mst_employee_join')->join('mst_employee', 'mst_employee_join.employee_id = mst_employee.employee_id')
        ->like(['employee_name' => $keyword])->paginate(5);

    }


}