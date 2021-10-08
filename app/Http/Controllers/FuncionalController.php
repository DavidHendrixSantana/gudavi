<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;
use App\Models\Teacher;
use App\Models\Day;
use App\Models\Clase;
use App\Models\Day_clase;
use App\Models\Days_teachers;
use Illuminate\Support\Facades\DB;


class FuncionalController extends Controller
{
    
    public function listado_clases(){
        $get_last_teacher = DB::select('select Min(id) as id from teachers');
        $last_teacher=  $get_last_teacher[0]->id;
        $Teachers =Teacher::all();
        $Days= DB::select('select Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        


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
