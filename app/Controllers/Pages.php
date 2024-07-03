<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function index()
    {
        
        return view('admin/home/index');
    }

    public function karyawan()
    {
        return view('admin/karyawan');
    }
}
