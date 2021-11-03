<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class PayController extends Controller
{
    public function listar_pago(){
        $pays = History::all();

        return response()->json($pays);
        

    }
}
