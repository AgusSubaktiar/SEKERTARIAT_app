<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratK_Model extends Model
{

    protected $table = 'surat_keluar';
    protected $allowedFields = ['proyek', 'kontak', 'tgl_surat', 'no_surat', 'dibuat', 'hal', 'kerahasiaan', 'urgensi', 'ordner'];

    public function search($keyword)
    {
        return $this->table('surat_keluar')->like('proyek', $keyword)->orLike('tgl_surat', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('surat_keluar')->get()->getResultArray();
        } else {
            return $this->db->table('surat_keluar')->where('id', $id);
            return $this->db->table('surat_keluar')->get()->getRowArray();
        }
    }

    public function addSuratsk($data)
    {
        return $this->table('surat_keluar')->insert($data);
    }

    public function hapussk($id)
    {
        return $this->db->table('surat_keluar')->delete(['id' => $id]);
    }

    public function ubahsk($data, $id)
    {
        return $this->db->table('surat_keluar')->update($data, ['id' => $id]);
    }
}
