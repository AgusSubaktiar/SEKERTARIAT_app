<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasukUser_Model extends Model
{

    protected $table = 'suratmasuk';
    protected $allowedFields = ['tgl_suratmasuk', 'no_suratmasuk', 'kepada', 'perihal', 'kode_proyek', 'nama_proyek', 'ordner'];

    public function search($keyword)
    {
        return $this->table('suratmasuk')->like('tgl_suratmasuk', $keyword)->orLike('nama_proyek', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('suratmasuk')->get()->getResultArray();
        } else {
            return $this->db->table('suratmasuk')->where('id', $id);
            return $this->db->table('suratmasuk')->get()->getRowArray();
        }
    }

    public function addsuratmasuk($data)
    {
        return $this->table('suratmasuk')->insert($data);
    }

    public function hapussuratmasuk($id)
    {
        return $this->db->table('suratmasuk')->delete(['id' => $id]);
    }

    public function ubahsuratmasuk($data, $id)
    {
        return $this->db->table('suratmasuk')->update($data, ['id' => $id]);
    }
}
