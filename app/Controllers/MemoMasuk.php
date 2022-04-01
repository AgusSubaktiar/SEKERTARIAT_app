<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemoMasuk_Model;

class MemoMasuk extends BaseController
{

    public function __construct()
    {
        $this->model = new MemoMasuk_Model();
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
            'memomasuk' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/memomasuk', $data);
    }
    public function addmemomasuk()
    {
        if (isset($_POST['addmemomasuk'])) {
            $val = $this->validate([
                'tgl_memomasuk' => 'required',
                'no_memo' => 'required',
                'dari' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
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
                return redirect()->to('MemoMasuk')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo Masuk',
                    'memomasuk' => $this->model->getAllData()
                ];

                $data['memomasuk'] = $this->model->getdata('memomasuk')->result();

                echo view('admin/memomasuk', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadmemomasuk');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_memomasuk' => $this->request->getPost('tgl_memomasuk'),
                    'no_memo' => $this->request->getPost('no_memo'),
                    'dari' => $this->request->getPost('dari'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addmemomasuk($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('MemoMasuk'));
                }
            }
        } else {
            return redirect()->to('MemoMasuk');
            dd('berhasil');
        }
    }

    public function ubahmemomasuk()
    {
        if (isset($_POST['ubahmemomasuk'])) {
            $val = $this->validate([
                'tgl_memomasuk' => 'required',
                'no_memo' => 'required',
                'dari' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('MemoMasuk')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'memomasuk' => $this->model->getAllData()
                ];

                echo view('admin/memomasuk', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_memomasuk' => $this->request->getPost('tgl_memomasuk'),
                    'no_memo' => $this->request->getPost('no_memo'),
                    'dari' => $this->request->getPost('dari'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'ordner' => $this->request->getPost('ordner')
                ];

                // update data
                $success = $this->model->ubahmemomasuk($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('MemoMasuk'));
                }
            }
        } else {
            return redirect()->to('MemoMasuk');
        }
    }


    public function hapusmemomasuk($id)
    {
        $success = $this->model->hapusmemomasuk($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('MemoMasuk'));
        }
    }
}
