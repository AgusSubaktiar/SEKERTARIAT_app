<?php

namespace App\Models;

use CodeIgniter\Model;

class EmailK_Model extends Model
{

    protected $table = 'email_keluar';
    protected $allowedFields = ['proyek', 'kontak', 'tgl_surat', 'no_surat', 'dibuat', 'hal', 'kerahasiaan', 'urgensi', 'ordner'];

    public function search($keyword)
    {
        return $this->table('email_keluar')->like('proyek', $keyword)->orLike('tgl_surat', $keyword);
    }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('email_keluar')->get()->getResultArray();
        } else {
            return $this->db->table('email_keluar')->where('id', $id);
            return $this->db->table('email_keluar')->get()->getRowArray();
        }
    }

    public function addEmailK($data)
    {
        return $this->table('email_keluar')->insert($data);
    }

    public function hapusEmailK($id)
    {
        return $this->db->table('email_keluar')->delete(['id' => $id]);
    }

    public function ubahEmailK($data, $id)
    {
        return $this->db->table('email_keluar')->update($data, ['id' => $id]);
    }
}
