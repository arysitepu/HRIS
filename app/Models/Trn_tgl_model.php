<?php

namespace App\Models;

use CodeIgniter\Model;

class Trn_tgl_model extends Model{

    protected $table = 'trn_tgl';
    protected $primaryKey = 'id';
    protected $allowedFields = ['trn_id', 'tgl_cuti', 'cuti_id', 'cuti_type'];

    public function getDetail($id)
    {

        $db = \Config\Database::connect();

        $builder = $db->table('trn_cuti');
        $builder->select('*');
        $query = $builder->where('trn_id', $id)->get();

        return $query;
    }
  

}