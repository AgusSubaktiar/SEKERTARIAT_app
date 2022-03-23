<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratKeluar_Model;

class SuratKeluar extends BaseController
{

    public function __construct()
    {
        $this->model = new SuratKeluar_Model();
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
            'judul' => 'Data Surat Keluar',
            'suratkeluar' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/suratkeluar', $data);
    }
    public function addsuratkeluar()
    {
        if (isset($_POST['addsuratkeluar'])) {
            $val = $this->validate([
                'tgl_suratkeluar' => 'required',
                'no_suratkeluar' => 'required',
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
                    'suratkeluar' => $this->model->getAllData()
                ];

                $data['suratkeluar'] = $this->model->getdata('suratkeluar')->result();

                echo view('admin/suratkeluar', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadsuratkeluar');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_suratkeluar' => $this->request->getPost('tgl_suratkeluar'),
                    'no_suratkeluar' => $this->request->getPost('no_suratkeluar'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addsuratkeluar($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('suratkeluar'));
                }
            }
        } else {
            return redirect()->to('suratkeluar');
            dd('berhasil');
        }
    }

    public function ubahsuratkeluar()
    {
        if (isset($_POST['ubahsuratkeluar'])) {
            $val = $this->validate([
                'tgl_suratkeluar' => 'required',
                'no_suratkeluar' => 'required',
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
                    'suratkeluar' => $this->model->getAllData()
                ];

                echo view('admin/suratkeluar', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_suratkeluar' => $this->request->getPost('tgl_suratkeluar'),
                    'no_suratkeluar' => $this->request->getPost('no_suratkeluar'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'kode_proyek' => $this->request->getPost('kode_proyek'),
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                ];

                // update data
                $success = $this->model->ubahsuratkeluar($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('suratkeluar'));
                }
            }
        } else {
            return redirect()->to('suratkeluar');
        }
    }


    public function hapussuratkeluar($id)
    {
        $success = $this->model->hapussuratkeluar($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('suratkeluar'));
        }
    }
}
