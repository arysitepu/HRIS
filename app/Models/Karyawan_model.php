<?php

namespace App\Models;
use CodeIgniter\Model;

class Karyawan_model extends Model
{
  protected $table = 'mst_employee';
  protected $primaryKey = 'employee_id';
  protected $allowedFields  = ['employee_name',
                               'employee_nickname',
                               'branch_id',
                               'position_id',
                               'jenis_kelamin', 
                               'lahir_tempat', 
                               'lahir_tanggal', 
                               'no_ktp', 
                               'no_kk', 
                               'no_bpjs_tk', 
                               'no_bpjs_kes', 
                               'no_npwp',
                               'alamat_ktp', 
                               'alamat_tinggal', 
                               'kecamatan_id', 
                               'kode_pos', 
                               'status_rumah', 
                               'status_nikah', 
                               'etnis', 
                               'agama', 
                               'gol_darah',
                               'no_tlp', 
                               'no_tlp2', 
                               'email_pribadi', 
                               'email_kantor', 
                               'badan_tinggi', 
                               'badan_berat', 
                               'no_rek',  
                               'gambar', 
                               'nik', 
                               'hak_cuti', 
                               'start_cuti'];
  protected $useTimestamps = true;
  protected $createdField = 'create_date';
  protected $updatedField = 'update_date';
 
  public function getKaryawan()
  {

    $builder = $this->select('mst_employee.*, branch.branch_name, mst_position.position_name');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');

    $query = $builder->where('mst_employee.employee_status', 2)->paginate(5);

    return $query;
  }

  public function getKaryawanSbu($branch_id)
  {
    $builder = $this->select('mst_employee.*, branch.branch_name, mst_position.position_name');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    $builder->where('mst_employee.employee_status', 2);
    $builder->where('mst_employee.branch_id', $branch_id);
    $query = $builder->paginate(5);

    return $query;
  }

  public function getKaryawanById($branch_id)
  {
    $builder = $this->select('mst_employee.*, branch.branch_name, mst_position.position_name');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    $builder->where('mst_employee.employee_status', 2);
    $builder->where('mst_employee.branch_id', $branch_id);
    $query = $builder->get();

    return $query;
  }


  public function cetakKaryawan()
  {
    return $this->select('mst_employee.*, branch.branch_name, mst_position.position_name, mst_employee.gambar')
    ->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT')
    ->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT')->get();
  }

  public function getKaryawanCount()
  {
    return $this->select('mst_employee.*, branch.branch_name, mst_position.position_name')
    ->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT')
    ->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT')
    ->where('employee_status', 2)->CountAllResults();

  }

  public function getKaryawanCount_user($branch_id)
  {
    $builder = $this->select('mst_employee.*, branch.branch_name, mst_position.position_name');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    $builder->get();
    $query = $builder->where('mst_employee.branch_id', $branch_id)->where('mst_employee.employee_status', 2)->CountAllResults();
    return $query;

  }

  public function search_multi($sbu, $keyword, $status)
  {

    return $this->table('mst_employee')->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT')
    ->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT')
    ->like('employee_name', "%$keyword%")
    ->Like('branch.branch_id', $sbu)
    ->like('employee_status', $status)
    ->paginate(5);
  }

  public function search_multi_user($sbu, $keyword, $status, $branch_id)
  {

    $builder = $this->table('mst_employee');
    $builder->select('mst_employee.*, branch.*, mst_position.*');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');

    if ($keyword) {
        $builder->like('mst_employee.employee_name', $keyword);
    }
    if ($sbu) {
        $builder->like('branch.branch_id', $sbu);
    }
    if ($status) {
        $builder->like('mst_employee.employee_status', $status);
    }
    if ($branch_id) {
        $builder->where('mst_employee.branch_id', $branch_id);
    }

    $query = $builder->paginate(5);

    return $query;

    // $builder = $this->select('mst_employee');
    // $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    // $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    // $builder->like('employee_name', "%$keyword%");
    // $builder->Like('branch.branch_id', $sbu);
    // $builder->like('employee_status', $status);
    // $builder->where('mst_employee.branch_id', $branch_id);
    // $query = $builder->paginate(5);

    // return $query;


    
  }

  public function search_multi_count($sbu, $keyword, $status)
  {
    return $this->table('mst_employee')->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT')
    ->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT')->like('employee_name', "%$keyword%")
    ->Like('branch.branch_id', $sbu)->like('employee_status', $status)->countAllResults();
  }

