<?php

namespace App\Models;

use CodeIgniter\Model;

class FileModel extends Model
{
    protected $table      = 'verifikasi_file';
    protected $primaryKey = 'id';

    protected $allowedFields = ['nama_file', 'tanggal_upload', 'data_bidang_id', 'status', 'nama_bidang_id'];


    public function saveFile($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editFile($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $data['id']);
        return $builder->update($data);
    }
}
