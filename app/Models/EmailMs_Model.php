<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailMs_Model extends Model
{

    protected $table = 'email_masuk';
    protected $allowedFields = ['proyek', 'kontak', 'tgl_surat', 'no_surat', 'dibuat', 'hal', 'kerahasiaan', 'urgensi', 'ordner'];

    public function search($keyword)
    {
        return $this->table('email_masuk')->like('proyek', $keyword)->orLike('tgl_surat', $keyword);
    }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('email_masuk')->get()->getResultArray();
        } else {
            return $this->db->table('email_masuk')->where('id', $id);
            return $this->db->table('email_masuk')->get()->getRowArray();
        }
    }

    public function addEmailMs($data)
    {
        return $this->table('email_masuk')->insert($data);
    }

    public function hapusEmailm($id)
    {
        return $this->db->table('email_masuk')->delete(['id' => $id]);
    }

    public function ubahEmailm($data, $id)
    {
        return $this->db->table('email_masuk')->update($data, ['id' => $id]);
    }
}
