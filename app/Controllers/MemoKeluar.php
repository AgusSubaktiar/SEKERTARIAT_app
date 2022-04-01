<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MemoKeluar_Model;

class MemoKeluar extends BaseController
{

    public function __construct()
    {
        $this->model = new MemoKeluar_Model();
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
            'judul' => 'Data Memo Keluar',
            'memokeluar' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/memokeluar', $data);
    }
    public function addmemokeluar()
    {
        if (isset($_POST['addmemokeluar'])) {
            $val = $this->validate([
                'tgl_memokeluar' => 'required',
                'no_memokeluar' => 'required',
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
                return redirect()->to('MemoKeluar')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo Keluar',
                    'memokeluar' => $this->model->getAllData()
                ];

                $data['memokeluar'] = $this->model->getdata('memokeluar')->result();

                echo view('admin/memokeluar', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadmemokeluar');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'tgl_memokeluar' => $this->request->getPost('tgl_memokeluar'),
                    'no_memokeluar' => $this->request->getPost('no_memokeluar'),
                    'dari' => $this->request->getPost('dari'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'ordner' => $namaSampul,
                ];

                $success = $this->model->addmemokeluar($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('MemoKeluar'));
                }
            }
        } else {
            return redirect()->to('MemoKeluar');
            dd('berhasil');
        }
    }

    public function ubahmemokeluar()
    {
        if (isset($_POST['ubahmemokeluar'])) {
            $val = $this->validate([
                'tgl_memokeluar' => 'required',
                'no_memokeluar' => 'required',
                'dari' => 'required',
                'kepada' => 'required',
                'perihal' => 'required',
                'ordner' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('MemoKeluar')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'memokeluar' => $this->model->getAllData()
                ];

                echo view('admin/memokeluar', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'tgl_memokeluar' => $this->request->getPost('tgl_memokeluar'),
                    'no_memokeluar' => $this->request->getPost('no_memokeluar'),
                    'dari' => $this->request->getPost('dari'),
                    'kepada' => $this->request->getPost('kepada'),
                    'perihal' => $this->request->getPost('perihal'),
                    'ordner' => $this->request->getPost('ordner')
                ];

                // update data
                $success = $this->model->ubahmemokeluar($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('MemoKeluar'));
                }
            }
        } else {
            return redirect()->to('MemoKeluar');
        }
    }


    public function hapusmemokeluar($id)
    {
        $success = $this->model->hapusmemokeluar($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('memokeluar'));
        }
    }
    public function download($var)
    {
        $response = $this->response;;

        $path = 'uploadmemokeluar/' . (string)$var;

        echo $path;
        return $response->download($path, null);
    }
}
