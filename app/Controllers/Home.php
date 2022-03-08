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

        $data = [
            'tot_suratm' => $this->modal->tot_suratm(),
            'tot_suratk' => $this->modal->tot_suratk()
        ];

        return view('admin/home', $data);
    }
}
