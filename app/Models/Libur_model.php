<?php

namespace App\Models;

use CodeIgniter\Model;

class Libur_model extends Model{

    protected $table = 'libur';
    protected $primaryKey = 'id_libur';
    protected $useTimestamp = true;
    protected $allowedFields = ['tgl_libur', 'jenis_libur'];

    public function getLibur()
    {
        $libur = $this->table('libur')->orderBy('id_libur', 'DESC')->get();
        return $libur;
    }

    public function search($jenis_libur, $bulan)
    {
        $builder = $this->select('*');
        if($jenis_libur){
            $query = $builder->like('jenis_libur', $jenis_libur)->paginate(5);
            return $query;
        }elseif($bulan){
            $query = $builder->where("DATE_FORMAT(tgl_libur, '%Y-%m')", $bulan)->paginate(5);
            return $query;
        }else{
            echo "";
        }

    }

    public function get_liburDetail($id = false)
    {
        if($id == false){
            $this->get();
        }

        return $this->table('libur')->where(['id_libur' => $id])->first();
    }

}