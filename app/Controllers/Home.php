<?php

namespace App\Controllers;

use App\Models\FileModel;
use App\Models\Bidang_admin_model;
use App\Models\Users_Model;
use App\Models\DataBidang_Model;
use App\Models\DisposisiModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->fileModel = new FileModel();
    }

    public function index()
    {
        $model = new Bidang_admin_model;
        $modelUser = new Users_Model;
        $modelDataBidang = new DataBidang_Model;
        $suratMasuk = new DisposisiModel();
        $session = session()->get();

        $data = [
            'judul' => 'Home',
            'validation' => \Config\Services::validation(),
            'getNamaBidang' => $model->getNamaBidang(),
            'getUser0' => $modelUser->getUserModel(),
            'getBidangData' => $modelDataBidang->getDataBidang(),
            'suratByBidang' => $suratMasuk->getSuratMasukByBidang($session['id_bidang']),
            'disposisi' => $suratMasuk->getAllData()
        ];
        return view('admin/home', $data);
    }

    public function upload()
    {
        $modelUpload = new FileModel();


        $validation = $this->validate([
            'files' => 'uploaded[files]|mime_in[files,text/csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/pdf,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/zip]'
        ]);
        if ($validation == false) {
            session()->setFlashdata('uploadItem', 'Silahkan pilih data yang akan di upload dengan format csv atau xlsx');
            return redirect()->to('/Home');
        } else {
            $file = $this->request->getFile('files');
            $file->move('uploads');
            $nameFile = $file->getName();
            $date = date("Y/m/d");

            $data = array(
                'nama_file' => $nameFile,
                'tanggal_upload' => $date,
                'data_bidang_id' => $this->request->getPost('idHome'),
                'status' => 1,
                'nama_bidang_id' => session()->get('id_bidang'),
            );

            $modelUpload->saveFile($data);
            return redirect()->to('/Home');
        }
    }

    public function download($var)
    {
        $response = $this->response;;

        $path = 'uploads/' . (string)$var;

        echo $path;
        return $response->download($path, null);
    }

    public function editFile($id)
    {
        $model = new FileModel;
        $nameFile = $model->find($id);
        // echo $nameFile['nama_file'];
        unlink('uploads/' . $nameFile['nama_file']);

        $file = $this->request->getFile('editFiles');
        $file->move('uploads');
        $fileName = $file->getName();
        // 	// unlink('uploads/8.png');
        $object = array(
            'id' => $id,
            'nama_file' => $fileName,
            'tanggal_upload' => date('Y/m/d'),
            'data_bidang_id' => $this->request->getPost('nameRevisi'),
            'status' => 1,
            'review' => " ",
        );

        $model->editFile($object);

        return redirect()->to('/Home');
    }
}
