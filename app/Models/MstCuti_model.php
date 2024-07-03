<?php

namespace App\Models;

use CodeIgniter\Model;

class MstCuti_model extends Model{

    protected $table = 'mst_cuti';
    protected $primaryKey = 'cuti_id';
    protected $allowedFields = ['cuti_name', 'cuti_type', 'potong_cuti', 'qty_max'];

    public function search($cuti_name)
    {
        $builder = $this->select('*');
        $builder->where(['cuti_name' => $cuti_name]);
        $query = $builder->paginate(5);

        return $query;
    }

}