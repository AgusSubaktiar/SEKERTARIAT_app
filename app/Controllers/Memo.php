<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Memo_Model;

class Memo extends BaseController
{

    public function __construct()
    {
        $this->model = new Memo_Model();
        $this->pager = \Config\Services::pager();
    }

    public function index()
    {

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $surat = $this->model->search($keyword);
        } else {
            $surat = $this->model;
        }

        $data = [
            'judul' => 'Data Memo',
            'memo' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/memo', $data);
    }
    public function addmemo()
    {
        if (isset($_POST['addmemo'])) {
            $val = $this->validate([
                'tgl_memo' => 'required',
                'no_surat' => 'required',
                'dibuat' => 'required',
                'perihal' => 'required',
                'dari' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Memo',
                    'memo' => $this->model->getAllData()
                ];

                $data['memo'] = $this->model->getdata('memo')->result();

                echo view('admin/memo', $data);
            } else {

                $data  = [
                    'tgl_memo' => $this->request->getPost('tgl_memo'),
                    'no_surat' => $this->request->getPost('no_surat'),
                    'dibuat' => $this->request->getPost('dibuat'),
                    'perihal' => $this->request->getPost('perihal'),
                    'dari' => $this->request->getPost('dari')
                ];

                $success = $this->model->addmemo($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('Memo'));
                }
            }
        } else {
            return redirect()->to('Memo');
            dd('berhasil');
        }
    }

    public function ubahmemo()
    {
        if (isset($_POST['ubahmemo'])) {
            $val = $this->validate([
                'tgl_memo' => 'required',
                'no_surat' => 'required',
                'dibuat' => 'required',
                'perihal' => 'required',
                'dari' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Memo',
                    'memo' => $this->model->getAllData()
                ];

                echo view('admin/memo', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_memo' => $this->request->getPost('tgl_memo'),
                    'no_surat' => $this->request->getPost('no_surat'),
                    'dibuat' => $this->request->getPost('dibuat'),
                    'perihal' => $this->request->getPost('perihal'),
                    'dari' => $this->request->getPost('dari')
                ];

                // update data
                $success = $this->model->ubahmemo($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('Memo'));
                }
            }
        } else {
            return redirect()->to('Memo');
        }
    }


    public function hapusmemo($id)
    {
        $success = $this->model->hapusmemo($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('Memo'));
        }
    }
}
