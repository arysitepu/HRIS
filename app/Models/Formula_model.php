<?php 

namespace App\Models;
use CodeIgniter\Model;

class Formula_model extends Model{

    protected $table = 'mst_formula';
    protected $primaryKey = 'id';

    public function getFormula()
    {
        $builder = $this->select('mst_formula.*');
        $query = $builder->where(['id' => 1])->first();

        return $query;
    }

}