<?php

namespace App\Models;
use CodeIgniter\Model;

class Sbu_model extends Model{

    public function get_sbu()
    {
        $strquery = "UPDATE `mst_employee` SET `NIK`=null";
		$query = $this->db->query($strquery);

        $strquery = "UPDATE `mst_employee` INNER JOIN `branch` ON `mst_employee`.`branch_id`=`branch`.`branch_id` 
			SET `NIK`=CONCAT(`branch`.`branch_code`, '.', 
			RIGHT(CONCAT('0',MONTH(`mst_employee`.`tanggal_masuk`)),2), RIGHT(CONCAT('0',YEAR(`mst_employee`.`tanggal_masuk`)),2), '.',
			RIGHT(CONCAT('0',DAY(`mst_employee`.`lahir_tanggal`)),2), RIGHT(CONCAT('0',MONTH(`mst_employee`.`lahir_tanggal`)),2)) WHERE `employee_status`=2 ";
		$query = $this->db->query($strquery);

        return $query;
    }

    public function nik_out()
    {
        $strquery = "UPDATE `mst_employee` SET `NIK`=null";
		$query = $this->db->query($strquery);

        
        return $query;
    }

}