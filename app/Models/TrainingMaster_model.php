<?php

namespace App\Models;

use CodeIgniter\Model;

class TrainingMaster_model extends Model{

    protected $table = 'mst_training';
    protected $primaryKey = 'id_training';
    protected $allowedFields = ['name_training'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
   

}