<?php

namespace App\Models;

use CodeIgniter\Model;


class DataBidang_Model extends Model
{
    protected $table = 'isi_bidang_tb';
    protected $primaryKey = 'id_isi_bidang';
    protected $allowFields = ['nama_isi_bidang', 'id_bidang'];

    public function addDataBidang($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function getDataBidang($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id_isi_bidang' => $id])->first();
        }
    }

    public function deleteDataBidang($id)
    {
        $query = $this->db->table('isi_bidang_tb')->delete(array('id_isi_bidang' => $id));
        return $query;
    }

    public function updateBidang($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_isi_bidang', $data['id_isi_bidang']);
        return $builder->update($data);
    }
}
