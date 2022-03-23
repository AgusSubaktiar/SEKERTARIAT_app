<?php

namespace App\Models;

use CodeIgniter\Model;

class MemoMasuk_Model extends Model
{

    protected $table = 'memomasuk';
    protected $allowedFields = ['tgl_memomasuk', 'no_memo', 'dari', 'kepada', 'perihal', 'ordner'];

    public function search($keyword)
    {
        return $this->table('memomasuk')->like('tgl_memomasuk', $keyword)->orLike('dari', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('memomasuk')->get()->getResultArray();
        } else {
            return $this->db->table('memomasuk')->where('id', $id);
            return $this->db->table('memomasuk')->get()->getRowArray();
        }
    }

    public function addmemomasuk($data)
    {
        return $this->table('memomasuk')->insert($data);
    }

    public function hapusmemomasuk($id)
    {
        return $this->db->table('memomasuk')->delete(['id' => $id]);
    }

    public function ubahmemomasuk($data, $id)
    {
        return $this->db->table('memomasuk')->update($data, ['id' => $id]);
    }
}
