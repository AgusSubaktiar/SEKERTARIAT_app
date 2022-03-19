<?php

namespace App\Controllers;

use App\Models\EmailMs_Model;

class EmailMs extends BaseController
{

    public function __construct()
    {
        $this->model = new EmailMs_Model();
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
            'judul' => 'Data Email Masuk',
            'email_masuk' => $this->model->paginate('2'),
            'pager' => $this->model->pager
        ];
        echo view('admin/emailMs', $data);
    }
    public function addEmailMs()
    {
        if (isset($_POST['addEmailMs'])) {
            $val = $this->validate([
                'proyek' => 'required',
                'kontak' => 'required',
                'tgl_surat' => 'required',
                'no_surat' => 'required',
                'dibuat' => 'required',
                'hal' => 'required',
                'kerahasiaan' => 'required',
                'urgensi' => 'required',
                'ordner' => [
                    'rules' => 'uploaded[ordner]|mime_in[ordner,application/pdf]|max_size[ordner,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ]
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Email Masuk',
                    'email_masuk' => $this->model->getAllData()
                ];

                $data['email_masuk'] = $this->model->getdata('email_masuk')->result();

                echo view('admin/emailMs', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadEmail');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'proyek' => $this->request->getPost('proyek'),
                    'kontak' => $this->request->getPost('kontak'),
                    'tgl_surat' => $this->request->getPost('tgl_surat'),
                    'no_surat' => $this->request->getPost('no_surat'),
                    'dibuat' => $this->request->getPost('dibuat'),
                    'hal' => $this->request->getPost('hal'),
                    'kerahasiaan' => $this->request->getPost('kerahasiaan'),
                    'urgensi' => $this->request->getPost('urgensi'),
                    'ordner' => $namaSampul
                ];

                $success = $this->model->addEmailMs($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('EmailMs'));
                }
            }
        } else {
            return redirect()->to('EmailMs');
            dd('berhasil');
        }
    }

    public function ubahEmailm()
    {
        if (isset($_POST['ubahEmailm'])) {
            $val = $this->validate([
                'proyek' => 'required',
                'kontak' => 'required',
                'tgl_surat' => 'required',
                'no_surat' => 'required',
                'dibuat' => 'required',
                'hal' => 'required',
                'kerahasiaan' => 'required',
                'urgensi' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Surat Masuk',
                    'email_masuk' => $this->model->getAllData()
                ];

                echo view('admin/emailMs', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'proyek' => $this->request->getPost('proyek'),
                    'kontak' => $this->request->getPost('kontak'),
                    'tgl_surat' => $this->request->getPost('tgl_surat'),
                    'no_surat' => $this->request->getPost('no_surat'),
                    'dibuat' => $this->request->getPost('dibuat'),
                    'hal' => $this->request->getPost('hal'),
                    'kerahasiaan' => $this->request->getPost('kerahasiaan'),
                    'urgensi' => $this->request->getPost('urgensi'),
                    'ordner' => $this->request->getPost('ordner')
                ];

                // update data
                $success = $this->model->ubahEmailm($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('EmailMs'));
                }
            }
        } else {
            return redirect()->to('EmailMs');
            dd('berhasil');
        }
    }


    public function hapusmu($id)
    {
        $success = $this->model->hapusmu($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('EmailMs'));
        }
    }
}
