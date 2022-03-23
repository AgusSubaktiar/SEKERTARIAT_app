<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluar_Model extends Model
{

    protected $table = 'suratkeluar';
    protected $allowedFields = ['tgl_suratkeluar', 'no_suratkeluar', 'kepada', 'perihal', 'kode_proyek', 'nama_proyek', 'ordner'];

    public function search($keyword)
    {
        return $this->table('suratkeluar')->like('tgl_suratkeluar', $keyword)->orLike('nama_proyek', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('suratkeluar')->get()->getResultArray();
        } else {
            return $this->db->table('suratkeluar')->where('id', $id);
            return $this->db->table('suratkeluar')->get()->getRowArray();
        }
    }

    public function addsuratkeluar($data)
    {
        return $this->table('suratkeluar')->insert($data);
    }

    public function hapussuratkeluar($id)
    {
        return $this->db->table('suratkeluar')->delete(['id' => $id]);
    }

    public function ubahsuratkeluar($data, $id)
    {
        return $this->db->table('suratkeluar')->update($data, ['id' => $id]);
    }
}
