<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratKeputusan_Model;

class SuratKeputusan extends BaseController
{

    public function __construct()
    {
        $this->model = new SuratKeputusan_Model();
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
            'judul' => 'Data Surat Keputusan',
            'surat_keputusan' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/suratkeputusan', $data);
    }
    public function addsurat_keputusan()
    {
        if (isset($_POST['addsurat_keputusan'])) {
            $val = $this->validate([
                'no_sk' => 'required',
                'tgl_sk' => 'required',
                'kepada' => 'required',
                'ordner' => [
                    'rules' => 'uploaded[ordner]|mime_in[ordner,application/pdf]|max_size[ordner,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ],
                'upload_sk' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('SuratKeputusan')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'surat_keputusan' => $this->model->getAllData()
                ];

                $data['surat_keputusan'] = $this->model->getdata('surat_keputusan')->result();

                echo view('admin/suratkeputusan', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadsuratKeputusan');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'no_sk' => $this->request->getPost('no_sk'),
                    'tgl_sk' => $this->request->getPost('tgl_sk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'ordner' => $namaSampul,
                    'upload_sk' => $this->request->getPost('upload_sk')
                ];

                $success = $this->model->addsurat_keputusan($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('SuratKeputusan'));
                }
            }
        } else {
            return redirect()->to('SuratKeputusan');
            dd('berhasil');
        }
    }

    public function ubahsurat_keputusan()
    {
        if (isset($_POST['ubahsurat_keputusan'])) {
            $val = $this->validate([
                'no_sk' => 'required',
                'tgl_sk' => 'required',
                'kepada' => 'required',
                'ordner' => 'required',
                'upload_sk' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('SuratKeputusan')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'surat_keputusan' => $this->model->getAllData()
                ];

                echo view('admin/suratkeputusan', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'no_sk' => $this->request->getPost('no_sk'),
                    'tgl_sk' => $this->request->getPost('tgl_sk'),
                    'kepada' => $this->request->getPost('kepada'),
                    'ordner' => $this->request->getPost('ordner'),
                    'upload_sk' => $this->request->getPost('upload_sk')
                ];

                // update data
                $success = $this->model->ubahsurat_keputusan($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('SuratKeputusan'));
                }
            }
        } else {
            return redirect()->to('SuratKeputusan');
        }
    }


    public function hapussurat_keputusan($id)
    {
        $success = $this->model->hapusmemo($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('SuratKeputusan'));
        }
    }
}
