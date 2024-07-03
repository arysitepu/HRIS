<?php

namespace App\Models;
use CodeIgniter\Model;

class Kecamatan_model extends Model
{
  protected $table = 'mst_kecamatan';
  protected $primaryKey = 'kecamatan_id';
  protected $useTimestamp = true;
  protected $createdField = 'create_date';
  protected $updateField = 'update_date';


}