<?php

namespace App\Models;

use CodeIgniter\Model;

class Memo_Model extends Model
{

    protected $table = 'memo';
    protected $allowedFields = ['tgl_memo', 'no_surat', 'dibuat', 'perihal', 'dari'];

    public function search($keyword)
    {
        return $this->table('memo')->like('tgl_memo', $keyword)->orLike('no_surat', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('memo')->get()->getResultArray();
        } else {
            return $this->db->table('memo')->where('id', $id);
            return $this->db->table('memo')->get()->getRowArray();
        }
    }

    public function addmemo($data)
    {
        return $this->table('memo')->insert($data);
    }

    public function hapusmemo($id)
    {
        return $this->db->table('memo')->delete(['id' => $id]);
    }

    public function ubahmemo($data, $id)
    {
        return $this->db->table('memo')->update($data, ['id' => $id]);
    }
}
