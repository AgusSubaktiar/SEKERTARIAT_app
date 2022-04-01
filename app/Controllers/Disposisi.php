<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Bidang_admin_model;
use App\Models\Users_Model;
use App\Models\DataBidang_Model;
use App\Models\FileModel;


class Disposisi extends Controller
{

    protected $modelBidang, $usersModel;

    public function __construct()
    {
        $this->modelBidang = new Bidang_admin_model();
    }

    public function index()
    {
        $model = new Bidang_admin_model;
        $modelUser = new Users_Model;
        $modelDataBidang = new DataBidang_Model;
        $fileModel = new FileModel;

        $data['getNamaBidang'] = $model->getNamaBidang();
        $data['getUser0'] = $modelUser->getUserModel();
        $data['getBidangData'] = $modelDataBidang->getDataBidang();
        $data['fileModel'] = $fileModel->findAll();
        $data['validation'] = \Config\Services::validation();

        return view('admin/disposisi', $data);
    }

    public function addBidang()
    {
        $model = new Bidang_admin_model;
        $data = array(
            'nama_bidang' => $this->request->getPost('nama')
        );
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/NamaBidang')->withInput()->with('validation', $validation);
        }
        $model->saveBidang($data);
        return redirect()->to('/NamaBidang');
    }


    public function editBidang($id)
    {
        if (!$this->validate([
            'nama' => [
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong!'
                ]
            ]
        ])) {
            $validation = \Config\Services::validation();
            return redirect()->to('/NamaBidang')->withInput()->with('validation', $validation);
        }
        $this->modelBidang->updateBidang([
            'id_bidang' => $id,
            'nama_bidang' => $this->request->getVar('nama')
        ]);
        // $this->usersModel->editUser([])
        return redirect()->to('/NamaBidang');
    }

    public function delete($id)
    {
        $model = new Bidang_admin_model;
        $model->deleteBidang($id);
        return redirect()->to('/NamaBidang');
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
        return redirect()->to('/Disposisi');
    }
    public function addUserAdmin()
    {
        $model = new Users_Model;
        $data = array(
            'username' => $this->request->getPost('usernameAdmin'),
            'password' => md5($this->request->getPost('passwordAdmin')),
            'id_bidang' => 0,
            'role' => 1,
        );
        $model->saveUser($data);
        return redirect()->to('/User');
    }

    public function getUser($id)
    {
        $model = new Users_Model;
        $data['getUser'] = $model->getUserModel();
    }

    public function addDataBidang()
    {
        $model = new DataBidang_Model;
        $data = array(
            'nama_isi_bidang' => $this->request->getPost('namaDataBidang'),
            'id_bidang'       => $this->request->getPost('datbidBagianBidang')
        );
        $model->addDataBidang($data);
        return redirect()->to('/databidang');
    }

    public function deleteDataBidang($id)
    {
        $model = new DataBidang_Model;
        $model->deleteDataBidang($id);
        return redirect()->to('/databidang');
    }

    // Page Controller
    public function  namaBidang()
    {
        $model = new Bidang_admin_model;
        $modelUser = new Users_Model;
        $modelDataBidang = new DataBidang_Model;
        $data['getNamaBidang'] = $model->getNamaBidang();
        $data['getUser0'] = $modelUser->getUserModel();
        $data['getBidangData'] = $modelDataBidang->getDataBidang();
        $data['validation'] = \Config\Services::validation();

        return view('admin/pages/namabidang_admin', $data);
    }

    public function dataBidang()
    {
        $model = new Bidang_admin_model;
        $modelUser = new Users_Model;
        $modelDataBidang = new DataBidang_Model;
        $data['title'] = 'Data Bidang';
        $data['getNamaBidang'] = $model->getNamaBidang();
        $data['getUser0'] = $modelUser->getUserModel();
        $data['getBidangData'] = $modelDataBidang->getDataBidang();
        $data['validation'] = \Config\Services::validation();

        return view('admin/pages/databidang_admin', $data);
    }

    public function dataUser()
    {
        $model = new Bidang_admin_model;
        $modelUser = new Users_Model;
        $modelDataBidang = new DataBidang_Model;
        $data['title'] = 'Data Bidang';
        $data['getNamaBidang'] = $model->getNamaBidang();
        $data['getUser0'] = $modelUser->getUserModel();
        $data['getBidangData'] = $modelDataBidang->getDataBidang();
        $data['validation'] = \Config\Services::validation();

        return view('admin/pages/dataUser/admin', $data);
    }

    public function dataView()
    {
        $model = new Bidang_admin_model;
        $modelUser = new Users_Model;
        $modelDataBidang = new DataBidang_Model;
        $data['title'] = 'Data Bidang';
        $data['getNamaBidang'] = $model->getNamaBidang();
        $data['getUser0'] = $modelUser->getUserModel();
        $data['getBidangData'] = $modelDataBidang->getDataBidang();
        $data['validation'] = \Config\Services::validation();

        return view('admin/pages/dataview_admin', $data);
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

        return redirect()->to('/Disposisi');
    }

    public function uploadRevisi()
    {

        return redirect()->to('/Disposisi');
    }
}
