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
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        for($x=0; $x<$number_of_days; $x++){

            $id_day = $Days[$x]->id;
            $Classes = DB::select('select classes.id, persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id = ?', [$id_day]);
           
            $Classes_general = DB::select('SELECT Clase from classes');


            for($y=0; $y<count($Classes_general); $y++){
                for($w=0; $w<count($Classes); $w++){

                    if($Classes_general[$y]->Clase == $Classes[$w]->Clase){
                        $Classes_general[$y] = $Classes[$w];
                    }
                    
                    } 
            }
            
            $Days[$x]->Clases = $Classes_general;
        }
        return response()->json([
            'Teachers' => $Teachers ,
            'Days' => $Days ,
        
          
        ]) ;
    }
    public function listado_teacher($id){

      
        $last_teacher=  $id;
        $Days= DB::select('select days_teachers.id, days.Dia from days inner join days_teachers on days.id = days_teachers.day_id where days_teachers.teacher_id=?',[$last_teacher]);
        $number_of_days = count($Days);
        for($x=0; $x<$number_of_days; $x++){
            $id_day = $Days[$x]->id;
            $Classes = DB::select('select classes.id, persons.nombre ,classes.Clase, days_classes.status from classes  inner join days_classes on classes.id = days_classes.class_id INNER JOIN persons ON days_classes.person_id =persons.id WHERE days_classes.day_teacher_id = ?', [$id_day]);
            $Classes_general = DB::select('SELECT Clase from classes');


            for($y=0; $y<count($Classes_general); $y++){
                for($w=0; $w<count($Classes); $w++){

                    if($Classes_general[$y]->Clase == $Classes[$w]->Clase){
                        $Classes_general[$y] = $Classes[$w];
                    }
                    
                    } 
            }
           
            $Days[$x]->Clases = $Classes_general;
            
        }

        return response()->json([
          
            'Days' => $Days ,
        
          
        ]) ;
    }
}