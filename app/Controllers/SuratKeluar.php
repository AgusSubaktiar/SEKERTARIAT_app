<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SuratK_Model;
use TCPDF;

class SuratKeluar extends BaseController
{

    public function __construct()
    {
        $this->model = new SuratK_Model();
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
            'surat_keluar' => $this->model->paginate('5'),
            'pager' => $this->model->pager
        ];
        echo view('admin/suratk_view', $data);
    }
    public function addSuratsk()
    {
        if (isset($_POST['addSuratsk'])) {
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
                    'surat_keluar' => $this->model->getAllData()
                ];

                $data['surat_keluar'] = $this->model->getdata('suratkeluar')->result();

                echo view('admin/suratk_view', $data);
            } else {
                // Ambil file
                $fileSampul = $this->request->getFile('ordner');
                // pindahkan file ke folder upload
                $fileSampul->move('uploadsk');
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

                $success = $this->model->addSuratsk($data);
                if ($success) {
                    session()->setFlashdata('message', ' Ditambahkan');
                    return redirect()->to(base_url('Suratkeluar'));
                }
            }
        } else {
            return redirect()->to('Suratkeluar');
            dd('berhasil');
        }
    }

    public function ubahsk()
    {
        if (isset($_POST['ubahsk'])) {
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
                    'judul' => 'Data Surat keluar',
                    'surat_keluar' => $this->model->getAllData()
                ];

                echo view('admin/suratk_view', $data);
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
                $success = $this->model->ubahsk($data, $id);
                if ($success) {
                    session()->setFlashdata('message', ' Diubah');
                    return redirect()->to(base_url('SuratKeluar'));
                }
            }
        } else {
            return redirect()->to('SuratKeluar');
        }
    }


    public function hapussk($id)
    {
        $success = $this->model->hapussk($id);
        if ($success) {
            session()->setFlashdata('message', ' Dihapus');
            return redirect()->to(base_url('SuratKeluar'));
        }
    }

    public function cetak()
    {
        $id = $this->request->uri->getSegment(1);

        $this->model = new SuratK_Model();
        $surat = $this->model->find($id);

        $html = view('admin/cetak', [
            'surat' => $surat,
        ]);

        $pdf = new TCPDF('L', PDF_UNIT, 'A5', true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Dea Venditama');
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->addPage();

        // output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        //line ini penting
        $this->response->setContentType('application/pdf');
        //Close and output PDF document
        $pdf->Output('invoice.pdf', 'I');
    }
}
