<?php

namespace App\Models;

use CodeIgniter\Model;

class Formulir_Model extends Model
{

    protected $table = 'formulir';
    protected $allowedFields = ['ordner', 'keterangan'];

    public function search($keyword)
    {
        return $this->table('formulir')->like('ordner', $keyword)->orLike('keterangan', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('formulir')->get()->getResultArray();
        } else {
            return $this->db->table('formulir')->where('id', $id);
            return $this->db->table('formulir')->get()->getRowArray();
        }
    }

    public function addformulir($data)
    {
        return $this->table('formulir')->insert($data);
    }

    public function hapusformulir($id)
    {
        return $this->db->table('formulir')->delete(['id' => $id]);
    }

    public function ubahformulir($data, $id)
    {
        return $this->db->table('formulir')->update($data, ['id' => $id]);
    }
}
