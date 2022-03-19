<?php

namespace App\Controllers;

use App\Models\EmailK_Model;

class EmailK extends BaseController
{

    public function __construct()
    {
        $this->model = new EmailK_Model();
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
            'email_keluar' => $this->model->paginate('2'),
            'pager' => $this->model->pager
        ];
        echo view('admin/emailK', $data);
    }
    public function addEmailK()
    {
        if (isset($_POST['addEmailK'])) {
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
                    'email_keluar' => $this->model->getAllData()
                ];

                $data['email_keluar'] = $this->model->getdata('email_keluar')->result();

                echo view('admin/emailK', $data);
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

                $success = $this->model->addEmailK($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('EmailK'));
                }
            }
        } else {
            return redirect()->to('EmailK');
            dd('berhasil');
        }
    }

    public function ubahEmailK()
    {
        if (isset($_POST['ubahEmailK'])) {
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
                    'email_keluar' => $this->model->getAllData()
                ];

                echo view('admin/emailK', $data);
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
                $success = $this->model->ubahEmailK($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('EmailK'));
                }
            }
        } else {
            return redirect()->to('EmailK');
            dd('berhasil');
        }
    }


    public function hapusEmailK($id)
    {
        $success = $this->model->hapusEmailK($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('EmailK'));
        }
    }
}
