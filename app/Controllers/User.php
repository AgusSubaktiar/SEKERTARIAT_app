<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\Users_Model;
use App\Models\Bidang_admin_model;

class User extends Controller
{

    public function index()
    {
        $userModel = new Users_Model;
        $bidangAdminModel = new Bidang_admin_model;
        $data['getUserData'] = $userModel->getUserModel();
        $data['getNamaBidang'] = $bidangAdminModel->getNamaBidang();
        return view('admin/adduser', $data);
    }

    public function deleteUser($id)
    {
        $model = new Users_Model;
        $model->deleteUser($id);
        return redirect()->to('User');
    }

    public function editUser($id)
    {
        $model = new Users_Model;
        $password = $this->request->getPost('userEditPassword');
        $object = array(
            'id_user' => $id,
            'username' => $this->request->getPost('userEditUsername'),
            'id_bidang' => $this->request->getPost('userEditIdBidang'),
        );
        if ($password != null) {
            $object['password'] = md5($this->request->getPost('userEditPassword'));
        }
        $model->editUser($object);

        return redirect()->to('User');
    }
}
