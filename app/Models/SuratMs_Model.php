<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMs_Model extends Model
{

    protected $table = 'surat_masuk';   
    protected $allowedFields = ['perusahaan', 'alamat', 'tgl_masuk', 'no_surat', 'perihal', 'arsip'];
    // protected $allowedFields = ['proyek', 'kontak', 'tgl_surat', 'no_surat', 'dibuat', 'hal', 'kerahasiaan', 'urgensi', 'ordner'];

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table($this->table);
    }

    public function getAllData()
    {
        return $this->builder->get();
    }

    public function addSurat($data)
    {
        return $this->builder->insert($data);
    }

    public function hapus($id)
    {
        return $this->builder->delete(['id' => $id]);
    }

    public function ubah($data, $id)
    {
        return $this->builder->update($data, ['id' => $id]);
    }
}
