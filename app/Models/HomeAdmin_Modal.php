<?php

namespace App\Models;

use CodeIgniter\Model;

class HomeAdmin_Modal extends Model
{
    public function tot_suratm()
    {
        return $this->db->table('suratmasuk')->countAll();
    }

    // public function tot_suratk()
    // {
    //     return $this->db->table('surat_keluar')->countAll();
    // }

    // public function tot_user()
    // {
    //     return $this->db->table('user_tb')->countAll();
    // }

    // public function tot_emailms()
    // {
    //     return $this->db->table('email_masuk')->countAll();
    // }

    // public function tot_emailk()
    // {
    //     return $this->db->table('email_keluar')->countAll();
    // }

    // public function tot_formulir()
    // {
    //     return $this->db->table('formulir_formulir')->countAll();
    // }
    // public function tot_memo()
    // {
    //     return $this->db->table('memo')->countAll();
    // }
}
