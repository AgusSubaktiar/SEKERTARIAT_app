<?php

namespace App\Controllers;

use App\Models\HomeAdmin_Modal;

class Home extends BaseController
{
    public function __construct()
    {
        $this->modal = new HomeAdmin_Modal();
    }

    public function index()
    {

        $data = [];

        return view('admin/home', $data);
    }
}
