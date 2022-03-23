<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EmailMasuk_Model;

class EmailMasuk extends BaseController
{

    public function __construct()
    {
        $this->model = new EmailMasuk_Model();
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
            'emailmasuk' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/emailmasuk', $data);
    }
    public function addemailmasuk()
    {
        if (isset($_POST['addemailmasuk'])) {
            $val = $this->validate([
                'tgl_emailmasuk' => 'required',
                'no_emailmasuk' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
                'tembusan' => 'required',
                'ordner' => [
                    'rules' => 'uploaded[ordner]|mime_in[ordner,application/pdf]|max_size[ordner,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ],
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Email Masuk',
                    'emailmasuk' => $this->model->getAllData()
                ];

                $data['emailmasuk'] = $this->model->getdata('emailmasuk')->result();

                echo view('admin/emailmasuk', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploademailmasuk');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_emailmasuk' => $this->request->getPost('tgl_emailmasuk'),
                    'no_emailmasuk' => $this->request->getPost('no_emailmasuk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tembusan' => $this->request->getPost('tembusan'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addemailmasuk($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('EmailMasuk'));
                }
            }
        } else {
            return redirect()->to('EmailMasuk');
            dd('berhasil');
        }
    }

    public function ubahemailmasuk()
    {
        if (isset($_POST['ubahemailmasuk'])) {
            $val = $this->validate([
                'tgl_emailmasuk' => 'required',
                'no_emailmasuk' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
                'tembusan' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Email Masuk',
                    'emailmasuk' => $this->model->getAllData()
                ];

                echo view('admin/emailmasuk', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_emailmasuk' => $this->request->getPost('tgl_emailmasuk'),
                    'no_emailmasuk' => $this->request->getPost('no_emailmasuk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tembusan' => $this->request->getPost('tembusan'),
                    'ordner' => $this->request->getPost('ordner')
                ];

                // update data
                $success = $this->model->ubahemailmasuk($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('EmailMasuk'));
                }
            }
        } else {
            return redirect()->to('EmailMasuk');
        }
    }


    public function hapusemailmasuk($id)
    {
        $success = $this->model->hapusemailmasuk($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('EmailMasuk'));
        }
    }
}
