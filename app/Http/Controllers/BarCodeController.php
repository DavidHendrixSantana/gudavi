<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;


class BarCodeController extends Controller
{
    public function index($id)
    {
        $person =  Person::find($id);
        return view('pdf.credencial', compact('person'));
    }
}
