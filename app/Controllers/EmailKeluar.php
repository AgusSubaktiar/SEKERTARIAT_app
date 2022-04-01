<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\EmailKeluar_Model;

class EmailKeluar extends BaseController
{

    public function __construct()
    {
        $this->model = new EmailKeluar_Model();
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
            'judul' => 'Data Email Keluar',
            'emailkeluar' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/emailkeluar', $data);
    }
    public function addemailkeluar()
    {
        if (isset($_POST['addemailkeluar'])) {
            $val = $this->validate([
                'tgl_emailkeluar' => 'required',
                'no_emailkeluar' => 'required',
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
                return redirect()->to('EmailKeluar')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Email Keluar',
                    'emailkeluar' => $this->model->getAllData()
                ];

                $data['emailkeluar'] = $this->model->getdata('emailkeluar')->result();

                echo view('admin/emailkeluar', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploademailkeluar');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_emailkeluar' => $this->request->getPost('tgl_emailkeluar'),
                    'no_emailkeluar' => $this->request->getPost('no_emailkeluar'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tembusan' => $this->request->getPost('tembusan'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addemailkeluar($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('EmailKeluar'));
                }
            }
        } else {
            return redirect()->to('EmailKeluar');
            dd('berhasil');
        }
    }

    public function ubahemailkeluar()
    {
        if (isset($_POST['ubahemailkeluar'])) {
            $val = $this->validate([
                'tgl_emailkeluar' => 'required',
                'no_emailkeluar' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
                'tembusan' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('EmailKeluar')->withInput()->with('validation', $val);
                $data = [
                    'judul' => 'Data Email Masuk',
                    'emailkeluar' => $this->model->getAllData()
                ];

                echo view('admin/emailkeluar', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_emailkeluar' => $this->request->getPost('tgl_emailkeluar'),
                    'no_emailkeluar' => $this->request->getPost('no_emailkeluar'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tembusan' => $this->request->getPost('tembusan'),
                    'ordner' => $this->request->getPost('ordner')
                ];

                // update data
                $success = $this->model->ubahemailkeluar($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('EmailKeluar'));
                }
            }
        } else {
            return redirect()->to('EmailKeluar');
        }
    }


    public function hapusemailkeluar($id)
    {
        $success = $this->model->hapusemailkeluar($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('EmailKeluar'));
        }
    }
}
