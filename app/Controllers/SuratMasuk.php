<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratMsu_Model;

class SuratMasuk extends BaseController
{

    public function __construct()
    {

        $this->model = new SuratMsu_Model();
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
            'surat_masukus' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/suratm_view', $data);
    }
    public function addSuratmu()
    {
        if (isset($_POST['addSuratmu'])) {
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
                    'judul' => 'Data Surat Keluar',
                    'surat_masukus' => $this->model->getAllData()
                ];

                $data['surat_masukus'] = $this->model->getdata('SuratMasuks')->result();

                echo view('admin/suratm_view', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadmu');
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

                $success = $this->model->addSuratmu($data);
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

    public function ubahm()
    {
        if (isset($_POST['ubahm'])) {
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
                    'surat_masukus' => $this->model->getAllData()
                ];

                echo view('admin/suratm_view', $data);
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
                $success = $this->model->ubahm($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('SuratMasuk'));
                }
            }
        } else {
            return redirect()->to('SuratMasuk');
        }
    }


    public function hapusmu($id)
    {
        $success = $this->model->hapusmu($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('SuratMasuk'));
        }
    }
    function download($id)
    {
        $data = $this->model->find($id);
        return $this->response->download('upload' . $data->upload, null);
    }
}
