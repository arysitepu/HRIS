<?php

namespace App\Models;
use CodeIgniter\Model;

class Branch_model extends Model
{
  protected $table = 'branch';
  protected $primaryKey = 'branch_id';
  protected $allowedFields = ['branch_code', 'branch_name', 'address', 'phone', 'fax', 'email', 'status'];
  protected $useTimestamp = true;
  protected $createdField = 'create_date';
  protected $updateField = 'update_date';


  public function getSbu()
  {
    
    $query = $this->select('branch.*')->paginate(5);

    return $query;
    
  }

  public function getSbu_id($id = false)
  {
    if($id == false){
      $this->get();
    }
    $query = $this->select('branch.*')->where(['branch_id' => $id])->first();
    return $query;
  }

  public function search($keyword)
  {
    $query = $this->select('branch.*')->like('branch_name', $keyword)->paginate(5);

    return $query;
  }


}