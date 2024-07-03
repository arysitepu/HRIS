<?php
 
namespace App\Models;
 
use CodeIgniter\Model;

class Dokumen_model extends Model
{
	protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';
    protected $allowedFields = ['nama_dokumen', 'dokumen', 'deskripsi'];
    protected $useTimestamps = true;
    protected $createdField = 'create_date';
    protected $updatedField = 'update_date';

    public function getDokumen()
    {
        $dokumen = $this->table('dokumen')->paginate(5);

        return $dokumen;
    }

    public function getDokumenId($id = false)
    {

        if($id == false){
            return $this->get();
        }

        $dokumen = $this->table('dokumen')->where(['id_dokumen' => $id])->first();
        return $dokumen;

    }

    public function search($keyword)
    {
        $dokumen = $this->table('dokumen')->like(['nama_dokumen' => $keyword])->paginate(5);
        return $dokumen;
    }

    public function count_search($keyword)
    {
        $dokumen = $this->table('dokumen')->like(['nama_dokumen' => $keyword])->countAllResults();
        return $dokumen;
    }

    public function jumlah_dokumen()
  {
    $query = $this->db->table('dokumen');
    if($query->countAllResults()>0)
    {
      return $query->countAllResults();
    }
    else
    {
      return 0;
    }
  }
    
}