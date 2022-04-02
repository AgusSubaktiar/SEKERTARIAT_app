<?php

namespace App\Models;

use CodeIgniter\Model;

class Penawaran_Model extends Model
{

    protected $table = 'penawaran';
    protected $allowedFields = ['kepada', 'no_penawaran', 'tgl_penawaran', 'uraian'];

    public function search($keyword)
    {
        return $this->table('penawaran')->like('kepada', $keyword)->orLike('tgl_penawaran', $keyword);
    }

    public function getAllData($id = false)
    {

        if ($id == false) {
            return $this->db->table('penawaran')->orderBy('tgl_penawaran', 'DESC')->get()->getResultArray();
        } else {
            return $this->db->table('penawaran')->where('id', $id)->orderBy('tgl_penawaran', 'DESC');
            return $this->db->table('penawaran')->orderBy('tgl_penawaran', 'DESC')->get()->getRowArray();
        }
    }
    public function addpenawaran($data)
    {
        return $this->table('penawaran')->insert($data);
    }

    public function hapuspenawaran($id)
    {
        return $this->db->table('penawaran')->delete(['id' => $id]);
    }

    public function ubahpenawaran($data, $id)
    {
        return $this->db->table('penawaran')->update($data, ['id' => $id]);
    }
}
