<?php 

namespace App\Models;
use CodeIgniter\Model;

class Family_model extends Model{


    protected $table = "mst_employee_family";
    protected $primaryKey = 'id';
    protected $allowedFields = ['employee_id', 'family_type', 'family_name', 'jenis_kelamin', 'lahir_tempat', 'lahir_tanggal', 'pekerjaan', 
                                'pendidikan', 'jurusan', 'sekolah_nama', 'sekolah_alamat', 'no_tlp', 'no_tlp2'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getFamily_employee()
    {
        return $this->select('mst_employee_family.*, e1.employee_name as employee_name')
        ->join('mst_employee e1', 'mst_employee_family.employee_id = e1.employee_id', 'LEFT')->paginate(5);
    }


    public function getFamily_id($id = false)
    {

        if($id == false){
            $this->get();
        }
        return  $this->select('mst_employee_family.*, e1.employee_name as employee_name')
        ->join('mst_employee e1', 'mst_employee_family.employee_id = e1.employee_id', 'LEFT')->where(['id' => $id])->first();

    }

    public function search($keyword)
    {
        return  $this->select('mst_employee_family.*, e1.employee_name as employee_name')
        ->join('mst_employee e1', 'mst_employee_family.employee_id = e1.employee_id', 'LEFT')->like(['employee_name' => $keyword])->paginate(5);
    }

}