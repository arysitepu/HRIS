<?php

namespace App\Models;

use CodeIgniter\Model;

class Training_model extends Model{

    protected $table = 'trn_training';
    protected $primaryKey = 'trn_id';
    protected $useTimestamps = true;
    protected $allowedFields =  ['trn_no', 
                                 'trn_date', 
                                 'employee_id_buat', 
                                 'employee_id_setuju', 
                                 'id_training',
                                 'training_name', 
                                 'training_purpose', 
                                 'training_desc', 
                                 'training_organizer', 
                                 'training_start', 
                                 'training_end'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function get_training()
    {

        $builder = $this->select('trn_training.*, trn_id, 
                                 e1.employee_name as buat_name, 
                                 e2.employee_name as setuju_name, 
                                 mst_training.name_training');
        $builder->join('mst_employee e1', 'trn_training.employee_id_buat = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_training.employee_id_setuju = e2.employee_id');
        $builder->join('mst_training', 'trn_training.id_training = mst_training.id_training');
        $query = $builder->paginate(5);
        return $query;

    }

    public function getTraining_id($id = false)
    {

        if($id == false){
            $this->get();
        }

        $builder = $this->select('trn_training.*, trn_id, 
                                e1.employee_name as buat_name, 
                                e2.employee_name as setuju_name, 
                                mst_training.name_training');
        $builder->join('mst_employee e1', 'trn_training.employee_id_buat = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_training.employee_id_setuju = e2.employee_id');
        $builder->join('mst_training', 'trn_training.id_training = mst_training.id_training');
        $query = $builder->where('trn_training.trn_id', $id)->first();
        return $query;
    }

    
    public function getTraining_detail($id = false)
    {

        if($id == false){
            $this->get();
        }

        $builder = $this->select('trn_training.*, trn_id, 
                                e1.employee_name as buat_name, 
                                e2.employee_name as setuju_name, 
                                mst_training.name_training');
        $builder->join('mst_employee e1', 'trn_training.employee_id_buat = e1.employee_id');
        $builder->join('mst_employee e2', 'trn_training.employee_id_setuju = e2.employee_id');
        $builder->join('mst_training', 'trn_training.id_training = mst_training.id_training');
        $query = $builder->where('trn_training.trn_id', $id)->first();
        return $query;
    }

    public function search_training($nama)
    {
        return $this->select('trn_training.*, e1.employee_name as buat_name, e2.employee_name as setuju_name, trn_training_det.id as id')
        ->join('mst_employee e1', 'trn_training.employee_id_buat = e1.employee_id')
        ->join('mst_employee e2', 'trn_training.employee_id_setuju = e2.employee_id')
        ->join('trn_training_det', 'trn_training.trn_id = trn_training_det.trn_id')
       ->like(['training_organizer' => $nama])->paginate(5);
    }

    public function nomorDokumen()
    {
        $bulan = date('n');
        $tahun = date('Y');
        // $nomor = "ATL-/".$kode.$bulan."/".$tahun;
  
        $query = "SELECT max(trn_no) as maxKode FROM trn_training WHERE month(trn_date)='$bulan'";
    
        $hasil = $this->query($query);
        $data  = $hasil->getRowArray();
      
        $no= (int) substr($data['maxKode'], 4, 4);
      
        
        
        $noUrut= $no + 1;
      
        $kode = sprintf("%04s", $noUrut);
        $nomor = "ATL-".$kode."/"."LATIHAN"."/".$tahun;
        // $nomorbaru = $kode.$nomor;
        
        return $nomor;
  
    }

}