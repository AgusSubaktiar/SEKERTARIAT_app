<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMsu_Model extends Model
{

    protected $table = 'surat_masukus';
    protected $allowedFields = ['proyek', 'kontak', 'tgl_surat', 'no_surat', 'dibuat', 'hal', 'kerahasiaan', 'urgensi', 'ordner'];

    public function search($keyword)
    {
        return $this->table('surat_masukus')->like('proyek', $keyword)->orLike('tgl_surat', $keyword);
    }

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->db->table('surat_masukus')->get()->getResultArray();
        } else {
            return $this->db->table('surat_masukus')->where('id', $id);
            return $this->db->table('surat_masukus')->get()->getRowArray();
        }
    }

    public function addSuratmu($data)
    {
        return $this->table('surat_masukus')->insert($data);
    }

    public function hapusmu($id)
    {
        return $this->db->table('surat_masukus')->delete(['id' => $id]);
    }

    public function ubahm($data, $id)
    {
        return $this->db->table('surat_masukus')->update($data, ['id' => $id]);
    }
}
