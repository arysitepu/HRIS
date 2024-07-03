<?php

namespace App\Models;
use CodeIgniter\Model;

class MstType_model extends Model{

    protected $table = 'mst_type';
    protected $primaryKey = 'type_id';
    protected $useTimestamp = true;
    protected $createdField = 'create_date';
    protected $updateField = 'update_date';


}