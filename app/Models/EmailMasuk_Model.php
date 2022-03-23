<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailMasuk_Model extends Model
{

    protected $table = 'emailmasuk';
    protected $allowedFields = ['tgl_emailmasuk', 'no_emailmasuk', 'kepada', 'perihal', 'kode_proyek', 'nama_proyek', 'tembusan', 'ordner'];

    public function search($keyword)
    {
        return $this->table('emailmasuk')->like('tgl_emailmasuk', $keyword)->orLike('no_emailmasuk', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('emailmasuk')->get()->getResultArray();
        } else {
            return $this->db->table('emailmasuk')->where('id', $id);
            return $this->db->table('emailmasuk')->get()->getRowArray();
        }
    }

    public function addemailmasuk($data)
    {
        return $this->table('emailmasuk')->insert($data);
    }

    public function hapusemailmasuk($id)
    {
        return $this->db->table('emailmasuk')->delete(['id' => $id]);
    }

    public function ubahemailmasuk($data, $id)
    {
        return $this->db->table('emailmasuk')->update($data, ['id' => $id]);
    }
}
