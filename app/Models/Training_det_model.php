<?php

namespace App\Models;

use CodeIgniter\Model;

class Training_det_model extends Model{

    protected $table = 'trn_training_det';
    protected $primaryKey = 'id';
    protected $allowedFields = ['trn_id', 'employee_id', 'biaya'];
    

    public function getTraining_det($id)
    {
        return $this->table('trn_training_det')
        ->join('mst_employee', 'trn_training_det.employee_id = mst_employee.employee_id')
        ->join('trn_training', 'trn_training_det.trn_id = trn_training.trn_id')->where(['trn_training_det.trn_id' => $id])->get();
    }

    public function getTraining_det_id($id = false)
    {
        if($id == false){
            $this->get();
        }
        return $this->table('trn_training_det')
        ->join('mst_employee', 'trn_training_det.employee_id = mst_employee.employee_id')
        ->join('trn_training', 'trn_training_det.trn_id = trn_training.trn_id')->where(['id' => $id])->first();
    }

}