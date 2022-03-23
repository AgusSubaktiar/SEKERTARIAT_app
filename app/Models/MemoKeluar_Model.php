<?php

namespace App\Models;

use CodeIgniter\Model;

class MemoKeluar_Model extends Model
{

    protected $table = 'memokeluar';
    protected $allowedFields = ['tgl_memokeluar', 'no_memokeluar', 'dari', 'kepada', 'perihal', 'ordner'];

    public function search($keyword)
    {
        return $this->table('memokeluar')->like('tgl_memokeluar', $keyword)->orLike('dari', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('memokeluar')->get()->getResultArray();
        } else {
            return $this->db->table('memokeluar')->where('id', $id);
            return $this->db->table('memokeluar')->get()->getRowArray();
        }
    }

    public function addmemokeluar($data)
    {
        return $this->table('memokeluar')->insert($data);
    }

    public function hapusmemokeluar($id)
    {
        return $this->db->table('memokeluar')->delete(['id' => $id]);
    }

    public function ubahmemokeluar($data, $id)
    {
        return $this->db->table('memokeluar')->update($data, ['id' => $id]);
    }
}
