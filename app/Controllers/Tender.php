<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Tender_Model;

class Tender extends BaseController
{

    public function __construct()
    {
        $this->model = new Tender_Model();
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
            'tender' => $this->model->paginate('10'),
            'pager' => $this->model->pager
        ];
        echo view('admin/tender', $data);
    }
    public function addtender()
    {
        if (isset($_POST['addtender'])) {
            $val = $this->validate([
                'nama_proyek' => 'required',
                'tgl_tender' => 'required',
                'filetender' => [
                    'rules' => 'uploaded[filetender]|mime_in[filetender,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip]|max_size[filetender,10000]',
                    'errors' => [
                        'uploaded' => 'Pilih file terlebih dahulu',
                        'max_size' => 'Ukuran file terlalu besar',
                        'mime_in' => 'File anda salah'
                    ]
                ],
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Tender')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Dokumen tender',
                    'tender' => $this->model->getAllData()
                ];

                $data['tender'] = $this->model->getdata('tender')->result();

                echo view('admin/tender', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('filetender');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadtender');
                // ambil nama file 
                $namaSampul = $fileSampul->getName();

                $data  = [
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tgl_tender' => $this->request->getPost('tgl_tender'),
                    'filetender' => $namaSampul,
                ];

                $success = $this->model->addtender($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('Tender'));
                }
            }
        } else {
            return redirect()->to('Tender');
            dd('berhasil');
        }
    }

    public function ubahtender()
    {
        if (isset($_POST['ubahtender'])) {
            $val = $this->validate([
                'nama_proyek' => 'required',
                'tgl_tender' => 'required',
                'filetender' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('tender')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'tender' => $this->model->getAllData()
                ];

                echo view('admin/tender', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'nama_proyek' => $this->request->getPost('nama_proyek'),
                    'tgl_tender' => $this->request->getPost('tgl_tender'),
                    'filetender' => $this->request->getPost('filetender')
                ];

                // update data
                $success = $this->model->ubahtender($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('Tender'));
                }
            }
        } else {
            return redirect()->to('Tender');
        }
    }


    public function hapustender($id)
    {
        $success = $this->model->hapustender($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('Tender'));
        }
    }

    public function download($var)
    {
        $response = $this->response;;

        $path = 'uploadtender/' . (string)$var;

        echo $path;
        return $response->download($path, null);
    }
}
