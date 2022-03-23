<?php

namespace App\Models;

use CodeIgniter\Model;

class Perizinan_Model extends Model
{

    protected $table = 'perizinan';
    protected $allowedFields = ['nama', 'tgl_perizinan', 'no_perizinan', 'perihal', 'masaberlaku'];

    public function search($keyword)
    {
        return $this->table('perizinan')->like('nama', $keyword)->orLike('tgl_perizinan', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('perizinan')->get()->getResultArray();
        } else {
            return $this->db->table('perizinan')->where('id', $id);
            return $this->db->table('perizinan')->get()->getRowArray();
        }
    }

    public function addperizinan($data)
    {
        return $this->table('perizinan')->insert($data);
    }

    public function hapusperizinan($id)
    {
        return $this->db->table('perizinan')->delete(['id' => $id]);
    }

    public function ubahperizinan($data, $id)
    {
        return $this->db->table('perizinan')->update($data, ['id' => $id]);
    }
}
