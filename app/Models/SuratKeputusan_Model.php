<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeputusan_Model extends Model
{

    protected $table = 'surat_keputusan';
    protected $allowedFields = ['no_sk', 'tgl_sk', 'kepada', 'ordner', 'upload_sk'];

    public function search($keyword)
    {
        return $this->table('surat_keputusan')->like('no_sk', $keyword)->orLike('tgl_sk', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('surat_keputusan')->get()->getResultArray();
        } else {
            return $this->db->table('surat_keputusan')->where('id', $id);
            return $this->db->table('surat_keputusan')->get()->getRowArray();
        }
    }

    public function addsurat_keputusan($data)
    {
        return $this->table('surat_keputusan')->insert($data);
    }

    public function hapussurat_keputusan($id)
    {
        return $this->db->table('surat_keputusan')->delete(['id' => $id]);
    }

    public function ubahsurat_keputusan($data, $id)
    {
        return $this->db->table('surat_keputusan')->update($data, ['id' => $id]);
    }
}
