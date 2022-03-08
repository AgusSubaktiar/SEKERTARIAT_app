<?php

namespace App\Models;

use CodeIgniter\Model;

class Users_Model extends Model
{

    protected $table = 'user_tb';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['username', 'password', 'id_bidang'];

    public function saveUser($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }


    public function getUserModel($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        } else {
            return $this->where(['id_user' => $id])->first();
        }
    }

    public function editUser($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_user', $data['id_user']);
        return $builder->update($data);
    }

    public function deleteUser($id)
    {
        $query = $this->db->table('user_tb')->delete(array('id_user' => $id));
        return $query;
    }

    public function cekLogin($username, $password)
    {
        $queryLogin = $this->db->table('user_tb')
            ->where(array('username' => $username, 'password' => $password))
            ->get()->getRowArray();
        return $queryLogin;
    }
}
