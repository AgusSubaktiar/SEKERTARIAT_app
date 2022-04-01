<?php

namespace App\Models;

use CodeIgniter\Model;

class Tender_Model extends Model
{

    protected $table = 'tender';
    protected $allowedFields = ['nama_proyek', 'tgl_tender', 'filetender'];

    public function search($keyword)
    {
        return $this->table('tender')->like('nama_proyek', $keyword)->orLike('tgl_tender', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('tender')->get()->getResultArray();
        } else {
            return $this->db->table('tender')->where('id_tender', $id);
            return $this->db->table('tender')->get()->getRowArray();
        }
    }

    public function addtender($data)
    {
        return $this->table('tender')->insert($data);
    }

    public function hapustender($id)
    {
        return $this->db->table('tender')->delete(['id_tender' => $id]);
    }

    public function ubahtender($data, $id)
    {
        return $this->db->table('tender')->update($data, ['id_tender' => $id]);
    }
}
