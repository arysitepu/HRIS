<?php 

namespace App\Models;

use CodeIgniter\Model;

class Mst_achivement_model extends Model{

    protected $table = 'mst_achivement';
    protected $primaryKey = 'id_achive';
    protected $useTimestamps = true;
    protected $allowedFields = ['name'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getMstAchivement()
    {
        $builder = $this->select('*');
        $query = $builder->paginate(5);

        return $query;
    }

    public function getAchivementId($id)
    {

        $builder = $this->select('*');
        $query = $builder->where(['id_achive' => $id])->first();

        return $query;

    }

}