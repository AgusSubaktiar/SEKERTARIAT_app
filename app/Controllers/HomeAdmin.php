<?php

namespace App\Controllers;

use App\Models\HomeAdmin_Modal;
use App\Models\Users_Model;
use App\Models\FileModel;

class HomeAdmin extends BaseController
{
    public function __construct()
    {
        $this->modal = new HomeAdmin_Modal();
    }

    public function index()
    {

        $data = [
            'tot_suratm' => $this->modal->tot_suratm(),
            'tot_suratk' => $this->modal->tot_suratk(),
            'tot_memomasuk' => $this->modal->tot_memomasuk(),
            'tot_memokeluar' => $this->modal->tot_memokeluar(),
            'tot_emailmasuk' => $this->modal->tot_emailmasuk(),
            'tot_emailkeluar' => $this->modal->tot_emailkeluar(),
            'tot_suratkeputusan' => $this->modal->tot_suratkeputusan(),
            'tot_perizinan' => $this->modal->tot_perizinan(),
            'tot_formulir' => $this->modal->tot_formulir(),
            'tot_user' => $this->modal->tot_user(),
        ];

        return view('admin/homeAdmin', $data);
    }

    public function addUser()
    {
        $model = new Users_Model;
        $data = array(
            'username' => $this->request->getPost('username'),
            'password' => md5($this->request->getPost('password')),
            'id_bidang' => $this->request->getPost('t_user')
        );
        $model->saveUser($data);
        return redirect()->to('User');
    }
    public function addUserAdmin()
    {
        $model = new Users_Model;
        $data = [
            'username' => $this->request->getPost('usernameAdmin'),
            'password' => md5($this->request->getPost('passwordAdmin')),
            'id_bidang' => 0,
            'role' => 1,
        ];
        $model->saveUser($data);
        return redirect()->to('HomeAdmin');
        dd('berhasil');
    }

    public function getUser($id)
    {
        $model = new Users_Model;
        $data['getUser'] = $model->getUserModel();
    }

    public function editFileAdmin($id)
    {
        $model = new FileModel;
        $nameFile = $model->find($id);
        $inputDisetujui = $this->request->getPost('disetujui');
        $inputDitolak = $this->request->getPost('revisi');

        if ($inputDisetujui != null) {
            $var = 3;
        } else {
            $var = 2;
        }

        $object = array(
            'id' => $id,
            'status' => $var,
            'review' => $this->request->getPost('review'),
        );

        $model->editFile($object);

        return redirect()->to('HomeAdmin');
    }

    public function uploadRevisi()
    {

        return redirect()->to('HomeAdmin');
    }
}
