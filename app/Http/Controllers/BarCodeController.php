<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BarCodeController extends Controller
{
    public function index()
    {
        return view('pdf.credencial');
    }
}
