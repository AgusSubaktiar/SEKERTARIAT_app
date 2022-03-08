<?php

namespace App\Models;

use CodeIgniter\Model;

class Bidang_admin_model extends Model
{

    protected $table = 'nama_bidang_tb';
    protected $primaryKey = 'id_bidang';
    protected $allowedFields = 'nama_bidang';

    public function getNamaBidang($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id_bidang' => $id])->first();
        }
    }

    public function saveBidang($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function updateBidang($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_bidang', $data['id_bidang']);
        return $builder->update($data);
    }

    public function deleteBidang($id)
    {
        $query = $this->db->table('nama_bidang_tb')->delete(array('id_bidang' => $id));
        return $query;
    }
}
