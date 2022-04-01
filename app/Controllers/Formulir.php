<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Formulir_Model;

class Formulir extends BaseController
{

    public function __construct()
    {
        $this->model = new Formulir_Model();
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
            'judul' => 'Data Softcopy Formulir',
            'formulir' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/formulir', $data);
    }
    public function addformulir()
    {
        if (isset($_POST['addformulir'])) {
            $val = $this->validate([
                'ordner' => [
                    'rules' => 'uploaded[ordner]|mime_in[ordner,application/pdf,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip]|max_size[ordner,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ],
                'keterangan' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Formulir')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Softcopy Formulir',
                    'formulir' => $this->model->getAllData()
                ];

                $data['formulir'] = $this->model->getdata('formulir')->result();

                echo view('admin/formulir', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadformulir');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'ordner' => $namaSampul,
                    'keterangan' => $this->request->getPost('keterangan')
                ];

                $success = $this->model->addformulir($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('Formulir'));
                }
            }
        } else {
            return redirect()->to('Formulir');
            dd('berhasil');
        }
    }

    public function ubahformulir()
    {
        if (isset($_POST['ubahformulir'])) {
            $val = $this->validate([
                'ordner' => 'required',
                'keterangan' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Formulir')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Softcopy Formulir',
                    'formulir' => $this->model->getAllData()
                ];

                echo view('admin/formulir', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'ordner' => $this->request->getPost('ordner'),
                    'keterangan' => $this->request->getPost('keterangan')
                ];

                // update data
                $success = $this->model->ubahformulir($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('Formulir'));
                }
            }
        } else {
            return redirect()->to('Formulir');
        }
    }


    public function hapusformulir($id)
    {
        $success = $this->model->hapusformulir($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('Formulir'));
        }
    }
    public function download($var)
    {
        $response = $this->response;;

        $path = 'uploadformulir/' . (string)$var;

        echo $path;
        return $response->download($path, null);
    }
}
