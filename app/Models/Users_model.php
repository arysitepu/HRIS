<?php

namespace App\Models;
use CodeIgniter\Model;

class Users_model extends Model{
    protected $table = "mst_user";
    protected $primaryKey = "user_id";
    protected $allowedFields = ["user_name", 
                                "user_name_full", 
                                "user_password", 
                                "user_email", 
                                "last_date_login", 
                                "last_date_logout", 
                                "branch_id",
                                "user_level", 
                                "status_active", 
                                "create_user", 
                                "create_date", 
                                "update_user", 
                                "update_date"];
    protected $createdField = 'create_date';
    protected $updateField = 'update_date';
    protected $useTimestamps = false;

    public function getUsers()
    {
        $builder = $this->select('*');
        $builder->join('branch', 'mst_user.branch_id = branch.branch_id');
        $query = $builder->orderBy('user_name', 'ASC')->get();
        return $query;
    }

    public function getUsersId($id)
    {
        $builder = $this->select('*');
        $builder->join('branch', 'mst_user.branch_id = branch.branch_id');
        $query = $builder->where('user_id', $id)->first();
        return $query;
    }
}