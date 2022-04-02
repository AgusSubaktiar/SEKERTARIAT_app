<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Penawaran_Model;

class Penawaran extends BaseController
{

    public function __construct()
    {
        $this->model = new Penawaran_Model();
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
            'judul' => 'Data Memo Masuk',
            'penawaran' => $this->model->paginate('10'),
            // 'penawaran' => $this->model->getAllData(),
            'pager' => $this->model->pager
        ];
        echo view('admin/penawaran', $data);
    }
    public function addpenawaran()
    {
        if (isset($_POST['addpenawaran'])) {
            $val = $this->validate([
                'kepada' => 'required',
                'no_penawaran' => 'required',
                'tgl_penawaran' => 'required',
                'uraian' => [
                    'rules' => 'uploaded[uraian]|mime_in[uraian,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip]|max_size[uraian,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ],
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Penawaran')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Dokumen penawaran',
                    'penawaran' => $this->model->getAllData()
                ];

                $data['penawaran'] = $this->model->getdata('penawaran')->result();

                echo view('admin/penawaran', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('uraian');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadpenawaran');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'kepada' => $this->request->getPost('kepada'),
                    'no_penawaran' => $this->request->getPost('no_penawaran'),
                    'tgl_penawaran' => $this->request->getPost('tgl_penawaran'),
                    'uraian' => $namaSampul,
                ];

                $success = $this->model->addpenawaran($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('Penawaran'));
                }
            }
        } else {
            return redirect()->to('Penawaran');
            dd('berhasil');
        }
    }

    public function ubahpenawaran()
    {
        if (isset($_POST['ubahpenawaran'])) {
            $val = $this->validate([
                'kepada' => 'required',
                'no_penawaran' => 'required',
                'tgl_penawaran' => 'required',
                'uraian' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Penawaran')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'penawaran' => $this->model->getAllData()
                ];

                echo view('admin/penawaran', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'kepada' => $this->request->getPost('kepada'),
                    'no_penawaran' => $this->request->getPost('no_penawaran'),
                    'tgl_penawaran' => $this->request->getPost('tgl_penawaran'),
                    'uraian' => $this->request->getPost('uraian')
                ];

                // update data
                $success = $this->model->ubahpenawaran($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('Penawaran'));
                }
            }
        } else {
            return redirect()->to('Penawaran');
        }
    }


    public function hapuspenawaran($id)
    {
        $success = $this->model->hapuspenawaran($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('Penawaran'));
        }
    }

    public function download($var)
    {
        $response = $this->response;;

        $path = 'uploadpenawaran/' . (string)$var;

        echo $path;
        return $response->download($path, null);
    }
}
