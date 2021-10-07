<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Clase;
use App\Models\Day_clase;


class FuncionalController extends Controller
{
    
    public function listado_clases(){
        $Teachers = Teacher::all();
        $Days = Day::all();
        $Clases = Clase::all();
        $Day_clase = Day_clase::all();


        return response()->json([
            'Teachers' => $Teachers ,
            'Days' => $Days ,
            'Clases' => $Clases ,
            'Day_clase' => $Day_clase ,
        ]) ;
    }
    public function listado_teacher(Request $request, $id){
        
        $Days = Day::where('teacher_id', $id)->get();
        $Day_clase = Day_clase::where('day_id', $Days->id)->get();


        return response()->json([
           
            'Days' => $Days ,
            
            'Day_clase' => $Day_clase ,
        ]) ;
    }
}
