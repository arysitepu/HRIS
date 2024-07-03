<?php 

namespace App\Models;
use  CodeIgniter\Model;

class TrnCutiPeriod_model extends Model{

    protected $table = 'trn_cuti_period';
    protected $primaryKey = 'trn_id';
    protected $allowedFields = ['employee_id', 'periode', 'cuti_qty'];

    public function getCuti_period()
    {
        return $this->table('trn_cuti_period')
        ->join('mst_employee', 'trn_cuti_period.employee_id = mst_employee.employee_id', 'LEFT')->get();
    }

}