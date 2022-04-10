<?php

namespace App\Models;

use App\Controllers\SuratMasuk;
use CodeIgniter\Model;

class DisposisiModel extends Model
{
    protected $table = 'disposisi';
    protected $primaryKey = 'id';
    protected $allowFields = ['disposisi'];

    public function getAllData($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        } else {
            return $this->where(['id' => $id])->first();
        }
    }

    public function getAllSuratMasuk()
    {
        $builder = $this->db->table('suratmasuk as s');
        $builder->select('s.*, GROUP_CONCAT(b.nama_bidang SEPARATOR ",") as bidang');
        $builder->join('terdisposisi as t', 't.id_surat=s.id');
        $builder->join('nama_bidang_tb as b', 'b.id_bidang=t.id_bidang');
        $builder->groupBy('s.id');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getSuratMasukByBidang($idBidang)
    {
        $builder = $this->db->table('suratmasuk as s');
        $builder->select('s.*');
        $builder->join('terdisposisi as t', 't.id_surat=s.id');
        $builder->join('nama_bidang_tb as b', 'b.id_bidang=t.id_bidang');
        $builder->where('b.id_bidang', $idBidang);
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function deleteTerdisposisiBySurat($idSurat)
    {
        return $this->db->table('terdisposisi')->delete(['id_surat' => $idSurat]);
    }

    //insert data many 2 many terdisposisi
    public function insertSuratTerdisposisi($bidang, $suratMasuk)
    {
        $data = [
            'id_disposisi' => $suratMasuk['id_disposisi'],
            'tgl_suratmasuk' => $suratMasuk['tgl_suratmasuk'],
            'no_suratmasuk' => $suratMasuk['no_suratmasuk'],
            'kepada' => $suratMasuk['kepada'],
            'perihal' => $suratMasuk['perihal'],
            'kode_proyek' => $suratMasuk['kode_proyek'],
            'nama_proyek' => $suratMasuk['nama_proyek'],
            'ordner' => $suratMasuk['ordner'],
        ];
        $builder = $this->db->table('suratmasuk');
        $builder->insert($data);
        $suratMasukId = $this->db->insertID();
        $terdisposisi = array();
        foreach ($bidang['id_bidang'] as $key => $val) {
            $terdisposisi[] = array(
                'id_surat' => $suratMasukId,
                'id_bidang' => $_POST['bidang'][$key]
            );
        }
        $custom = $this->db->table('terdisposisi');
        $custom->insertBatch($terdisposisi);
        $this->db->transComplete();
        return redirect()->to(base_url('SuratMasuk'));
    }
}
