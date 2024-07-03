<?php
namespace App\Models;

use CodeIgniter\Model;

class Report_model extends Model{


    public function getKaryawanReport($sbu, $status)
    {
    $db = \Config\Database::connect();
    $db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
    $builder = $db->table('mst_employee');
    $builder->select('mst_employee.*, branch.branch_name, mst_position.position_name, p2.education_type');
    $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    $builder->join('(SELECT * FROM mst_employee_education p WHERE p.education_type 
    = (SELECT MAX(p2.education_type) FROM mst_employee_education p2 WHERE p2.employee_id = p.employee_id)) p2', 
    'mst_employee.employee_id = p2.employee_id', 'LEFT', false);
    $builder->orderBy('p2.education_type', 'ASC', false);

    if($sbu && $status){
        $builder->where('mst_employee.branch_id', $sbu);
        $builder->where('mst_employee.employee_status', $status);
    }elseif($sbu){
        $builder->where('mst_employee.branch_id', $sbu);
    }elseif($status){
        $builder->where('mst_employee.employee_status', $status);
    }else{
    
    }
   
   $builder->groupBy('mst_employee.employee_name');
   $query = $builder->get();
    return $query;
}

    // public function getKaryawanReport($sbu)
    // {
    //     $db = \Config\Database::connect();
    //     $builder = $db->table('mst_employee');
    //     $builder->select('mst_employee.*, branch.branch_name, mst_position.position_name, mst_employee_education.education_type');
    //     $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
    //     $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');
    //     $builder->join('mst_employee_education', 'mst_employee.employee_id = mst_employee_education.employee_id')->orderBy('education_type', 'DESC','NUMERIC');

    //     if($sbu != ""){

    //         $query = $builder->where('mst_employee.branch_id', $sbu)->groupBy('mst_employee.employee_name')->get();
    //         return $query;
    //     }else{
    //         $query = $builder->get();
    //         return $query;
    //     }
    // }

    public function get_sbu($sbu)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('branch');
        $query = $builder->where('branch.branch_id', $sbu)->get();
        return $query;
    }

    public function getKaryawanCount_sbu($sbu)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_employee');
        $builder->join('branch', 'mst_employee.branch_id = branch.branch_id', 'LEFT');
        $builder->join('mst_position', 'mst_employee.position_id = mst_position.position_id', 'LEFT');

        if($sbu != ""){
            $query = $builder->where('mst_employee.branch_id', $sbu)->countAllResults();
            return $query;
        }else{
            $query = $builder->countAllResults();
            return $query;
        }
    }
    public function getKaryawanCount_tetap($sbu)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_employee');
        if($sbu != ""){
            $builder->where('mst_employee.branch_id', $sbu);
            $query = $builder->where('employee_status', 2)->countAllResults();
            return $query;
        }else{
            $query = $builder->where('employee_status', 2)->countAllResults();
            return $query;
        }
    }

    public function getKaryawanCount_probation($sbu)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_employee');

        if($sbu != ""){

            $builder->where('mst_employee.branch_id', $sbu);
            $query = $builder->where('employee_status', 1)->countAllResults();
            return $query;
        }else{
            $query = $builder->where('employee_status', 1)->countAllResults();
            return $query;
        }
    }

    public function getKaryawanCount_resign($sbu)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('mst_employee');

        if($sbu){

            $builder->where('mst_employee.branch_id', $sbu);
            $query = $builder->where('employee_status', 3)->countAllResults();
            return $query;
        }else{
            $query = $builder->where('employee_status', 3)->countAllResults();
            return $query;
        }
    }



    

   
}