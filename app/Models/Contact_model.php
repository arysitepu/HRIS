<?php

namespace App\Models;
use CodeIgniter\Model;

class Contact_model extends Model
{
  protected $table = 'mst_employee_contact';
  protected $primaryKey = 'id';
  protected $allowedFields = ['employee_id', 'contact_type', 'contact_name', 'jenis_kelamin', 'lahir_tempat', 'lahir_tanggal',
  'pekerjaan', 'no_tlp', 'no_tlp2', 'alamat_tinggal', 'kecamatan_id'];
  protected $useTimestamp = true;
  protected $createdField = 'create_date';
  protected $updateField = 'update_date';
public function getContact_employee()
{
  // return $this->join('mst_employee', 'mst_employee_contact.employee_id = mst_employee.employee_id', 'LEFT');
  return $this->table('mst_employee_contact')->select('mst_employee_contact.*, e1.employee_name as employee')
  ->join('mst_employee e1', 'mst_employee_contact.employee_id = e1.employee_id', 'LEFT')->paginate(5);
}

public function getContact_id($id = false)
{
  if($id == false){
    $this->get();
  }
  return $this->select('mst_employee_contact.*, e1.employee_name as employee, e2.kecamatan_distrik as kecamatan')
  ->join('mst_employee e1', 'mst_employee_contact.employee_id = e1.employee_id')
  ->join('mst_kecamatan e2', 'mst_employee_contact.kecamatan_id = e2.kecamatan_id', 'LEFT')->where(['id' => $id])->first();

}

public function search($keyword)
{
  return $this->select('mst_employee_contact.*, e1.employee_name as employee, e2.kecamatan_distrik as kecamatan')
  ->join('mst_employee e1', 'mst_employee_contact.employee_id = e1.employee_id')
  ->join('mst_kecamatan e2', 'mst_employee_contact.kecamatan_id = e2.kecamatan_id', 'LEFT')->like('employee_name', $keyword)->paginate(5);

}
}