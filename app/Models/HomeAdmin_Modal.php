<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeAdmin_Modal extends Model
{
    public function tot_suratm()
    {
        return $this->db->table('suratmasuk')->countAll();
    }

    public function tot_suratk()
    {
        return $this->db->table('suratkeluar')->countAll();
    }

    public function tot_user()
    {
        return $this->db->table('user_tb')->countAll();
    }

    public function tot_emailmasuk()
    {
        return $this->db->table('emailmasuk')->countAll();
    }

    public function tot_emailkeluar()
    {
        return $this->db->table('emailkeluar')->countAll();
    }

    public function tot_formulir()
    {
        return $this->db->table('formulir')->countAll();
    }
    public function tot_memomasuk()
    {
        return $this->db->table('memomasuk')->countAll();
    }
    public function tot_memokeluar()
    {
        return $this->db->table('memokeluar')->countAll();
    }
    public function tot_suratkeputusan()
    {
        return $this->db->table('surat_keputusan')->countAll();
    }
    public function tot_perizinan()
    {
        return $this->db->table('perizinan')->countAll();
    }
    public function tot_berkas()
    {
        return $this->db->table('penawaran')->countAll();
    }
    public function tot_tender()
    {
        return $this->db->table('tender')->countAll();
    }
}
