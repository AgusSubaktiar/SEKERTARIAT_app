<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Users_Model;

class login extends BaseController
{

    public function index()
    {
        helper(['form']);
        $data = [
            'validation' => \Config\Services::validation()
        ];
        return view('admin/login', $data);
    }

    public function auth()
    {
        if (!$this->validate([
            'username' => 'required',
            'password' => 'required'
        ])) {
            $validation = \Config\Services::validation();
            // dd($validation);
            return redirect()->to('/Login')->withInput()->with('validation', $validation);
            # code...
        }
        $userModel = new Users_Model;
        $username = $this->request->getPost('username');
        $password = md5($this->request->getPost('password'));

        $cekLogin = $userModel->cekLogin($username, $password);
        if ($cekLogin == 0) {
            session()->setFlashData('alertPassword', 'Username atau password yang kamu masukkan salah. Silakan coba lagi.');
            return redirect()->to('/Login');
        } else {
            if ($cekLogin['role'] == 1) {
                session()->set('loginData', '1');
                session()->set('id_user', $cekLogin['id_user']);
                session()->set('username', $cekLogin['username']);
                session()->set('id_bidang', $cekLogin['id_bidang']);
                return redirect()->to('/HomeAdmin');
            } else {
                session()->set('id_user', $cekLogin['id_user']);
                session()->set('username', $cekLogin['username']);
                session()->set('id_bidang', $cekLogin['id_bidang']);
                return redirect()->to('/Home');
            }
            // return redirect()->to('/Login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
