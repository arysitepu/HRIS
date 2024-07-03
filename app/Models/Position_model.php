<?php

namespace App\Models;
use CodeIgniter\Model;

class Position_model extends Model
{
  protected $table = 'mst_position';
  protected $primaryKey = 'position_id';
  protected $useTimestamp = true;
  protected $createdField = 'create_date';
  protected $updateField = 'update_date';
  protected $allowedFields = ['position_name'];

  public function getPosition_id($id = false)
  {
    if($id == false){
      return $this->findAll();
    }

    return $this->table('mst_position')->where(['position_id' => $id])->first();
  }
}