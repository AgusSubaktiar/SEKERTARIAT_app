<?php

namespace App\Models;

use CodeIgniter\Model;

class Formulir_Model extends Model
{

    protected $table = 'formulir_formulir';
    protected $allowedFields = ['nama_dokumen', 'input_oleh', 'waktu_input', 'ordner'];

    public function search($keyword)
    {
        return $this->table('formulir_formulir')->like('nama_dokumen', $keyword)->orLike('waktu_input', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('formulir_formulir')->get()->getResultArray();
        } else {
            return $this->db->table('formulir_formulir')->where('id', $id);
            return $this->db->table('formulir_formulir')->get()->getRowArray();
        }
    }

    public function addformulir($data)
    {
        return $this->table('formulir_formulir')->insert($data);
    }

    public function hapusformulir($id)
    {
        return $this->db->table('formulir_formulir')->delete(['id' => $id]);
    }

    public function ubahformulir($data, $id)
    {
        return $this->db->table('formulir_formulir')->update($data, ['id' => $id]);
    }
}