  public function search_multi_count_user($sbu, $keyword, $status, $branch_id)
  {
    $builder = $this->select('mst_employee')->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    $builder->like('employee_name', "%$keyword%");
    $builder->Like('branch.branch_id', $sbu);
    $builder->like('employee_status', $status);
    $query = $builder->where('mst_employee.branch_id', $branch_id)->countAllResults();
    return $query;
  }


  public function getKaryawan_id($id = false)
  {
    if($id == false){
      return $this->get();
    }


    
    return $this->select('mst_employee.*,e1.branch_name as branch_name, e1.branch_code, e2.position_name as position_name, 
    e3.kecamatan_distrik as kecamatan_distrik, e3.kota_kabupaten as kota_kabupaten, e3.provinsi as provinsi, 
    trn_position.position_id as position_id_trn, p1.position_name as position_name_trn, 
    trn_cuti.cuti_jumlah, trn_cuti.cuti_id, trn_cuti.tgl_dari')
    ->join('branch e1',  'mst_employee.branch_id = e1.branch_id', 'LEFT')
    ->join('mst_position e2', 'mst_employee.position_id = e2.position_id','LEFT')
    ->join('mst_kecamatan e3', 'mst_employee.kecamatan_id = e3.kecamatan_id','LEFT')
    ->join('mst_kecamatan', 'mst_employee.kecamatan_id = mst_kecamatan.kecamatan_id','LEFT')
    ->join('trn_position', 'mst_employee.employee_id = trn_position.employee_id','LEFT')
    ->join('mst_position p1', 'trn_position.position_id = p1.position_id','LEFT')
    ->join('trn_cuti', 'mst_employee.employee_id = trn_cuti.employee_id', 'LEFT')
    ->where(['mst_employee.employee_id' => $id])->first();
    
 
  }

  public function getKaryawan_detail($id = false)
  {
    if($id == false){
      return $this->get();
    }


    
    return $this->select('mst_employee.*,e1.branch_name as branch_name, e1.branch_code, e2.position_name as position_name, 
    e3.kecamatan_distrik as kecamatan_distrik, e3.kota_kabupaten as kota_kabupaten, e3.provinsi as provinsi, 
    trn_position.position_id as position_id_trn, p1.position_name as position_name_trn')
    ->join('branch e1',  'mst_employee.branch_id = e1.branch_id', 'LEFT')
    ->join('mst_position e2', 'mst_employee.position_id = e2.position_id','LEFT')
    ->join('mst_kecamatan e3', 'mst_employee.kecamatan_id = e3.kecamatan_id','LEFT')
    ->join('mst_kecamatan', 'mst_employee.kecamatan_id = mst_kecamatan.kecamatan_id','LEFT')
    ->join('trn_position', 'mst_employee.employee_id = trn_position.employee_id','LEFT')
    ->join('mst_position p1', 'trn_position.position_id = p1.position_id','LEFT')
   
    ->where(['mst_employee.employee_id' => $id])->get();
    
 
  }

  public function getContact_id($id = false)
  {
    if($id == false){
      return $this->get();
    }

    return $this->select('mst_employee.*, mst_employee_contact.id as id_contact, mst_employee_contact.contact_name as contact_name,mst_employee_contact.jenis_kelamin as jenis_kelamin1,
    mst_employee_contact.alamat_tinggal as alamat_contact, mst_employee_contact.lahir_tempat as tempat_lahir_contact, mst_employee_contact.lahir_tanggal as lahir_contact,
    mst_employee_contact.no_tlp as no_tlp_contact, mst_employee_contact.no_tlp2 as no_tlp2_contact,mst_kecamatan.kecamatan_distrik as kecamatan, mst_employee_contact.contact_type as contact_type, 
    mst_employee_contact.contact_name as contact_name, mst_employee_contact.pekerjaan as pekerjaan')
    ->join('mst_employee_contact', 'mst_employee.employee_id = mst_employee_contact.employee_id','LEFT')
    ->join('mst_kecamatan', 'mst_employee_contact.kecamatan_id = mst_kecamatan.kecamatan_id','LEFT')
    ->where(['mst_employee_contact.employee_id' => $id])->get();

    
  }

  
  public function getContact_detail_id($id = false)
  {
    if($id == false){
      return $this->get();
    }

    return $this->db->table('mst_employee_contact')
    ->join('mst_kecamatan', 'mst_employee_contact.kecamatan_id = mst_kecamatan.kecamatan_id','LEFT')
    ->where(['id' => $id])->get(); 
  }

  public function getKeluarga_id($id = false)
  {
    if($id == false){
      return $this->get();
    }

    return $this->select('mst_employee.*, mst_employee_family.id as id_family, mst_employee_family.jenis_kelamin as jenis_kelamin_family, mst_employee_family.lahir_tempat as lahir_tempat_family,
    mst_employee_family.lahir_tanggal as lahir_tanggal_family, mst_employee_family.no_tlp as no_tlp_family, mst_employee_family.no_tlp2 as no_tlp2_family, mst_employee_family.sekolah_nama as sekolah_nama,
    mst_employee_family.family_type, mst_employee_family.family_name, mst_employee_family.pekerjaan')
    ->join('mst_employee_family', 'mst_employee.employee_id = mst_employee_family.employee_id')
    ->where(['mst_employee_family.employee_id' => $id])->get();
  }

  public function getKeluarga_detail_id($id)
  {
    if($id == false){
      return $this->get();
    }

    return $this->db->table('mst_employee_family')->where(['id' => $id])->get();
  }
  
  public function get_education($id = false)
  {

    if($id == false){
      return $this->get();
    }

    return $this->select('mst_employee.*, mst_employee_education.id as id_education, mst_employee_education.education_type as education_type,
    mst_employee_education.education_name as education_name, mst_employee_education.education_address as education_address,
    mst_employee_education.tahun_masuk as tahun_masuk,mst_employee_education.tahun_lulus as tahun_lulus, 
    mst_employee_education.education_major as education_major, mst_employee_education.ipk as ipk')
    ->join('mst_employee_education', 'mst_employee.employee_id = mst_employee_education.employee_id')
    ->where(['mst_employee_education.employee_id' => $id])->get();
  }

  public function getEducation_id($id = false)
  {
    if($id == false){
      return $this->get();
    }

    return $this->db->table('mst_employee_education')->where(['id' => $id])->get();

  }

  // public function get_fasilitas($id = false)
  // {

  //   if($id == false){
  //     return $this->get();
  //   }

  //  return $this->select('mst_employee.*, mst_employee_facility.id as id_facility, mst_type.type_name as type_name_facility, 
  //  mst_employee_facility.facility_name as facility_name, mst_employee_facility.facility_desc as facility_desc, 
  //  mst_employee_facility.facility_asset_no as facility_asset_no')
  //  ->join('mst_employee_facility', 'mst_employee.employee_id = mst_employee_facility.employee_id')
  //  ->join('mst_type', 'mst_employee_facility.type_id = mst_type.type_id')
  //  ->where(['mst_employee_facility.employee_id' => $id])->get();

  // }

  public function get_fasilitas($id = false)
  {

    if($id == false){
      return $this->get();
    }

   return $this->select('mst_employee.*, trn_facility.trn_id as id_facility, e1.employee_name as buat_name, 
   e2.employee_name as setuju_name, trn_facility.trn_no as trn_no, trn_facility.trn_date as trn_date,
   trn_facility.tgl_pinjam as tgl_pinjam, trn_facility.tgl_kembali, 
   
   trn_facility_det.kegunaan as kegunaan, trn_facility_det.trn_id as id_facility_det, 
   mst_facility.facility_name as facility_name,
   
   mst_type.type_name as type_name')
   ->join('trn_facility', 'mst_employee.employee_id = trn_facility.employee_id')
   ->join('mst_employee e1', 'trn_facility.employee_id_buat = e1.employee_id')
   ->join('mst_employee e2', 'trn_facility.employee_id_setuju = e2.employee_id')
   ->join('trn_facility_det', 'trn_facility.trn_id = trn_facility_det.trn_id')
   ->join('mst_facility', 'trn_facility_det.facility_id = mst_facility.facility_id')
   ->join('mst_type', 'mst_facility.type_id = mst_type.type_id')
   ->where(['trn_facility.employee_id' => $id])->get();

  }

  public function getFacility_id($id = false)
  {

    if($id == false){
      return $this->get();
    }

    return $this->db->table('mst_employee_facility')
    ->join('mst_type', 'mst_employee_facility.type_id = mst_type.type_id')->where(['id' => $id])->get();

  }

  public function get_jaminan($id = false)
  {

    if($id == false){
      return $this->get();
    }

    $builder = $this->select('mst_employee.*, 
                              trn_jaminan.trn_id as id_jaminan, 
                              mst_type.type_name as type_name_jaminan,
                              trn_jaminan.jaminan_name as jaminan_name, 
                              trn_jaminan.jaminan_desc as jaminan_desc, 
                              trn_jaminan.trn_no as jaminan_doc,
                              trn_jaminan.tgl_serah as tgl_serah, 
                              mst_type.type_name as type_name,
                              trn_jaminan.status as status_jaminan');
   $builder->join('trn_jaminan', 'mst_employee.employee_id = trn_jaminan.employee_id');
   $builder->join('mst_type', 'trn_jaminan.type_id = mst_type.type_id');
   $query =  $builder->where('trn_jaminan.employee_id', $id)->get();
   return $query;

  //  return $this->select('mst_employee.*, trn_jaminan.trn_id as id_jaminan, mst_type.type_name as type_name_jaminan,
  //  trn_jaminan.jaminan_name as jaminan_name, trn_jaminan.jaminan_desc as jaminan_desc, trn_jaminan.trn_no as jaminan_doc,
  //  trn_jaminan.tgl_serah as tgl_serah, mst_type.type_name as type_name,')
  //  ->join('trn_jaminan', 'mst_employee.employee_id = trn_jaminan.employee_id')
  //  ->join('mst_type', 'trn_jaminan.type_id = mst_type.type_id')
  //  ->where(['trn_jaminan.employee_id' => $id])->get();

  }

  public function getJaminan_id($id = false)
  {
    if($id == false){
      return $this->get();
    }
      
   
    $builder = $this->db->table('mst_employee_jaminan')->select('*');
    $builder->join('mst_type', 'mst_employee_jaminan.type_id = mst_type.type_id');
    $query = $builder->where('id',$id)->get();
    return $query;
  }

  public function get_training($id = false)
  {
    if($id == false){
      return $this->get();
    }
    return $this->select('mst_employee.*, mst_employee_training.id as id_training, mst_employee_training.training_name as training_name,
     mst_employee_training.training_purpose as training_purpose, mst_employee_training.training_desc as training_desc,
     mst_employee_training.training_organizer as training_organizer, mst_employee_training.training_start, mst_employee_training.training_end,
     mst_employee_training.biaya_oleh as biaya_oleh')
     ->join('mst_employee_training', 'mst_employee.employee_id = mst_employee_training.employee_id')->where(['mst_employee_training.employee_id' => $id])->get();
  }

  public function getTraining_id($id = false)
  {

    if($id == false){
      return $this->get();
    }

    return $this->db->table('mst_employee_training')->where(['id' => $id])->get();

  }

  public function get_position($id = false)
  {
    if($id == false){
      $this->get();
    }
    return $this->select('mst_employee.*, trn_position.trn_id as id_position')
    ->select('trn_position.*, mst_position.position_name as position_name,
    p1.position_name as position_name_old')
    ->join('trn_position', 'mst_employee.employee_id = trn_position.employee_id')
    ->join('mst_position', 'trn_position.position_id = mst_position.position_id')
    ->join('mst_position p1', 'trn_position.position_id_old = p1.position_id')
    ->where(['trn_position.employee_id' => $id])->get();
  }

  public function getPosition_id($id = false)
  {
    if($id == false){
      $this->get();
    }
   
   
   return $this->db->table('trn_position')->select('trn_position.*, mst_position.position_name as position_name, 
   p1.position_name as position_name_old, branch.branch_name as branch_name, b1.branch_name as branch_name_old,
   mst_employee.employee_name as employee_name, e1.employee_name as buat_name, e2.employee_name as setuju_name, 
  ')
   ->join('mst_position', 'trn_position.position_id = mst_position.position_id')
   ->join('mst_position p1', 'trn_position.position_id_old = p1.position_id')
   ->join('branch', 'trn_position.branch_id = branch.branch_id')
   ->join('branch b1', 'trn_position.branch_id_old = b1.branch_id')
   ->join('mst_employee', 'trn_position.employee_id = mst_employee.employee_id')
   ->join('mst_employee e1', 'trn_position.employee_id_buat = e1.employee_id')
   ->join('mst_employee e2', 'trn_position.employee_id_setuju = e2.employee_id')
   ->where(['trn_id' => $id])->get();

  }

  public function get_join($id = false)
  {
    if($id == false){
      $this->get();
    }

    return $this->select('mst_employee.*, trn_join.trn_id as id_join, p1.position_name as position_name, b1.branch_name as branch_name,
    join_start, trn_join.employee_status')
    ->join('trn_join', 'mst_employee.employee_id = trn_join.employee_id')
    ->join('mst_position p1', 'mst_employee.position_id = p1.position_id')
    ->join('branch b1', 'mst_employee.branch_id = b1.branch_id')
    ->where(['trn_join.employee_id' => $id])->get();
  }




  public function jumlah_karyawan()
  {
    $query = $this->db->table('mst_employee')->where('employee_status', 2)->CountAllResults();
    return $query;
  }



}