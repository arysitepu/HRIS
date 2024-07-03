<?php 

namespace App\Models;

use CodeIgniter\Model;

class Trn_fasilitas_in_model extends Model{

    protected $table = 'trn_facility_in';
    protected $primaryKey = 'trn_id';
    protected $useTimestamps = true;
    protected $allowedFields = ['trn_no', 'trn_date', 'employee_id_buat', 'employee_id_setuju', 'employee_id', 'tgl_pinjam', 'tgl_kembali'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getFasilitas_in()
    {
        return $this->table('trn_facility_in')
        ->join('mst_employee', 'trn_facility_in.employee_id = mst_employee.employee_id')->paginate(5);
    }

    public function getFasilitas_in_id($id = false)
    {
        if($id == false){
            $this->get();
        }

        return $this->select('trn_facility_in.*, t1.employee_name as employee_name, t2.employee_name as buat_name,
        t3.employee_name as setuju_name')
        ->join('mst_employee t1', 'trn_facility_in.employee_id = t1.employee_id')
        ->join('mst_employee t2', 'trn_facility_in.employee_id_buat = t2.employee_id')
        ->join('mst_employee t3', 'trn_facility_in.employee_id_setuju = t3.employee_id')
        ->where(['trn_facility_in.trn_id' => $id])->first();

    }

    public function search($keyword)
    {
        return $this->table('trn_facility_in')
        ->join('mst_employee', 'trn_facility_in.employee_id = mst_employee.employee_id')->where(['employee_name' => $keyword])->paginate(5);
    }

}