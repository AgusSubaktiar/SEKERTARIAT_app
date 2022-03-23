<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratMasuk_Model;

class SuratMasuk extends BaseController
{

    public function __construct()
    {
        $this->model = new SuratMasuk_Model();
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
            'judul' => 'Data Surat Masuk',
            'suratmasuk' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/suratmasuk', $data);
    }
    public function addsuratmasuk()
    {
        if (isset($_POST['addsuratmasuk'])) {
            $val = $this->validate([
                'tgl_suratmasuk' => 'required',
                'no_suratmasuk' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
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
                    'judul' => 'Data Surat Masuk',
                    'suratmasuk' => $this->model->getAllData()
                ];

                $data['suratmasuk'] = $this->model->getdata('suratmasuk')->result();

                echo view('admin/suratmasuk', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadsuratmasuk');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_suratmasuk' => $this->request->getPost('tgl_suratmasuk'),
                    'no_suratmasuk' => $this->request->getPost('no_suratmasuk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addsuratmasuk($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('SuratMasuk'));
                }
            }
        } else {
            return redirect()->to('SuratMasuk');
            dd('berhasil');
        }
    }

    public function ubahsuratmasuk()
    {
        if (isset($_POST['ubahsuratmasuk'])) {
            $val = $this->validate([
                'tgl_suratmasuk' => 'required',
                'no_suratmasuk' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'kode_proyek' => 'required',
                'nama_proyek' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Memo',
                    'suratmasuk' => $this->model->getAllData()
                ];

                echo view('admin/suratmasuk', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_suratmasuk' => $this->request->getPost('tgl_suratmasuk'),
                    'no_suratmasuk' => $this->request->getPost('no_suratmasuk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                ];

                // update data
                $success = $this->model->ubahsuratmasuk($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('SuratMasuk'));
                }
            }
        } else {
            return redirect()->to('SuratMasuk');
        }
    }


    public function hapussuratmasuk($id)
    {
        $success = $this->model->hapussuratmasuk($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('SuratMasuk'));
        }
    }
}
