<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeAdmin_Modal extends Model
{
    public function tot_suratm()
    {
        return $this->db->table('surat_masuk')->countAll();
    }

    public function tot_suratk()
    {
        return $this->db->table('surat_keluar')->countAll();
    }

    public function tot_user()
    {
        return $this->db->table('user_tb')->countAll();
    }
}
