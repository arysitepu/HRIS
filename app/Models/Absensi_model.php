<?php

namespace App\Models;

use CodeIgniter\Model;

class Absensi_model extends Model{

    protected $table = 'trn_absensi';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['employee_name', 'jam_masuk', 'jam_pulang', 'tgl_absensi'];
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getAbsensi()
    {
        $absensi = $this->select('*')->get();
        return $absensi;
    }

}