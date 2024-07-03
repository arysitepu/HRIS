<?php 

namespace App\Models;
use CodeIgniter\Model;

class Mst_jaminan_model extends Model{


    protected $table = 'mst_employee_jaminan';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['employee_id', 'type_id', 'jaminan_name', 'jaminan_desc', 'doc_no', 'tanggal_simpan', 'tanggal_kembali'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';


    public function getJaminan()
    {
        return $this->join('mst_employee', 'mst_employee_jaminan.employee_id = mst_employee.employee_id')
        ->join('mst_type', 'mst_employee_jaminan.type_id = mst_type.type_id')->paginate(5);
    }


    public function getJaminan_id($id)
    {
        return $this->join('mst_employee', 'mst_employee_jaminan.employee_id = mst_employee.employee_id')
        ->join('mst_type', 'mst_employee_jaminan.type_id = mst_type.type_id')->where(['id' => $id])->first();
    }

    public function search($keyword)
    {
        return $this->join('mst_employee', 'mst_employee_jaminan.employee_id = mst_employee.employee_id')
        ->join('mst_type', 'mst_employee_jaminan.type_id = mst_type.type_id')->like(['employee_name' => $keyword])->paginate(5);
    }

}