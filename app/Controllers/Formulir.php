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
            'judul' => 'Data Formulir',
            'formulir_formulir' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/formulir', $data);
    }
    public function addformulir()
    {
        if (isset($_POST['addformulir'])) {
            $val = $this->validate([
                'nama_dokumen' => 'required',
                'input_oleh' => 'required',
                'waktu_input' => 'required',
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
                    'judul' => 'Data Formulir',
                    'formulir_formulir' => $this->model->getAllData()
                ];

                $data['formulir_formulir'] = $this->model->getdata('formulir_formulir')->result();

                echo view('admin/formulir', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadformulir');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'nama_dokumen' => $this->request->getPost('nama_dokumen'),
                    'input_oleh' => $this->request->getPost('input_oleh'),
                    'waktu_input' => $this->request->getPost('waktu_input'),
                    'ordner' => $namaSampul
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
                'nama_dokumen' => 'required',
                'input_oleh' => 'required',
                'waktu_input' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());

                $data = [
                    'judul' => 'Data Formulir',
                    'formulir_formulir' => $this->model->getAllData()
                ];

                echo view('admin/formulir', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'nama_dokumen' => $this->request->getPost('nama_dokumen'),
                    'input_oleh' => $this->request->getPost('input_oleh'),
                    'waktu_input' => $this->request->getPost('waktu_input'),
                    'ordner' => $this->request->getPost('ordner')
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
        $success = $this->model->hapussk($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('Formulir'));
        }
    }
}
