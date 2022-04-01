<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Perizinan_Model;

class Perizinan extends BaseController
{

    public function __construct()
    {
        $this->model = new Perizinan_Model();
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
            'perizinan' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/perizinan', $data);
    }
    public function addperizinan()
    {
        if (isset($_POST['addperizinan'])) {
            $val = $this->validate([
                'nama' => 'required',
                'tgl_perizinan' => 'required',
                'no_perizinan' => 'required',
                'perihal' => 'required',
                'masaberlaku' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Perizinan')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'perizinan' => $this->model->getAllData()
                ];

                $data['perizinan'] = $this->model->getdata('perizinan')->result();

                echo view('admin/perizinan', $data);
            } else {


                $data  = [
                    'nama' => $this->request->getPost('nama'),
                    'tgl_perizinan' => $this->request->getPost('tgl_perizinan'),
                    'no_perizinan' => $this->request->getPost('no_perizinan'),
                    'perihal' => $this->request->getPost('perihal'),
                    'masaberlaku' => $this->request->getPost('masaberlaku')
                ];

                $success = $this->model->addperizinan($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('Perizinan'));
                }
            }
        } else {
            return redirect()->to('Perizinan');
            dd('berhasil');
        }
    }

    public function ubahperizinan()
    {
        if (isset($_POST['ubahperizinan'])) {
            $val = $this->validate([
                'nama' => 'required',
                'tgl_perizinan' => 'required',
                'no_perizinan' => 'required',
                'perihal' => 'required',
                'masaberlaku' => 'required'
            ]);

            if (!$val) {

                session()->setFlashdata('err', \Config\Services::validation()->listErrors());
                return redirect()->to('Perizinan')->withInput()->with('validation', $val);

                $data = [
                    'judul' => 'Data Memo',
                    'perizinan' => $this->model->getAllData()
                ];

                echo view('admin/perizinan', $data);
            } else {
                $id = $this->request->getPost('id');

                $data  = [
                    'nama' => $this->request->getPost('nama'),
                    'tgl_perizinan' => $this->request->getPost('tgl_perizinan'),
                    'no_perizinan' => $this->request->getPost('no_perizinan'),
                    'perihal' => $this->request->getPost('perihal'),
                    'masaberlaku' => $this->request->getPost('masaberlaku')
                ];

                // update data
                $success = $this->model->ubahperizinan($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('Perizinan'));
                }
            }
        } else {
            return redirect()->to('Perizinan');
        }
    }


    public function hapusperizinan($id)
    {
        $success = $this->model->hapusperizinan($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('Perizinan'));
        }
    }
}
