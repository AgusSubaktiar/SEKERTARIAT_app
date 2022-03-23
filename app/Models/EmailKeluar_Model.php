<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailKeluar_Model extends Model
{

    protected $table = 'emailkeluar';
    protected $allowedFields = ['tgl_emailkeluar', 'no_emailkeluar', 'kepada', 'perihal', 'kode_proyek', 'nama_proyek', 'tembusan', 'ordner'];

    public function search($keyword)
    {
        return $this->table('emailkeluar')->like('tgl_emailkeluar', $keyword)->orLike('no_emailkeluar', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('emailkeluar')->get()->getResultArray();
        } else {
            return $this->db->table('emailkeluar')->where('id', $id);
            return $this->db->table('emailkeluar')->get()->getRowArray();
        }
    }

    public function addemailkeluar($data)
    {
        return $this->table('emailkeluar')->insert($data);
    }

    public function hapusemailkeluar($id)
    {
        return $this->db->table('emailkeluar')->delete(['id' => $id]);
    }

    public function ubahemailkeluar($data, $id)
    {
        return $this->db->table('emailkeluar')->update($data, ['id' => $id]);
    }
}
