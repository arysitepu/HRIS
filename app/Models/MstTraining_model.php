<?php

namespace App\Models;

use CodeIgniter\Model;

class MstTraining_model extends Model{

    protected $table = 'mst_employee_training';
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'training_name', 'training_purpose', 'training_desc', 'training_organizer', 
                                'training_start', 'training_end', 'biaya_oleh'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function get_training()
    {
        return $this->table('mst_employee_training')->join('mst_employee', 'mst_employee_training.employee_id = mst_employee.employee_id')->paginate(5);
    }

    public function getTraining_id($id = false)
    {

        if($id == false){
            $this->get();
        }

        return $this->table('mst_employee_training')->join('mst_employee', 'mst_employee_training.employee_id = mst_employee.employee_id')
        ->where(['id' => $id])->first();

    }

    public function search_training($keyword)
    {
        return $this->table('mst_employee_training')->join('mst_employee', 'mst_employee_training.employee_id = mst_employee.employee_id')
        ->like(['employee_name' => $keyword])->paginate(5);
    }

}