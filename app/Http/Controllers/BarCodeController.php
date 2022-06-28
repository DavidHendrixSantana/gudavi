<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;


class BarCodeController extends Controller
{
    public function index($id)
    {
        $person =  Person::find($id);
        return view('pdf.credencial', compact('person'));
    }

    public function printAll(){
        $persons = Person::where('estatus', null)->get();
       
            return view('pdf.credenciales', compact('persons'));
    
    }


    public function credencialT($id)
    {
        $person =  Teacher::find($id);
        return view('pdf.credencial', compact('person'));
    }



}
