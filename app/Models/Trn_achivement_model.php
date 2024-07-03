<?php 

namespace App\Models;

use CodeIgniter\Model;

class Trn_achivement_model extends Model{

    protected $table = 'trn_achivement';
    protected $primaryKey = 'trn_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['employee_id', 'id_achive', 'tahun_terima', 'gambar'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';


    public function getTrnAchivement()
    {
        $builder = $this->select('*');
        $builder->join('mst_employee', 'mst_employee.employee_id = trn_achivement.employee_id');
        $builder->join('mst_achivement', 'mst_achivement.id_achive = trn_achivement.id_achive');
        $builder->join('mst_position', 'mst_position.position_id = mst_employee.position_id', 'LEFT');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
        $query = $builder->orderBy('trn_achivement.tahun_terima', 'ASC')
                ->orderBy('branch.branch_id', 'ASC')
                ->orderBy('trn_achivement.employee_id', 'ASC')->paginate(5);

        return $query;
    }

    public function getAchivementId($id)
    {

        $builder = $this->select('*, trn_achivement.gambar as gambar, mst_employee.gambar as gambar_karyawan');
        $builder->join('mst_employee', 'mst_employee.employee_id = trn_achivement.employee_id');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id');
        $builder->join('mst_achivement', 'mst_achivement.id_achive = trn_achivement.id_achive');
        $builder->join('mst_position', 'mst_position.position_id = mst_employee.position_id', 'LEFT');
        $query = $builder->where(['trn_id' => $id])->first();
        return $query;
    }
    public function getAchivement_employee($id)
    {
 
        $builder = $this->select('*, mst_achivement.name as name_achievement');
        $builder->join('mst_employee', 'mst_employee.employee_id = trn_achivement.employee_id');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id');
        $builder->join('mst_achivement', 'mst_achivement.id_achive = trn_achivement.id_achive');
        $builder->join('mst_position', 'mst_position.position_id = mst_employee.position_id', 'LEFT');
        $query = $builder->where('mst_employee.employee_id',  $id)->get();
        return $query;
    }

    public function search($nama, $branch_id)
    {
        $builder = $this->select('*');
        $builder->join('mst_employee', 'mst_employee.employee_id = trn_achivement.employee_id');
        $builder->join('mst_achivement', 'mst_achivement.id_achive = trn_achivement.id_achive');
        $builder->join('mst_position', 'mst_position.position_id = mst_employee.position_id', 'LEFT');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');

        if($nama){
            $query = $builder->like('employee_name', $nama);
        }elseif($branch_id){
            $query = $builder->where('mst_employee.branch_id', $branch_id);
        }

        return $query->paginate(5);
    }

}